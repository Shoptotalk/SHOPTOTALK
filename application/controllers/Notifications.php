<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends MY_Shoptotalk
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = $this->input->post('data');

        $add['from_user'] = $data['userMakeActionID'];
        $add['to_user'] = $data['alertUser'];
        $add['msg'] = $data['msg'];
        $add['type'] = $data['type'];
        $add['type_id'] = $data['post_id'];

        $exist = $this->db->get_where('notifications', $add)->row(0);
        if( isset($exist->_id) ) {
            $return['success'] = false;
            die(json_encode($return));
        }

        $add['socketResponse'] = json_encode($data);

        $lastID = $this->dbAdd('notifications', $add);
        $return['success'] = ($lastID ? true : false);
        die(json_encode($return));
    }

    public function getNotifications()
    {
        $where['to_user'] = $this->userInfo->_id;
        $return = Array();

        $notifications = $this->db->order_by('rdate', 'desc')->limit(8)->get_where('notifications', $where);
        foreach($notifications->result() AS $notification) {

            // From user
            $notification->from_user = $this->getUser($notification->from_user);
            // Post details
            if($notification->type == "posts") $notification->post = $this->getPost($notification->type_id);
                else $notification->post = Array();

            $return['data'][] = $this->load->view('notification', $notification, TRUE);

            // Update seen
            $update['_id'] = $notification->_id;
            $update['valid'] = 0;
            $this->dbAdd('notifications', $update);
        }

        die(json_encode($return));
    }

}