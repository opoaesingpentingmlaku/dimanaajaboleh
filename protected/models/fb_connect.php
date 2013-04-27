<?php

//fb_connect.php
//Author: Graham McCarthy,  HitSend Inc., September 29th, 2010
//Email: graham@hitsend.ca
//Description: facebook connect library, connects to facebook and
//    stores all the required information in return variables
//grab the facebook api php file
include(APPPATH . 'libraries/facebook/facebook.php');

class Fb_connect {

//declare variables
    private $_obj;
    private $_api_key = NULL;
    private $_secret_key = NULL;
    public $user = NULL;
    public $user_id = FALSE;
    public $fbLoginURL = "";
    public $fbLogoutURL = "";
    public $fb = FALSE;
    public $fbSession = FALSE;
    public $appkey = 0;

//constructor method.
    function Fb_connect() {
//Using the CodeIgniter object, rather than creating a copy of it
        $this->_obj = & get_instance();

//loading the config paramters for facebook (where we stored our Facebook API and SECRET keys
//$this->_obj->load->config('facebook');
//make sure the session library is initiated. may have already done this in another method.
        $this->_obj->load->library('session');

//
        $this->_api_key = $this->_obj->config->item('facebook_app_id');
        $this->_secret_key = $this->_obj->config->item('facebook_app_key');

        $this->appkey = $this->_api_key;

//connect to facebook
        $this->fb = new Facebook(array(
                    'appId' => $this->_api_key,
                    'secret' => $this->_secret_key,
                    'cookie' => true,
                ));

//store the return session from facebook
        $this->fbSession = $this->fb->getSession();

        $me = null;
// If a valid fbSession is returned, try to get the user information contained within.
        if ($this->fbSession) {
            try {
//get information from the fb object
                $uid = $this->fb->getUser();
                $me = $this->fb->api('/me');

                $this->user = $me;
                $this->user_id = $uid;
            } catch (FacebookApiException $e) {
                error_log($e);
            }
        }

// login or logout url will be needed depending on current user state.
//(if using the javascript api as well, you may not need these.)
        if ($me) {
            $this->fbLogoutURL = $this->fb->getLogoutUrl();
        } else {
            $this->fbLoginURL = $this->fb->getLoginUrl();
        }
    }

//end Fb_connect() function
}

// end class

/* End of file fb_connect.php */
/* Location: ./application/libraries/fb_connect.php */
