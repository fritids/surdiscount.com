<?php

mysql_connect( 'db826.1and1.fr', 'dbo194351872', 'aqHkyteD' );
mysql_select_db( 'db194351872' );

function __autoload ( $className ) {
	require_once( 'classes/'.$className.'.class.php' );
}

$edit_id = 0;
if ( $_GET['action'] == 'edit' ) {
	$edit_id = $_GET['id'];
}

$client_loterie = new client_loterie( $edit_id );

if ( $_GET['action'] == 'delete' ) {
	$id = $_GET['id'];

	$client_loterie->delete( $id );

	header( 'location: index.php' );
}

if ( count( $_POST ) > 0 ) {

	if ( $_GET['action'] == 'edit' ) {
		$client_loterie->save( $edit_id, $_POST );

		header( 'location: index.php' );
	}
	else {
		if ( !empty( $_POST['prenom'] ) ) $where[] = "cl.prenom = '".$_POST['prenom']."'";
		if ( !empty( $_POST['nom'] ) ) $where[] = "cl.nom = '".$_POST['nom']."'";
		if ( !empty( $_POST['email'] ) ) $where[] = "cl.email = '".$_POST['email']."'";
		if ( !empty( $_POST['postal'] ) ) $where[] = "cl.postal = '".$_POST['postal']."'";

		$appli['where'] = $where;

		$nbResult = $client_loterie->listes( $appli, 'count' );

		if ( !(int)$nbResult ) {

			$client_loterie->add( $_POST );
		}
		else {
			echo '<p class="warning">Champs saisie déja présent dans la base de donnée</p>';
		}
	}
}

$list_client = $client_loterie->listes();

echo '<style>
	label {
		width: 100px;
		display: block;
		float: left;
		text-align: right;
		padding-right: 10px;
	}

	.submit {
		color: #fff;
	}

	.warning {
		color: #fff;
		background: #f00;
		padding: 5px;
	}

	table {
		width: 100%;
		float: left;
		width: 77%;
		padding-top: 6px;
	}

	th, td {
		padding-left: 5px;
	}

	th {
		color: #fff;
		background: #aaa;
		font-weight: bold;
		text-align: left;
	}

	td {
		color: #000;
		background: #ddd;
	}

	fieldset {
		float: right;
		right: 0;
		width: 20%;
		position: fixed;
	}
</style>

<form method="post">';
	echo '<fieldset>';
		echo '<legend>Formulaire</legend>';

		echo '<p><label for="nom">Nom</label>
		<input type="text" id="nom" name="nom" value="'.$client_loterie->nom.'"></p>';

		echo '<p><label for="prenom">Prénom</label>
		<input type="text" id="prenom" name="prenom" value="'.$client_loterie->prenom.'"></p>';

		echo '<p><label for="address">Adresse</label>
		<input type="text" id="address" name="address" value="'.$client_loterie->address.'"></p>';

		echo '<p><label for="postal">Code postal</label>
		<input type="text" id="postal" name="postal" value="'.$client_loterie->postal.'"></p>';

		echo '<p><label for="ville">Ville</label>
		<input type="text" id="ville" name="ville" value="'.$client_loterie->ville.'"></p>';

		echo '<p><label for="telephone">Téléphone</label>
		<input type="text" id="telephone" name="telephone" value="'.$client_loterie->telephone.'"></p>';

		echo '<p><label for="email">Email</label>
		<input type="text" id="email" name="email" value="'.$client_loterie->email.'"></p>';

		$txt_bt = 'Ajouter';
		if ( $_GET['action'] == 'edit' ) {
			$txt_bt = 'Sauvegarder';
		}

		echo '<p><label class="submit">Envoyer</label>
		<input type="submit" value="'.$txt_bt.'"></p>';
	echo '</fieldset>';
echo '</form>

<table>
	<tr>
		<th>ID</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Adresse</th>
		<th>Code postal</th>
		<th>Ville</th>
		<th>Téléphone</th>
		<th>Email</th>
		<th>Action</th>
	</tr>';

	if ( count( $list_client ) > 0 ) {
		foreach ( $list_client as $client ) {
			echo '<tr>';
				echo '<td>'.$client['id'].'</td>';
				echo '<td>'.$client['nom'].'</td>';
				echo '<td>'.$client['prenom'].'</td>';
				echo '<td>'.$client['address'].'</td>';
				echo '<td>'.$client['postal'].'</td>';
				echo '<td>'.$client['ville'].'</td>';
				echo '<td>'.$client['telephone'].'</td>';
				echo '<td>'.$client['email'].'</td>';
				echo '<td><a href="?action=edit&id='.$client['id'].'">Editer</a> | <a href="?action=delete&id='.$client['id'].'">Supprimer</a></td>';
			echo '</tr>';
		}
	}
echo '</table>';