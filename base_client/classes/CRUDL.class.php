<?php

/*
   $Id: CRUDL.class.php,v 1 01/07/2006 01:58:19 mosaic Exp $
   +-----------------------------------------------------------------------+
   |                  OSC-evolution Open Source E-commerce                 |
   +-----------------------------------------------------------------------+
   | Copyright (c) 2006 OSC-evolution                                      |
   |                                                                       |
   | http://www.osc-evolution.com                                          |
   |                                                                       |
   | Portions Copyright (c) 2003 osCommerce                                |
   +-----------------------------------------------------------------------+
   | This source file is subject to version 2.0 of the GPL license,        |
   | available at the following url:                                       |
   | http://www.osc-evolution.com/license/2_0.txt.                         |
   +-----------------------------------------------------------------------+
*/

class CRUDL {
	public $_from;
	public $_table;

	private $_out;
	private $_appli;

	public function __construct( $appli )
	{
		$query = mysql_query( $this->getQuery( $appli ) ) or die ( 'Mauvaise requete SQL:<br />'.$this->getQuery( $appli ).'<br />' );

		if ( mysql_num_rows( $query ) > 0 ) {
			$result = mysql_fetch_assoc( $query );

			foreach ( $this as $k => $v ) {
				if ( !is_array( $v ) ) {
					$this->$k = $result[$k];
				}
			}
		}
	}

	public function tep_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link')
	{
		reset($data);
		if ($action == 'insert')
		{
			$query = 'insert into '.$table.' (';
			while (list($columns, ) = each($data))
			{
				$query .= $columns.', ';
			}
			$query = substr($query, 0, -2).') values (';
			reset($data);
			while (list(, $value) = each($data))
			{
				switch ((string)$value)
				{
					case 'now()':
						$query .= 'now(), ';
						break;

					case 'null':
						$query .= 'null, ';
						break;

					default:
						$query .= '\''.$this->tep_db_input($value).'\', ';
						break;
				}
			}
			$query = substr($query, 0, -2).')';
		}
		elseif ($action == 'update')
		{
			$query = 'update '.$table.' set ';
			while (list($columns, $value) = each($data))
			{
				switch ((string)$value)
				{
					case 'now()':
						$query .= $columns.' = now(), ';
						break;

					case 'null':
						$query .= $columns .= ' = null, ';
						break;

					case '++':
						$query .= "$columns = $columns + 1, ";
						break;

					case '--':
						$query .= "$columns = $columns - 1, ";
						break;

					default:
						$query .= $columns.' = \''.$this->tep_db_input($value).'\', ';
						break;
				}
			}
			$query = substr($query, 0, -2).' where '.$parameters;
		}
		return mysql_query($query);
	}

	public function tep_db_input($string, $link = 'db_link')
	{
		global $$link;
		if (function_exists('mysql_real_escape_string'))
		{
			return mysql_real_escape_string($string);
		}
		elseif (function_exists('mysql_escape_string'))
		{
			return mysql_escape_string($string);
		}
		return addslashes($string);
	}

	private function constructFrom ()
	{
		$i = 0;
		$out[$i]['alias'] = $this->_table['alias'];
		$out[$i]['table'] = $this->_table['val'];

		$i++;

		if ( is_array( $this->_appli['from'] ) ) {
			$froms = array_unique( $this->_appli['from'] );

			foreach ( $froms as $from ) {
				list( $table, $alias ) = explode( ' ', $from );

				$out[$i]['alias'] = $alias;
				$out[$i]['table'] = $table;

				$i++;
			}
		}
		elseif ( is_string( $this->_appli['from'] ) ) {
			if ( !empty( $this->_appli['from'] ) ) {
				list( $table, $alias ) = explode( ' ', $this->_appli['from'] );

				$out[$i]['alias'] = $alias;
				$out[$i]['table'] = $table;
			}
		}

		return $out;
	}

