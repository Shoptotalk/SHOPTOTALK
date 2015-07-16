<?php

class lang_detected {
	
	public $lang_heb = Array('ף','ך','ץ','ן','ם','א','ב','ג','ד','ה','ו','ז','ח','ט','י','כ','ל','מ','נ','ס','ע','פ','צ','ק','ר','ש','ת');
	public $lang_eng = Array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

	public function getLang($str) {
		$string = $this->str_split_unicode($str);
		$heb = 0;
		$eng = 0;
		
		foreach($string AS $letter) {
			if(in_array($letter,$this->lang_heb)) $heb++;
			else if(in_array($letter,$this->lang_eng)) $eng++;
		}
	
		if($heb > $eng) return 'HEB';
			else return 'ENG';
	}
	
	public function getSide($str) {
		if($this->getLang($str) == "HEB") return 'right';
			else return 'left';
	}
	
	public function getLtrRtl($str) {
		if($this->getLang($str) == "HEB") return 'rtl';
			else return 'ltr';
	}
	
	
	private function str_split_unicode($str, $l = 0) {
		if ($l > 0) {
			$ret = array();
			$len = mb_strlen($str, "UTF-8");
			for ($i = 0; $i < $len; $i += $l) {
				$ret[] = mb_substr($str, $i, $l, "UTF-8");
			}
			return $ret;
		}
		return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
	}
	
}