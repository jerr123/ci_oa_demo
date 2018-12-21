<?php 

class Page {
	/**
	 * [$CI CI]
	 * @var null
	 */
	private $CI = NULL;
	/**
	 * 构造函数
	 */
	public function __construct() {
		$this->CI =& get_instance();
	}

	/**
	 * 加载首页面
	 */
	public function page ( $_page = NULL, $_params = array() )  {
		if ($_page === NULL) {
			die('page can not be null');
		}
		$this->CI->load->view('templates/head', array_key_exists('head_params', $_params)?$_params['head_params'] : NULL , false);
		$this->CI->load->view('templates/header', array_key_exists('header_params', $_params)?$_params['header_params'] : NULL , false);
		$this->CI->load->view($_page, array_key_exists('params', $_params) ? $_params['params'] : NULL, false);
		$this->CI->load->view('templates/foot', array_key_exists('foot_params', $_params)?$_params['foot_params']:NULL, false);
		$this->CI->load->view('templates/footer', array_key_exists('footer_params', $_params)?$_params['footer_params']:NULL, false);
	}

	/**
	 * 加载首页面
	 */
	public function tempPage ( $_page = NULL, $_params = array() )  {
		if ($_page === NULL) {
			die('page can not be null');
		}
		$this->CI->load->view('templates/temp_head', array_key_exists('head_params', $_params)?$_params['head_params'] : NULL , false);
		//$this->CI->load->view('templates/header', array_key_exists('header_params', $_params)?$_params['header_params'] : NULL , false);
		$this->CI->load->view($_page, array_key_exists('params', $_params) ? $_params['params'] : NULL, false);
		//$this->CI->load->view('templates/foot', array_key_exists('foot_params', $_params)?$_params['foot_params']:NULL, false);
		$this->CI->load->view('templates/footer', array_key_exists('footer_params', $_params)?$_params['footer_params']:NULL, false);
	}

	/**
	 * 加载新闻页面
	 */
	public function getNewsPage ( $_page = NULL, $_params = array() ) {
		if ($_page === NULL) {
			die('page can not be null');
		}
		$this->CI->load->view('templates/header', array_key_exists('header_params', $_params)?$_params['header_params'] : NULL , false);
		$this->CI->load->view($_page, array_key_exists('params', $_params) ? $_params['params'] : NULL, false);
		$this->CI->load->view('news/right', array_key_exists('params', $_params) ? $_params['params'] : NULL, false);
		$this->CI->load->view('templates/footer', array_key_exists('footer_params', $_params)?$_params['footer_params']:NULL, false);
	}

	/**
	 * 加载后台主界面方法
	 */
	public function getAdminPage ( $_page = NULL, $_params = array() , $isTop=TRUE) {
		if ($_page==null) die('You don\'t fill the \'_page\' param.');
		$this->CI->load->view('admin/template/header',array_key_exists('header_param', $_params)?$_params['header_param']:NULL);
		if ($isTop){
			$this->CI->load->view('admin/template/top',$_params['top_param']);
		}
		$this->CI->load->view('admin/'.$_page, array_key_exists('param', $_params)?$_params['param']:NULL);
		if ($isTop){
			$this->CI->load->view('admin/template/buttom',array_key_exists('buttom_param', $_params)?$_params['buttom_param']:'');
		}
		$this->CI->load->view('admin/template/footer', array_key_exists('footer_param', $_params)?$_params['footer_param']:NULL);
	}

	/**
	 * 
	 */
	public function loadAdmin($_page = NULL, $_params = array()) {
		$this->CI->load->view('admin/template/header', array_key_exists('head_param', $_params)?$_params['head_param']:null, false);
		$this->CI->load->view('admin/template/top', array_key_exists('top_param', $_params)?$_params['top_param']:NULL, FALSE);
		$this->CI->load->view('admin/'.$_page, array_key_exists('param', $_params)?$_params['param']:NULL);
		$this->CI->load->view('admin/template/buttom',array_key_exists('buttom_param', $_params)?$_params['buttom_param']:'');
		$this->CI->load->view('admin/template/footer', array_key_exists('footer_param', $_params)?$_params['footer_param']:NULL);
	}

	/**
	 * 加载公共的头部
	 * @param  boolean $is_return [description]
	 * @return [type]             [description]
	 */
	public function common_head($is_return=false){
		$this->CI->load->view('templates/temp_head', $params, false);
	}

	/**
	 * 加载公共的底部，js脚本部分
	 */
	public function common_foot($_params = NULL, $is_return = false){
		$this->CI->load->view('templates/common_foot', $params, false);
	}
}
?>