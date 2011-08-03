<?php

class GoogleBase extends Module
{
	private $_html = '';
	private $_postErrors = array();
	private $_cookie;
	
	public function __construct()
	{
		global $cookie;
		$this->_cookie = $cookie;
		$this->name = 'googlebase';
		$this->tab = 'Tools';
		$this->version = '0.6.3.1';
		
		/* The parent construct is required for translations and must be called before the following */
		parent::__construct();
		
		$this->page = basename(__FILE__, '.php');
		
		// Create the feed in our default base directory
		if (!Configuration::get('googlebase_filepath'))
			Configuration::updateValue('googlebase_filepath', addslashes($this->defaultOutputFile()));
		if (!Configuration::get('googlebase_domain'))
			Configuration::updateValue('googlebase_domain', $_SERVER['HTTP_HOST']);
		if (!Configuration::get('googlebase_psdir'))
			Configuration::updateValue('googlebase_psdir', __PS_BASE_URI__);
		
		if (!Configuration::get('googlebase_description'))
			$this->warning = $this->l('You have not yet configured your Googlebase feed!');
		$this->displayName = $this->l('Google Base Feed Products');
		$this->description = $this->l('Generate your products feed for Google Base. www.ecartservice.net');
	}
	
	public function uninstall()
	{
		// Should cleanup the config variables to play nice
		Configuration::deleteByName('googlebase_filepath');
		Configuration::deleteByName('googlebase_domain');
		Configuration::deleteByName('googlebase_psdir');
		Configuration::deleteByName('googlebase_description');
		
		parent::uninstall();
	}
	
	private function directory()
	{
		return dirname(__FILE__).'/../../'; // move up to the __PS_BASE_URI__ directory
	}
	
	
	private function winFixFilename($file)
	{
		return str_replace('\\\\','\\',$file);
	}
	
	private function defaultOutputFile()
	{
		// PHP on windows seems to return a trailing '\' where as on unix it doesn't
		$output_dir = realpath($this->directory());
		$dir_separator = '/';
		
		// If there's a windows directory separator on the end, 
		// then don't add the unix one too when building the final output file
		if (substr($output_dir, -1, 1)=='\\')
			$dir_separator = '';
		
		$output_file = $output_dir.$dir_separator.strtolower(Language::getIsoById($this->_cookie->id_lang)).'_googlebase.xml';
		return $output_file;
	}

	
	private function can_write($filename)
	{
		// Test if we can write the file specified in the config screen
		@unlink($filename);
		$fp = @fopen($filename, 'wb');
		@fclose($fp);
		return file_exists($filename); 
	}
		
	private function getPath($id_category, $path = '')
	{		
		$category = new Category(intval($id_category), intval($this->_cookie->id_lang));
		
		if (!Validate::isLoadedObject($category))
			die (Tools::displayError());
		
		if ($category->id == 1)
			return Tools::iconv( 'ISO-8859-1', 'UTF-8', $path );
		
		$pipe = ' > ';

		$category_name = Category::hideCategoryPosition($category->name);
		
		if ($path != $category_name)
			$path = $category_name.($path!='' ? $pipe.$path : '');
		
		return $this->getPath(intval($category->id_parent), $path);
	}
	
	private function file_url()
	{
		$filename = $this->winFixFilename(Configuration::get('googlebase_filepath'));
		$root_path = realpath($this->directory());
		$file = str_replace($root_path,'', $filename);
		
		$separator = '';
		
		if (substr($file, 0, 1)=='\\')
			substr_replace($file, '/', 0, 1);
			
		if (substr($file, 0, 1)!='/')
			$separator = '/';
		
		return 'http://'.$_SERVER['HTTP_HOST'].$separator.$file;
	}
	
	private function _addToFeed($str)
	{
		$filename = $this->winFixFilename(Configuration::get('googlebase_filepath'));
		if(file_exists($filename))
		{
			$fp = fopen($filename, 'ab');
			fwrite($fp, $str, strlen($str));
			fclose($fp);
		}
	}
	
