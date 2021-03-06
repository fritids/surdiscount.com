<?php
# ***** BEGIN LICENSE BLOCK *****
# This file is part of SpongeStats
# Copyright (c) 2006 Bastien Bobe. All rights reserved.
#
# SpongeStats is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# SpongeStats is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# ***** END LICENSE BLOCK *****
if (!isset($_GET['onglet']))
{
	header('Content-type: text/html; charset=utf-8');
@include_once("../sps.configuration.php");
@include_once("../sps.connect.inc.php");
}
@include_once("../locale.php");

@include("functions.php");

$nom_mois = array("01" => _("Janvier"), "02" => _("Fevrier"), "03" => _("Mars"), "04" => "Avril", "05" => _("Mai"), "06" => _("Juin"), "07" => _("Juillet"), "08" =>_("Aout"), "09" => _("Septembre"), "10" => _("Octobre"), "11" => _("Novembre"), "12" => _("Decembre"));
echo "<h3>"._("Statistiques de")." ".$nom_mois[$mois]." $annee</h3>";
$nb_jours = date("t", mktime(0,0,0,$mois,1,$annee));

	echo "<div>
	<ul>
		<li><a href=\"#\" class=\"lien_annee\" id=\"stats_annee-$annee\">"._("Voir les statistiques globales pour l'annee")." $annee</a></li>
		<li><a href=\"#frequentation\" >"._("Voir les statistiques de frequentation")."</a></li>
		<li><a href=\"#plages-horaires\" >"._("Voir les statistiques horaires")."</a></li>
	</ul>
	</div>";
		
	
	$i_bar = 1;
$i_day = 1;

$table_i_bar = $i_bar;

if(strlen($mois) == 1) {$mois_date = "0".$mois;}
else $mois_date=$mois;
$req_total = mysql_query("SELECT SUM(visiteurs) as sum_visiteurs,SUM(pages) as sum_pages FROM ".$sps_config['db_prefix']."archives WHERE '$annee-$mois-01' <= date AND date <= '$annee-$mois_date-31';");
$res_total = @mysql_result($req_total,0,"sum_pages");
$res_ip_total = @mysql_result($req_total,0,"sum_visiteurs");

//echo "</div>\n";
echo "<a name=\"frequentation\"></a>";
echo "<h2>"._("Statistiques de frequentation")."</h2>\n";
echo "<div>\n";


while($i_bar < $nb_jours+1)
	{
	if(strlen($i_bar) == 1) {$i_bar_var = "0".$i_bar;} else {$i_bar_var = $i_bar;}
	$req = mysql_query("SELECT visiteurs,pages FROM ".$sps_config['db_prefix']."archives WHERE date='$annee-$mois-$i_bar_var';");
	if(@mysql_num_rows($req))
	{
	$res_pages = @mysql_result($req,0,"pages");
	$res_ip = @mysql_result($req,0,"visiteurs");
	

	if(!empty($res_pages)) 	$table_h[$i_bar] = $res_pages;
	if(!empty($res_ip))	$table_v[$i_bar] = $res_ip;

$long = $res_pages;
$long_ip = $res_ip;

	}
	$i_bar++;
}

$day_h = count($table_h);
$day_v = count($table_v);

$table_sort_h = $table_h;
$table_sort_v = $table_v;

  @sort($table_sort_h);
  @reset($table_sort_h);
  while (list ($key, $val) = @each ($table_sort_h)) {
    $h_max = $val;
  }
  @sort($table_sort_v);
  @reset($table_sort_v);
  while (list ($key, $val) = @each ($table_sort_v)) {
    $v_max = $val;
  }

@  $avg_v = round($res_ip_total / $day_v);
@  $avg_h = round($res_total / $day_h);

@ $avg_total = round($res_total/$res_ip_total,2);

$size = 160;
@ $coef_h = $size / $h_max;
@ $coef_v = $size / $v_max;

