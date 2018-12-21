<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Option extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //
    }

    /**
     * 分页查询统一渲染
     * @param String $act 
     * @param Array $optMap 该字段信息
     * @param Array $config 配置
     */
    public function displayPage ( $act, $optMap = array(), $config = array() ) {
        $per_page = 10;
        $this->load->model('option_model');
        $func = 'query'.ucfirst($act);
        $rs = $this->option_model->queryByPage($per_page, $optMap['om_id']);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url(__CLASS__.'/'.$act);
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
        $info['menu2'] = $optMap['om_name'];
        $info['menu3'] = $optMap['om_name'].'管理';
        $data['info'] = $info;
        $data['rule'] = $rule;
        $data['optMap'] = $optMap;

        $this->page->tempPage('option/feild-option.php', array(
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

    public function optList () {
        $type = $this->input->get_post('type');
        $this->load->model('Option_model');
        $rs = $this->Option_model->getOptMap($type);
        $this->displayPage(__FUNCTION__, $rs);
    }

    /**
     * 金融机构
     */
    public function bankingList () {
    	$this->load->model('Option_model');
    	$rs = $this->Option_model->getOptMap(1);
    	$this->displayPage(__FUNCTION__, $rs);
    }

    /**
     * 添加金融机构
     */
    public function financialAdd () {
    	$id = intval($this->input->get_post('id'));
    	if ($id!=''){
    		$this->load->model('Option_model');
    		$opt = $this->Option_model->get($id);
    		$param['opt'] = $opt;
    	}
    	$this->load->model('option_model');
    	$opt_type = $this->input->get_post('opt_type');
    	$rs = $this->option_model->getOptMap($opt_type);
    	$param['data'] = $rs;
    	$this->page->tempPage('option/financial-add.php', array(
            'head_params' => '',
            'header_params' => array(
            	'title' => '添加'.$rs['om_name'],
                'css' => array('main'),
                'js' => array('')
                ),
            'params' => $param,
            'foot_params' => '',
            'footer_params' => ''
            ));
    }

    /**
     * 车辆品牌
     */
    public function carBrandList () {
        $this->load->model('Option_model');
        $rs = $this->Option_model->getOptMap(2);
        $this->displayPage(__FUNCTION__, $rs);
    }
}
