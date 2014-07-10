<?php

class Pay_It_Easy_paymentgateway extends Pay_It_Easy_paymentgateway_parent {
	/*
	 * Array of all payment method IDs belonging
	*
	* @var array
	*/
	protected $_aPaymentTypes = array(
			'Pay_It_Easy_CC','Pay_It_Easy_DD','Pay_It_Easy_GP','Pay_It_Easy_PP'
	);


	/**
	 * Overrides standard oxid finalizeOrder method if the used payment method belongs to PAYONE.
	 * Return parent's return if payment method is no PAYONE method
	 *
	 * Executes payment, returns true on success.
	 *
	 * @param double $dAmount Goods amount
	 * @param object &$oOrder User ordering object
	 *
	 * @extend executePayment
	 * @return bool
	 */
	public function executePayment( $dAmount, &$oOrder ) {

			// Use standard method if payment type does not belong to PAYONE
		if(in_array($oOrder->oxorder__oxpaymenttype->value, $this->_aPaymentTypes) === false) {
			return parent::executePayment($dAmount, $oOrder);
		}

		$aDynvalue = oxSession::getVar( 'dynvalue' );
		$aDynvalue = $aDynvalue ? $aDynvalue : oxConfig::getParameter( 'dynvalue' );

		$this->_iLastErrorNo = null;
		$this->_sLastError = null;


		$oPayment = oxNew('oxpayment');
		$oPayment->load($oOrder->oxorder__oxpaymenttype->value);
		$sAuthorizationType = '';
		$oOrder->save();

		if(!empty($oOrder->oxorder__oxordernr->value)) {
			$iRefNr = $oOrder->oxorder__oxordernr->value;
		}

		oxSession::setVar('Pay_It_EasyRefNr', $iRefNr);

		include_once 'Pay_It_EasyConfig.php';

		$config= new Pay_It_EasyConfig($oOrder);

		$secret=$config->getSecret();

		// build amount
		$amount =$config->getAmount();
		$config->getCustomer_addr_city();
		$prefix='';

		// seems unnecessary but for v3,v4 etc. this should sty here
		if (oxSession::getVar('Pay_It_Easy_transaction_token')) {
			$prefix = oxSession::getVar('Pay_It_Easy_transaction_token');
		} else {
			$this->getSession()->setVar("Pay_It_Easy_error", "No transaction code was provided");
			return 'payment';
		}

		$config->setPrefix($prefix);

		include_once 'core/Pay_It_EasyCore.php';
		$helper=new Pay_It_EasyCore();
		// process the payment
		oxSession::setVar( 'Pay_It_Easy_redirect_data', $helper->getTransactionParams($config));
		oxSession::setVar( 'Pay_It_Easy_redirect_url', $helper->getPaymentGatewayURL($config));
		oxSession::setVar( 'Pay_It_Easy_redirect_form', $helper->getTransactionRedirect($config));

		$sRedirect_url = $this->getConfig()->getSslShopUrl().'index.php?cl=Pay_It_Easy_redirect';
		return oxUtils::getInstance()->redirect($sRedirect_url);
	}



}