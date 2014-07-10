[{include file="headitem.tpl" title="PIETITLE"|oxmultilangassign}]

<div id=liste>

    <form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="fnc" value="save">
        <input type="hidden" name="oxid" value="[{$oxid}]">
        <input type="hidden" name="editval[oxshops__oxid]" value="[{$oxid}]">
        <table cellspacing="0" cellpadding="0" border="0" style="width:100%;height:100%;">
            <tr>
                <td valign="top" class="edittext" style="padding:10px;">
                    <table cellspacing="0" cellpadding="5" border="0" class="edittext" style="text-align: left;">
                        <tr>
                            <td valign="top" class="groupExp" width="250" nowrap="" colspan="2"><b>[{ oxmultilang ident="PIETITLE_BASE" }]</b></td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIESSLMERCHANT_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_sslmerchant] value="[{$confstrs.PIE_sslmerchant}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIESECRET_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_secret] value="[{$confstrs.PIE_secret}]" />
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEFORM_MERCHANTNAME_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_form_merchantname] value="[{$confstrs.PIE_form_merchantname}]" />
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIECSSURL_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_cssurl] value="[{$confstrs.PIE_cssurl}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIENOTIFICATIONFAILEDURL_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_notificationfailedurl] value="[{$confstrs.PIE_notificationfailedurl}]" />
                            </td>
                        </tr>
                  		<tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEDEBUG_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_debug]">
                                    <option value="DEBUG"[{if $confstrs.PIE_debug_mode == "DEBUG"}] selected="selected"[{/if}]>Development</option>
                                    <option value="INFO"[{if $confstrs.PIE_debug_mode == "INFO"}] selected="selected"[{/if}]>Transaction</option>
                                    <option value="NONE"[{if $confstrs.PIE_debug_mode == "NONE" || $confstrs.PIE_debug== ""}] selected="selected"[{/if}]>Off</option>
                                </select>
                            </td>
                        </tr>

                         <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEDEBUG_FILE_PATH_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_debug_file_path] value="[{$confstrs.PIE_debug_file_path}]" />
                            </td>
                        </tr>


                         <!------credit card ------>
                           <tr>
                            <td valign="top" class="edittext" width="250" nowrap="" colspan="2"><b>&nbsp;</td>
                        </tr> <tr>
                            <td valign="top" class="groupExp" width="250" nowrap="" colspan="2">[{ oxmultilang ident="PIETITLE_CC" }]</td>
                        </tr>
