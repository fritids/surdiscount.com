<?php

class Order extends OrderCore {
	private $FTP;

	public function generateGLS () {
		$this->FTP = $this->getFTP();

		$history = $this->generateHistory();
		
		if ( !in_array( (string)$this->id, $history ) ) {
			$this->generateExport();
		}
		else {
			$this->cleanExport();
		}
	}
	
	public function cleanExport () {
		$local_dir = _PS_DOWNLOAD_DIR_.'gls/';
		$server_dir = "/";

		$FTP = $this->FTP;
		$list = $FTP->ls( $server_dir.'source/*' );

		if ( in_array( 'commandes.csv', $list ) ) {
			$FTP->download( $local_dir.'commandes.csv', $server_dir.'source/commandes.csv', FTP_BINARY );

			if ( file_exists( $local_dir.'commandes.csv' ) ) {
				$commandes = file_get_contents( $local_dir.'commandes.csv' );
				
				$csv = explode( "\n", $commandes );
				
				foreach ( $csv as $i => $item ) {
					if ( preg_match( "#[0-9]*;([0-9]*);#", $item, $out ) ) {
						if ( in_array( $out[1], $this->generateHistory() ) ) {
							unset( $csv[$i] );
						}
					}
				}
			}
		}
		
		$new_csv = join( "\n", $csv );

		file_put_contents( $local_dir.'commandes.csv', $new_csv );
		
		$FTP->upload( $server_dir.'source/commandes.csv', $local_dir.'commandes.csv', FTP_BINARY );
	}
	
	public function generateExport () {
		$local_dir = _PS_DOWNLOAD_DIR_.'gls/';
		$server_dir = "/";

		$Customer = new Customer( $this->id_customer );

		$Address = new Address( $this->id_address_delivery, $this->id_lang );

		$weight = $this->getTotalWeight();
		
		if ( empty( $Address->phone ) ) {
			$Address->phone = $Address->phone_mobile;
		}

		$csv_add = "$this->id_customer;o$this->id;$Address->company;$Address->lastname;$Address->firstname;$Customer->email;$Address->phone;$Address->address1;$Address->address2;$Address->other;$Address->postcode;$Address->city;;$weight\n";

		$FTP = $this->FTP;
		$list = $FTP->ls( $server_dir.'source/*' );

		if ( in_array( 'commandes.csv', $list ) ) {
			$FTP->download( $local_dir.'commandes.csv', $server_dir.'source/commandes.csv', FTP_BINARY );

			if ( file_exists( $local_dir.'commandes.csv' ) ) {
				$commandes = file_get_contents( $local_dir.'commandes.csv' );
				
				$csv = explode( "\n", $commandes );

				foreach ( $csv as $i => $item ) {
					if ( preg_match( "#[0-9]*;([0-9]*);#", $item, $out ) ) {
						if ( in_array( $out[1], $this->generateHistory() ) ) {
							unset( $csv[$i] );
						}
					}
				}
			}
		}
		
		$new_csv = join( "\n", $csv )."\n".$csv_add;

		file_put_contents( $local_dir.'commandes.csv', $new_csv );
		
		$FTP->upload( $server_dir.'source/commandes.csv', $local_dir.'commandes.csv', FTP_BINARY );
	}
	
