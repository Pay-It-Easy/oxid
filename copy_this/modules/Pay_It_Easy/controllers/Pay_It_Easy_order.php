<?php
class Pay_It_Easy_order extends Pay_It_Easy_order_parent {

	/*
	 * Array of all payment method IDs belonging @var array
	 */
	protected $_aPaymentTypes = array (
			'Pay_It_Easy_CC',
			'Pay_It_Easy_DD',
			'Pay_It_Easy_GP',
			'Pay_It_Easy_PP'
	);
	protected $_blIsRedirectAfterSave;

	/**
	 * Returns true if this request is the return to the shop from a payment provider where the user has been redirected to
	 *
	 * @return bool
	 */
	protected function _isRedirectAfterSave() {
		if ($this->_blIsRedirectAfterSave === null) {
			$this->_blIsRedirectAfterSave = false;
			if (oxConfig::getParameter ( 'status' ) && oxConfig::getParameter ( 'refnr' )) {
				$this->_blIsRedirectAfterSave = true;
			}
		}
		return $this->_blIsRedirectAfterSave;
	}

	/**
	 * @overload
	 */
	protected function _getNextStep($orderState) {
		$order = oxNew ( 'oxorder' );
		$order->load ( oxSession::getVar ( 'sess_challenge' ) );

		if (! $order->isLoaded ()) {
			return parent::_getNextStep ( $orderState );
		}

		// check if order is Pay_It_Easy order
		if (in_array ( $oBasket->getPaymentId (), $this->_aPaymentTypes ) === false) {
			return parent::_getNextStep ( $orderState );
		} else {

			$this->getSession ()->setVar ( "Pay_It_Easy_error", "Payment could not be processed" );
			return 'payment';
		}
	}