<!--
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIESTATUS_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_CC_active]">
                                    <option value="yes"[{if $confstrs.PIE_CC_active == "yes" || $confstrs.PIE_CC_active == ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value="no"[{if $confstrs.PIE_CC_active == "no"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>
-->
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap=""><b>[{ oxmultilang ident="PIETEST_MODE_TITLE" }]</b></td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_test_mode_CC]">
                                    <option value="yes" [{if $confstrs.PIE_test_mode_CC == "yes" || $confstrs.PIE_test_mode_CC == ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value="no" [{if $confstrs.PIE_test_mode_CC == "no"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETRANSACTIONTYPE_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_transactiontype_CC]">
                                    <option value="authorization"[{if $confstrs.PIE_transactiontype_CC == "authorization"}] selected="selected"[{/if}]>authorization</option>
                                    <option value="preauthorization"[{if $confstrs.PIE_transactiontype_CC == "preauthorization"}] selected="selected"[{/if}]>preauthorization</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEFORM_MERCHANTREF_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_form_merchantref] value="[{$confstrs.PIE_form_merchantref}]" />
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEPAYMENT_OPTIONS_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_paymentoptions_CC] value="[{$confstrs.PIE_paymentoptions_CC}]" />
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEACCEPTCOUNTRIES_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_acceptcountries] value="[{$confstrs.PIE_acceptcountries}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEREJECTCOUNTRIES_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_rejectcountries] value="[{$confstrs.PIE_rejectcountries}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEAUTOCAPTURE_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_autocapture_CC] value="[{$confstrs.PIE_autocapture_CC}]" />
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEDELIVERYCOUNTRY_ACTION_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_deliverycountry_action]">
                                    <option value="yes"[{if $confstrs.PIE_deliverycountry_action == "notify" || $confstrs.PIE_deliverycountry_action == ""}] selected="selected"[{/if}]>notify</option>
                                    <option value="no"[{if $confstrs.PIE_deliverycountry_action == "reject"}] selected="selected"[{/if}]>reject</option>
                                </select>
                            </td>
                        </tr>




                        <!------direct debit------>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="" colspan="2"><b>&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top" class="groupExp" width="250" nowrap="" colspan="2"><b>[{ oxmultilang ident="PIETITLE_DD" }]</b></td>
                        </tr>
<!--
	                    <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIESTATUS_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_DD_active]">
                                    <option value="yes"[{if $confstrs.PIE_DD_active == "yes" || $confstrs.PIE_DD_active == ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value="no"[{if $confstrs.PIE_DD_active == "no"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>
-->
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETEST_MODE_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_test_mode_DD]">
                                    <option value="yes"[{if $confstrs.PIE_test_mode_DD == "yes" || $confstrs.PIE_test_mode_DD == ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value="no"[{if $confstrs.PIE_test_mode_DD == "no"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETRANSACTIONTYPE_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_transactiontype_DD]">
                                    <option value="authorization"[{if $confstrs.PIE_transactiontype_DD == "authorization"}] selected="selected"[{/if}]>authorization</option>
                                    <option value="preauthorization"[{if $confstrs.PIE_transactiontype_DD == "preauthorization"}] selected="selected"[{/if}]>preauthorization</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEPAYMENT_OPTIONS_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_paymentoptions_DD] value="[{$confstrs.PIE_paymentoptions_DD}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEAUTOCAPTURE_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_autocapture_DD] value="[{$confstrs.PIE_autocapture_DD}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEMANDAT_PREFIX_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_mandateprefix] value="[{$confstrs.PIE_mandateprefix}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEMANDAT_NAME_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_mandatename] value="[{$confstrs.PIE_mandatename}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIESEQUENCETYPE_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_sequencetype]">
                                    <option value="oneoff"[{if $confstrs.PIE_sequencetype == "oneoff"}] selected="selected"[{/if}]>oneoff</option>
                                    <option value="first"[{if $confstrs.PIE_sequencetype == "first"}] selected="selected"[{/if}]>first</option>
                                    <option value="recurring"[{if $confstrs.PIE_sequencetype == "recurring"}] selected="selected"[{/if}]>recurring</option>
                                    <option value="final"[{if $confstrs.PIE_sequencetype == "final"}] selected="selected"[{/if}]>final</option>
                                </select>
                            </td>
                        </tr>

                        <!------giropay------>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="" colspan="2"><b>&nbsp;</td>
                        </tr>                      <tr>
                            <td valign="top" class="groupExp" width="250" nowrap="" colspan="2"><b>[{ oxmultilang ident="PIETITLE_GP" }]</b>&nbsp;</td>
                        </tr>
<!--
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIESTATUS_TITLE" }]</td>
                                  <td valign="top" class="edittext">
                                <select name="confstrs[PIE_GP_active]">
                                    <option value="yes"[{if $confstrs.PIE_GP_active == "yes" || $confstrs.PIE_DD_active == ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value="no"[{if $confstrs.PIE_GP_active == "no"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>
 -->
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETEST_MODE_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_test_mode_GP]">
                                    <option value="yes"[{if $confstrs.PIE_test_mode_GP == "yes" || $confstrs.PIE_test_mode_GP == ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value="no"[{if $confstrs.PIE_test_mode_GP == "no"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>

                       <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIEPAYMENT_OPTIONS_TITLE_GP" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_paymentoptions_GP]">
                                    <option value="avsopen"[{if $confstrs.PIE_paymentoptions_GP == "avsopen"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value=""[{if $confstrs.PIE_paymentoptions_GP == ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>


                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIELABEL_TITLE" }] 0</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_label0] value="[{$confstrs.PIE_label0}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETEXT_TITLE" }] 0</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_text0] value="[{$confstrs.PIE_text0}]" />
                            </td>
                        </tr>


                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIELABEL_TITLE" }] 1</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_label1] value="[{$confstrs.PIE_label1}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETEXT_TITLE" }] 1</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_text1] value="[{$confstrs.PIE_text1}]" />
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIELABEL_TITLE" }] 2</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_label2] value="[{$confstrs.PIE_label2}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETEXT_TITLE" }] 2</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_text2] value="[{$confstrs.PIE_text2}]" />
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIELABEL_TITLE" }] 3</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_label3] value="[{$confstrs.PIE_label3}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETEXT_TITLE" }] 3</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_text3] value="[{$confstrs.PIE_text3}]" />
                            </td>
                        </tr>



                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIELABEL_TITLE" }] 4</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_label4] value="[{$confstrs.PIE_label4}]" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETEXT_TITLE" }] 4</td>
                            <td valign="top" class="edittext">
                                <input type=text class="editinput" style="width:410px" name=confstrs[PIE_text4] value="[{$confstrs.PIE_text4}]" />
                            </td>
                        </tr>
                          <tr>
                            <td valign="top" class="edittext" width="250" nowrap="" colspan="2"><b>&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top" class="groupExp" width="250" nowrap="" colspan="2">[{ oxmultilang ident="PIETITLE_PP" }]</td>
                        </tr>


<!--
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIESTATUS_TITLE" }]</td>
                               <td valign="top" class="edittext">
                                <select name="confstrs[PIE_PP_active]">
                                    <option value="yes"[{if $confstrs.PIE_PP_active == "yes" || $confstrs.PIE_PP_active == ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value="no"[{if $confstrs.PIE_PP_active == "no"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>
 -->
                        <tr>
                            <td valign="top" class="edittext" width="250" nowrap="">[{ oxmultilang ident="PIETEST_MODE_TITLE" }]</td>
                            <td valign="top" class="edittext">
                                <select name="confstrs[PIE_test_mode_PP]">
                                    <option value="yes"[{if $confstrs.PIE_test_mode_PP == "yes" || $confstrs.PIE_test_mode_PP== ""}] selected="selected"[{/if}]>[{ oxmultilang ident="PIEYES" }]</option>
                                    <option value="no"[{if $confstrs.PIE_test_mode_PP == "no"}] selected="selected"[{/if}]>[{ oxmultilang ident="PIENO" }]</option>
                                </select>
                            </td>
                        </tr>
                                                 <tr>
                            <td valign="top" class="edittext" width="250" nowrap="" colspan="2"><b>&nbsp;</td>
                        </tr>
                         <tr>
                            <td valign="top" class="edittext" width="250" nowrap=""></td>
                            <td valign="top" class="edittext">
                                <input type="submit" name="save" value="[{ oxmultilang ident="PIEUPDATE_SETUP" }]">

                                <input type="button" value="[{ oxmultilang ident="PIEINSTALL_PAYMENTS" }]" onclick="window.location.href='[{$oViewConf->getSelfLink()}]cl=Pay_It_Easy_configuration&fnc=installPayments';" />
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    </form>
    [{include file="pagenavisnippet.tpl"}]
</div>
[{include file="pagetabsnippet.tpl"}]

[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]
