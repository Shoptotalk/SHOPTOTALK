<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Url extends MY_Shoptotalk {

	public function __construct() {
		parent::__construct();
	}

	public function paste() {
		$html = $this->curl($this->input->post('url'));
		$doc = new DOMDocument();
		@$doc->loadHTML($html);
		$finder = new DomXPath($doc);
		$parse = parse_url($_REQUEST['url']);

		$data['item_url'] = $_REQUEST['url'];

		foreach( $doc->getElementsByTagName('meta') as $meta ) {
			$key = str_replace("og:","",$meta->getAttribute('property'));
			if(!$key) $key = str_replace("og:","",$meta->getAttribute('name'));
			if(!$key) continue;
			$data[$key] = $meta->getAttribute('content');
		}

		if( !isset($data['site_name']) ) {
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

		// $data['category'] = $_REQUEST['category'];

		die(json_encode($data));
	}

}
