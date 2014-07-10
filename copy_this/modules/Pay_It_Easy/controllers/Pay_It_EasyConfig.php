<?php
class Pay_It_EasyConfig{

	var $order;
	var $prefix;
	var $logger;
	var $oBasket;

	function __construct($order=array(),$oBasket=''){
		$this->order=$order;
		$this->oBasket=$oBasket;
		include_once 'core/simpleLogger.php';

		$this->logger =new simpleLogger();
	}

	function getValueforKey($key){
		$tmp='PIE_'.$key;
		return oxConfig::getInstance()->getShopConfVar($tmp);
	}


	function getSSLMerchant(){
		return $this->getValueforKey('sslmerchant');
	}


	function getTransactiontype(){
		return $this->getValueforKey('transactiontype');
	}

	function getCssurl(){
		return $this->getValueforKey('cssurl');

	}

	function isLiveMode(){
		if($this->prefix=='CC' && $this->getValueforKey('test_mode_CC')=='yes')
			return false;
		if($this->prefix=='DD' && $this->getValueforKey('test_mode_DD')=='yes')
			return false;
		if($this->prefix=='GP' && $this->getValueforKey('test_mode_GP')=='yes')
			return false;
		if($this->prefix=='PP' && $this->getValueforKey('test_mode_PP')=='yes')
			return false;

		return true;

	}

	function getSecret(){
		if($this->getValueforKey('secret')=='')
			return '';
		return $this->getValueforKey('secret');
	}

	function getPrefix(){
		return $this->prefix;
	}

	function setPrefix($prefix){
		$this->prefix=$prefix;
	}

	function getLoggerLevel(){
		if($this->getValueforKey('debug')=='')
			return 'NONE';
		else
			return strtoupper($this->getValueforKey('debug'));
	}


	/**
	 * Enter description here ...
	 */
	function getOrderid(){
		if($this->order)
			return  $this->order->oxorder__oxordernr->value;
		else
			return '';
	}

	function getPaymentMethod(){

		switch ($this->prefix)
		{
			case 'CC' :
				$this->paymentMethod='creditcard';
				break;
			case 'DD' :
				$this->paymentMethod='directdebit';
				break;
			case 'GP' :
				$this->paymentMethod='banktransfer';
				break;
			case 'PP':
				$this->paymentMethod='paypal';
				break;
		}

		return $this->paymentMethod;
	}

	/**
	 * Enter description here ...
	 */
	function getLocale(){
		$lang = oxLang::getInstance()->getLanguageAbbr();
		$str = strtolower($lang);
		if(strlen($str)<2)
		return "de";
		else
		return substr($str,0,2);
	}

	/**
	 * Enter description here ...
	 */
	function getBasketid(){
		///qqq get the basketid
		return $this->getPrefix().'_'.oxSession::getInstance()->getSessionChallengeToken();
	}

	private function getChallengeToken(){
		if($_REQUEST['basketid']){
			preg_match('/(.+)_(.+)/', $_POST['basketid'], $m);
			return $m[2];
		}

		return '';
	}

	private function formatAmount($amount){
		// set the amount
		$tstr = number_format($amount, 2, ',', '');
		//$tstr = str_replace('.',',',$amount);
		$tstr = substr( $tstr, 0,strpos($tstr,',')+3);
		//$this->logDebug(sprintf('setAmount: %d',$tstr));
		return $tstr;
	}

	function getAmount(){

		return $this->formatAmount(oxSession::getInstance()->getBasket()->getPrice()->getBruttoPrice());

// 		if($this->prefix=='CC' && !$this->isLiveMode()){
// 			return "1,00";
// 		}
// 		else{
// 			return $this->formatAmount(oxSession::getInstance()->getBasket()->getPrice()->getBruttoPrice());
// 		}
	}

	function getAcceptcountries(){
		return $this->getValueforKey('acceptcountries');
	}

	function getPayment_options() {
		return $this->getValueforKey('paymentoptions_'.$this->prefix);
	}


	function getRejectcountries(){
		return $this->getValueforKey('rejectcountries');
	}

	function getCustomer_addr_city(){
		if ($this->order) // Redirect to payment failed page
			return $this->order->oxorder__oxbillcity->value;
		return '';
	}

	function getCustomer_addr_street(){
		if ($this->order) // Redirect to payment failed page
			return $this->order->oxorder__oxbillstreet->value;
		return '';

	}
	function getCustomer_addr_zip(){
		if ($this->order) // Redirect to payment failed page
			return $this->order->oxorder__oxbillzip->value;
		return '';
	}
	function getCustomer_addr_number(){
		if ($this->order) // Redirect to payment failed page
			return $this->order->oxorder__oxbillstreetnr->value;
		return '';
	}

	function getDeliverycountry(){
		if ($this->order) // Redirect to payment failed page
			return $this->order->getDelCountry();
		return '';
	}


	/**
	 * Enter description here ...
	 */
	function getCurrency(){
		if ($this->order) // Redirect to payment failed page
			return $this->order->oxorder__oxcurrency->value;
		return '';

	}
	/**
	 * Enter description here ...
	 */
	function getSessionid(){
		return oxSession::getInstance()->getId();
	}

