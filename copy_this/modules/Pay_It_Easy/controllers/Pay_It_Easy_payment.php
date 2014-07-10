<?php

class Pay_It_Easy_payment extends Pay_It_Easy_payment_parent
{
	/**
	 * @overload
	 */
	public function validatePayment()
	{

		// payment selected by user
		$paymentId = oxConfig::getParameter('paymentid');
		$parentResult = parent::validatePayment();

		oxSession::setVar('Pay_It_Easy_transaction_token', '');


		// handle Pay_It_Easy payment
		if ($paymentId == "Pay_It_Easy_CC") {
			oxSession::setVar('Pay_It_Easy_transaction_token', 'CC');
		} else
			if ($paymentId == "Pay_It_Easy_DD") {
			oxSession::setVar('Pay_It_Easy_transaction_token', 'DD');
		} else if ($paymentId == "Pay_It_Easy_GP") {
			oxSession::setVar('Pay_It_Easy_transaction_token', 'GP');
		} else if ($paymentId == "Pay_It_Easy_PP") {
			oxSession::setVar('Pay_It_Easy_transaction_token', 'PP');
		}

		return $parentResult;
	}

}