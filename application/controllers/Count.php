<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Count extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->isLogin();
    }

    function index() {
        //
    }

    /**
     * 申请单数据
     */
    public function order () {
    	$this->load->model('customer_model');
    	$info['title'] = "申请单处理状态数据";
    	$data['info'] = $info;
    	$data['data'] = $this->customer_model->countOrder();
    	$this->page->tempPage('count/order', array(
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
     * 申请单数据
     */
    public function countCompany () {
    	$this->load->model('customer_model');
    	$info['title'] = "申请单金融公司数据";
    	$info['name'] = "申请单金融公司数据";
    	$data['info'] = $info;
    	$data['data'] = $this->customer_model->countCompany();
    	$this->page->tempPage('count/order', array(
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
}
