<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->toLogin();
    }

    //登陆视图
    public function toLogin () {
    	$this->load->view('login');
    }

    /**
		 * 获取验证码
		 */
    public function getCode () {
    	// header("Content-type:image/png");
    	$config = array('length'=>4,'fontSize'=>16);
    	$this->load->library('verify', $config);
    	//$Verify = new Verify($config);
    	$this->verify->entry();
    }

    //登录操作
    public function login(){
    	header("Content-type:text/json");
    	$rd = array('code'=>-1,'errmsg'=>'error');
		$this->load->library('verify');
		$code = $this->input->post('code');
		if ($this->verify->check($code)) {
			$user_name = $this->input->post('user_name');
			$password = $this->input->post('user_pwd', TRUE);
			//取出密码
			$this->load->model('user_model');
			$user = (array)$this->user_model->get(array('user_name'=>$user_name));
			if ($user){
				if ($user['state']==2) die('{"code":-3,"errmsg":"该用户被禁用"}');
				if ($user['user_pwd']==md5($password)){
					$this->session->USER = $user;
					$rd['code'] = 1;
					unset($user);
				}else{
					$rd['code'] = -2;
					$rd['errmsg'] = '密码错误';
				}
			}else{
				$rd['code'] = -2;
				$rd['errmsg'] = '用户不存在';
			}
			
		}else{
			$rd['code'] = -3;
			$rd['errmsg'] = '验证码错误';
		}
		echo json_encode($rd);
    }
}