affiche_table(_("Nombre de visiteurs total"),$res_ip_total,0,0,0);
affiche_table(_("Nombre de pages vues total"),$res_total,0,0,1);
affiche_table(_("Nombre de visiteurs maximum"),$v_max,0,0,0);
affiche_table(_("Nombre de pages vues maximum"),$h_max,0,0,1);
affiche_table(_("Moyenne du nombre de visiteurs"),$avg_v,0,0,0);
affiche_table(_("Moyenne du nombre de pages vues par visiteur"),$avg_total,0,0,1);

// Affichage du mois
// Month display




echo "<p>&nbsp;</p>";
echo "<div id=\"details\" style=\"position:absolute;\" class=\"survol\"></div>";

$texte = _("Ce graphique affiche le nombre de visiteurs et de pages vues pour la periode en cours, cliquez sur les barres ou sur le chiffre pour obtenir le detail des visiteurs pour cette journee.");
affiche_aide($texte,"themes/".$sps_config['default_theme']."/icones/help.png",$sps_config['aide']);

echo "<table cellpadding=\"0\" cellspacing=\"0\"  style=\"margin-left:auto;margin-right:auto;\"><tr>";

while($table_i_bar < $nb_jours+1)
	{
		$long_h = (isset($table_h[$table_i_bar])) ? round($table_h[$table_i_bar] * $coef_h) : 0;
		$long_v = (isset($table_v[$table_i_bar])) ? round($table_v[$table_i_bar] * $coef_h) : 0;
		
	
	if(strlen($table_i_bar) == 1) {$i_link = "0".$table_i_bar;} else {$i_link = $table_i_bar;}
	
	echo "<td style=\"vertical-align:bottom;\" ";
	if($long_h != 0) echo "onmouseover=\"affiche_details('$table_i_bar/','$mois_date','$annee','".$table_h[$table_i_bar]."','".$table_v[$table_i_bar]."');\" onmouseout=\"cache_details();\"";
	echo ">";
	echo "<div id=\"stats_jour-$i_link-$mois-$annee-$table_i_bar\" class=\"barre-hits-mois lien_jour\" style=\"height:".$long_h."px;cursor:pointer;\"></div>\n";

	echo "</td><td style=\"vertical-align:bottom;\" ";
	if($long_v != 0) echo "onmouseover=\"affiche_details('$table_i_bar/','$mois_date','$annee','".$table_h[$table_i_bar]."','".$table_v[$table_i_bar]."');\" onmouseout=\"cache_details();\"";
	echo ">";
	echo "<div id=\"stats_jour-$i_link-$mois-$annee-".($table_i_bar+1)."\" class=\"barre-visiteurs-mois lien_jour\" style=\"height:".$long_v."px;cursor:pointer;\"></div>\n";

	echo "</td>";
	$table_i_bar++;
	}

	echo "</tr><tr>";
while($i_day < $nb_jours+1)
	{
	if(strlen($i_day) == 1) {$i_day = "0".$i_day;}

	$we = date("w", mktime(0,0,0,$mois,$i_day,$annee));
	if($we ==0 or $we==6) $class = "color-weekend"; else $class= "color-semaine";
	echo "<td colspan=\"2\">";
	echo "<span style=\"font-size:9px;text-align:center;width:18px;\"><a href=\"#\" class=\"$class lien_jour\" id=\"stats_jour-$i_day-$mois-$annee\">$i_day</a></span>";
	echo "</td>\n";
	$i_day++;
	}

	echo "</tr></table></div>\n";
	echo "\n";


//echo "</tr></table>";

echo "<div class=\"legende-1\"><span  class=\"legende-2 barre-visiteurs-mois\"></span><span class=\"legende-3\">"._("Visiteurs")."</span><span class=\"legende-4 barre-hits-mois\"></span><span class=\"legende-5\">"._("Pages vues")."</span></div>";

//echo "</div>\n";

include_once("inc.graph_horaire.php");


mysql_close($connect_db);
?>