<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->home();
    }

    /**
     * 首页
     */
    public function home () {
        $this->page->page('home', array(
            'head_params' => '',
            'header_params' => array(
                'css' => array(''),
                'js' => array('')
                ),
            'params' => '',
            'foot_params' => '',
            'footer_params' => ''
            )
        );
    }

    /**
     * 资讯
     */
    public function articleList () {
        $this->page->tempPage('article-list', array(
            'head_params' => '',
            'header_params' => array(
                'css' => array(''),
                'js' => array('')
                ),
            'params' => '',
            'foot_params' => '',
            'footer_params' => ''
            ));
    }

    /**
     * about us 关于我们
     */
    public function about () {
        $this->page->getPage('about/about_us', array(
            'params' => '',
            'header_params' => array(
                'css' => array('home'),
                'js' => array('custom'),
                'flag' => 'about'
                ),
            )
        );
    }
    /**
     * about us 关于我们
     */
    public function photo () {
        $this->page->getPage('about/photos', array(
            'params' => '',
            'header_params' => array(
                'css' => array('home'),
                'js' => array('custom'),
                'flag' => 'about'
                ),
            )
        );
    }

    /**
     * 服务
     */
    public function cases () {
        $this->load->model('Cases_model');
        $per_page = 12;
        $rs = $this->Cases_model->queryCasePage($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('Home/cases/page');
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
        $config['cur_tag_open'] = '<li class="thisclass"><a href="#"></a>';
        $config['cur_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $data['page'] =  $this->pagination->create_links();
        $data['data'] = $rs['data'];
        $info['total_page'] = $this->pagination->get_total_page();
        $info['total'] = $rs['total'];
        $info['per_page'] = $per_page;
        $info['case_type'] = $this->input->post_get('case_type');
        $data['info'] = $info;
        $this->page->getPage('case', array(
            'params' => $data,
            'header_params' => array(
                'css' => array('home'),
                'js' => array('custom'),
                'flag' => 'case'
                ),
            )
        );
    }

    /**
     * 案例详细
     */
    public function caseDetail () {
        $this->load->model('Cases_model');
        $data['data'] = $this->Cases_model->getDetailById();
         $this->page->getPage('case/detail', array(
            'params' => $data,
            'header_params' => array(
                'css' => array('home'),
                'js' => array('custom'),
                'flag' => 'case'
                ),
            )
        );
    }

    /**
     * 服务
     */
    public function service () {
        $this->page->getPage('services', array(
            'params' => '',
            'header_params' => array(
                'css' => array('home','services'),
                'js' => array('custom','services'),
                'flag' => 'service'
                ),
            )
        );
    }

    /**
     * 新闻
     */
    public function news () {
        $per_page = 6;
        $this->load->model('News_model');
        $rs = $this->News_model->queryNewsPage($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('Home/news/page');
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
        $config['cur_tag_open'] = '<li class="thisclass"><a href="#"></a>';
        $config['cur_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $data['page'] =  $this->pagination->create_links();
        $data['data'] = $rs['data'];
        $info['total_page'] = $this->pagination->get_total_page();
        $info['total'] = $rs['total'];
        $info['per_page'] = $per_page;
        $info['type_id'] = $this->input->post_get('type_id');
        $data['info'] = $info;
        $data['newest_artical'] = $this->News_model->getNewestArtical();
        $data['type'] = $this->News_model->getType();
        $this->page->getNewsPage('news/news', array(
            'params' => $data,
            'header_params' => array(
                'css' => array('home','news'),
                'js' => array('custom','news'),
                'flag' => 'news'
                ),
            )
        );
    }

    public function details () {
        $id = $this->input->post_get('id');
        $this->load->model('News_model');
        $data['data'] = $this->News_model->getNewsDetail($id);
        $info['type_id'] = $data['data']['news_type'];
        $data['info'] = $info;
        $data['newest_artical'] = $this->News_model->getNewestArtical();
        $data['type'] = $this->News_model->getType();
        $this->page->getNewsPage('news/details', array(
            'params' => $data,
            'header_params' => array(
                'css' => array('home','news'),
                'js' => array('custom','news'),
                'flag' => 'news'
                ),
            )
        );
    }

    /**
     *  联系我们/提交需求
     */
    public function linkUs () {
        $this->page->getPage('about/link_us', array(
            'params' => '',
            'header_params' => array(
                'css' => array('home','link_us'),
                'js' => array('custom',),
                'flag' => 'linkus'
                ),
            'footer_params' => array(
                'layui'=>1,
                'js' => array('link_us')
                )
            )
        );
    }
    /**
     * 接收提交需求
     */
    public function acceptNeed () {
        $data['name'] = $this->input->post('name');
        $data['tel'] = $this->input->post('tel');
        $data['email'] = $this->input->post('email');
        $data['qq'] = $this->input->post('qq');
        $data['content'] = $this->input->post('content');
        $data['add_time'] = date("Y-m-d h:i:s");
        $this->load->model('Need_model');
        if ($this->Need_model->insert($data)) {
            $rd['code'] = 1;
        }else{
            $rd['code'] = -1;
            $rd['errmsg'] = '网络错误';
        }
        header("Content-Type:text/json");
        echo json_encode($rd);
    }
}

?>