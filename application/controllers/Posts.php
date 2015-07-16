<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_Shoptotalk {

	public function __construct() {
		parent::__construct();
	}

    public function show()
    {
        $id = $this->input->post('id');
        $this->db->where('_id', $id);
        $this->db->where('valid', 1);
        $result = $this->db->get('posts')->row(0);
        $result->user_post = $this->db->get_where('users', array('_id' => $result->user_id))->row(0);
        $result->numOfComments = $this->count_comments($id);
        $result->numOfLoves = $this->count_loves($id);

        $data['postData'] = $this->load->view('post_popup', $result, TRUE);
        $data['item_title'] = $result->item_title;

        die(json_encode($data));
    }

	public function add()
	{
		if($this->input->post("itemTitle")) $this->newPost(); // when form sent

        // when paste url
        $data['categories'] = $this->getCategories();
		$data['data'] = json_decode($this->input->post("data"));
		$this->load->view('new_post',$data);
	}

	private function newPost()
	{
		$data['item_title']			= $this->input->post("itemTitle");
		$data['item_price'] 		= $this->input->post("itemPrice");
		$data['item_image'] 		= $this->input->post("itemImage");
		$data['item_site'] 			= $this->input->post("itemSite");
		$data['item_url'] 			= $this->input->post("itemUrl");
		$data['user_id'] 			= $this->userInfo->_id;
		$data['user_price'] 		= $this->input->post("userPrice");
		$data['user_experience'] 	= $this->input->post("userExperience");
		$data['user_itemCategory']  	= $this->input->post("userItemCategory");

        if($this->input->post('itemMoreImages')) {
            $data['item_moreImages'] = implode(",", $this->input->post('itemMoreImages'));
        }

        $postID = $this->dbAdd('posts', $data);

		if($postID) die('true');
			else die('false');
	}

	public function getPosts()
	{
        $data = Array();
        $page = $this->input->post('page');
        $category = $this->input->post('category');
        $user_id = $this->input->post('user_id');

        if($page) $page = $page * $this->postLimit;
        if($category) $this->db->where('user_itemCategory', $category);
        if($user_id) $this->db->where('user_id', $user_id);

		$this->db->where('valid', 1);
        $this->db->limit($this->postLimit, $page);
        $this->db->order_by('rdate', 'desc');
		$query = $this->db->get('posts');

        foreach($query->result() AS $postData){
			$postData->user_post        = $this->db->get_where('users', array('_id' => $postData->user_id))->row(0);
            $postData->numOfComments    = $this->count_comments($postData->_id);
            $postData->numOfLoves       = $this->count_loves($postData->_id);
			$postData->category         = $this->db->get_where('categories', Array("_id" => $postData->user_itemCategory))->row(0);
            $data['data'][]             = $this->load->view('post',$postData, TRUE);
		}

        die(json_encode($data));
	}
	
	public function delete()
	{
        $id = $this->input->post('id');
		$data = Array('valid' => 0);
		$this->db->where("_id", $id);
		$this->db->where("user_id", $this->userInfo->_id);
		$this->db->update('posts', $data);

        if($this->db->affected_rows()) die('true');
            else die('false');
	}

    public function getMoreImagesFromPaste()
    {

        $html = $this->curl($this->input->post('url'));
        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        $parse = parse_url($_REQUEST['url']);

        $data['moreImages'] = Array();
        $i =0;
        foreach( $doc->getElementsByTagName('img') as $img ) {
            $imgSrc = $img->getAttribute('src');
            $parseImgSrc = parse_url($imgSrc);
            if( !isset($parseImgSrc['host']) ) $imgSrc = $parse['host'].'/'.$imgSrc;
            if(!@strstr($imgSrc, $parse['scheme'].'://')) $imgSrc = $parse['scheme'].'://'.$imgSrc;
            $imgSrc = str_replace("////","//",$imgSrc);
            $size = @getimagesize($imgSrc);
            if($size[0] > 250) {
                $data['moreImages'][] = $imgSrc;
                $i++;
            }

            if($i >= 5) break;
        }

        if(count($data['moreImages'])) $data['success'] = true;
            else $data['success'] = false;

        die(json_encode($data));
    }

}
