<?php
require_once('system/global.php');

switch($_REQUEST['act']){
	
	case md5("redirect_to_item"):
		$data['item_id'] = new MongoId($_REQUEST['id']);
		$data['user_id'] = new MongoId(decode($_COOKIE[$global->userCookie]));
		dbAdd($data,"redirects_db");
		$item = dbGet($_REQUEST['id'],"items_db");
		
		switch(strtolower($item['site'])) {
			case "ebay":
				preg_match('/\d{12}/',$item['url'],$matches);
				$itemID = $matches[0];
				$redirectTo = "http://rover.ebay.com/rover/1/711-53200-19255-0/1?icep_ff3=2&pub=5575089363&toolid=10001&campid=5337694071&customid=&icep_item=".$itemID."&ipn=psmain&icep_vectorid=229466&kwid=902099&mtid=824&kw=lg";
				break;
			
			default:
				$redirectTo = $item['url'];
				break;
		}
		
		redirect($redirectTo);
		break;
	
	case "get_item_details":
		$html = get_data($_REQUEST['url']);
		$doc = new DOMDocument();
		@$doc->loadHTML($html);
		$finder = new DomXPath($doc);;
		$parse = parse_url($_REQUEST['url']);
		
		$data['url'] = $_REQUEST['url'];
		
		foreach( $doc->getElementsByTagName('meta') as $meta ) { 
			$key = str_replace("og:","",$meta->getAttribute('property'));
			if(!$key) $key = str_replace("og:","",$meta->getAttribute('name'));
			if(!$key) continue;
			$data[$key] = $meta->getAttribute('content');
		}
		
		$data['moreImages'] = Array();
		$i =0;
		foreach( $doc->getElementsByTagName('img') as $img ) { 
			$imgSrc = $img->getAttribute('src');
			$parseImgSrc = parse_url($imgSrc);
			if(!$parseImgSrc['host']) $imgSrc = $parse['host'].'/'.$imgSrc;
			if(!@strstr($imgSrc, $parse['scheme'].'://')) $imgSrc = $parse['scheme'].'://'.$imgSrc;
			$imgSrc = str_replace("////","//",$imgSrc);
			$size = getimagesize($imgSrc);
			if($size[0] > 250) {
				$data['moreImages'][] = $imgSrc;
				$i++;
			}
			
			if($i >= 5) break;
		}
		
		if(!$data['site_name']) {
			$domainEXP = explode(".",$parse['host']);
			if(strstr($parse['host'],"www.")) $data['site_name'] = $domainEXP[1]; else $data['site_name'] = $domainEXP[0];
		}
		
		// Get Price 
		$elements = $finder->query("//*[contains(@itemprop, 'price') or contains(@class, 'price') or contains(@id, 'price')]");
		foreach ($elements as $element) {
			if(preg_match("/(?:\d*\.)?\d+/",$element->textContent)) {
				preg_match("/(?:\d*\.)?\d+/", $element->textContent, $matches);
				$data['price'] = $matches[0];
				$data['fullTextPrice'] = trim($element->textContent);
				break;
			}
		}
		
		$data['category'] = $_REQUEST['category'];
		
		die(json_encode($data));
		break;
	
	case "get_url":
		$parse = parse_url($_REQUEST['url']);
		$domainEXP = explode(".",$parse['host']);
		if(strstr($parse['host'],"www.")) $data['site'] = $domainEXP[1]; else $data['site'] = $domainEXP[0];
		$data['_id'] = new MongoId();
		$data['insert_date'] = new MongoDate();
		$data['url'] = $_REQUEST['url'];
		$data['scheme'] = $parse['scheme'];
		$data['domain'] = $parse['host'];
		$data['path'] = $parse['path'];
		$data['query'] = $parse['query'];
		$data['category'] = $_REQUEST['category'];
		$data['uid'] = new MongoId($userInfo['_id']);
		if($global->savePastes) dbAdd($data,'pastes_db');
		die(json_encode($data));
		break;
	
}

function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
	curl_setopt($ch, CURLOPT_COOKIEJAR, TRUE);
	curl_setopt($ch, CURLOPT_COOKIEFILE, TRUE);
	curl_setopt($ch, CURLOPT_REFERER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
