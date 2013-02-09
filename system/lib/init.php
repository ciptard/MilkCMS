<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class app {

	public static function initiate() {
	
		# Parse URL
		$url = str_replace(c::get('rewritebase'), '', $_SERVER['REQUEST_URI']);
		
		# Load text parsers
		parsers::load();
		
		if (empty($url)) {
		
			self::loadIndex();
		
		}
		else {
		
			if (strstr($url, 'page=')) {
				
				$page = str_replace('page=', '', $url);
				self::loadIndex($page);
				
			}
			elseif (strstr($url, '?search=')) {
				
				$search = new search($url);
				$articles = $search -> getResults();
				
				if (is_file(c::get('root.templates') . '/search.php')) require_once(c::get('root.templates') . '/search.php');
				else require_once(c::get('root.templates') . '/index.php');
				
			}
			else {
			
				if (file_exists(c::get('root.content') . '/' . $url . '.txt')) {
				
					# Is caching turned on?
					if (c::get('cacheexpire')) {
						
						if (!is_dir(c::get('root.cache'))) cache::createCacheDir();
						
						# Check the cache status and get existing or create new cached file
						cache::checkCache($url);
						
					}
					else {
						
						# Get the article
						$article = new article($url . '.txt');
						
						require_once(c::get('root.templates') . '/article.php');
					
					}
				
				}
				else {
				
					if (isset($_GET['e'])) header::error($_GET['e']);
					else header::error(404);
				
				}
				
			}
			
		}
	
	}
	
	private static function loadIndex($page = 1) {
	
		$index = true;
		
		# Get page details
		pagination::pageDetails($page);
		
		# Get article list in an array
		$articles = files::getArticles();
		
		require_once(c::get('root.templates') . '/index.php');
	
	}

}

?>