	private function _postProcess()
	{
		$description = Configuration::get('googlebase_description');
		$domain = Configuration::get('googlebase_domain');
		$psdir = Configuration::get('googlebase_psdir');
		$items_added = 0;
		
		$link = new Link();
		$Products = Product::getProducts(intval($this->_cookie->id_lang), 0, NULL, 'id_product', 'ASC');
		
		if($Products)
		{
			$this->_addToFeed("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n\n"
			. "<rss version =\"2.0\" xmlns:g=\"http://base.google.com/ns/1.0\">\n\n"
            . "<channel>\n"
	        . "<title>Google Base feed for ".$domain."</title>\n"
	        . "<description>".Tools::iconv( 'ISO-8859-1', 'UTF-8', $description )."</description>\n"
	        . "<link>http://".$domain."/</link>\n"
			. "\n");
			

			$items = "";
			foreach ($Products AS $Product)
			{
			  if ($Product['active']) {
				$image = Image::getImages(intval($this->_cookie->id_lang), $Product['id_product']);
				$expire_date = date('Y-m-d', strtotime("+30 days"));
				$product_link = $link->getProductLink($Product['id_product'], $Product['link_rewrite']);
				// Make 1.1 result look like 1.2
				if (strpos( $product_link, 'http://' ) === false )        
					$product_link = 'http://'.$_SERVER['HTTP_HOST'].$product_link;
				// remove the start to get a URI relative to __PS_BASE_URI__
				$product_link = str_replace('http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__,'',$product_link);                 				
				// Then build a full url according to the settings
				$product_link = 'http://'.$domain.$psdir.$product_link; 

				$items .= "<item>\n"
				. "<title>".Tools::iconv( 'ISO-8859-1', 'UTF-8', $Product['name'] )."</title>\n"
				. "<g:brand>".Tools::iconv( 'ISO-8859-1', 'UTF-8', $Product['manufacturer_name'])."</g:brand>\n" 
				. "<g:condition>new</g:condition>\n"
				. "<description><![CDATA[".$Product['description_short']."]]></description>\n"
                . "<g:expiration_date>$expire_date</g:expiration_date>\n"
				. "<g:id>"."pc".strtolower(Language::getIsoById($this->_cookie->id_lang))."-".$Product['id_product']."</g:id>\n"
				. "<guid>"."pc".strtolower(Language::getIsoById($this->_cookie->id_lang))."-".$Product['id_product']."</guid>\n";
				if (isset($image[0]))
					$items .= "<g:image_link>".'http://'.$domain.$psdir.'img/p/'.$image[0]['id_product'].'-'.$image[0]['id_image'].'-large.jpg'."</g:image_link>\n";
				$items .= "<link>".$product_link."</link>\n"
				. "<g:price>".Product::getPriceStatic(intval($Product['id_product']))."</g:price>\n"
				. "<g:product_type>".$this->getPath($Product['id_category_default'])."</g:product_type>\n";
				if ($Product['weight']>0)
					$items .= "<g:weight>".$Product['weight']." ".Configuration::get('PS_WEIGHT_UNIT')."</g:weight>\n";
				$items .= "</item>\n\n";
				$items_added++;
				if ($items_added>100) {
					// 0.6.3.1: Flush the buffer out to the file, just in case it gets too big
					$this->_addToFeed($items);
					$items_added = 0;
					$items = '';
				}
			  }
			}
			$this->_addToFeed( "$items</channel>\n</rss>\n" );
		}
		
		$res = file_exists($this->winFixFilename(Configuration::get('googlebase_filepath')));
		$this->_html .= '<h3 class="'. ($res ? 'conf confirm' : 'alert error') .'" style="margin-bottom: 20px">';
		$this->_html .= $res ? $this->l('Feed file successfully generated') : $this->l('Error while creating feed file');
		$this->_html .= '</h3>';
	}
	
	private function _displayFeed()
	{
		$filename = $this->winFixFilename(Configuration::get('googlebase_filepath'));
		if(file_exists($filename))
		{
			$fp = fopen($filename, 'rb');
			$fstat = fstat($fp);
			fclose($fp);
			
			$this->_html .= '<fieldset><legend><img src="../img/admin/enabled.gif" alt="" class="middle" />'.$this->l('Feed Generated').'</legend>';
			if (strpos($filename,realpath($this->directory())) === FALSE)
			{
				$this->_html .= '<p>'.$this->l('Your Google Base feed file is available via ftp as the following:').' <b>'.$filename.'</b></p><br />';
			} else {
				$this->_html .= '<p>'.$this->l('Your Google Base feed file is online at the following address:').' <a href="'.$this->file_url().'"><b>'.$this->file_url().'</b></a></p><br />';
			}
			$this->_html .= $this->l('Last Updated:').' <b>'.date('m.d.y G:i:s', $fstat['mtime']).'</b><br />';
			$this->_html .= '</fieldset>';
		} else {
			$this->_html .= '<fieldset><legend><img src="../img/admin/delete.gif" alt="" class="middle" />'.$this->l('No Feed Generated').'</legend>';
			$this->_html .= '<br /><h3 class="alert error" style="margin-bottom: 20px">No feed file has been generated at this location yet!</h3>';
			$this->_html .= '</fieldset>';
		}
	}
	
	private function _displayForm()
	{
		$this->_html .=
			'<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
				<br />
				<center><input name="btnSubmit" class="button" value="'.((!file_exists($this->winFixFilename(Configuration::get('googlebase_filepath')))) ? $this->l('Generate feed file') : $this->l('Update feed file')).'" type="submit" /></center>
				<hr />
				<fieldset>
					<legend><img src="../img/admin/cog.gif" alt="" class="middle" />'.$this->l('Standard Settings').'</legend>
					<fieldset class="space">
						<p style="font-size: smaller;"><img src="../img/admin/unknown.gif" alt="" class="middle" />'.$this->l('The minimum <em>required</em> configuration is to define a description for your feed. This should be text (not html), up to a maximum length of 10,000 characters. Ideally, greater than 15 characters and 3 words.').'</p>
					</fieldset>
					<br />
					<label>'.$this->l('Feed Description: ').'</label>
					<div class="margin-form">
						<textarea name="description" rows="5" cols="80" >'.Tools::getValue('description', Configuration::get('googlebase_description')).'</textarea>
						<p class="clear">'.$this->l('Example:').' Our range of fabulous products</p>
					</div>
					<label>'.$this->l('Output Location: ').'</label>
					<div class="margin-form">
						<input name="filepath" type="text" style="width: 600px;" value="'.(isset($_POST['filepath']) ? $_POST['filepath'] : $this->winFixFilename(Configuration::get('googlebase_filepath'))).'"/>
						<p class="clear">'.$this->l('Example (default):').' '.$this->defaultOutputFile().'</p>
					</div>
				</fieldset>
				<fieldset>
					<legend><img src="../img/admin/cog.gif" alt="" class="middle" />'.$this->l('Advanced Settings').'</legend>
					<fieldset class="space">
						<p style="font-size: smaller;"><img src="../img/admin/unknown.gif" alt="" class="middle" />'.$this->l('The following settings allow you to create a feed based on a remote server configuration, for example when generating a feed on a local server installation for use on a live server. These should not normally be modified. Note that the Shop Base should specify the PrestaShop directory on the remote server and end in a \'/\'. The module will clean and replace invalid entries where possible.').'</p>
					</fieldset>
					<br />
					<label>'.$this->l('Domain: ').'</label>
					<div class="margin-form">
						<input name="domain" type="text" style="width: 600px;" value="'.Tools::getValue('domain', Configuration::get('googlebase_domain')).'"/>
						<p class="clear">'.$this->l('Example (default):').' '.$_SERVER['HTTP_HOST'].'</p>
					</div>
					<label>'.$this->l('Shop Base: ').'</label>
					<div class="margin-form">
						<input name="psdir" type="text" style="width: 600px;" value="'.Tools::getValue('psdir', Configuration::get('googlebase_psdir')).'"/>
						<p class="clear">'.$this->l('Example (default):').' '.__PS_BASE_URI__.'</p>
					</div>
				</fieldset>
				<br />
				<input name="btnSubmit" class="button" value="'.((!file_exists($this->winFixFilename(Configuration::get('googlebase_filepath')))) ? $this->l('Generate feed file') : $this->l('Update feed file')).'" type="submit" />
			</form>';
	}
		
