<?php
class EuroInformation extends PaymentModule{
  private $_html = '';
  private $_postErrors = array();
  
  public function __construct(){
    $this->name = 'euroinformation';
    $this->tab = 'Payment';
    $this->version = '1.0';
    parent::__construct();
    $this->page = basename(__FILE__, '.php');
    $this->displayName = $this->l('Euro Information');
    $this->description = $this->l('Module de Paiement Bancaire Euro Information');
    $this->confirmUninstall = $this->l('&Ecirc;tes vous s&ocirc;r de vouloir supprimer vos details ?');
  }

  public function install(){
    if (!parent::install()
        OR !Configuration::updateValue('EI_TPENUM', '') 
        OR !Configuration::updateValue('EI_PASSPHRASE', '')
        OR !Configuration::updateValue('EI_SITECODE', '')
        OR !Configuration::updateValue('EI_URLRETOUR', '')
        OR !Configuration::updateValue('EI_URLRETOUROK', '')
        OR !Configuration::updateValue('EI_URLRETOURKO', '')
        OR !Configuration::updateValue('EI_BANKSERVER', '')
        OR !Configuration::updateValue('EI_CTLHMAC', '')
        OR !$this->registerHook('payment')){
			return false;
		}
    return true;
  }

  public function uninstall(){
    if (!Configuration::deleteByName('EI_TPENUM') 
        OR !Configuration::deleteByName('EI_PASSPHRASE') 
        OR !Configuration::deleteByName('EI_SITECODE')
        OR !Configuration::deleteByName('EI_URLRETOUR')
        OR !Configuration::deleteByName('EI_URLRETOUROK')
        OR !Configuration::deleteByName('EI_URLRETOURKO')
        OR !Configuration::deleteByName('EI_BANKSERVER')
        OR !Configuration::deleteByName('EI_CTLHMAC')
        OR !parent::uninstall())
        return false;
    return true;
  }
  public function getContent(){
    $this->_html .= '<h2>Banques Euro Information</h2>';
    if (isset($_POST['submitEuroInformation'])){
      if (empty($_POST['PassPhrase']))
        $this->_postErrors[] = $this->l('La phrase cl&eacute; Euro Information est requise.');
      if (empty($_POST['TpeNum']))
        $this->_postErrors[] = $this->l('Votre numero de TPE Euro Information est requis.');
      if (empty($_POST['SiteCode']))
        $this->_postErrors[] = $this->l('Le SiteCode est requis.');
      if (empty($_POST['CtlHmac']))
        $this->_postErrors[] = $this->l('La cl&eacute; est requise.');
      if (empty($_POST['urlRetour']))
        $this->_postErrors[] = $this->l('L\'URL de retour est requise.');
      if (empty($_POST['urlRetourOK']))
        $this->_postErrors[] = $this->l('L\'URL de retour OK est requise.');
      if (empty($_POST['urlRetourKO']))
        $this->_postErrors[] = $this->l('L\'URL de retour KO est requise.');
      if (empty($_POST['BankServer']))
        $this->_postErrors[] = $this->l('Le champ Serveur Bancaire est requis.');
      if (!sizeof($this->_postErrors)){
        Configuration::updateValue('EI_PASSPHRASE', $_POST['PassPhrase']);
        Configuration::updateValue('EI_TPENUM', $_POST['TpeNum']);
        Configuration::updateValue('EI_SITECODE', $_POST['SiteCode']);
        Configuration::updateValue('EI_URLRETOUR', $_POST['urlRetour']);
        Configuration::updateValue('EI_URLRETOUROK', $_POST['urlRetourOK']);
        Configuration::updateValue('EI_URLRETOURKO', $_POST['urlRetourKO']);
        Configuration::updateValue('EI_BANKSERVER', $_POST['BankServer']);
        Configuration::updateValue('EI_CTLHMAC', $_POST['CtlHmac']);
        $this->displayConf();
      }
      else
        $this->displayErrors();
    }
    $this->displayEuroInformation();
    $this->displayFormSettings();
    return $this->_html;
  }
  
  public function displayConf(){
    $this->_html .= '
    <div class="conf confirm">
      <img src="../img/admin/ok.gif" alt="Confirmation" />
      Param&egrave;tres Sauvegard&eacute;s
    </div>';
  }
  public function displayErrors(){
    $nbErrors = sizeof($this->_postErrors);
    $this->_html .= '
    <div class="alert error">
      <h3>'.($nbErrors > 1 ? $this->l('Il y a') : $this->l('Il y a')).' '.$nbErrors.' '.($nbErrors > 1 ? $this->l('erreurs') : $this->l('erreur')).'</h3>
      <ol>';
    foreach ($this->_postErrors AS $error)
      $this->_html .= '<li>'.$error.'</li>';
    $this->_html .= '
      </ol>
    </div>';
  }
  
  public function displayEuroInformation()
  {
    $this->_html .= '
    <img src="../modules/euroinformation/euroinformation.gif" style="float:left; margin-right:15px;" />
    <b>Ce module vous permet d\'accepter les paiements par votre banque via Euro Information.</b><br /><br />
    Si le client choisis ce mode de paiement, votre compte bancaire sera automatiquement cr&eacute;dit&eacute;.<br />
    Vous devez cr&eacute;er votre compte e-commerce aupr&egrave; de votre banque via Euro Information.<br />Les donn&eacute;es inscrites par d&eacute;faut sont ici des donn&eacute;es vous permettant de faire fonctionner le module en mode g&eacute;n&eacute;rique mais en aucun cas d\'accepter de r&eacute;els paiements.
    <br /><br /><br />';
  }

