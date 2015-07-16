<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Shoptotalk {

    public $data;

	public function __construct() {
		parent::__construct();
        $this->data = $this->getDefaultData();
	}

    public function _remap($function, $category)
    {
        $this->category = @$category[0];
        $this->index();
    }

	public function index()
	{
		if(!isUser()) redirect('/Login');

        $this->data['page_js'][] = 'js/posts.js';
        $this->data['page_js'][] = 'js/loves.js';
        $this->data['category'] = $this->category;
        $this->data['right_bar'] = $this->load->view('right_bar', $this->data, TRUE);

        $views = Array('main');
        $this->template->load($views,$this->data);
	}

}