	/**
	 * Enter description here ...
	 */
	function getNotifyurl(){
		return '';// $router->assemble(array('action' => 'notify','forceSecure' => true)) .'?orderId=' . $this->getOrderid();
	}
	/**
	 * Enter description here ...
	 */
	function getNotificationfailedurl(){
		return '';//$router->assemble(array('action' => 'notify','forceSecure' => true)) .'?orderId=' . $this->getOrderid();
	}



	function getLoggerFileName(){
		if($this->getValueforKey('logger_file_name'))
			$this->getValueforKey('logger_file_name');
		else
			return '';
	}

	/**
	 * @param unknown $param
	 */
	function logDebug($param){
		$this->logger->debug("".$param);
	}

	/**
	 * @param unknown $param
	 */
	function logTransaction($param){
		$this->logger->info("".$param);
	}

	/**
	 * @param unknown $param
	 */
	function logError($param){
		$this->logger->error("".$param);

	}

	function getPaymentGatewayURL(){
		return '';
	}

	/**
	 * @return Ambigous <mixed, NULL>
	 */
	function getForm_label_submit(){
		$value=Pay_It_EasyCore::translateKey('FORM_LABEL_SUBMIT',$this->getLocale());
		$value=trim($value);

		if(Pay_It_EasyCore::notEmpty($value))
			return $value;
		return '';
	}

	/**
	 * Enter description here ...
	 * @return Ambigous <NULL, mixed>
	 */
	function getDeliverycountryrejectmessage(){
		$value=Pay_It_EasyCore::translateKey('DELIVERYCOUNTRY_REJECT_MESSAGE',$this->getLocale());
		$value=trim($value);

		if(Pay_It_EasyCore::notEmpty($value))
			return $value;
		return '';
	}

	/**
	 * Enter description here ...
	 * @return Ambigous <NULL, mixed>
	 */
	function getForm_merchantref(){
		return $this->getValueforKey('form_merchantref');
	}

	/**
	 * Enter description here ...
	 * @return Ambigous <NULL, mixed>
	 */
	function getForm_label_cancel(){
		$value=Pay_It_EasyCore::translateKey('FORM_LABEL_CANCEL',$this->getLocale());
		$value=trim($value);

		if(Pay_It_EasyCore::notEmpty($value))
			return $value;
		return '';
	}

	/**
	 * Enter description here ...
	 * @return Ambigous <NULL, mixed>
	 */
	function  getDeliverycountryaction(){
		return $this->getValueforKey('deliverycountry_action_CC');
	}


	/**
	 * Enter description here ...
	 * @return Ambigous <NULL, mixed>
	 */
	function getAutocapture(){
		if('CC'==$this->prefix)
			return $this->getValueforKey('autocapture_CC');
		if('DD'==$this->prefix)
			return $this->getValueforKey('autocapture_DD');
		else
			return '';
	}

	/**
	 * Enter description here ...
	 * @return Ambigous <NULL, mixed>
	 */
	function getCountryrejectmessage(){
		return Pay_It_EasyCore::translateKey('COUNTRYREJECTMESSAGE');
	}

	/**
	 * Enter description here ...
	 * @return Ambigous <NULL, mixed>
	 */
	function getForm_merchantname(){
		return $this->getValueforKey('form_merchantname');
	}


	public function getAccountnumber(){
		'';
	}

	public function getBankcode(){
		if($this->isLiveMode())
			return '';
		else{
			return '12345679';
		}
	}

	function getBic(){
		if($this->isLiveMode())
		return '';
		else
		return 'TESTDETT421';
	}

	function getIban(){
		return '';
	}

	function getMandateid() {
		return $this->getValueforKey('mandateprefix').'-'.$this->getOrderid();
	}
	function getMandatename() {
		return $this->getValueforKey('mandatename');
	}

	function getMandatesigned() {
		return date('Ymd');
	}

	function getSequencetype() {
		return $this->getValueforKey('sequencetype');
	}


	public function getLabel0(){
		if($this->getValueforKey('label0'))
			return $this->getValueforKey('label0');
		else
			return '';
	}
	public function getLabel1(){
		if($this->getValueforKey('label1'))
			return $this->getValueforKey('label1');
		else
			return '';
	}
	public function getLabel2(){
		if($this->getValueforKey('label2'))
			return $this->getValueforKey('label2');
		else
			return '';
	}
	public function getLabel3(){
		if($this->getValueforKey('label3'))
			return $this->getValueforKey('label3');
		else
			return '';
	}

	public function getLabel4(){
		if($this->getValueforKey('label4'))
			return $this->getValueforKey('label4');
		else
			return '';
	}

	public function getText0(){
		if($this->getValueforKey('text0'))
			return $this->getValueforKey('text0');
		else
			return '';
	}
	public function getText1(){
		if($this->getValueforKey('text1'))
			return $this->getValueforKey('text1');
		else
			return '';
	}
	public function getText2(){
		if($this->getValueforKey('text2'))
			return $this->getValueforKey('text2');
		else
			return '';
	}
	public function getText3(){
		if($this->getValueforKey('text3'))
			return $this->getValueforKey('text3');
		else
			return '';
	}
	public function getText4(){
		if($this->getValueforKey('text4'))
			return $this->getValueforKey('text4');
		else
			return '';
	}


