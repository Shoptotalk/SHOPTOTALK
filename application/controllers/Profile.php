<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Shoptotalk
{
    public $data, $saveOriginals;

    public function __construct()
    {
        parent::__construct();
        if(!isUser()) redirect('/Login');
        $this->data = $this->getDefaultData();
    }

    public function u($user_id)
    {
        $this->data['page_js'][] = 'js/posts.js';
        $this->data['page_js'][] = 'js/loves.js';
        $this->data['page_js'][] = 'js/profile_show.js';
        $this->data['category'] = $this->category;

        $this->data['user'] = $this->getUser($user_id);
        $this->data['count_user_posts'] = $this->count_user_posts($user_id);
        $this->data['count_user_friends'] = $this->count_user_friends($user_id);
        $this->data['count_user_loves'] = $this->count_user_loves($user_id);
        $views = Array('profile/profile');
        $this->template->load($views,$this->data);
    }

    public function save()
    {
        $add['fname'] = $this->input->post('FirstName');
        $add['lname'] = $this->input->post('LastName');
        $add['nickname'] = $this->input->post('NickName');
        $add['email'] = $this->encrypt->enc($this->input->post('EmailAddress'));
        $add['gender'] = $this->input->post('Gender');
        $add['birthDate'] = date("Y-m-d", strtotime($this->input->post('BirthDay').'-'.$this->input->post('BirthMonth').'-'.$this->input->post('BirthYear')));
        $add['country'] = $this->input->post('Country');
        $add['bestShop'] = $this->input->post('BestShop');
        $add['_id'] = $this->userInfo->_id;

        $this->dbAdd('users', $add);
        $this->session->set_flashdata('success', 'Your details was successfully saved!');
        redirect('/profile/edit');
    }

    public function edit()
    {
        $this->data['page_js'][] = 'js/profile_edit.js';
        $this->data['page_js'][] = 'js/autocomplete.js';
        $this->data['page_js'][] = 'validate/jquery.validate.js';
        $this->data['page_js'][] = 'validate/jquery.form.min.js';
        $this->data['page_js'][] = 'uploadImage/assets/js/html5imageupload.js';
        $this->data['page_css'][] = 'uploadImage/assets/css/html5imageupload.css';
        $views = Array('profile/edit');
        $this->template->load($views,$this->data);
    }

    public function removeProfilePic()
    {
        $add['_id'] = $this->userInfo->_id;
        $add['profilePicture'] = '';
        $this->dbAdd('users', $add);
    }

    public function uploadProfilePicture()
    {
        $this->saveOriginals = ($this->input->post('originial') ? TRUE : FALSE);
        header('Content-Type: application/json');
        $dir = '/uploads/profilePictures/';
        $serverDir				= str_replace("application/controllers/", "", dirname(__FILE__).$dir);
        $tmp					= explode(',',$this->input->post('data'));
        $imgData 				= base64_decode($tmp[1]);
        $extension				= @strtolower(end(explode('.',$this->input->post('name'))));
        $filename				= substr(0,-(strlen($extension) + 1)).'.'.substr(sha1(time()),0,10).'.'.$extension;
        $handle					= fopen($serverDir.$filename,'w');

        if(fwrite($handle, $imgData)){
            $return['status'] = 'success';
            $return['url'] = $dir.$filename.'?'.time();
            $return['filename'] = $filename;
            fclose($handle);

            if($this->saveOriginals) {
                $dir = '/uploads/profilePictures/originals/';
                $serverDir				= str_replace("application/controllers/", "", dirname(__FILE__).$dir);
                $tmp				= explode(',',$this->input->post('original'));
                $originalData		= base64_decode($tmp[1]);

                $handle				= fopen($serverDir.$filename,'w');
                fwrite($handle, $originalData);
                fclose($handle);
            }

            $add['_id'] = $this->userInfo->_id;
            $add['profilePicture'] = $return['url'];
            $this->dbAdd('users', $add);
        } else {
            $return['status'] = 'false';
        }

        die(json_encode($return));
    }

}