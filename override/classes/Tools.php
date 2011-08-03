<?php

class Tools extends ToolsCore {
	public static function getPath($id_category, $path = '', $linkOntheLastItem = false, $categoryType = 'products')
		{
			global $link, $cookie;
	
			if ($id_category == 1)
				return '';

			if ($categoryType === 'products') {
				$category = Db::getInstance()->getRow('
				SELECT id_category, level_depth, nleft, nright
				FROM '._DB_PREFIX_.'category
				WHERE id_category = '.(int)$id_category);
	
				if (isset($category['id_category'])) {
					$categories = Db::getInstance()->ExecuteS('
					SELECT c.id_category, cl.name, cl.link_rewrite
					FROM '._DB_PREFIX_.'category c
					LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (cl.id_category = c.id_category)
					WHERE c.nleft <= '.(int)$category['nleft'].' AND c.nright >= '.(int)$category['nright'].' AND cl.id_lang = '.(int)($cookie->id_lang).' AND c.id_category != 1
					ORDER BY c.level_depth ASC
					LIMIT '.(int)$category['level_depth']);
	
					$fullPath = '';
					$n = 1;
					$nCategories = (int)sizeof($categories);
					foreach ($categories AS $i => $category) {

						$fullPath .=
						'<li'.( ( $i+1 == $nCategories && empty( $path ) ) ? ' class="last"' : '' ).' itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.self::safeOutput($link->getCategoryLink((int)$category['id_category'], $category['link_rewrite'])).'" title="'.htmlentities($category['name'], ENT_NOQUOTES, 'UTF-8').'"><span itemprop="title">'.
							htmlentities($category['name'], ENT_NOQUOTES, 'UTF-8').
						'</span></a></li>';
					}
	
					if ( !empty( $path ) ) {
						$path = '<li class="last">'.$path.'</li>';
					}
	
					return $fullPath.$path;
				}
			}
			elseif ($categoryType === 'CMS')
			{
				$category = new CMSCategory((int)($id_category), (int)($cookie->id_lang));
				if (!Validate::isLoadedObject($category))
					die(self::displayError());
				$categoryLink = $link->getCMSCategoryLink($category);
	
				if ($path != $category->name)
					$fullPath .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.self::safeOutput($categoryLink).'"><span itemprop="title">'.htmlentities($category->name, ENT_NOQUOTES, 'UTF-8').'</span></a></li>'.$path;
				else
					$fullPath = ($linkOntheLastItem ? '<a href="'.self::safeOutput($categoryLink).'">' : '').htmlentities($path, ENT_NOQUOTES, 'UTF-8').($linkOntheLastItem ? '</a>' : '');
	
				return self::getPath((int)($category->id_parent), $fullPath, $linkOntheLastItem, $categoryType);
			}
		}
}