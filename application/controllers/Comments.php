<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends MY_Shoptotalk {

    public $blockCommentsDelta = 0;

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $post_id = $this->input->post('post_id');

        $this->db->where("post_id", $post_id);
        $this->db->where("valid", 1);

        // When send new comment
        if($this->input->post('limit')){
            $this->db->limit($this->input->post('limit'));
            $this->db->order_by("rdate", "desc");
        } else {
            $this->db->order_by("rdate", "asc");
        }

        $query = $this->db->get('comments');
        foreach($query->result() AS $comment) {
            $comment->user_comment = $this->db->get_where('users', Array("_id" => $comment->user_id))->row(0);
            $comment->numOfCommentLoves = $this->count_comment_loves($comment->_id);
            $data['data'][] = $this->load->view('comment', $comment, TRUE);
        }

        $data['numOfComments'] = $this->count_comments($post_id);

        die(json_encode($data));
    }

    public function add()
    {
        if($this->userCommentsBlock()) die('false');
        $user_id = $this->userInfo->_id;

        $data['user_id'] = $user_id;
        $data['post_id'] = $this->input->post('post_id');
        $data['text'] = $this->input->post('text');

        $this->db->insert('comments',$data);
        $commentID = $this->db->insert_id();

        $return['numOfcomments'] = $this->count_comments($data['post_id']);
        $return['commentID'] = $commentID;

        $post =  $this->getPost($data['post_id']);
        $return['post_id'] = $post->_id;
        $return['alertUser'] = $this->getUser($post->user_id)->_id;
        $return['userMakeAction'] = $this->userInfo->fname. ' '.$this->userInfo->lname;
        $return['userMakeActionID'] = $this->userInfo->_id;
        $return['msg'] = 'newComment';
        $return['type'] = 'posts';
        $return['type'] = 'posts';

        if($return['alertUser'] == $this->userInfo->_id) unset($return['alertUser']);

        die(json_encode($return));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $post_id = $this->input->post('post_id');

        $data = Array('valid' => 0);
        $this->db->where("_id", $id);
        $this->db->where("user_id", $this->userInfo->_id);
        $this->db->update('comments', $data);

        if($this->db->affected_rows()){
            $return['success'] = true;
            $return['post_id'] = $post_id;
            $return['numOfComments'] = $this->count_comments($post_id);
        } else {
            $return['success'] = false;
        }

        die(json_encode($return));
    }

    private function userCommentsBlock()
    {
        $lastComment = $this->session->userdata('lastComment');
        if( (time() - $lastComment) < $this->blockCommentsDelta) return true;

        $data['lastComment'] = time();
        $this->session->set_userdata($data);

        return false;
    }

}