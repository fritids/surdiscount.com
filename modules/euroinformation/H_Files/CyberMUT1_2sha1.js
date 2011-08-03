function creerFormulaire
(rep_serveur,TPE,montant,reference,texte_libre,url_retour_ok,url_retour_nok,contexte_retour,langue,societe,texte_bouton) 
{
  var url_serveur   = 'https://' + rep_serveur + 'paiement.cgi';

  var champInput    = '">' + String.fromCharCode(13) + String.fromCharCode(10) + '   <INPUT TYPE="';

  var date_paiement = datePaiement();

  var MACchamps     = TPE           + "*"
                    + date_paiement + "*"
                    + montant       + "*"
                    + reference     + "*"
                    + texte_libre   + "*1.2open*"
                    + langue        + "*"
                    + societe       + "*";
  var champMAC   = calculerMAC(TPE,MACchamps);

  var formulaire = 
  '<FORM METHOD="post" TARGET="_top"  NAME="PaymentRequest" ACTION="' + encodeStr2HTML(url_serveur);
  formulaire += champInput + 'hidden" NAME="version"         VALUE="' + encodeStr2HTML('1.2open');
  formulaire += champInput + 'hidden" NAME="TPE"             VALUE="' + encodeStr2HTML(TPE);
  formulaire += champInput + 'hidden" NAME="date"            VALUE="' + encodeStr2HTML(date_paiement);
  formulaire += champInput + 'hidden" NAME="montant"         VALUE="' + encodeStr2HTML(montant);
  formulaire += champInput + 'hidden" NAME="reference"       VALUE="' + encodeStr2HTML(reference);
  formulaire += champInput + 'hidden" NAME="MAC"             VALUE="' + encodeStr2HTML(champMAC);
  formulaire += champInput + 'hidden" NAME="url_retour"      VALUE="' + encodeStr2HTML(url_retour_nok);
  formulaire += champInput + 'hidden" NAME="url_retour_ok"   VALUE="' + encodeStr2HTML(url_retour_ok);
  formulaire += champInput + 'hidden" NAME="url_retour_err"  VALUE="' + encodeStr2HTML(url_retour_nok);
  formulaire += champInput + 'hidden" NAME="lgue"            VALUE="' + encodeStr2HTML(langue);
  formulaire += champInput + 'hidden" NAME="societe"         VALUE="' + encodeStr2HTML(societe);
  formulaire += champInput + 'hidden" NAME="texte-libre"     VALUE="' + encodeStr2HTML(texte_libre);
  formulaire += champInput + 'submit" NAME="bouton"          VALUE="' + encodeStr2HTML(texte_bouton);
  formulaire += '"></FORM>';
  return formulaire;
}

/*
 * CyberMUT Paiement - PaiementCIC Sample
 * Tests confirmation MAC
 */
function verifierMAC(MAC, TPE, date_confirmation, montant, reference, texte_libre, code_retour) {
 var MACchamps  = TPE+"+"+date_confirmation+"+"+montant+"+"+reference+"+"+texte_libre+"+1.2open+"+code_retour+"+";
 if (MAC == calculerMAC(TPE,MACchamps)) return "1" ; else return "0-" + MACchamps;
}
/*
 * CyberMUT Paiement - PaiementCIC Sample
 * formats a receipt / response to the confirmation message
 * formate un accuse reception en reponse au message de confirmation emis par la banque
 */
function CreerAccuseReception(phrase) {  
 return 'Pragma: no-cache ' + String.fromCharCode(10) + 'Content-type: text/plain ' + String.fromCharCode(10) + 'Version:1 ' + phrase + ' ' + datePaiement();
}
/*
 * CyberMUT Paiement - PaiementCIC Sample
 * Computes HMAC SHA1 using Paul Johnston's Library
 * Calcule le HMAC SHA1 avec la librairie de Paul Johnston
 */
function calculerMAC(TPE, data) {  
  var bkey = TPE2binb(TPE);

  var ipad = Array(16), opad = Array(16);
  for(var i = 0; i < 16; i++) {
    ipad[i] = bkey[i] ^ 0x36363636;
    opad[i] = bkey[i] ^ 0x5C5C5C5C;
  }
  var hash = core_sha1(ipad.concat(str2binb(data)), 512 + data.length * chrsz);
  return binb2hex(core_sha1(opad.concat(hash), 512 + 160));
}
/*
 * Malfunction basic tests - tests de bon fonctionnement
 */
