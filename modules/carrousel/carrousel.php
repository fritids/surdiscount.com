<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class Carrousel extends Module
{
 	public function __construct()
 	{
 	 	$this->name = 'carrousel';
		$this->tab = 'Blocks';
		$this->version = '0.1';

	 	parent::__construct();

 	 	$this->displayName = $this->l('Carrousel');
 	 	$this->description = $this->l('Adds a block for carrousel subscription');

		
 	}
 	
 	public function install()
 	{
 	 	if (parent::install() == false OR $this->registerHook('home') == false)
 	 		return false;
 	 		
 	 	mkdir( _THEME_IMG_DIR_.'crll/' );
 	 	chmod( _THEME_IMG_DIR_.'crll/', 755 );

 	 	Db::getInstance()->Execute('
			CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'carrousel (
				`id` int(6) NOT NULL AUTO_INCREMENT,
				`title` varchar(255) NOT NULL,
				`subtitle` varchar(255) NOT NULL,
				`image` varchar(255) NOT NULL,
				`description` TEXT NULL,
				`order` TINYINT(2) NOT NULL,
				`url` TEXT NOT NULL,
				PRIMARY KEY(`id`)
			) ENGINE=MyISAM default CHARSET=utf8;
		');
			 		
	 	Db::getInstance()->Execute("INSERT INTO "._DB_PREFIX_."carrousel (id) VALUE (1)");
	 	Db::getInstance()->Execute("INSERT INTO "._DB_PREFIX_."carrousel (id) VALUE (2)");
	 	Db::getInstance()->Execute("INSERT INTO "._DB_PREFIX_."carrousel (id) VALUE (3)");
	 	return Db::getInstance()->Execute("INSERT INTO "._DB_PREFIX_."carrousel (id) VALUE (4)");
 	}
 	
 	public function uninstall()
 	{
 	 	if (!parent::uninstall())
 	 		return false;

 	 	unlink( _THEME_IMG_DIR_.'crll/' );
 	 	
 	 	return Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'carrousel');
 	}

	public function getContent()
	{
		$this->_html = '<h2>'.$this->displayName.'</h2>';
		
		if ( Tools::isSubmit('submitUpdate') ) {
			foreach ( $_POST['carrousel'] as $i => $carrousel ) {
				$k = $i + 1;

				Db::getInstance()->Execute( "UPDATE "._DB_PREFIX_."carrousel SET title = '$carrousel[title]' WHERE id = $k" );
				Db::getInstance()->Execute( "UPDATE "._DB_PREFIX_."carrousel SET subtitle = '$carrousel[subtitle]' WHERE id = $k" );
				Db::getInstance()->Execute( "UPDATE "._DB_PREFIX_."carrousel SET description = '$carrousel[description]' WHERE id = $k" );
				Db::getInstance()->Execute( "UPDATE "._DB_PREFIX_."carrousel SET `order` = $carrousel[order] WHERE id = $k" );
				Db::getInstance()->Execute( "UPDATE "._DB_PREFIX_."carrousel SET url = '$carrousel[url]' WHERE id = $k" );

				if ( !empty( $_FILES['carrousel']['tmp_name'][$i]['image'] ) ) {
					$name_image = 'slide-'.rand(10000, 99999).'.jpg';
					
					move_uploaded_file( $_FILES['carrousel']['tmp_name'][$i]['image'], _PS_THEME_DIR_."img/crll/$name_image" );
					Db::getInstance()->Execute( "UPDATE "._DB_PREFIX_."carrousel SET image = '$name_image' WHERE id = $k" );
				}
			}

			$this->_html .= '<div class="conf ok">'.$this->l('Updated successfully').'</div>';
		}

		return $this->_html.$this->_displayForm();
	}

	public function _displayForm()
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'carrousel ORDER BY `order`';
		$carrousels = Db::getInstance()->ExecuteS($sql);
		
		$output = '<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
			<fieldset>';
				foreach ( $carrousels as $i => $carrousel ) {
					$output .= '<div class="slide">
						<label>'.$this->l('Titre').'</label>
						<input type="text" name="carrousel['.$i.'][title]" value="'.$carrousel['title'].'" />
						<p class="clear">
						
						<label>'.$this->l('URL').'</label>
						<input type="text" name="carrousel['.$i.'][url]" value="'.$carrousel['url'].'" />
						<p class="clear">
						
						<label>'.$this->l('Prix').'</label>
						<input type="text" name="carrousel['.$i.'][subtitle]" value="'.$carrousel['subtitle'].'" />
						<p class="clear">
						
						<label>'.$this->l('Description').'</label>
						<textarea name="carrousel['.$i.'][description]">'.$carrousel['description'].'</textarea>
						<p class="clear">
						
						<label>'.$this->l('Ordre').'</label>
						<input type="text" size="4" name="carrousel['.$i.'][order]" value="'.$carrousel['order'].'" />
						<p class="clear">
						
						<label>'.$this->l('Image').'</label>
						<input type="file" name="carrousel['.$i.'][image]" />
						<p class="clear">';
						
						if ( !empty( $carrousel['title'] ) ) {
							$output .= '<img src="'._THEME_IMG_DIR_."crll/$carrousel[image]".'" />';
						}
					$output .= '</div><hr />';
				}
				
				$output .= '<center><input type="submit" name="submitUpdate" value="'.$this->l('Enregistrer').'" class="button" /></center>
			</fieldset>
		</form>';

		return $output;
	}

	function hookRightColumn($params)
	{
		return $this->hookLeftColumn($params);
	}
 	
 	function hookLeftColumn($params)
 	{
 		return $this->hookHome($params);
 	}

	function hookHome($params)
	{
		global $smarty;
		
		$sql = 'SELECT * FROM '._DB_PREFIX_.'carrousel WHERE title != "" ORDER BY `order`';
		$carrousels = Db::getInstance()->ExecuteS($sql);

		$smarty->assign(array(
			'carrousels' => $carrousels,
			'first' => $carrousels[0]
		));
	

		return $this->display(__FILE__, 'carrousel.tpl');
	}
}

?>