	private function getSelect ()
	{

		$froms = $this->constructFrom();
		if ( count( $froms ) ) {
			$out = '';
			foreach ( $froms as $from ) {
				$out .= $from['alias'].".*, ";
			}
		}

		if ( is_array( $this->_appli['select'] ) ) {
			$selects = array_unique( $this->_appli['select'] );

			$out = '';
			foreach ( $selects as $select ) {
				$out .= $select.", ";
			}
		}
		elseif ( is_string( $this->_appli['select'] ) ) {
			if ( !empty( $this->_appli['select'] ) ) {
				$out = $this->_appli['select'].", ";
			}
		}

		$out = 'SELECT '.trim( $out, ', ' );

		return $out;
	}

	private function getFrom ()
	{
		$froms = $this->constructFrom();
		if ( count( $froms ) ) {
			$out = ' FROM ';

			foreach ( $froms as $from ) {
				$out .= $from['table']." ".$from['alias'].", ";
			}
		}

		$out = trim( $out, ', ' );

		return ' '.$out;
	}

	private function getWhere ()
	{
		if ( is_array( $this->_appli['where'] ) ) {
			$this->_appli['where'] = array_unique( $this->_appli['where'] );

			$out = '';
			foreach ( $this->_appli['where'] as $where ) {
				if ( !empty( $where ) ) {
					$out .= $where.' AND ';
				}
			}
		}
		elseif ( is_string( $this->_appli['where'] ) ) {
			if ( !empty( $this->_appli['where'] ) ) {
				$out = $this->_appli['where'];
			}
		}

		if ( !empty( $out ) ) {
			$out = trim( $out, ' AND ' );

			$out = ' WHERE '.$out;
		}

		if ( $out == ' WHERE ' ) {
			$out = '';
		}

		return $out;
	}

	private function getOrderby ()
	{
		return ( !empty( $this->_appli['orderby'] ) ? ' ORDER BY '.$this->_appli['orderby'] : '' );
	}

	private function getLimit ()
	{
		return ( !empty( $this->_appli['limit'] ) ? ' LIMIT '.$this->_appli['limit'] : '' );
	}

	private function getGroupby ()
	{
		if ( is_array( $this->_appli['groupby'] ) ) {
			$this->_appli['groupby'] = array_unique( $this->_appli['groupby'] );

			$out = ' GROUP BY ';
			foreach ( $this->_appli['groupby'] as $groupby ){
				$out .= $groupby.', ';
			}

			$out = ' '.trim( $out, ', ' );
		}
		elseif ( is_string( $this->_appli['groupby'] ) ) {
			if ( !empty( $this->_appli['groupby'] ) ) {
				$out = ' GROUP BY '.$this->_appli['groupby'];
			}
		}

		return $out;
	}

	private function getHaving ()
	{
		if ( is_array( $this->_appli['having'] ) ) {
			$this->_appli['having'] = array_unique( $this->_appli['having'] );

			$out = ' HAVING ';
			foreach ( $this->_appli['having'] as $having ){
				$out .= $having.', ';
			}

			$out = ' '.trim( $out, ', ' );
		}
		elseif ( is_string( $this->_appli['having'] ) ) {
			if ( !empty( $this->_appli['having'] ) ) {
				$out = ' HAVING '.$this->_appli['having'];
			}
		}

		return $out;
	}

	public function getQuery ( $appli )
	{
		$this->_appli = $appli;

		//echo $this->getSelect().$this->getFrom().$this->getWhere().$this->getOrderby().$this->getLimit().$this->getGroupby().$this->getHaving().'<br />';
		return $this->getSelect().$this->getFrom().$this->getWhere().$this->getGroupby().$this->getHaving().$this->getOrderby().$this->getLimit();
	}

	public function add ( $array )
	{
		$this->tep_db_perform( $this->_table['val'], $array );
		$id = mysql_insert_id();

		return $id;
	}

	public function delete ( $id )
	{
		if ( $id > 0 ) {
			mysql_query( "DELETE FROM ".$this->_table['val']." WHERE ".$this->_table['key']." = '" . (int)$id . "' " );
		}
	}