function getCtlHmac (TPE) {
 var LibV = ("V1.03.sha1.js--");
 if (TPE=="0b0b0b0")
      return( LibV  + "0b0b0b0..., Hello = 0x" + calculerMAC(TPE, "Hello"));
 else return( LibV  + "CtlHmac" + "-1.2open-[" + TPE + "]-" 
  + calculerMAC( TPE, "CtlHmac" + "1.2open" + TPE ) ); // CyberMUT test
}
/*
 *  format date francais - french date format
 */
function datePaiement() {
 now = new Date();
 var jj = now.getDate();      jj = (jj < 10)? '0' + jj : jj;
 var mm = now.getMonth() + 1; mm = (mm < 10)? '0' + mm : mm;
 var aaaa = now.getFullYear();
 var hh = now.getHours();     hh = (hh < 10)? '0' + hh : hh;
 var mn = now.getMinutes();   mn = (mn < 10)? '0' + mn : mn;
 var ss = now.getSeconds();   ss = (ss < 10)? '0' + ss : ss;
 return jj + "/" + mm + "/" + aaaa + ":" + hh + ":" + mn + ":" + ss;
}
/*
 * CyberMUT Paiement - PaiementCIC Sample
 * Retrieves hex representation of merchant (TPE) key and convert to an array of big-endian words
 * accede a la representation hexa de la cle TPE commercant et la convertit en tableau de binaires
 */
function cle2binb(Cle) {
   xCle  = new String(Cle.toUpperCase().substr(0,40));
  if(Cle.substr(0,2) == "0x") xCle = Cle.toUpperCase().substr(2,40);
  var HEX_CHARS = "0123456789ABCDEF";
  var	EvalB = "";
  for(var i = 0; i < xCle.length / 8; i++)  {
     for(var j = 0; j < 4; j++) {
        if ((HEX_CHARS.indexOf(xCle.substr(8*i+2*j,1))!=-1) 
         && (HEX_CHARS.indexOf(xCle.substr(8*i+2*j+1,1))!=-1)) {
             EvalB += String.fromCharCode(16*HEX_CHARS.indexOf(xCle.substr(8*i+2*j,1))
                                     + HEX_CHARS.indexOf(xCle.substr(8*i+2*j+1,1)));
      }
      else {
             EvalB += 0x00;
      }
  }
  }
  return str2binb(EvalB);
}
function cleXorPass(Cle, Pass) {  
  var bCle = cle2binb(Cle);
  var bPass= core_sha1(str2binb(Pass), Pass.length * chrsz);
  var bXor = Array(5), iPass = Array(5);
  var i=0, l=bPass.length; if (l>bCle.length) l=bCle.length;
  for (i = 0; i < bCle.length; i++)   bXor[i] = bCle[i] ;
  for (i = 0; i < l; i++)   bXor[i] = bXor[i] ^ bPass[i]; 
  return bXor;
}
function TPE2binb(TPE) {
  if (TPE=="0b0b0b0")
    return cle2binb("0x0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b0b000000");
  var hex2ndKey  = hexCle(TPE);
  var passPhrase = phraseCle(TPE);
  return cleXorPass(hex2ndKey,passPhrase);
}
function encodeStr2HTML(Source) {
 var encoded = "";
 var RESERVED_CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890._-'

 for (var i=0; i<Source.length; i++)
 {
   if (Source.charCodeAt(i)<=127)
   {
     if (RESERVED_CHARS.indexOf(Source.charAt(i))!=-1)
     {
       encoded += Source.charAt(i)
     }
     else
     {
       encoded += "&#x" + Hex(String(Source.charAt(i))) + ";"
     }
   }
   else
   {
     encoded += Source.charAt(i)
   }
 }
 return encoded;
}
function Hex(chaine)
{
  var hextab = "0123456789ABCDEF";
  var strH = "";

  for (var i=0; i<chaine.length; i++) {
    strH += hextab.charAt((chaine.charCodeAt(i) >> 4) & 0xF)
    strH += hextab.charAt(chaine.charCodeAt(i) & 0xF)
  }
  return strH;
}