	public function generateHistory () {
		$local_dir = _PS_DOWNLOAD_DIR_.'gls/';
		$server_dir = "/";
		
		$history = array();

		$FTP = $this->FTP;

		$logs = $FTP->ls($server_dir.'winexpe6/log/*');

		foreach ( $logs as $item ) {
			$FTP->download( $local_dir.$item, $server_dir.'winexpe6/log/'.$item, FTP_BINARY );
			$FTP->rm( $server_dir.'winexpe6/log/'.$item );
		}
		
		$logs = glob( $local_dir.'*' );

		foreach ( $logs as $item ) {
			$file = file_get_contents( $item );
			
			preg_match_all( '#T8262:([0-9]*)#', $file, $out );

			if ( count( array_unique( $out[1] ) ) ) {
				$history = array_merge( $history, array_unique( $out[1] ) );
			}

			unlink( $item );
		}

		$FTP->download( $local_dir.'history.json', $server_dir.'history/orders.json', FTP_BINARY );

		$old_history = file_get_contents( $local_dir.'history.json' );
		$old_history = json_decode( $old_history, true );

		if ( count( $history ) ) {
			if ( count( $old_history ) ) {
				$history = array_unique( array_merge( $old_history, $history ) );
			}
		}
		else {
			$history = $old_history;
		}

		file_put_contents( $local_dir.'history.json', json_encode( $history ) );

		$FTP->upload( $server_dir.'history/orders.json', $local_dir.'history.json', FTP_BINARY );

		return $history;
	}
	
	public function getFTP () {
		$ftp['host'] = "surdiscount.no-ip.org";
		$ftp['login'] = "surdiscount";
		$ftp['mdp'] = "edwinn29";
		$ftp['port'] = 2211;
		
		$FTP = new Ftp( $ftp['host'], $ftp['login'], $ftp['mdp'], $ftp['port'] );
		$FTP->connexion();
		
		return $FTP;
	}
	
	public function getGLSState () {
		//$this->id = 4235;
		$url = 'http://www.gls-group.eu/276-I-PORTAL-WEB/dLink.jsp?un=2502824801&pw=surdiscount&crf=o'.$this->id.'&no=3781001&lc=FR';

		$file = file_get_contents( $url );

		preg_match_all( '#<tr class="details">(.*?)</tr>#si', $file, $out );

		$suivis = array();
		
		if ( !count( $out[1] ) ) {
			$url = 'http://www.gls-group.eu/276-I-PORTAL-WEB/dLink.jsp?un=2502824801&pw=surdiscount&crf='.$this->id.'&no=3781001&lc=FR';

			$file = file_get_contents( $url );

			preg_match_all( '#<tr class="details">(.*?)</tr>#si', $file, $out );
		}
		
		foreach ( $out[1] as $row ) {
			preg_match_all( '#<td>(.*?)</td>#si', $row, $out2 );
			
			foreach ( $out2[1] as $i => $item ) {
				$out2[1][$i] = trim( $out2[1][$i] );
			}

			$suivis[] = $out2[1];
		}

		return $suivis;
	}
	
	public function suivi () {
		$suivis = $this->getGLSState();
		
		foreach ( $suivis as $item ) {
			$state = $item[3];
			
			switch ( $state ) {
				case 'LIVRE':
					$new_state = 5;
				break;

				case 'MIS EN LIVRAISON':
					$new_state = 4;
				break;

				case 'RECEPTION':
					$new_state = 4;
				break;

				case 'NON LIVRE ABSENT / FERME':
					$new_state = 4;
				break;

				case 'EXPEDITION':
					$new_state = 4;
				break;
				
				default:
					$new_state = 4;
				break;
			}

			$this->changeStatut( $new_state );
		}		
	}
	
	public function changeStatut ( $state_id ) {
		if ($state_id > 0  ) {
			$hitory = $this->_getHistory();
	
			if ( !in_array( $state_id, $hitory ) ) {
				$this->_setHistory( $state_id );
			}
		}
	}
	
	public function _setHistory ( $state_id ) {
		$history = new OrderHistory();
		$history->id_order = $this->id;
		$history->id_order_state = $state_id;
		$history->id_employee= 1;
		$history->addWithemail();
	}

	public function _getHistory () {
		$return = Db::getInstance()->ExecuteS("
		SELECT id_order_state
		FROM `"._DB_PREFIX_."order_history`
		WHERE `id_order` = $this->id
		ORDER BY `date_add` DESC
		");
		
		$out = array();
		foreach ( $return as $item ) {
			$out[] = $item['id_order_state'];
		}
		
		return $out;
	}
}