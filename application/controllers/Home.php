<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->isLogin();
    }

    function test () {

// 创建一个cURL资源
$ch = curl_init();

// 设置URL和相应的选项
curl_setopt($ch, CURLOPT_URL, "https://zoom.us/j/6563085781");
curl_setopt($ch, CURLOPT_HEADER, 0);

// 抓取URL并把它传递给浏览器
curl_exec($ch);

// 关闭cURL资源，并且释放系统资源
curl_close($ch);
    }

    function index() {
        // $this->session->USER = array(
        //     'uid' => 1
        //     );
        $this->home();
    }

    /**
     * 首页
     */
    public function home () {
        $this->load->model('home_model');
        $data['opt_map'] = $this->home_model->get_opt_map();
        $this->page->page('home', array(
            'head_params' => '',
            'header_params' => array(
                'css' => array(''),
                'js' => array('')
                ),
            'params' => $data,
            'foot_params' => '',
            'footer_params' => ''
            )
        );
    }

    /**
     * 首页
     */
    public function welcome () {
        $this->page->tempPage('welcome', array(
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
     * 查看单个详细 ckxx
     */
    public function detailView () {
        $id = $this->input->get_post('id');
        $this->load->model('customer_model');
        $this->load->model('log_model');
        $this->load->model('option_model');
        $this->load->model('home_model');
        $data['data'] = $this->customer_model->getDetailAll($id);
        $data['opts'] = $this->option_model->getFields();
        $data['logs'] = $this->log_model->getLogsById($id);
        $data['status_map'] = $this->home_model->get_status_map();
        $this->page->tempPage('order-detail', array(
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
     * 创建为提交列表 权限识别码：cjwtj
     */
    public function subForReview () {
        $per_page = 10;
        $this->load->model('customer_model');
        $rs = $this->customer_model->querySubForReviewList($per_page);
        $this->load->library('pagination');

        $config['base_url'] = site_url('Home/'.__FUNCTION__);
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

        $this->page->tempPage('subForReview-list', array(
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
     * 退回待修改 权限识别码：thdxg
     */
    public function returnToAlter () {
        $per_page = 10;
        $this->load->model('customer_model');
        $rs = $this->customer_model->querySubForReviewList($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('Home/'.__FUNCTION__);
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

        $this->page->tempPage('subForReview-list', array(
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
     * 审核中 权限识别码：shz
     */
    public function reviewingList () {
        $per_page = 10;
        $this->load->model('customer_model');
        $rs = $this->customer_model->queryReviewingList($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('Home/'.__FUNCTION__);
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

        $this->page->tempPage('reviewing-list', array(
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
     * 退回待修改 权限识别码：thxg
     */
    public function returnList () {
        $per_page = 10;
        $this->load->model('customer_model');
        $rs = $this->customer_model->queryReturnList($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('Home/'.__FUNCTION__);
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

        $this->page->tempPage('return-list', array(
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
     * 拒绝申请 权限识别码：jjsq
     */
    public function rejectList () {
        $per_page = 10;
        $this->load->model('customer_model');
        $rs = $this->customer_model->queryRejectList($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('Home/'.__FUNCTION__);
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

        $this->page->tempPage('order/reject-list', array(
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
     * 通过申请待请款 权限识别码：tgdqk
     */
    public function passList () {
        $per_page = 10;
        $this->load->model('customer_model');
        $func = 'query'.ucfirst(__FUNCTION__);
        $rs = $this->customer_model->$func($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('Home/'.__FUNCTION__);
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

        $this->page->tempPage('pass-list', array(
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
    public function displayPage ( $act, $state, $config = array()) {
        $per_page = 10;
        $this->load->model('customer_model');
        $func = 'query'.ucfirst($act);
        $rs = $this->customer_model->queryByPage($per_page, $state);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('Home/'.$act);
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

        $this->page->tempPage('order/'.str_replace('List', '-list', $act).'.php', array(
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

    public function cancelList () {
        $this->displayPage(__FUNCTION__, 4);
    }

    public function firstList () {
        $this->displayPage(__FUNCTION__, 6);
    }

    public function reqPayList () {
        $this->displayPage(__FUNCTION__, 7);
    }

    public function payedList () {
        $this->displayPage(__FUNCTION__, 8);
    }

    /**
     * 添加(录入)客户界面
     * 权限识别码：tjkh
     */
    public function CustomerAdd () {
        $id = intval($this->input->post_get('id'));
        if ($id != '') {
            $this->load->model('customer_model');
            $data['data'] = (array)$this->customer_model->get($id);
            $data['title'] = '编辑申请单';
        }else{
            $data['title'] = '创建申请单';
        }
        $this->load->model('option_model');
        $data['opts'] = $this->option_model->getFields();
        $this->page->tempPage('order/order-add', array(
            'head_params' => '',
            'header_params' => array(
                'css' => array(''),
                'js' => array('')
                ),
            'params' => $data,
            'foot_params' => '',
            'footer_params' => ''
            ));

    }

    public function exeCustomerAdd () {
        
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