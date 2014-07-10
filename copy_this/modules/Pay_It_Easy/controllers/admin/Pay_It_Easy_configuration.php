<?php

class Pay_It_Easy_configuration extends Shop_Config
{

    const PAYMILL_MODULE_NAME = 'Pay_It_Easy';

    protected $payments=array('DD','CC','GP','PP');

    protected $_sThisTemplate = 'Pay_It_Easy_configuration.tpl';

    public function render()
    {

        $myConfig = $this->getConfig();
        $aDbVariables = $this->_loadConfVars($myConfig->getShopId(), $moduleName = '');
        $aConfVars = $aDbVariables['vars'];

        foreach ($this->_aConfParams as $sType => $sParam) {
            $this->_aViewData[$sParam] = $aConfVars[$sType];
        }

        return $this->_sThisTemplate;
    }

    public function getConfigs(){
    	$myConfig = $this->getConfig();
    	$aDbVariables = $this->_loadConfVars($myConfig->getShopId(), $moduleName = '');
    	$aConfVars = $aDbVariables['vars'];
    	foreach ($this->_aConfParams as $sType => $sParam) {
    		$this->_aViewData[$sParam] = $aConfVars[$sType];
    	}
    	return $this->_aViewData;
    }

    public function saveConfVars()
    {
        $myConfig = $this->getConfig();

        $aConfBools = oxConfig::getParameter("confbools");
        $aConfStrs = oxConfig::getParameter("confstrs");
        $aConfArrs = oxConfig::getParameter("confarrs");
        $aConfAarrs = oxConfig::getParameter("confaarrs");

        if (is_array($aConfStrs)) {
            foreach ($aConfStrs as $sVarName => $sVarVal) {
                $myConfig->saveShopConfVar("str", $sVarName, $sVarVal);
            }
        }
    }

    public function save()
    {
    	$this->logAction('save');
    	$this->saveConfVars();
        return;
    }

    protected function getLanguageKeyForOxidPaymentId($oxidPaymentId)
    {
        return 'PIEPAYMENT_METHOD_' . strtoupper(end(explode('_', $oxidPaymentId, 10)));
    }

    public function uninstallPayments()
    {
       $this->logAction('uninstallPayments ');
        $sQuery = 'DELETE FROM `oxpayments` WHERE `OXID` like "Pay_It_Easy_%"';
        oxDb::getDb()->Execute($sQuery);
    }

    public function installPayments()
    {

        $this->uninstallPayments();

        foreach ($this->payments as $payment_id){

        	$oxidPaymentId = 'Pay_It_Easy_'.$payment_id;
        	$aLanguageParams = array_values($this->getConfig()->getConfigParam('aLanguageParams'));

        	$this->logAction('installPayments ->oxidPaymentId:'.$oxidPaymentId);
        	$sQuery = "INSERT INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXTOAMOUNT`, ";

        	$queryLanguageColumnNames = '';
        	foreach ($aLanguageParams as $aLanguageParam) {

        		if (!empty($queryLanguageColumnNames)) {
        			$queryLanguageColumnNames .= ", ";
        		}
        		if ($aLanguageParam["baseId"] > 0) {
        			$queryLanguageColumnNames .= "`OXDESC_" . $aLanguageParam["baseId"] . "` ";
        		} else {
        			$queryLanguageColumnNames .= "`OXDESC` ";
        		}
        	}
        	$sQuery .= $queryLanguageColumnNames;

        	$sQuery .= ") VALUES ('" . $oxidPaymentId . "', 1, 1000000, ";

        	$langKey = $this->getLanguageKeyForOxidPaymentId($oxidPaymentId);
        	$oxLang = oxLang::getInstance();

        	$queryLanguageColumnValues = '';
        	foreach ($aLanguageParams as $aLanguageParam) {
        		if (!empty($queryLanguageColumnValues)) {
        			$queryLanguageColumnValues .= ', ';
        		}
        		$queryLanguageColumnValues .=
        		oxDb::getDb()->quote($oxLang->translateString($langKey, $aLanguageParam['baseId']));
        	}
        	$sQuery .= $queryLanguageColumnValues;

        	$sQuery .= ")";
        	$this->logAction('installPayments ->sQuery:'.$sQuery);
        	oxDb::getDb()->Execute($sQuery);

        }


    }

    public static function logAction($message)
    {
    	$logfile = '/tmp/oxid.txt';
    	if (is_writable($logfile)) {
    		$handle = fopen($logfile, 'a');
    		fwrite($handle, "[" . date(DATE_RFC822) . "] " . $message . "\n");
    		fclose($handle);
    	}
    }











}
