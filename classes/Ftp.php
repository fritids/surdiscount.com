<?php

class FtpCore {
	private $host ;
	private $user ;
	private $pass ;
	private $port ;
	private $flux_connexion ;
	private $flux_identification ;
	private $mode_transmission ;

	function __construct ( $host, $user, $pass, $port = 21 ) {
		$this -> host = $host ;
		$this -> user = $user ;
		$this -> pass = $pass ;
		$this -> port = $port ;
	}

	function __destruct ( ) {
		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			ftp_close ( $this -> flux_connexion ) ;
		}
	}

	function connexion () {
		$this -> flux_connexion = ftp_connect ( $this -> host, $this -> port ) ; // or die ( "erreur de connexion" ) ;

		if ( !$this -> flux_connexion === true ) {
			return 1 ;
		}
		else {
			$this -> flux_identification = ftp_login ( $this -> flux_connexion, $this -> user, $this -> pass ) ;
			if ( !$this -> flux_identification === true ) {
				return 2 ;
			}
			else {
				return 3 ;
			}
		}
	}

	function pwd () {
		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			return ftp_pwd ( $this -> flux_connexion ) ;
		}
		else {
			return false ;
		}
	}

	function cd ( $repertoire ) {
		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			return ftp_chdir ( $this -> flux_connexion, $repertoire ) ;
		}
		else {
			return false ;
		}
	}

	function ls ( $dossier = '.' ) {
		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			$sortie = array ( ) ;
			$i = 0 ;
			$tab_ls = ftp_nlist ( $this -> flux_connexion, $dossier ) ;
			if ( $tab_ls !== FALSE ) {
				foreach ( $tab_ls AS $id => $fichier ) {
					if ( $fichier != '.' AND $fichier != '..' ) {
						$sortie [ $i ] = $fichier ;
						$i++;
					}
				}
				return $sortie ;
			} else {
				return false ;
			}
		} else {
			return false ;
		}
	}

	function upload($fichier_distant, $fichier_local, $mode = ''){
		if ( true === empty ( $mode ) ) {
			$mode = $this -> mode_transmission ;
		}

		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			return ftp_put ( $this -> flux_connexion, $fichier_distant, $fichier_local, $mode ) ;
		}
		else {
			return false ;
		}
	}

	function download ( $fichier_local, $fichier_distant, $mode = '' ) {
		if ( true === empty ( $mode ) ) {
			$mode = $this -> mode_transmission ;
		}

		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			return ftp_get ( $this -> flux_connexion, $fichier_local, $fichier_distant, $mode ) ;
		}
		else {
			return false ;
		}
	}

	function chmod ( $fichier, $mode ) {
		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			return ftp_chmod ( $this -> flux_connexion, $mode, $fichier ) ;
		}
		else {
			return false ;
		}
	}

	function mkdir(){
$dossiers = func_get_args();
$result = true;
		if(!$this -> flux_connexion === false && $this -> flux_identification === true ){
foreach($dossiers AS $dossier){
$result = ($result && ftp_mkdir($this->flux_connexion, $dossier));
}
return $result;
		}else{
			return false ;
		}
	}

	function rm ( $fichier ) {
		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			return ftp_delete ( $this -> flux_connexion, $fichier ) ;
		}
		else {
			return false ;
		}
	}

	function rmdir ( $repertoire ) {
		if ( !$this -> flux_connexion === false && $this -> flux_identification === true ) {
			return ftp_rmdir ( $this -> flux_connexion, $repertoire ) ;
		}
		else {
			return false ;
		}
	}

	function set_mode ( $mode ) {
		$this -> mode_transmission = $mode ;
	}
}