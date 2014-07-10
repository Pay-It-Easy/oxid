<?php

class Pay_It_Easy_Redirect extends oxUBase
{


	protected $_sThisTemplate = 'Pay_It_Easy_redirect.tpl';


    public function render()
    {
        parent::render();

		$_redirect_cnt = oxSession::getVar('Pay_It_Easy_redirect_data');
		$_redirect_form = oxSession::getVar('Pay_It_Easy_redirect_form');
		$_redirect_url = oxSession::getVar('Pay_It_Easy_redirect_url');

		$this->_aViewData['frm_action'] = $_redirect_url;

		$this->_aViewData['frm_cnt'] = $_redirect_cnt;
		$this->_aViewData['frm_form'] = $_redirect_form;

        return $this->_sThisTemplate;
    }
}
