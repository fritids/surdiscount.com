<?php

class Store extends StoreCore {
	public function getCountry () {
		global $cookie;

	 	return Country::getNameById( $cookie->id_lang, $this->id_country );
	}

	public function getState () {
	 	return State::getNameById( $this->id_state );
	}

	public function getHours () {
	 	return unserialize( $this->hours );
	}

	public function getPhotos () {
	 	return unserialize( $this->hours );
	}

	public function getImages ( $id ) {
	 	return glob( _PS_STORE_IMG_DIR_.'mags/'.$id.'/*' );
	}
}