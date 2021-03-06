<?php
@header('Content-type: text/html; charset=utf-8');


@include_once("../sps.configuration.php");
@include_once("../sps.connect.inc.php");
@include_once("../locale.php");
@include_once("functions.php");

if(empty($format_date_sql)) {$format_date_sql = "'$annee-$mois-01' <= date AND date <= '$annee-$mois-31'"; }



	echo "<a name=\"hotes\"></a>";
	$lang_top_hotes = _("Top %s des noms d'hotes");
	echo "<h2>";
	printf($lang_top_hotes,$sps_config['display_hotes']);
	echo "</h2>\n";
	echo "<div id=\"hotes\">\n";
	
	$texte = _("Les noms d'hotes sont les identifiants des fournisseurs d'acces des visiteurs s'etant connectes au site, ils sont classes par nombre de visites depuis cet hote pour la periode en cours");
	affiche_aide($texte,"themes/".$sps_config['default_theme']."/icones/help.png",$sps_config['aide']);

	$req = @mysql_query("SELECT DISTINCT(host),COUNT(host) AS nbhost FROM ".$sps_config['db_prefix']."statistiques WHERE host != '' AND $format_date_sql AND host!=ip GROUP BY host ORDER BY nbhost DESC LIMIT 0,".$sps_config['display_hotes'].";");
	
	$res_all_request = @mysql_num_rows($req);
	$i = 0;
	while($i != $res_all_request)
	{
	
	$gauche = @mysql_result($req,$i,"host");
	$droite = @mysql_result($req,$i,"nbhost");
	
	$domaine = explode(".",$gauche);
	$dmn = array_reverse($domaine);
	$icone = "http://www.".$dmn[1].".".$dmn[0]."/favicon.ico";
	
	affiche_table($gauche,$droite,0,$icone,$i);
	
	unset($icone);
	$i++;
	}
	
	echo "</div>\n";
	
	
####################################################################################################
// Affichage des IP
// IP display
	
	echo "<a name=\"ip\"></a>";
	$lang_top_ip = _("Top %s des adresses IP");
	echo "<h2>";printf($lang_top_ip,$sps_config['display_ip']);echo "</h2>\n";
	
	echo "<div id=\"ip\">\n";
	
	$texte = _("Les adresses IP sont les numeros qui identifient chaque ordinateur connecte a Internet, les visiteurs de votre site sont indexes grace a cet identifiant unique. Elles sont classees par nombre de visites depuis cette adresse IP pour la periode en cours");
	affiche_aide($texte,"themes/".$sps_config['default_theme']."/icones/help.png",$sps_config['aide']);
	
	$req = @mysql_query("SELECT DISTINCT(ip) as ip,COUNT(ip) AS nbip FROM ".$sps_config['db_prefix']."statistiques WHERE $format_date_sql GROUP BY ip ORDER BY nbip DESC LIMIT 0,".$sps_config['display_ip'].";");
	$res_all_request = @mysql_num_rows($req);
	$i = 0;
	while($i != $res_all_request)
	{
	
	$gauche = @mysql_result($req,$i,"ip");
	$droite = @mysql_result($req,$i,"nbip");
	
	$url = "http://www.ripe.net/fcgi-bin/whois?searchtext=".$gauche;
	
	$icone = "http://api.hostip.info/flag.php?ip=".$gauche;
	
	affiche_table($gauche,$droite,$url,$icone,$i);

	$i++;
	}


	echo "</div>";
?>