	public function finalizeOrder(oxBasket $oBasket, $oUser, $blRecalculatingOrder = false) {

		// Use standard method if payment type does not belong to PAYONE
		if (in_array ( $oBasket->getPaymentId (), $this->_aPaymentTypes ) === false) {
			return parent::finalizeOrder ( $oBasket, $oUser, $blRecalculatingOrder );
		}

		$blSaveAfterRedirect = $this->_isRedirectAfterSave ();

		// check if this order is already stored
		$sGetChallenge = oxSession::getVar ( 'sess_challenge' );
		if ($this->_checkOrderExist ( $sGetChallenge ) && ! $blSaveAfterRedirect) {
			oxRegistry::getUtils ()->logger ( 'BLOCKER' );
			// we might use this later, this means that somebody klicked like mad on order button
			return self::ORDER_STATE_ORDEREXISTS;
		}

		// if not recalculating order, use sess_challenge id, else leave old order id
		if (! $blRecalculatingOrder && ! $blSaveAfterRedirect) {
			// use this ID
			$this->setId ( $sGetChallenge );

			// validating various order/basket parameters before finalizing
			if ($iOrderState = $this->validateOrder ( $oBasket, $oUser )) {
				return $iOrderState;
			}
		}

		// copies user info
		$this->_setUser ( $oUser );

		// copies basket info
		$this->_loadFromBasket ( $oBasket );

		// payment information
		$oUserPayment = $this->_setPayment ( $oBasket->getPaymentId () );

		// set folder information, if order is new
		// #M575 in recalcualting order case folder must be the same as it was
		if (! $blRecalculatingOrder) {
			$this->_setFolder ();
		}

		if ($blSaveAfterRedirect === true) {
			$iSessRefNr = oxSession::getVar ( 'Pay_It_EasyRefNr' );

			if (oxConfig::getParameter ( 'refnr' ) != $iSessRefNr) {
				$oLang = oxLang::getInstance ();
				oxSession::deleteVar ( 'Pay_It_EasyRefNr' );
				return self::ORDER_STATE_ORDEREXISTS;
			} else {
				if (oxConfig::getParameter ( 'status' ) == 'canceld') {
					$lang = oxLang::getInstance ()->getLanguageAbbr ();
					$oOrder = oxNew ( 'oxorder' );
					$oOrder->load ( oxSession::getVar ( 'sess_challenge' ) );
					$oOrder->cancelOrder ();
					//$oBasket->deleteBasket ();
					oxSession::deleteVar ( 'sess_challenge' );
					oxSession::deleteVar ( 'refnr' );
					oxSession::deleteVar ( 'Pay_It_EasyRefNr' );
					return self::ORDER_STATE_PAYMENTERROR;
				} else if (oxConfig::getParameter ( 'status' ) == 'error') {
					$oOrder = oxNew ( 'oxorder' );
					$oOrder->load ( oxSession::getVar ( 'sess_challenge' ) );
					$oOrder->cancelOrder();
					//$oBasket->deleteBasket ();
					oxSession::deleteVar ( 'sess_challenge' );
					oxSession::deleteVar ( 'refnr' );
					oxSession::deleteVar ( 'Pay_It_EasyRefNr' );
					$iRet = self::ORDER_STATE_PAYMENTERROR;
				} else {
					// executing TS protection
					if (! $blRecalculatingOrder && $oBasket->getTsProductId ()) {
						$blRet = $this->_executeTsProtection ( $oBasket );
						if ($blRet !== true) {
							return $blRet;
						}
					}
					$this->oxorder__oxordernr = new oxField( oxConfig::getParameter ( 'refnr' ) );
					//$this->oxorder__oxordernr->value = oxConfig::getParameter ( 'refnr' );

					// deleting remark info only when order is finished
					oxSession::deleteVar ( 'ordrem' );
					oxSession::deleteVar ( 'stsprotection' );

					// store orderid
					$oBasket->setOrderId ( $this->getId () );

					// updating wish lists
					$this->_updateWishlist ( $oBasket->getContents (), $oUser );

					// updating users notice list
					$this->_updateNoticeList ( $oBasket->getContents (), $oUser );

					// marking vouchers as used and sets them to $this->_aVoucherList (will be used in order email)
					// skipping this action in case of order recalculation
					if (! $blRecalculatingOrder) {
						$this->_markVouchers ( $oBasket, $oUser );
					}

					// send order by email to shop owner and current user
					// skipping this action in case of order recalculation
					if (! $blRecalculatingOrder) {
						$iRet = $this->_sendOrderByEmail ( $oUser, $oBasket, $oUserPayment );
					} else {
						$iRet = self::ORDER_STATE_OK;
					}
				}

				return $iRet;
			}
		} else {
			// executing payment (on failure deletes order and returns error code)
			// in case when recalcualting order, payment execution is skipped

			// marking as not finished
			$this->_setOrderStatus ( 'NOT_FINISHED' );

			if (! $blRecalculatingOrder) {
				$blRet = $this->_executePayment ( $oBasket, $oUserPayment );
				if ($blRet !== true) {
					return $blRet;
				}
			}
		}
	}

	/**
	 * Overrides standard oxid _insert method
	 *
	 * Inserts order object information in DB. Returns true on success.
	 *
	 * @return bool
	 */
	protected function _insert() {
		$myConfig = $this->getConfig ();
		$oUtilsDate = oxUtilsDate::getInstance ();

		// V #M525 orderdate must be the same as it was
		if (! $this->oxorder__oxorderdate->value) {
			$this->oxorder__oxorderdate = new oxField ( date ( 'Y-m-d H:i:s', $oUtilsDate->getTime () ), oxField::T_RAW );
		} else {
			$this->oxorder__oxorderdate = new oxField ( $oUtilsDate->formatDBDate ( $this->oxorder__oxorderdate->value, true ) );
		}

		$this->oxorder__oxshopid = new oxField ( $myConfig->getShopId (), oxField::T_RAW );
		$this->oxorder__oxsenddate = new oxField ( $oUtilsDate->formatDBDate ( $this->oxorder__oxsenddate->value, true ) );

		if (($blInsert = parent::_insert ())) {
			// setting order number
			if (! $this->oxorder__oxordernr->value) {
				$blInsert = $this->_setNumber ();
			} else {
				oxNew ( 'oxCounter' )->update ( $this->_getCounterIdent (), $this->oxorder__oxordernr->value );
			}
		}
		return $blInsert;
	}
}