<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //
    }

    /**
     * 编辑
     */
    public function toEdit () {
    	$id = $this->input->get_post('id');
        $this->load->model('customer_model');
        $data = $this->customer_model->get($id);
        $this->page->tempPage('order/order-edit', array(
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
