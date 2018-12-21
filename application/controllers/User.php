<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //
    }

    public function roleList () {
    	$this->displayPage(__FUNCTION__);
    }


    public function roleAdd () {
    	$id = $this->input->get_post('id');
    	//取出所有权限
    	$this->load->model('user_model');
    	$this->load->model('role_model');
    	$data['permission'] = $this->user_model->getPermission();
    	if ($id!=''){
    		//取出用户权限
    		$this->load->model('user_model');
    		$data['rolePermiss'] = $this->user_model->getRolePermission($id);
    		$data['role'] = (array)$this->role_model->get($id);
    	}
    	$this->page->tempPage('user/role-add', array(
            'head_params' => '',
            'header_params' => array(
                'css' => array('main'),
                'js' => array('')
                ),
            'params' => $data,
            'foot_params' => '',
            'footer_params' => ''
            ));
    }

    public function userList () {
    	$this->displayPage(__FUNCTION__);
    }

    public function userAdd () {
    	$id = $this->input->post_get('id');
    	$this->load->model('role_model');
    	$data['role'] = $this->role_model->get();
    	if ($id!=''){
    		$this->load->model('user_model');
    		$data['data'] = (array)$this->user_model->get($id);
    	}
    	$this->page->tempPage('user/user-add', array(
            'head_params' => '',
            'header_params' => array(
                'css' => array('main'),
                'js' => array('')
                ),
            'params' => $data,
            'foot_params' => '',
            'footer_params' => ''
            ));
    }

    /**
     * 分页查询统一渲染
     * @param Array $config 配置
     */
    public function displayPage ( $act, $data=array(), $config = array()) {
        $per_page = 10;
        $this->load->model('user_model');
        $func = 'query'.ucfirst($act);
        $rs = $this->user_model->$func($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('User/'.$act);
        $config['total_rows'] = $rs['total'];
        $config['per_page'] = $per_page;
        $config['reuse_query_string'] = true;
        $config['first_link'] = true;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = true;
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $data['page'] =  $this->pagination->create_links();
        $rule['startDate'] = $this->input->get_post('startDate');
        $rule['endDate'] = $this->input->get_post('endDate');
        $rule['c_name'] = $this->input->get_post('c_name');
        $data['data'] = $rs['data'];
        $info['total_page'] = $this->pagination->get_total_page();
        $info['total'] = $rs['total'];
        $info['per_page'] = $per_page;
        $data['info'] = $info;
        $data['rule'] = $rule;

        $this->page->tempPage('user/'.str_replace('List', '-list', $act).'.php', array(
            'head_params' => '',
            'header_params' => array(
                'css' => array('main'),
                'js' => array('')
                ),
            'params' => $data,
            'foot_params' => '',
            'footer_params' => ''
            ));
    }
    

    //退出
    public function Logout () {
        unset($_SESSION['USER']);
        header("Location:".site_url('Login/toLogin'));
    }
}