	public function delete_where ( $params )
	{
		if ( is_array( $params ) ) {
			$params = array_unique( $params );

			$out_where = '';
			foreach ( $params as $where ) {
				if ( !empty( $where ) ) {
					$out_where .= $where.' AND ';
				}
			}
		}
		elseif ( is_string( $params ) ) {
			if ( !empty( $params ) ) {
				$out_where = $params;
			}
		}

		if ( !empty( $out_where ) ) {
			$out_where = trim( $out_where, ' AND ' );

			$out_where = ' WHERE '.$out_where;
		}

		if ( $out_where == ' WHERE ' ) {
			$out_where = '';
		}
		/*
		   echo "DELETE FROM ".$this->_table['val']." ".$out_where;
		   exit();
		*/
		mysql_query( "DELETE FROM ".$this->_table['val']." ".$out_where );
	}

	public function save ( $id, $array )
	{
		$this->tep_db_perform( $this->_table['val'], $array, 'update', $this->_table['key']." = '" . (int)$id . "'" );
	}

	public function verif_exist ( $where )
	{
		$appli['where'] = $where;
		$appli['limit'] = 1;
		//echo $this->getQuery( $appli );exit;
		$listes = $this->listes( $appli );

		if ( count( $listes ) > 0 ) {
			$return = $listes[0][$this->_table['key']];
		}
		else {
			$return = false;
		}

		return $return;
	}

	public function getPublic ()
	{
		$req = mysql_query( "SHOW FIELDS FROM ".$this->_table['val'] );
		while ( $rep = mysql_fetch_assoc( $req ) ) {
			echo 'public $'.$rep['Field'].';<br />';
		}

		exit;
	}

	public function listes( $appli = '', $sortie = '', $pipe = '' )
	{
		$this->_out = $sortie;
		$mysql_query = mysql_query( $this->getQuery( $appli ) );

		if ( $this->_out == 'count' ) {
			$count = mysql_num_rows( $mysql_query );
			return $count;
		}
		elseif ( $this->_out == 'pipe' ) {
			if ( mysql_num_rows( $mysql_query ) > 0 ) {
				while ( $lists = mysql_fetch_assoc( $mysql_query ) ) {
					$lists_array[] = $lists[$pipe];
				}

				return array2pipe( $lists_array );
			}
		}
		elseif ( $this->_out == 'extract_field' ) {
			if ( mysql_num_rows( $mysql_query ) > 0 ) {
				while ( $lists = mysql_fetch_assoc( $mysql_query ) ) {
					$value = $lists[$pipe];
				}

				return $value;
			}
		}
		elseif ( $this->_out == 'array' && $pipe != '' ) {
			if ( mysql_num_rows( $mysql_query ) > 0 ) {
				while ( $lists = mysql_fetch_assoc( $mysql_query ) ) {
					$lists_array[] = $lists[$pipe];
				}

				return $lists_array;
			}
		}
		else {
			if ( mysql_num_rows( $mysql_query ) > 0 ) {
				$i = 0;

				while ( $lists = mysql_fetch_assoc( $mysql_query ) ) {
					foreach ( $lists as $k => $v ) {
						$lists_array[$i][$k] = stripslashes( $v );
					}

					$i++;
				}

				return $lists_array;
			}
		}
	}

	public function complete ( $id, $field, $complete, $type = '' )
	{
		$name_class = get_class($this);
		$Class = new $name_class($id);

		$old_val_field = $Class->$field;

		if ( isPipe( $old_val_field ) ) {
			echo 'isPipe';exit;
			$new_val_field = addPipe( $complete, $old_val_field );
		}
		elseif ( $type == 'cumul' ) {
			$new_val_field = $old_val_field + $complete;
		}
		else {
			echo 'else';exit;
			$new_val_field = $old_val_field.$complete;
		}

		$array[$field] = $new_val_field;

		$this->save( $id, $array );
	}
}