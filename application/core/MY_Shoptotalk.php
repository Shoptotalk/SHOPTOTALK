<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Shoptotalk extends CI_Controller {

    public $secret = '1qaz@WSXPostsTokenShopToTalkZXjkl12qw';
    public $userInfo, $postLimit ,$category;
    public $showUserPosts;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('UTC');
        $user_session = $this->session->userdata('user');
        $this->userInfo = $this->getUser($user_session['_id']);
        $this->postLimit = 10;

        if($this->uri->segment(1) == "profile" AND $this->uri->segment(2) == "u") $this->showUserPosts = $this->uri->segment(3);
    }

    public function getDefaultData()
    {
        $data['categories'] = $this->getCategories();
        $data['count_notifications'] = $this->count_notifications();
        $data['userInfo'] = $this->userInfo;
        return $data;
    }

    public function dbAdd($tbl, $data)
    {
        if(array_key_exists('_id', $data)){
            $id = $data['_id'];
            unset($data['_id']);
        }

        if( isset($id) ){
            $this->db->where('_id', $id);
            $this->db->update($tbl, $data);
            $lastID = $id;
        } else {
            $data['createDate'] = date("Y-m-d H:i:s");
            $this->db->insert($tbl, $data);
            $lastID = $this->db->insert_id();
        }

        return $lastID;
    }

    public function getCategories()
    {
        $this->db->where('valid', 1);
        $result = $this->db->get('categories')->result();
        foreach($result AS $row) $return[$row->_id] = $row->title;

        return $return;
    }

    public function curl($url) {
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
    public function count_user_loves($user_id)
    {
        return $this->db->where('valid', 1)->where('user_id', $user_id)->count_all_results('loves');
    }
    public function count_user_friends($user_id)
    {
        return 0;
//        return $this->db->where('valid', 1)->where('user_id', $user_id)->count_all_results('friends');
    }

    public function count_user_posts($user_id)
    {
        return $this->db->where('valid', 1)->where('user_id', $user_id)->count_all_results('posts');
    }

    public function count_notifications()
    {
        return $this->db->where('valid', 1)->where('to_user', $this->userInfo->_id)->count_all_results('notifications');
    }

    public function count_comment_loves($comment_id)
    {
        return $this->db->where('valid', 1)->where('comment_id', $comment_id)->count_all_results('loves_comments');
    }

    public function count_loves($post_id)
    {
        return $this->db->where('valid', 1)->where('post_id', $post_id)->count_all_results('loves');
    }

    public function count_comments($post_id)
    {
        return $this->db->where('valid', 1)->where('post_id', $post_id)->count_all_results('comments');
    }

    public function getUser($user_id)
    {
        return $this->db->get_where('users', Array('_id' => $user_id))->row(0);
    }

    public function getPost($post_id)
    {
        return $this->db->get_where('posts', Array('_id' => $post_id))->row(0);
    }

}