  public function displayFormSettings(){
    $conf = Configuration::getMultiple(array('EI_PASSPHRASE', 'EI_SITECODE', 'EI_URLRETOUR', 'EI_URLRETOUROK', 'EI_URLRETOURKO', 'EI_BANKSERVER', 'EI_BANK', 'EI_TPENUM', 'EI_CTLHMAC'));

    if(@empty($conf) && @empty($_POST)){
       $PassPhrase = 'Uj19nXcOaObvZEl-Yc+n';
       $CtlHmac = '25723965563b7ccb74b0b29e18b751264b165d0c';
       $SiteCode = '39be6b2813f07fd1a921';
       $TpeNum = '0000001';
       $urlRetour = 'http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'modules&#x2f;euroinformation&#x2f;order.php';
       $urlRetourOK = 'http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'my-account.php';
       $urlRetourKO = 'http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'order.php';
       $BankServer = 'https&#x3a;&#x2f;&#x2f;ssl.paiement.cic-banques.fr&#x2f;test&#x2f;paiement.cgi';
    }elseif(!@empty($conf) && @empty($_POST)){
        if(empty($PassPhrase))
          $PassPhrase = $conf['EI_PASSPHRASE'];
        if(empty($SiteCode))
          $SiteCode = $conf['EI_SITECODE'];
        if(empty($TpeNum))
          $TpeNum = $conf['EI_TPENUM'];
        if(empty($urlRetour))
          $urlRetourOK = $conf['EI_URLRETOUR'];
        if(empty($urlRetourOK))
          $urlRetourOK = $conf['EI_URLRETOUROK'];
        if(empty($urlRetourKO))
          $urlRetourKO = $conf['EI_URLRETOURKO'];
        if(empty($BankServer))
          $BankServer = $conf['EI_BANKSERVER'];
        if(empty($CtlHmac))
          $CtlHmac = $conf['EI_CTLHMAC'];
    }elseif(@!empty($_POST)){
        if(empty($PassPhrase))
          $PassPhrase = $_POST['PassPhrase'];
        if(empty($CtlHmac))
          $CtlHmac = $_POST['CtlHmac'];
        if(empty($SiteCode))
          $SiteCode = $_POST['SiteCode'];
        if(empty($TpeNum))
          $TpeNum = $_POST['TpeNum'];
        if(empty($urlRetour))
          $urlRetourOK = $_POST['urlRetour'];
        if(empty($urlRetourOK))
          $urlRetourOK = $_POST['urlRetourOK'];
        if(empty($urlRetourKO))
          $urlRetourKO = $_POST['urlRetourKO'];
        if(empty($BankServer))
          $BankServer = $_POST['BankServer'];
        if(empty($CtlHmac))
          $CtlHmac = $_POST['EI_CTLHMAC'];
    }
    if(empty($PassPhrase))   $PassPhrase = 'Uj19nXcOaObvZEl-Yc+n';
    if(empty($CtlHmac))      $CtlHmac = '25723965563b7ccb74b0b29e18b751264b165d0c';
    if(empty($SiteCode))     $SiteCode = '39be6b2813f07fd1a921';
    if(empty($TpeNum))       $TpeNum = '0000001';
    if(empty($urlRetour))    $urlRetour = 'http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'modules&#x2f;euroinformation&#x2f;order.php';
    if(empty($urlRetourOK))  $urlRetourOK = 'http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'my-account.php';
    if(empty($urlRetourKO))  $urlRetourKO = 'http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'order.php';
    if(empty($BankServer))   $BankServer = 'https&#x3a;&#x2f;&#x2f;ssl.paiement.cic-banques.fr&#x2f;test&#x2f;paiement.cgi';
    $checkcictest='';
    $checkcicprod='';
    $checkobctest='';
    $checkobcprod='';
    $checkcmtest ='';
    $checkcmprod ='';
    if(@empty($BankServer)) $checkcictest=' checked';
    else{
		$poscic  = strpos($BankServer,'cic');
		$posobc  = strpos($BankServer,'obc');
		$poscm   = strpos($BankServer,'creditmutuel');
		if($poscic!==false){
			if(strpos($BankServer,'test'))
				$checkcictest 	= ' checked';
			else
				$checkcicprod 	= ' checked';
		}elseif($posobc!==false){
			if(strpos($BankServer,'test'))
				$checkobctest 	= ' checked';
			else
				$checkobcprod 	= ' checked';
		}elseif($poscm!==false){
			if(strpos($BankServer,'test'))
				$checkcmtest 	= ' checked';
			else
				$checkcmprod 	= ' checked';
		}
    }
    $this->_html .= '
    <FORM name="TextForm"><fieldset>
      <legend><img src="../img/admin/contact.gif" />Configuration - Outil SHA1 simplifi&eacute;</legend>';
	?>
	<SCRIPT LANGUAGE="JavaScript" SRC="http://<?php echo htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8'); ?>modules/euroinformation/H_Files/sha1.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" SRC="http://<?php echo htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8'); ?>modules/euroinformation/H_Files/CyberMUT1_2sha1.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
	function HighLightCust1()  { document.CustForm.TpeCust1.focus(); document.CustForm.TpeCust1.select(); return true; }
	function HighLightCust2()  { document.CustForm.TpeCust2.focus(); document.CustForm.TpeCust2.select(); return true; }
	function HighLightCust3()  { document.CustForm.TpeCust3.focus(); document.CustForm.TpeCust3.select(); return true; }
	function getRnd(lbnd,ubnd) { return (Math.floor(Math.random() * (ubnd - lbnd)) + lbnd); }
	function resetCust() { document.CustForm.reset(); document.CustForm.OK.disabled=true; document.CustForm.selCust1.disabled=true;
	 document.CustForm.selCust2.disabled=true; document.CustForm.selCust3.disabled=true;
	 document.CustForm.TpeCust1.rows=2;  document.CustForm.TpeCust2.rows=2;  document.CustForm.TpeCust3.rows=2; 
	}
	function hasAgreed() { if (document.RFC2104.EI_BSDLicense.rows<5) return true; else return false; }
	function initRFC2104(agreement,language) { var tryKeyCheck=document.KeyFileForm.tryKey.checked;
	 if (language=="FR") document.TextForm.CurrentLanguage.value=language; if (language=="EN") document.TextForm.CurrentLanguage.value=language;
	 document.KeyFileForm.reset(); document.KeysForm.reset(); document.TpeForm.reset(); 
	 document.KeyFileForm.tryKey.disabled=false;
	 document.KeyFileForm.genPass.disabled=false; document.KeyFileForm.genPass.value=getText("genPass"); 
	 document.KeyFileForm.PassPhrase.disabled=false;
	 document.TpeForm.TpeNum.disabled=false; document.TpeForm.inputTpe.value=getText("inputTpe"); 
	 document.TpeForm.genCtl.disabled=false; document.TpeForm.genCtl.value=getText("genCtl");    
	 var TpeRFC="0b0b0b0"; document.TpeForm.CtlHmac.value=getCtlHmac(TpeRFC); resetCust();
	 if (agreement=="1") {document.RFC2104.EI_BSDLicense.rows=3;document.RFC2104.PJ_BSDLicense.rows=6; document.RFC2104.BSD_License.rows=6; }
	 if (agreement=="0") {document.RFC2104.EI_BSDLicense.rows=9;document.RFC2104.PJ_BSDLicense.rows=3; document.RFC2104.BSD_License.rows=3; }
	 if (hasAgreed()) {Visible(document.RFC2104.showLicenses.checked,'Licenses');
	   document.KeyFileForm.KeyFile.value=
	   'VERSION 1 12345678901234567890123456789012345678P0\r\nHMAC-SHA1\r\n' + getText("pasteKey");   
	   document.TpeForm.TpeNum.value="0000001"; 
	   document.KeyFileForm.tryKey.checked=tryKeyCheck;
	   document.TpeForm.TpeNum.disabled=tryKeyCheck;
	   document.KeyFileForm.KeyFile.disabled=tryKeyCheck;
	   if ( document.KeyFileForm.KeyFile.disabled==false) {document.KeyFileForm.KeyFile.focus(); document.KeyFileForm.KeyFile.select();}
	   else {if ( document.KeyFileForm.genPass.disabled==false) {document.KeyFileForm.genPass.focus();}}
	   return true; }
	 document.RFC2104.reset(); alert (getText("notAgreed")); 
	 document.KeyFileForm.reset(); document.KeysForm.reset(); document.TpeForm.reset(); 
	 document.KeyFileForm.tryKey.disabled=true;  document.KeyFileForm.tryKey.value=""; 
	 document.KeyFileForm.genPass.disabled=true; document.KeyFileForm.genPass.value=""; 
	 document.KeyFileForm.PassPhrase.disabled=true;
	 document.TpeForm.TpeNum.disabled=true; document.TpeForm.inputTpe.value=""; 
	 document.TpeForm.genCtl.disabled=true; document.TpeForm.genCtl.value="";    
	   document.KeyFileForm.KeyFile.value=
	   'VERSION ? 00000000000000000000000000000000000000P0\r\nHMAC-SHA1\r\n' + getText("notAgreed");
	   document.RFC2104.agreement(3).focus(); return false;
	}
	function resetTpe() {
	  resetCust(); document.TpeForm.CtlHmac.value=getCtlHmac("0b0b0b0");
	  if (document.TpeForm.TpeNum.disabled==false) { document.TpeForm.TpeNum.value=""; document.TpeForm.TpeNum.focus(); }
	  return true;
	}
	function getPassPhrase(pplength) {var charSet = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-*";
	 pp = new String(""); for (var i = 0; i < pplength; ++i) pp += charSet.charAt(getRnd(0, charSet.length)); return pp; 
	}
	function getReference(rootRef) {var genRef = new String(rootRef);
	 var charSet1 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	 for (var i1 = genRef.length; i1 < 7; ++i1) genRef += charSet1.charAt(getRnd(0, charSet1.length));
	 var charSet2 = "0123456789";
	 for (var i2 = genRef.length; i2 < 12; ++i2) genRef += charSet2.charAt(getRnd(0, charSet2.length));
	 return genRef;
	}
	function controleCle() { if(hasAgreed()==false) {initRFC2104("",""); return false;}
	 document.KeyFileForm.HashMethod.value="ERR"; document.KeyFileForm.FullKey.value="0x";
	 strFile = new String(document.KeyFileForm.KeyFile.value); 
	 strVers = new String(strFile.substring(0,10)); 
	 if (strVers=="VERSION 1 ") 
	 { var ok = "yes"; var temp; var hexvalid = "abcdefABCDEF0123456789";
	   hexStrKey  = new String( "0x" + strFile.substring(10,48) );
	   hexFinal   = new String( "" + strFile.substring(48,50) + "00" );
	   var cca0=hexFinal.charCodeAt(0); 
	   if (cca0>70 && cca0<97) hexStrKey +=( String.fromCharCode(cca0-23) + hexFinal.substring(1,2) );
		else 
		{ if (hexFinal.substring(1,2)=="M") hexStrKey +=(hexFinal.substring(0,1) + "0"); else hexStrKey +=hexFinal.substring(0,2);
		}
	   for (var i=2; i<hexStrKey.length; i++) 
	   {temp = "" + hexStrKey.substring(i, i+1); 
		 if (hexvalid.indexOf(temp) == "-1") 
		{ alert(getText("invalidKey"));
			  document.KeyFileForm.KeyFile.focus(); 
			  document.KeyFileForm.KeyFile.select(); return false }
	   } 
	  } else { alert(getText("invalidVrs") + strVers); return false }
	  document.KeyFileForm.FullKey.value=hexStrKey.toLowerCase();
	  document.KeyFileForm.HashMethod.value="NULL"; 
	  if (hexStrKey.length>39) document.KeyFileForm.HashMethod.value="MD5"; 
	  if (cca0>70 && hexStrKey.length>41) document.KeyFileForm.HashMethod.value="SHA1";
	  return true;
	}
	function extract2Hmac() { resetCust(); document.KeysForm.reset(); 
	 if (controleCle() == false) return false;
	 strPass    = new String(document.KeyFileForm.PassPhrase.value.substring(0,20));     
	 hex1stKey  = new String(document.KeyFileForm.FullKey.value);
	 hex2ndKey  = new String("0x" + binb2hex(cleXorPass(hex1stKey,strPass)));
	 hexFullKey = new String("0x" + binb2hex(cleXorPass(hex2ndKey,strPass)));
	 document.KeysForm.KeyPass.value=strPass; 
	 document.KeysForm.Key2nd.value =hex2ndKey.toLowerCase(); 
	 document.KeysForm.KeyFull.value=hexFullKey.toLowerCase(); 
	 if (document.KeysForm.KeyFull.value==document.KeyFileForm.FullKey.value)  
	  { if ( document.TpeForm.TpeNum.disabled==false) {document.TpeForm.TpeNum.focus();}
		else {if ( document.TpeForm.genCtl.disabled==false) {document.TpeForm.genCtl.focus();}}
	  return true;}
	 else { alert(getText("badformKey") + "\r\n" + document.KeysForm.KeyFull.value); 
			document.KeyFileForm.HashMethod.value +=" not valid"; return false; }
	}
	function phraseCle(TPE) { return document.KeysForm.KeyPass.value; }
	function hexCle(TPE) {var i=0, j=40, h="0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b";
	 h=document.KeysForm.Key2nd.value+h; if (h.substring(2,7)=="0b0b0b0") j=32;
	 if (h.substring(0,2) == "0x") return h.substring(i,j+2); else return "0x" + h.substring(i,j); 
	}
	function controleTpe(TPE) { if (extract2Hmac()==false) return false;
	if (document.KeyFileForm.HashMethod.value =="MD5") { alert (getText("MD5Key") ); return false; } 
	var wtpe=TPE; 
	 if (wtpe.length==7) {  var numvalid = "0123456789b";
		var ok = "yes"; var temp;
		for (var i=2; i<wtpe.length; i++) {temp = "" + wtpe.substring(i, i+1); 
		 if (numvalid.indexOf(temp) == "-1") 
		{ alert(getText("invalidTpe"));
			  document.TpeForm.TpeNum.focus(); 
			document.TpeForm.TpeNum.select(); return false }
		} } else { alert(getText("shorterTpe")); return false } 
	 return true; 
	}
	
	function TpeCtlHmac(TPE) { if (controleTpe(TPE)==false) return false;
	  document.CustForm.OK.disabled=false;
	  document.CustForm.TpeCust1.value = document.KeysForm.KeyPass.value; document.CustForm.selCust1.value = getText("sel1st");
	  document.CustForm.TpeCust2.value = document.KeysForm.Key2nd.value;  document.CustForm.selCust2.value = getText("sel2nd"); 
	  document.CustForm.TpeCust3.value = document.KeysForm.KeyFull.value; document.CustForm.selCust3.value = getText("selKey");
	  document.CustForm.selCust1.disabled=false; document.CustForm.selCust2.disabled=false; document.CustForm.selCust3.disabled=false;
	  var TpeCtl= "" + TPE; document.TpeForm.CtlHmac.value=getCtlHmac(TpeCtl); 
	  return true;
	}
	function InfoCtlHmac()  { if (TpeCtlHmac(document.TpeForm.TpeNum.value)==false) return false; 
	  alert(document.TpeForm.CtlHmac.value + "\r\n" + getText("askCtl")); 
	  if (document.CustForm.SiteCode.disabled==false) {document.CustForm.SiteCode.select(); document.CustForm.SiteCode.focus();}
	  return true; }
	
	function Visible(show,lay) 
	{ 
	  var ie4 = (document.all) ? true : false;
	  var ns4 = (document.layers) ? true : false;
	  var ns6 = (document.getElementById && !document.all) ? true : false;
	  if (show==false)    
	   {	if (ie4) {document.all[lay].style.display = "none";}
		if (ns4) {document.layers[lay].visibility = "hide";}
		if (ns6) {document.getElementById([lay]).style.display = "none";}
	   } else
	   {	if (ie4) {document.all[lay].style.display = "block";}
		if (ns4) {document.layers[lay].visibility = "show";}
		if (ns6) {document.getElementById([lay]).style.display = "block";}
	   }
	}
	
	function SiteCtl(TPE) { if (document.CustForm.selCust1.disabled==true) { if (TpeCtlHmac(TPE)==false) return false; }
	  if (document.CustForm.SiteCode.value.length < 2)
	  { alert(getText("badSociete") );
		document.CustForm.SiteCode.focus(); return false;
	  }  
	  if (document.CustForm.urlRetourOK.value.length < 7) document.CustForm.urlRetourOK.reset();
	  if (document.CustForm.urlRetourKO.value.length < 7) document.CustForm.urlRetourKO.reset();
	  if (document.CustForm.ButtonText.value.length < 2) document.CustForm.Buttontext.reset();
	  return true;
	}
	
	
	function getPHP4(TPE) {if (SiteCtl(TPE)==false) return false;
	
	 document.CustForm.TpeCust1.rows=8; document.CustForm.TpeCust1.value
	= 'define("CMCIC_DIR", "/test/");\r\n'
	+ 'define("CMCIC_SERVER", "' + document.CustForm.BankServer.value + '" );\r\n'
	+ 'function CMCIC_hmac($CMCIC_Tpe, $data="")\r\n'
	+ '{  $pass = "' + document.KeysForm.KeyPass.value + '";';
	 document.CustForm.selCust1.value = 'Selectionner la cl&eacute;.'; 
	
	 document.CustForm.TpeCust2.rows=8; document.CustForm.TpeCust2.value 
	 = document.KeysForm.Key2nd.value.substring(2,42);
	 document.CustForm.selCust2.value = 'Selectionner la clé.'; 
	
	 document.CustForm.TpeCust3.rows=8; document.CustForm.TpeCust3.value
	= 'Keep in mind to do your best about storing splitted keys safe and secure.\r\n'
	+ 'Prendre les meilleures dispositions pour stocker et proteger les 2 parties de la clef.'; 
	 document.CustForm.selCust3.value='';
	
	 return true;
	}
	
	function getPHP3(TPE) {if (SiteCtl(TPE)==false) return false;
	
	 document.CustForm.TpeCust1.rows=6; document.CustForm.TpeCust1.value
	= 'define("CMCIC_DIR", "/test/");\r\n'
	+ 'define("CMCIC_SERVER", "' + document.CustForm.BankServer.value + '" );\r\n'
	+ '@require("sha1lib.class.inc.php"); // sha1 replacement for php<4.3.0 \r\n'
	+ 'function CMCIC_hmac($CMCIC_Tpe, $data="")\r\n'
	+ '{  $pass = "' + document.KeysForm.KeyPass.value + '";';
	 document.CustForm.selCust1.value = 'Select custom code for "CMCIC_HMAC.inc.php".'; 
	
	 document.CustForm.TpeCust2.rows=6; document.CustForm.TpeCust2.value
	= '$MyTpe = array ( "tpe" =>"' + TPE + '", "soc" => "' + document.CustForm.SiteCode.value
	+ '", "key" => "' + document.KeysForm.Key2nd.value.substring(2,42) + '" );\r\n'
	+ '$MyTpe["retourok"] = "' + document.CustForm.urlRetourOK.value + '";\r\n'
	+ '$MyTpe["retourko"] = "' + document.CustForm.urlRetourKO.value + '";\r\n'
	+ '$MyTpe["submit"]   = "' + document.CustForm.ButtonText.value + '";\r\n';
	 document.CustForm.selCust2.value = 'Selectionner la clé.'; 
	
	 document.CustForm.TpeCust3.rows=12; document.CustForm.TpeCust3.value
	= 'Keep in mind to do your best about storing splitted keys safe and secure.\r\n'
	+ '---\r\n'
	+ 'Copy sha1lib.class.inc.php from attached PHP3_compatibility folder to actual php-include.\r\n'
	+ 'Copier sha1lib.class.inc.php depuis le dossier PHP3_compatibility joint vers le php-include reel.\r\n'
	+ '---\r\n'
	+ 'Prendre les meilleures dispositions pour stocker et proteger les 2 parties de la clef.'; 
	 document.CustForm.selCust3.value='';
	
	 return true;
	}
	
	function getDotNet(TPE) {if (SiteCtl(TPE)==false) return false;
	
	  document.CustForm.TpeCust1.rows=2;
	  document.CustForm.TpeCust1.value='       new myTpeHmac("' + TPE + '", "' + document.KeysForm.KeyPass.value +'")';
	  document.CustForm.selCust1.value='Select "MyCyberMUT1_2open.vb" custom code for update and vbc compile.'; 
	
	  document.CustForm.TpeCust2.rows=10;  
	  document.CustForm.TpeCust2.value='     Application("CyberMUT_Server") = "' + document.CustForm.BankServer.value
	+ '"\r\n     Application("CyberMUT_Dir")    = "/test/'
	+ '"\r\n     Application("CyberMUT_'+ TPE + '_2ndHexKey") = _\r\n'
	+ '                 "' + document.KeysForm.Key2nd.value
	+ '"\r\n \'= CAUTION!  You must not share your global.asax with other companies.'
	+ '\r\n \'=ATTENTION! Vous ne devez pas partager ce global.asax avec des tiers. ';
	  document.CustForm.selCust2.value='Selectionner la clé.';
	
	  document.CustForm.TpeCust3.rows=12;
	  document.CustForm.TpeCust3.value=
	  '           dim ref as String=DateTime.Now.ToString("yyMMddHHmmss")\r\n'
	+ '           Return myTpe.CreerFormulaireHmac( _\r\n'
	+ '             "PaymentRequest", _\r\n'
	+ '             "123.45EUR", _\r\n'   
	+ '             ref, _\r\n' 
	+ '             "texte_libre", _\r\n' 
	+ '             "' + document.CustForm.urlRetourOK.value + '", _\r\n' 
	+ '             "' + document.CustForm.urlRetourKO.value + '", _\r\n' 
	+ '             "?ref=" + ref, _\r\n'   
	+ '             "' + document.TextForm.CurrentLanguage.value + '", _\r\n' 
	+ '             "' + document.CustForm.SiteCode.value + '", _\r\n' 
	+ '             "' + document.CustForm.ButtonText.value + '")';
	  document.CustForm.selCust3.value='Select "asp1.aspx" custom code.';
	
	 return true;
	}
	
	function getJavaJCE(TPE) {if (SiteCtl(TPE)==false) return false;
	
	  document.CustForm.TpeCust1.rows=3;
	  document.CustForm.TpeCust1.value=
	  '        super("'+ TPE +'",\r\n' 
	+ '              "' + document.KeysForm.Key2nd.value + '");';
	  document.CustForm.selCust1.value=
	  'Select the 2nd Key part for your Key Manager and to custom "YourTpeInstance.java".';
	
	  document.CustForm.TpeCust2.rows=12;
	  document.CustForm.TpeCust2.value=
	  '    final protected String TpeToBankServer() {\r\n'
	+ '        String TPE = this.getTPE();\r\n        return ("'
	+ document.CustForm.BankServer.value + '" + "/test/");\r\n    }\r\n'
	+ '    final protected String TpeToPassPhrase() {\r\n'
	+ '        String TPE = this.getTPE();\r\n        return ("'
	+ document.KeysForm.KeyPass.value + '");\r\n    }\r\n';
	  document.CustForm.selCust2.value=
	  'Select the PassPhrase for your Key Manager and to custom "YourTpeInstance.java".';
	
	  document.CustForm.TpeCust3.rows=9;
	  document.CustForm.TpeCust3.value=
	  '            String Formulaire = YourTpe.CreerFormulaireHmac( \r\n'
	+ '             "123.45EUR", Reference, "infos libres utiles", \r\n'
	+ '             "' + document.CustForm.urlRetourKO.value + '", \r\n'
	+ '             "' + document.CustForm.urlRetourOK.value + '?ref=facture00000001", \r\n'
	+ '             "' + document.CustForm.urlRetourKO.value + '?ref=facture00000001", \r\n'
	+ '             "' + document.TextForm.CurrentLanguage.value + '", //EN DE IT ES (*)\r\n' 
	+ '             "' + document.CustForm.SiteCode.value + '", // Site code-societe (*)\r\n' 
	+ '             "' + document.CustForm.ButtonText.value + '"); // payment button text';
	  document.CustForm.selCust3.value='Select "YourServlet1.java" custom code.';
	
	  return true;
	}
	
	function getSpec(TPE) {if (SiteCtl(TPE)==false) return false;
	 document.CustForm.TpeCust1.rows=17;
	 document.CustForm.TpeCust1.value=creerFormulaire(
	 document.CustForm.BankServer.value + "/test/",
	 TPE, "123.45EUR", getReference("Order"), "AlphaNum", 
	document.CustForm.urlRetourOK.value,document.CustForm.urlRetourKO.value, "?x=y", document.TextForm.CurrentLanguage.value,document.CustForm.SiteCode.value,document.CustForm.ButtonText.value)
	+ '\r\n       HMAC-SHA1 RFC2104 compliant Computation below / Calcul HMAC ci-dessous'
	+ '\r\nMAC := HMAC-SHA1( TPE."*".date."*".montant."*".reference."*".texte-libre\r\n ."*1.2open*".lgue."*".societe."*"'
	+ ', ' + document.KeyFileForm.FullKey.value + ' )'
	+ '\r\n {0x..} means 20byteKey from 40 Hex Digits, {.} dot operator means stringConcat.\r\n' ;
	 document.CustForm.selCust1.value=getText("creerFormulaireSpec");
	
	 document.CustForm.TpeCust2.rows=3;  
	 document.CustForm.TpeCust2.value='METHOD = post'
	+ '\r\n FIELDS_LIST =  { version; TPE; date; montant; reference; texte-libre; code-retour; [retourPLUS;] }'
	+ '\r\n       HMAC-SHA1 RFC2104 compliant Verify below / Verification HMAC ci-dessous' 
	+ '\r\nMAC == HMAC-SHA1( StringConcat( [retourPLUS,] TPE,"+",date,"+",montant,"+",reference,"+",texte-libre\r\n ,"+", version,"+", code-retour,"+" ), ' + document.KeyFileForm.FullKey.value + ' )';
	 document.CustForm.selCust2.value=getText("testerHMACSpec");
	
	 document.CustForm.TpeCust3.rows=4;
	 document.CustForm.TpeCust3.value='-- Case testerHMAC() is True : Response = \r\n' 
	+ CreerAccuseReception("OK")
	+ '\r\n      -- Case code-retour Equals "paiement" : ........'
	+ '\r\n      -- Case code-retour Equals "payetest" : ........'
	+ '\r\n      -- Other : ...'
	+ '\r\n-- Case testerHMAC() is False : Response = \r\n'
	+ CreerAccuseReception("Document falsifie");
	 document.CustForm.selCust3.value=getText("creerAccuseReceptionSpec");
	
	 return true;
	}
	
	function getCustom(TPE) { 
	switch (document.CustForm.Kit.value)
	 {  case "DotNet":  { return getDotNet(TPE); }
		case "PHP4":    { return getPHP4(TPE); }
		case "PHP3":    { return getPHP3(TPE); }
		case "JavaJCE": { return getJavaJCE(TPE); }
		case "Spec":    { return getSpec(TPE); }
		default:        { return SiteCtl(TPE); }
	 } 
	}
	
	function getText(TextCode) { eval("document.TextForm.CurrentText.value=document.TextForm." + TextCode + document.TextForm.CurrentLanguage.value + ".value;"); return document.TextForm.CurrentText.value; }
	</SCRIPT>	
	<?php
	
	$this->_html .= '<FORM name="TextForm">
	<input type=hidden name=CurrentText  size=10 maxlength=255 value="">
	<input type=hidden name=pasteKeyFR  size=10 maxlength=255 value="IMPORTANT ! Coller dans cette zone multi-lignes le contenu de votre fichier clef nnnnnnn.key, (texte &quot;mati&egrave;re&quot; commen&ccedil;ant &eacute;galement par &quot;VERSION&quot;, obtenu en t&eacute;l&eacute;chargement SSL sur le site s&eacute;curis&eacute; de la banque ). Remplacer l\'exemple de clef ci-dessus et suivre la sequence des boutons. Cette page d\'outils s\'ex&eacute;cutera localement.">
	<input type=hidden name=notAgreedFR size=10 maxlength=255 value="Pour utiliser cet outil, il faut d\'abord lire et accepter les termes des licences. ">
	<input type=hidden name=genPassFR size=10 maxlength=255 value="Phrase Clef de votre choix >">
	<input type=hidden name=sel1stFR size=10 maxlength=255 value="S&eacute;lectionner la 1&egrave;re partie (= Phrase Clef)." >
	<input type=hidden name=sel2ndFR size=10 maxlength=255 value="S&eacute;lectionner la 2nde partie (hexa).">
	<input type=hidden name=selKeyFR size=10 maxlength=255 value="S&eacute;lectionner la Clef hexa compl&egrave;te.">
	<input type=hidden name=inputTpeFR size=10 maxlength=255 value="Saisir votre No de TPE &agrave; 7 Chiffres :">
	<input type=hidden name=genCtlFR size=10 maxlength=255 value="Calculer le HMAC de Contr&ocirc;le >">
	<input type=hidden name=askCtlFR size=10 maxlength=255 value="Information de s&eacute;curit&eacute; : Le centre de support peut vous demander la valeur de ce hachage de contr&ocirc;le, mais non la valeur de la clef elle-m&ecirc;me.">
	<input type=hidden name=invalidKeyFR size=10 maxlength=255 value="Clef invalide ! Seuls les chiffres hexad&eacute;cimaux sont accept&eacute;s.">
	<input type=hidden name=invalidTpeFR size=10 maxlength=255 value="Numero de TPE invalide ! Seuls les chiffres sont accept&eacute;s.">
	<input type=hidden name=shorterTpeFR size=10 maxlength=255 value="Numero TPE incomplet ! 7 chiffres obligatoires.">
	<input type=hidden name=invalidVrsFR size=10 maxlength=255 value="Version de fichier Clef incorrecte : ">
	<input type=hidden name=badformKeyFR size=10 maxlength=255 value="Clef mal form&eacute;e !">
	<input type=hidden name=MD5KeyFR size=10 maxlength=255 value="Erreur : Clef pour Hmac-MD5 !">
	<input type=hidden name=badSocieteFR size=10 maxlength=255 value= "Le code societe (fourni par centrecom) doit avoir au moins 2 caract&egrave;res" >
	<input type=hidden name=creerFormulaireSpecFR size=10 maxlength=255 value="Sp&eacute;cifications de la fonction \'\'creerFormulaire()\'\'">
	<input type=hidden name=testerHMACSpecFR size=10 maxlength=255 value="Sp&eacute;cifications de la fonction \'\'testerHMAC()\'\'">
	<input type=hidden name=creerAccuseReceptionSpecFR size=10 maxlength=255 value="Sp&eacute;cifications de la fonction \'\'creerAccuseReception()\'\'">
	<input type=hidden name=CurrentLanguage size=2 maxlength=2 value="FR">
	</FORM>
	<FORM name="KeysForm">
	<input type=hidden name=KeyPass maxlength=32 value ="">
	<input type=hidden name=Key2nd  maxlength=66 value ="">
	<input type=hidden name=KeyFull maxlength=66 value="">
	</FORM>
	<FORM name="RFC2104">
	<DIV ID="Licenses">
	<TABLE width=98% border=2>
	<TR align=center><TD><font face="Arial, Helvetica, sans-serif" size="1">CyberMUT1_2openKit V1.03h for CyberMUT P@iement<SMALL><SUP>TM</SUP></SMALL> P@iement CIC<SMALL><SUP>TM</SUP></SMALL> P@iement OBC<SMALL><SUP>TM</SUP></SMALL><BR>
	No technical support is offered for the CyberMUT1_2openKits.<BR>We do however welcome your feedback which can be sent to centrecom@e-i.com (EuroInformation/Lille_910_e-commerce).<BR></font>
	<textarea name="EI_BSDLicense" cols=79 rows=9 readonly>Copyright  : (c) 2003-2004 EuroInformation. All rights reserved.
	Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
	- Redistributions of source code must retain the above copyright notice and the following disclaimer.
	- Redistributions in binary form must reproduce the above copyright notice and the following disclaimer in the documentation and/or other materials provided with the distribution.
	- Neither the name of EuroInformation nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
	</textarea>
	<TR align=center><TD><font face="Arial, Helvetica, sans-serif" size="1">This Software uses Paul Johnston\'s JavaScript MD5 Library distributed under the BSD License<BR>See http://pajhome.org.uk/crypt/md5 for more info<BR></font>
	<textarea name="PJ_BSDLicense" cols=79 rows=3 readonly>
	Copyright (c) 1998 - 2002, Paul Johnston & Contributors. All rights reserved. 
	Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met: 
	Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution. 
	Neither the name of the nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission. 
	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 
	</textarea></TD></TR>
	<TR align=center><TD><font face="Arial, Helvetica, sans-serif" size="1">This software uses RSA Data Security, Inc. MD5 Message-Digest Algorithm<BR></font>
	<textarea name="BSD_License" cols=79 rows=3 readonly>
	The JavaScript code implementing the algorithm is derived from the C code in RFC 1321 and is covered by the following copyright: 
	Copyright (C) 1991-2, RSA Data Security, Inc. Created 1991. All rights reserved. 
	License to copy and use this software is granted provided that it is identified as the "RSA Data Security, Inc. MD5 Message-Digest Algorithm" in all material mentioning or referencing this software or this function. 
	License is also granted to make and use derivative works provided that such works are identified as "derived from the RSA Data Security, Inc. MD5 Message-Digest Algorithm" in all material mentioning or referencing the derived work. 
	RSA Data Security, Inc. makes no representations concerning either the merchantability of this software or the suitability of this software for any particular purpose. It is provided "as is" without express or implied warranty of any kind. 
	These notices must be retained in any copies of any part of this documentation and/or software. 
	This copyright does not prohibit distribution of the JavaScript MD5 code under the BSD license. 
	</textarea><BR>
	<input type=radio name="agreement" value="0" onClick=\'initRFC2104("0","FR");\'>Je refuse &nbsp;&nbsp;&nbsp;
	<input type=radio name="agreement" value="2" onClick=\'initRFC2104("1","FR");\'><B>J\'accepte les termes des pr&eacute;sentes licences.</B><BR>
	</TD></TR></TABLE></DIV>
	<input type="hidden" name="showLicenses" />
	</FORM>
	<FORM name="KeyFileForm">
	<TABLE width=98% border=1>
	<TR align=center><TD>
	<textarea name="KeyFile" cols=79 rows=5 onFocus=\'if (!hasAgreed()) this.blur();\' onChange=\'controleCle();\'></textarea><BR>
	<input type="hidden" name="tryKey" disabled >
	<BR>
	<input type=hidden name=HashMethod value="SHA1">
	<font face="Arial, Helvetica, sans-serif" size="1"><I>Clef interm&eacute;diaire d&eacute;duite :</I></font>
	<input type=text name=FullKey size=50 maxlength=42 readonly><BR>
	<input type=button name=genPass disabled value="" 
	onClick="document.KeyFileForm.PassPhrase.value=getPassPhrase(20); extract2Hmac(); ">
	<input type=text name=PassPhrase value="'.$PassPhrase.'" size=40 maxlength=20 onChange="extract2Hmac();">
	<input name="RESET" type=button value="< Reset" onClick="document.KeyFileForm.reset(); initRFC2104(\'\',\'\');">
	</TD></TR>
	</TABLE></FORM>
	
	<FORM name="TpeForm"><TABLE width=98% border=1> 
	<TR align=center><TD><input type=text name=inputTpe size=40 readonly value="">
	<input type=text name=TpeNum size=10 maxlength=7 value="" 
	onChange="resetCust(); TpeCtlHmac(document.TpeForm.TpeNum.value);">
	<input type=button name=genCtl value="" 
	onClick="resetCust(); InfoCtlHmac();"><BR>
	<input type=text name=CtlHmac size=90 maxlength=200 readonly>
	<input name="RESET" type=button value="< Reset" onClick="resetTpe();document.KeyFileForm.RESET.focus();">
	</TD></TR> </TABLE> </FORM> 
	
	<FORM name="CustForm"> <DIV ID="CustTables">
	<TABLE width=98% border=1><TR><TD><TABLE width=98% border=0>
	<TR align=left><TD colspan="2"><font face="Arial, Helvetica, sans-serif" size="1"><I>Code Soci&eacute;t&eacute;</I></font><BR>
	<input type=text name=SiteCode size=25 maxlength=20 value="'.$SiteCode.'"></TD>
	</TR>
	<TR align=left><TD colspan="2">
	<input type=hidden name=ButtonText size=40 maxlength=64 value="Paiement par carte bancaire">
	<input type=hidden name=urlRetourOK value="http://'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'my-account.php" disabled="disabled" />
	<input type=hidden name=urlRetourKO value="http://'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'order.php" />
	<input type=hidden name="Kit" value="PHP4">
	<font face="Arial, Helvetica, sans-serif" size="1"><I>Serveur bancaire</I></font><BR>
	<select name="BankServer">
		<option selected value="ssl.paiement.cic-banques.fr">CIC</option>
		<option value="paiement.creditmutuel.fr">Cr&eacute;dit Mutuel</option>
		<option value="ssl.paiement.banque-obc.fr">OBC-ABNAMRO</option>
	</select>
	<input name="OK" type=button value="G&eacute;n&eacute;rer la Cl&eacute; >" disabled onClick="getCustom(document.TpeForm.TpeNum.value);">
	<input name="RESET" type=button value="< Reset" onClick="resetCust(); TpeCtlHmac(document.TpeForm.TpeNum.value); document.TpeForm.RESET.focus();"
	</TD></TR></TABLE>
	<div style="display:none;">
	<TABLE width=98% border=1><TR align=center><TD><textarea name="TpeCust1" cols=79 rows=2 readonly></textarea>
	</TD></TR><TR align=center><TD><input type=button value="(_|_)" name="selCust1" onClick="HighLightCust1();">&nbsp;&nbsp;
	</TD></TR>
	</TABLE>
	<TABLE width=98% border=2><TR align=center><TD><textarea name="TpeCust3" cols=79 rows=2 readonly></textarea>
	</TD></TR><TR align=center><TD><input type=button value="(_|||_)" name="selCust3" onClick="HighLightCust3();">&nbsp;&nbsp;
	</TD></TR> </TABLE>
	</div>
	<TABLE width=98% border=2><TR align=center><TD><input type="text" name="TpeCust2" value="'.$CtlHmac.'" size=50 maxlength=42 readonly>
	</TD></TR><TR align=center><TD><input type=button value="Remplissez les champs requis" name="selCust2" onClick="HighLightCust2();">&nbsp;&nbsp;
	</TD></TR> 
	</TABLE></TD></TR></TABLE>
	</DIV></fieldset>
    </FORM><br /><br />';

	$this->_html .= '
    <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
    <fieldset>
      <legend><img src="../img/admin/contact.gif" />Configuration</legend>
      <label>Phrase Cl&eacute; :</label>
      <div class="margin-form">
      <input type="text" name="PassPhrase" size=55 maxlength=42 value="'.$PassPhrase.'" />
      </div>
      <br />
      <label>Num&eacute;ro de TPE :</label>
      <div class="margin-form">
      <input type="text" name="TpeNum" size=55 maxlength=42 value="'.$TpeNum.'" />
      </div>
      <br />
      <label>Code Soci&eacute;t&eacute; :</label>
      <div class="margin-form">
      <input type="text" name="SiteCode" size=55 maxlength=42 value="'.$SiteCode.'" />
      </div>
      <br />
      <label>Cl&eacute :</label>
      <div class="margin-form">
      <input type="text" name="CtlHmac" size=55 maxlength=42 value="'.$CtlHmac.'" />
      </div>
      <br />
      <label>Page Interface Retour :</label>
      <div class="margin-form">
      http://'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'modules/euroinformation/order.php
      </div>
      <br />
      <label>Url paiement OK :</label>
      <div class="margin-form">
      http://'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'my-account.php
      </div>
      <br />
      <label>Url paiement Non OK :</label>
      <div class="margin-form">
      http://'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'order.php
      </div>
      <br />
      <label>Serveur bancaire :</label>
      <div class="margin-form">
      <input type="radio" name="BankServer" value="https&#x3a;&#x2f;&#x2f;ssl.paiement.cic-banques.fr&#x2f;telepaiement&#x2f;paiement.cgi" '.$checkcicprod.'/> CIC Production&nbsp;
      <input type="radio" name="BankServer" value="https&#x3a;&#x2f;&#x2f;ssl.paiement.cic-banques.fr&#x2f;test&#x2f;paiement.cgi" '.$checkcictest.'/> CIC Test
      </div>
      <div class="margin-form">
      <input type="radio" name="BankServer" value="https&#x3a;&#x2f;&#x2f;www.creditmutuel.fr&#x2f;telepaiement&#x2f;paiement.cgi" '.$checkcmprod.'/> Cr&eacute;dit Mutuel Production&nbsp;
      <input type="radio" name="BankServer" value="https&#x3a;&#x2f;&#x2f;paiement.creditmutuel.fr&#x2f;test&#x2f;paiement.cgi" '.$checkcmtest.'/> Cr&eacute;dit Mutuel Test
      </div>
      <div class="margin-form">
      <input type="radio" name="BankServer" value="https&#x3a;&#x2f;&#x2f;ssl.paiement.banque-obc.fr&#x2f;telepaiement&#x2f;paiement.cgi" '.$checkobcprod.'/> OBC Production&nbsp;
      <input type="radio" name="BankServer" value="https&#x3a;&#x2f;&#x2f;ssl.paiement.banque-obc.fr&#x2f;test&#x2f;paiement.cgi" '.$checkobctest.'/> OBC Test
      </div>
	  <br />
      <input type=hidden name=urlRetour value="http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'modules&#x2f;euroinformation&#x2f;order.php" />
      <input type=hidden name=urlRetourKO value="http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'order.php" />
      <input type=hidden name=urlRetourOK value="http&#x3a;&#x2f;&#x2f;'.htmlspecialchars($_SERVER['HTTP_HOST'].__PS_BASE_URI__, ENT_COMPAT, 'UTF-8').'my-account.php" />
      <br /><center><input type="submit" name="submitEuroInformation" value="Sauvegarder" class="button" /></center>
    </fieldset>
    </form><br /><br />';

    $this->_html .= '<fieldset>
      <legend><img src="../img/admin/warning.gif" />Information</legend>
      Afin d\'utiliser votre module de paiement Euro Information, vous devez demander &agrave; votre banque la cr&eacute;ation votre compte e-commerce Euro Information.<br /><br />
	  <font color=red><b>L\'outil SHA1 simplifi&eacute;</b></font> est une version concise de l\'outil SHA1 qui vous est donn&eacute; par votre banque, le passage par cet outil est indispensable pour configurer ce module.<br />
	  Utilisez l\'outil SHA1 simplifi&eacute; doit &ecirc;tre utilis&eacute; pour configurer le module pour votre phase de tests et de production. Vous pouvez laisser tel quel en attendant d\'avoir plus d\'informations de la part de votre banque.<br />
      Entrez la <i><b>Phrase Cl&eacute;</b></i> que vous avez choisie lors de l\'utilisation de l\'outil SHA1.<br />
      Entrez <i><b>Votre Num&eacute;ro de TPE Euro Information</b></i>, qui vous est donn&eacute; par votre banque.<br />
      Entrez <i><b>Votre Code Soci&eacute;t&eacute; Euro Information</b></i> que vous avez choisi lors de l\'utilisation de l\'outil SHA1.<br />
      Entrez la <i><b>Cl&eacute; Euro Information</b></i>. Utiliser l\'outil SHA1 simplifi&eacute; pour la calculer.<br />
      La <i><b>Page Interface Retour</b></i> est &agrave; indiquer &agrave; votre banque.<br />
      Choisissez le <i><b>Serveur Bancaire</b></i>.<br /></fieldset>';
  }