	private function _postValidation()
	{
		// Used $_POST here to allow us to modify them directly - naughty I know :)
		if (empty($_POST['domain']) OR strlen($_POST['domain']) < 3)
		{
			$this->_postErrors[] = $this->l('Domain is required/invalid.');
		} else {
			// Clean the domain name, just in case someone puts more than just a plain domain name in there
			$domain_split = explode('/',str_replace('http://','', $_POST['domain']));
			$_POST['domain']=$domain_split[0];
		}

		if (empty($_POST['psdir']))
		{
			$this->_postErrors[] = $this->l('Shop base is required.');
		} else {
			// Need to be absolutely sure that $psdir starts and ends with a '/'
			if (substr($_POST['psdir'], -1, 1)!='/')
				$_POST['psdir'] = $_POST['psdir'].'/';
			if (substr($_POST['psdir'], 0, 1)!='/')
				$_POST['psdir'] = '/'.$_POST['psdir'];
		}
		
		if (empty($_POST['description']) OR strlen($_POST['description']) > 10000)
			$this->_postErrors[] = $this->l('Description is invalid');
		// could check that this is a valid path, but the next test will
		// do that for us anyway
		// But first we need to get rid of the escape characters
		$_POST['filepath'] = $this->winFixFilename($_POST['filepath']);
		if (empty($_POST['filepath']) OR (strlen($_POST['filepath']) > 255))
			$this->_postErrors[] = $this->l('The target location is invalid');
		
		if (!$this->can_write($_POST['filepath']))
			$this->_postErrors[] = $this->l('The output location is invalid.<br />Cannot write to').' '.$_POST['filepath'];
	}
	
	function getContent()
	{
		$this->_html .= '<h2>'.$this->l('Google Base Products Feed').'</h2>';
		
		if (Tools::isSubmit('btnSubmit'))
		{			
			$this->_postValidation();
			
			if (!sizeof($this->_postErrors))
			{
				Configuration::updateValue('googlebase_description', Tools::getValue('description'));
				Configuration::updateValue('googlebase_filepath', addslashes($_POST['filepath'])); // the Tools class kills the windows file name separators :(				
				Configuration::updateValue('googlebase_domain', Tools::getValue('domain')); // may have been "fixed" by the validation function
				Configuration::updateValue('googlebase_psdir', Tools::getValue('psdir'));	// may have been "fixed" by the validation function
				// Go try and generate the feed
				$this->_postProcess();
			}
			else
			{
				foreach ($this->_postErrors AS $err)
				{
					$this->_html .= '<div class="alert error">'.$err.'</div>';
				}
			}
		}
			
		$this->_displayFeed();
		$this->_displayForm();
		
		return $this->_html;
	}

}
?>