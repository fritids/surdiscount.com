<?php

class OrderHistory extends OrderHistoryCore {
	public function changeIdOrderState($new_order_state = NULL, $id_order) {
		parent::changeIdOrderState( $new_order_state, $id_order );

		if ( $new_order_state == 3 ) {
			$Order = new Order((int)($id_order));
			$Order->generateGLS();
		}
	}
}
