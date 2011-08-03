<?php

class client_loterie extends CRUDL {
	public $id;
	public $prenom;
	public $nom;
	public $email;
	public $address;
	public $postal;
	public $ville;
	public $telephone;

	public function __construct( $id = '' ) {
		$this->_table = array(
		    'val' => 'client_loterie',
		    'alias' => 'cl',
		    'key' => 'id'
		);

		if ( $id != '' ) {
			$appli['where'] = $this->_table['alias'].'.'. $this->_table['key'] . " = '" . (int)$id . "'";

			parent::__construct( $appli );
		}
	}
}