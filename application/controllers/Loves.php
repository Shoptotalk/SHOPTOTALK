<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loves extends MY_Shoptotalk {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $post_id = $this->input->post('post_id');
        $comment_id = $this->input->post('comment_id');

        if($post_id) {
            // Love post
            $tbl = 'loves';
            $data['post_id'] = $post_id;
            $exist = $this->db->get_where($tbl, Array("user_id" => $this->userInfo->_id, "post_id" => $post_id))->row(0);
            if( !isset($exist->_id) ) {
                // Notification
                $return['alertUser'] = $this->db->get_where('posts', Array("_id" => $post_id))->row(0)->user_id;
                $return['msg'] = 'lovePost';
            }
        } else {
            // Love comment
            $comment = $this->db->get_where('comments', Array("_id" => $comment_id))->row(0);
            $tbl = 'loves_comments';
            $data['comment_id'] = $comment_id;
            $exist = $this->db->get_where($tbl, Array("user_id" => $this->userInfo->_id, "comment_id" => $comment_id))->row(0);
            if( !isset($exist->_id) ) {
                // Notification
                $return['alertUser'] = $comment->user_id;
                $return['msg'] = 'loveComment';
            }
        }

        if(!$post_id) $post_id = $comment->post_id;
        $data['user_id'] = $this->userInfo->_id;
        $data['valid'] = 1;

        if( isset($exist->_id) ){
            $data['_id'] = $exist->_id;
            if($exist->valid) $data['valid'] = 0;
        } else {
            if($return['alertUser'] == $this->userInfo->_id) unset($return['alertUser']);
        }

        // for develop
//        $return['alertUser'] = 1;
//        $return['msg'] = 'lovePost';
//        $return['type'] = 'posts';
        // for develop

        $return['type'] = 'posts';
        $return['post_id'] = $post_id;
        $return['userMakeAction'] = $this->userInfo->fname. ' '.$this->userInfo->lname;
        $return['userMakeActionID'] = $this->userInfo->_id;
        $return['love'] = $data['valid'];
        $return['lastID'] = $this->dbAdd($tbl, $data);

        if($comment_id) $return['numOfLoves'] = $this->count_comment_loves($comment_id);
            else $return['numOfLoves'] = $this->count_loves($post_id);

        if($return['lastID']) $return['success'] = TRUE; else $return['success'] = FALSE;
        
        die(json_encode($return));

    }

    public function getList()
    {
        $post_id = $this->input->post('post_id');
        $result = $this->db->get_where('loves', Array('valid' => 1, 'post_id' => $post_id));
        foreach($result->result() AS $love){
            $loveData['user'] = $this->getUser($love->user_id);
            $data['data'][] = $this->load->view('love_list', $loveData, TRUE);
        }

        $data['totalLoves'] = $this->count_loves($post_id);
        $data['success'] = true;
        die(json_encode($data));
    }

}