	function setAdditionalParamsforPayPal(array &$params){
		$oBasket=oxRegistry::getSession()->getBasket();

		$params['basket_shipping_costs']=$this->formatAmount(number_format($oBasket->getDeliveryCosts(),2));

		$iLineNr=0;
		foreach ($oBasket->getContents() as $oBasketItem)
		{

			$oProduct = $oBasketItem->getArticle(false);

			$iSumPricesBrut += $oBasketItem->getPrice()->getBruttoPrice();
			$iSumPricesNet += $oBasketItem->getPrice()->getNettoPrice();

			$sArticleName = $oProduct->oxarticles__oxtitle->rawValue.(empty($oProduct->oxarticles__oxvarselect->value) ? '' : ' - '.$oProduct->oxarticles__oxvarselect->rawValue);

			if(!oxConfig::getInstance()->isUtf()) {
				$params['basketitem_name'.$iLineNr] = utf8_encode($sArticleName);
			} else {
				$params['basketitem_name'.$iLineNr] = $sArticleName;
			}

			$iQty = $oBasketItem->getAmount();
			$params['basketitem_amount'.$iLineNr] =  $this->formatAmount(number_format($oBasketItem->getPrice()->getBruttoPrice() / $iQty,2));
			$params['basketitem_number'.$iLineNr] = $oProduct->oxarticles__oxartnume->rawValue;
			$params['basketitem_qty'.$iLineNr] = $iQty;
			$params['basketitem_desc'.$iLineNr] = $oProduct->oxarticles__oxeane->rawValue;

			$iLineNr++;

		}

		return $params;



	}

	function processOnError($order_id,$msg){

		$msg=str_replace("'", '', msg);

		if($this->checkOrder($order_id)){
			oxDB::getDb()->execute("update oxorder set OXTRANSSTATUS='ERROR', OXREMARK ='".$msg."' where OXORDERNR=".$order_id);
		}

		$url=oxConfig::getInstance()->getShopMainUrl().'/index.php?cl=order&fnc=execute&status=error&ord_agb=1&refnr='.$order_id.'&stoken='.$this->getChallengeToken().'&sid='.$_REQUEST['sessionid'];;
		return  $url;

	}

	function processOnCancel($order_id){

		if($this->checkOrder($order_id)){
			oxDB::getDb()->execute("update oxorder set OXTRANSSTATUS='CANCELD' where OXORDERNR=".$order_id);
		}

		$url=oxConfig::getInstance()->getShopMainUrl().'/index.php?cl=order&fnc=execute&status=canceld&ord_agb=1&refnr='.$order_id.'&stoken='.$this->getChallengeToken().'&sid='.$_REQUEST['sessionid'];;

		return  $url;
	}

	function processOnOk($order_id,$amount,$currency){

		$vmsg=$this->validateOrderAmount($order_id,$amount,$currency);
		if(''!=$vmsg)
			return $this->processOnError($order_id,$vmsg);

		oxDB::getDb()->execute("update oxorder set OXTRANSSTATUS='OK', oxpaid=now() where OXORDERNR=".$order_id);

		$url=oxConfig::getInstance()->getShopMainUrl().'/index.php?cl=order&fnc=execute&ord_agb=1&status=ok&refnr='.$order_id.'&stoken='.$this->getChallengeToken().'&sid='.$_REQUEST['sessionid'];

		return  $url;
	}

	function checkOrder($ordernr){
		$result=oxDB::getDb()->execute("select oxid from oxorder where OXORDERNR=".$ordernr);
		return $result->fields[0];
	}

	function validateOrderAmount(&$order_id,$amount,$currency){
		$this->logDebug("validate()->start() amount:".$amount.' currency:'.$currency);

		$result= oxDB::getDb()->execute('select OXCURRENCY from oxorder WHERE OXORDERNR='.$order_id);
		$orderCurrency=$result->fields[0];

		$result = oxDB::getDb()->execute('select OXTOTALORDERSUM from oxorder WHERE OXORDERNR='.$order_id);
		$orderAmount=$this->formatAmount($result->fields[0]);

		$this->logDebug("validate()->start() orderAmount:".$orderAmount." orderCurrency:".$orderCurrency);

		if(!is_null($currency) && $orderCurrency!=$currency){
			$this->logTransaction('validate()->invalid currency order currency:'.$orderCurrency.' gateway currency:'.$currency);
			return 'invalid currency order currency:'.$orderCurrency.' gateway currency:'.$currency;
		}

		if($orderAmount!= $amount){
			$this->logTransaction('validate()->invalid amount order amount:'.$orderAmount.' gateway amount:'.$amount);
			return 'invalid amount order amount:'.$orderAmount.' gateway amount:'.$amount;
		}
		$this->logTransaction('validate()->ok');
		return '';
	}



}