  public function hookPayment($params){
    global $smarty;
    $address = new Address(intval($params['cart']->id_address_invoice));
    $customer = new Customer(intval($params['cart']->id_customer));
    $id_currency = intval($params['cart']->id_currency);
    $currency = new Currency(intval($id_currency));

    $MyTpe["retouraccueil"]= Configuration::get('EI_URLRETOUR');
    $MyTpe["retourok"]     = Configuration::get('EI_URLRETOUROK');
    $MyTpe["retourko"]     = Configuration::get('EI_URLRETOURKO');
    $MyTpe["submit"]       = "Payer par carte bancaire avec Euro Information";
    $MyTpe["reference"]    = intval($params['cart']->id);
    $MyTpe["devise"]       = $currency->iso_code;
    $MyTpe["commentaire"]  = "Commande";
    $MyTpe["langue"]       = "FR";
    $MyTpe["tpe"]          = Configuration::get('EI_TPENUM');
    $MyTpe["soc"]          = Configuration::get('EI_SITECODE');
    $MyTpe["key"]          = Configuration::get('EI_CTLHMAC');
    $MyTpe["PassPhrase"]   = Configuration::get('EI_PASSPHRASE');
    $MyTpe["BankServer"]   = Configuration::get('EI_BANKSERVER');
	$poscic = strpos($MyTpe["BankServer"],'cic');
	$posobc = strpos($MyTpe["BankServer"],'obc');
	$poscm  = strpos($MyTpe["BankServer"],'creditmutuel');
	if($poscic!==false)
		$MyTpe["Bank"] 	= 'cic';
	elseif($posobc!==false)
		$MyTpe["Bank"] 	= 'obc';
	elseif($poscm!==false)
		$MyTpe["Bank"] 	= 'cybermut';
    
    if (!Validate::isLoadedObject($address) OR !Validate::isLoadedObject($currency))
      return $this->l('EuroInformation error: (invalid id)');
    $products = $params['cart']->getProducts();
    foreach ($products as $key => $product){
      $products[$key]['name'] = str_replace('"', '\'', $product['name']);
      if (isset($product['attributes']))
        $products[$key]['attributes'] = str_replace('"', '\'', $product['attributes']);
      $products[$key]['name'] = htmlentities(utf8_decode($product['name']));
      $products[$key]['Amount'] = number_format(Tools::convertPrice($product['price_wt'], $currency), 2, '.', '');
    }
    $MyTpe["montant"]      = number_format(Tools::convertPrice($params['cart']->getOrderTotal(true, 4), $currency), 2, '.', '');
    $shipping              =  number_format(Tools::convertPrice($params['cart']->getOrderShippingCost(), $currency), 2, '.', '');
    $MyTpe["montant"]      = $MyTpe["montant"]+$shipping;
    
    $MyTpe["submit"]   = "Paiement par carte bancaire";
    function hmac($Vtpe,$PassPhrase,$data="") {
      $k1 = pack("H*",sha1($PassPhrase));
      $l1 = strlen($k1);
      $k2 = pack("H*",$Vtpe['key']);
      $l2 = strlen($k2);
      if ($l1 > $l2):
          $k2 = str_pad($k2, $l1, chr(0x00));
      elseif ($l2 > $l1):
          $k1 = str_pad($k1, $l2, chr(0x00));
      endif;
      if ($data==""):
          $d = "CtlHmac1.2open". $Vtpe['tpe'];
      else:
          $d = $data;
      endif;
      return strtolower(hmac_sha1($k1 ^ $k2, $d)); // ^ veut dire XOR
    }
    function hmac_sha1 ($key, $data) {
      $length = 64; // block length for SHA1
      if (strlen($key) > $length) { $key = pack("H*",sha1($key)); }
      $key  = str_pad($key, $length, chr(0x00));
      $ipad = str_pad('', $length, chr(0x36));
      $opad = str_pad('', $length, chr(0x5c));
      $k_ipad = $key ^ $ipad ;
      $k_opad = $key ^ $opad;
      return sha1($k_opad  . pack("H*",sha1($k_ipad . $data)));
    }
    function HtmlEncode ($data) {
      $SAFE_OUT_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890._-";
      $encoded_data = "";
      $result = "";
      for ($i =0; $i < strlen($data); $i++) {
        if (strchr($SAFE_OUT_CHARS, $data{$i})) 
          $result = $result . $data{$i};
        else
          if (($var = bin2hex(substr($data,$i,1))) <= "7F")
            $result = $result . "&#x" . $var . ";";
          else
            $result = $result . $data{$i};
      }
      return $result;
    }
    function TesterHmac($Vtpe,$PassPhrase, $BruteVars ) {
      @$MyFields = $BruteVars['retourPLUS'] . $Vtpe["tpe"] . "+" . $BruteVars["date"] . "+" . $BruteVars['montant'] . "+" . 
        $BruteVars['reference'] . "+" . $BruteVars['texte-libre'] . "+1.2open+" . $BruteVars['code-retour'] . "+";
      if ( strtolower($BruteVars['MAC'] ) == hmac($Vtpe,$PassPhrase, $MyFields) ) {
        $result  = $BruteVars['code-retour'] . $BruteVars['retourPLUS'];
        $receipt = "OK";
      } else { 
          $result  = 'None';
          $receipt = "Document Falsifie 0--".$MyFields;
      }
      $len_montant = strlen($BruteVars['montant'] ) - 3;
      if ($len_montant > 0) {
        $currency = substr($BruteVars['montant'], $len_montant, 3);
        $amount   = substr($BruteVars['montant'], 0, $len_montant);
      } else {
        $currency = "";
        $amount   = $BruteVars['montant'];
      }
      return array( "resultatVerifie" => $result , "accuseReception" => $receipt ,
                    "tpe" => $BruteVars['TPE'],"reference" => $BruteVars['reference'],
                    "texteLibre" => $BruteVars['texte-libre'], "devise" => $currency, "montant" => $amount);
    }
    $CleHmac = "V1.03.sha1.php4--CtlHmac-1.2open-[" . $MyTpe['tpe'] . "]-" . hmac($MyTpe,$MyTpe["PassPhrase"]);
    $Return_Context = "?order_ref=".$MyTpe["montant"];
    if ($MyTpe["commentaire"] == "") $MyTpe["commentaire"] = "-";
    $Order_Date = date("d/m/Y:H:i:s");
    $Language_2 = substr($MyTpe["langue"], 0, 2);
    $keyedMAC = hmac($MyTpe,$MyTpe["PassPhrase"], $MyTpe["tpe"] . "*" . $Order_Date . "*" . $MyTpe["montant"] . $MyTpe["devise"] . "*" . $MyTpe["reference"] . "*" .
                            $MyTpe["commentaire"] . "*1.2open*" . $Language_2 . "*" . $MyTpe['soc'] . "*");

    $action= HtmlEncode($MyTpe["BankServer"]); //
    $version= HtmlEncode("1.2open"); //
    $TPE= HtmlEncode( $MyTpe["tpe"] ); //
    $date= $Order_Date; //
    $montant= HtmlEncode( $MyTpe["montant"] ).HtmlEncode( $MyTpe["devise"] ); //
    $reference= $MyTpe["reference"] ; //
    $MAC= HtmlEncode( $keyedMAC ); //
    $url_retour= $MyTpe["retouraccueil"]; //
    $url_retour_ok= $MyTpe["retourok"]; //
    $url_retour_err= $MyTpe['retourko']; //
    $lgue= HtmlEncode( $Language_2 ); //
    $societe= HtmlEncode( $MyTpe['soc'] ); //
    $bouton= HtmlEncode( $MyTpe['submit'] );
    
    $smarty->assign(array(
      'CleHmac' => $CleHmac,
      'address' => $address,
      'country' => new Country(intval($address->id_country)),
      'customer' => $customer,
      'version' => $version,
      'currency' => $currency,
      'lgue' => $lgue,
      'TpeNum' => $TPE,
      'datetoday' => $date,
      'SiteCode' => $societe,
      'MAC' => $MAC,
      'urlRetour' => $url_retour,
      'urlRetourOK' => $url_retour_ok,
      'urlRetourKO' => $url_retour_err,
      'Bank' => $MyTpe["Bank"],
      'BankServer' => $action,
      'amount' =>$montant,
      'shipping' =>  number_format(Tools::convertPrice($params['cart']->getOrderShippingCost(), $currency), 2, '.', ''),
      'discounts' => $params['cart']->getDiscounts(),
      'products' => $products,
      'total' => $MyTpe["montant"],
      'id_cart' => $reference,
      'submit' => $bouton,
      'this_path' => $this->_path
    ));
    return $this->display(__FILE__, 'euroinformation.tpl');
    }
}

?>
