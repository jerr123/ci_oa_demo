<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->isAdminLogin();
    }

    public function index() {
        $this->home();
    }

    /**
     * 后台主页
     */
    public function home () {
    	$this->newsList();
    }

    /*-------------------------------------------------------------------------------------------------------------
     *
     *			案例相关
     *			
     *-------------------------------------------------------------------------------------------------------------*/

    /**
     * 添加/编辑案例 页面
     */
    public function caseAdd () {
    	$data = array();
        $id = $this->input->post_get('id');
        if ($id){
            $this->load->model('Cases_model');
            $data['data'] = $this->Cases_model->getDetailById();
        }
    	$this->page->loadAdmin('case_edit', array(
    		'head_param' => array('title'=>'添加案例',
    			'css' => array()
    			),
    		'top_param' => array('flag1'=>'case','flag2'=>'caseadd'),
    		'param' => $data
    		)
    	);
    }

    /**
     * 删除案例
     */
    public function caseDel () {
        $this->load->model('Cases_model');
        $this->Cases_model->del();
    }
    /**
     * 执行添加编辑
     */
    public function exeAdd () {
    	$data['case_title'] = $this->input->post('title');
    	$data['case_des'] = $this->input->post('desc');
    	$data['case_content'] = htmlspecialchars($this->input->post('content'));
    	$data['case_adddate'] = date("Y-m-d h:i:s");
    	$config['upload_path'] = './upload/cases/';
    	$config['allowed_types'] = 'gif|jpg|png';
    	//$config['max_size']  = '100';
    	// $config['max_width']  = '1024';
    	// $config['max_height']  = '768';
    	
    	$this->load->library('upload', $config);
    	
    	if ( ! $this->upload->do_upload('img')){
    		$error = array('error' => $this->upload->display_errors());
    		echo $error['error'];
    		die();
    	}
    	else{
    		$imgdata = $this->upload->data();
    		$data['case_img'] = base_url().'upload/cases/'.$imgdata['file_name'];
    	}
        $id = $this->input->post_get('id');
        if ($id){
            $rs1 = $this->db->update('cases', $data, array('case_id'=>$id));
            if ($rs1!==false){
                $rs = true;
            }else{
                $rs = false;
            }
        }else{
            $rs = $this->db->insert('cases', $data);
        }
    	if ($rs){
    		$this->load->view('admin/template/jump', array('jType'=>1, 'to'=>site_url('admin/home/caseList')));
    	}else{
    		$this->load->view('admin/template/jump', array('jType'=>2, 'to'=>site_url('admin/home/caseEdit')));
    	}
    }

    /**
     * 案例列表
     */
    public function caseList () {
    	$per_page = 10;
    	$this->load->model('Cases_model');
    	$rs = $this->Cases_model->queryCaseList($per_page);
    	$this->load->library('pagination');
    	
    	$config['base_url'] = site_url('admin/Home/caseList');
    	$config['total_rows'] = $rs['total'];
    	$config['per_page'] = $per_page;
    	$config['first_link'] = false;
    	// $config['first_tag_open'] = '<div>';
    	// $config['first_tag_close'] = '</div>';
    	$config['last_link'] = false;
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
    	$data['data'] = $rs['data'];
    	$info['total_page'] = $this->pagination->get_total_page();
    	$info['total'] = $rs['total'];
    	$info['per_page'] = $per_page;
    	$data['info'] = $info;
    	$this->page->loadAdmin('case_list', array(
    		'head_param' => array('title'=>'案例列表',
    			'css' => array()
    			),
    		'top_param' => array('flag1'=>'case','flag2'=>'caselist'),
    		'param' => $data
    		)
    	);
    }

    /**
     * 新闻资讯相关
     */
    public function newsList () {
    	$per_page = 10;
    	$this->load->model('News_model');
    	$rs = $this->News_model->queryNewsList($per_page);
    	$this->load->library('pagination');
    	
    	$config['base_url'] = site_url('admin/Home/newsList');
    	$config['total_rows'] = $rs['total'];
    	$config['per_page'] = $per_page;
    	$config['first_link'] = false;
    	// $config['first_tag_open'] = '<div>';
    	// $config['first_tag_close'] = '</div>';
    	$config['last_link'] = false;
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
    	$data['data'] = $rs['data'];
    	$info['total_page'] = $this->pagination->get_total_page();
    	$info['total'] = $rs['total'];
    	$info['per_page'] = $per_page;
    	$data['info'] = $info;
    	$this->page->loadAdmin('news/news_list', array(
    		'head_param' => array('title'=>'新闻资讯列表',
    			'css' => array()
    			),
    		'top_param' => array('flag1'=>'news','flag2'=>'newslist'),
    		'param' => $data
    		)
    	);
    }

    /**
     * 新闻添加编辑
     */
    public function newsAdd () {
    	$id = $this->input->post_get('id');
    	$data = array();
    	$this->load->model('News_model');
    	$data['type'] = $this->News_model->getType();
    	if ($id!=='') {
    		$title = '编辑';
    		$data['data'] = $this->News_model->getNewsDetail($id);
    		
    	}else{
    		$title = '添加';
    	}
    	$this->page->loadAdmin('news/add', array(
    		'head_param' => array('title'=>'新闻资讯'.$title,
    			'css' => array()
    			),
    		'top_param' => array('flag1'=>'news','flag2'=>'newsadd'),
    		'param' => $data
    		)
    	);
    }
    /**
     * 添加
     */
    public function exeNewsAdd () {
    	$id = $this->input->post_get('id');
    	$data['news_title'] = $this->input->post('title');
    	$data['news_content'] = htmlspecialchars( $this->input->post('content') );
    	$data['news_type'] = $this->input->post('type');
    	$this->checkEmpty($data);
    	$data['news_addtime'] = date('Y-m-d h:i:s');
    	$data['news_adddate'] = date('Y-m-d');
    	$data['news_author'] = 'admin';
    	$content = strip_tags(htmlspecialchars_decode($data['news_content']));
		$content = substr($content, 0, 290);
		$data['news_head'] = $content;
    	$this->load->model('News_model');
    	if ($id!='') {
    		$rs = $this->News_model->update($data, $id);
    		if ($rs!==false) {
    			$rd['code'] = 1;
    		}else{
    			$rd['code'] = -2;
    			$rd['errmsg'] = '编辑失败';
    		}
    	}else{
    		if ($this->News_model->insert($data)) {
    			$rd['code'] = 1;
    		}else{
    			$rd['code'] = -1;
    			$rd['errmsg'] = '插入数据失败';
    		}
    	}
    	header("Content-Type:text/json");
    	echo json_encode($rd);
    }
    /**
     * 删除新闻
     */
    public function newsDel () {
        $this->load->model('News_model');
        $id = $this->input->post_get('id');
        $rs = $this->News_model->delete($id);
        if ($rs!==false){
            $rd['code'] = 1;
        }else{
            $rd['code'] = -2;
            $rd['errmsg'] = '网络错误';
        }
        header("Content-Type:text/json");
        echo json_encode($rd);
    }

    /**
     * 需求列表
     */
    public function needList () {
    	$per_page = 10;
    	$this->load->model('Need_model');
    	$rs = $this->Need_model->queryByPage($per_page);
    	$this->load->library('pagination');
    	
    	$config['base_url'] = site_url('admin/Home/needList');
    	$config['total_rows'] = $rs['total'];
    	$config['per_page'] = $per_page;
    	$config['first_link'] = false;
    	// $config['first_tag_open'] = '<div>';
    	// $config['first_tag_close'] = '</div>';
    	$config['last_link'] = false;
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
    	$data['data'] = $rs['data'];
    	$info['total_page'] = $this->pagination->get_total_page();
    	$info['total'] = $rs['total'];
    	$info['per_page'] = $per_page;
    	$data['info'] = $info;
    	$this->page->loadAdmin('need_list', array(
    		'head_param' => array('title'=>'需求列表',
    			'css' => array()
    			),
    		'top_param' => array('flag1'=>'need','flag2'=>'needlist'),
    		'param' => $data
    		)
    	);
    }

    /**
     * 
     */
}

?>