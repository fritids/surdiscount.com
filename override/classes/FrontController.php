<?php
/*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 1.4 $
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class FrontController extends FrontControllerCore
{
	public function displayHeader()
	{
		global $cookie, $js_files;
		
		if (!self::$initialized)
			$this->init();

		$categories = Db::getInstance()->ExecuteS('
		SELECT DISTINCT c.*, cl.*
		FROM `'._DB_PREFIX_.'category` c 
		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.intval($cookie->id_lang).')
		LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)
		WHERE `id_parent` = 1
		AND c.`active` = 1
		AND cg.`id_group` '.(!$cookie->id_customer ?  '= 1' : 'IN (SELECT id_group FROM '._DB_PREFIX_.'customer_group WHERE id_customer = '.intval($cookie->id_customer).')').'
		ORDER BY `position` ASC, cl.`name` ASC');

		foreach ( $categories as $i => $categorie ) {
			$children = Category::getChildren( $categorie['id_category'], intval( $cookie->id_lang ) );
			
			if ( count( $children ) ) {
				$categories[$i]['children'] = $children;
			}
		}
		
		$categories = array_reverse( $categories );
		
		$colors = array(
			'cartable-sac-trolley' => array(
				'name' => 'vert',
				'border' => '#2eb509',
				'hexa' => '#68E287',
				'promo' => Category::getRandomProductFromCategory( 57 )
			),
			'cartouches-imprimantes' => array(
				'name' => 'rose',
				'border' => '#ff00cc',
				'hexa' => '#FF93E4',
				'promo' => Category::getRandomProductFromCategory( 102 )
			),
			'fantaisie-divers' => array(
				'name' => 'ciel',
				'border' => '#17cfda',
				'hexa' => '#9BFBFF',
				'promo' => Category::getRandomProductFromCategory( 27 )
			),
			'informatique-bureautique' => array(
				'name' => 'bleu',
				'border' => '#2d7bfb',
				'hexa' => '#77B2FF',
				'promo' => Category::getRandomProductFromCategory( 99 )
			),
			'fournitures-accessoires' => array(
				'name' => 'jaune',
				'border' => '#ffd800',
				'hexa' => '#FFE87A',
				'promo' => Category::getRandomProductFromCategory( 100 )
			),
			'fournitures-bureau' => array(
				'name' => 'orange',
				'border' => '#ff7300',
				'hexa' => '#FFBC75',
				'promo' => Category::getRandomProductFromCategory( 104 )
			),
			'scrapbooking-decoration' => array(
				'name' => 'rouge',
				'border' => '#ff0000',
				'hexa' => '#FF8C8C',
				'promo' => Category::getRandomProductFromCategory( 103 )
			)
		);

		self::$smarty->assign(array(
			'categories' => $categories,
			'menu_colors' => $colors,
			'isLogged' => $cookie->isLogged(),
			'cookie_once' => $cookie->once,
			'img_menu_size' => Image::getSize('home')
		));

		parent::displayHeader();
	}
	
	public function productFilter () {
		global $cookie;

		$filter_manufacturer = Tools::getValue('filter_manufacturer');
		
		if ( isset( $_GET['id_category'] ) && Validate::isUnsignedId( Tools::getValue('id_category') ) ) {
			$Category = new Category( Tools::getValue('id_category'), $cookie->id_lang );
		
			self::$smarty->assign(array(
				'manufacturers' => $Category->getManufacturers(),
				'filter_manufacturer' => $filter_manufacturer
			));
		}
	}
}
