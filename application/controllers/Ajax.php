<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		header("Content-Type:text/json");
	}

	public function index()
	{
		//
	}

	/**
	 * 添加option字段
	 * @param Int $opt_type 字段类型
	 * @param String $opt_name 字段标题
	 */
	public function optAdd () {
		$id = intval($this->input->post_get('id'));
		$this->load->model('Option_model');
		if ($id!=''){
			$data['opt_name'] = $this->input->post_get('opt_name');
			$rs = $this->Option_model->update($data, $id);
			if ( false!==$rs ){
				$rd['code'] = 1;
			}else{
				$rd['code'] = -1;
				$rd['errmsg'] = '编辑失败';
			}
		}else{
			$data['opt_type'] = intval($this->input->post_get('opt_type'));
			$data['opt_name'] = $this->input->post_get('opt_name');
			$data['addtime'] = date("Y-m-d H:i:s");
			if ( $this->Option_model->insert($data) ){
				$rd['code'] = 1;
			}else{
				$rd['code'] = -1;
				$rd['errmsg'] = '添加失败';
			}
		}
		echo json_encode($rd);
	}

	public function exeCustomerAdd (){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		
		$data['c_name'] = $this->input->post('c_name');
		$data['c_mobile'] = $this->input->post('c_mobile');
		$data['c_hj'] = $this->input->post('c_hj');
		$data['c_sfz'] = $this->input->post('c_sfz');

		$data['car_type'] = $this->input->post('car_type');
		$data['car_pl'] = $this->input->post('car_pl');
		$data['fp_price'] = $this->input->post('fp_price');
		$data['buy_type'] = $this->input->post('buy_type');
		$data['sales'] = $this->input->post('sales');
		$data['sales_mobile'] = $this->input->post('sales_mobile');
		$data['willing_register_area'] = $this->input->post('willing_register_area');

		$data['banking_id'] = $this->input->post('banking_id');
		$data['banking_id2'] = $this->input->post('banking_id2');
		$data['banking_road'] = $this->input->post('banking_road');
		$data['banking_road2'] = $this->input->post('banking_road2');
		$data['banking_pass'] = $this->input->post('banking_pass');
		$data['banking_pass2'] = $this->input->post('banking_pass2');
		$data['is_second_yxd'] = $this->input->post('is_second_yxd');
		$data['fp_money'] = $this->input->post('fp_money');
		$data['xpcl_date'] = $this->input->post('xpcl_date');
		$data['docking_person'] = $this->input->post('docking_person');
		$data['docking_area'] = $this->input->post('docking_area');
		$data['czyf'] = $this->input->post('czyf');
		$data['is_dy_finished'] = $this->input->post('is_dy_finished');
		$data['sp_date'] = $this->input->post('sp_date');
		// $data['contract_price'] = $this->input->post('contract_price');

		// $data['car_type'] = $this->input->post('car_type');
		
		// $data['dealer'] = $this->input->post('dealer');
		
		

		// $data['car_color'] = $this->input->post('car_color');
		// $data['car_brand_id'] = $this->input->post('car_brand_id');

		$this->load->model('Customer_model');
        if ($id==''){
        	$data['addtime'] = date("Y-m-d H:i:s");
        	$rs = $this->Customer_model->insert($data);
        	if ($rs){
        		$rd['code'] = 2;
        		$rd['insert_id'] = $rs;
        		$this->load->model('log_model');
        		$this->log_model->writeLog($rs, '创建申请');
        	}else{
        		$rd['code'] = -1;
        		$rd['errmsg'] = '网络错误，请稍后再试';
        	}
        }else{
        	$rs = $this->Customer_model->update($data, array('order_id'=>$id));
        	if ( false !== $rs ) {
        		$rd['code'] = 1;
        		$rd['msg'] = '修改成功';
        		$this->load->model('log_model');
        		$this->log_model->writeLog($rs, '进行修改');
        	}else{
        		$rd['code'] = -1;
        		$rd['errmsg'] = '修改失败!';
        	}
        }
        //header("Content-Type:text/json");
        echo json_encode($rd);
	}

	/**
	 * 提交申请 改state为2
	 * @param  Int $id 订单id
	 * @version V1.0
	 * @return Json json数组
	 */
	public function applyToReview () {
		$id = intval($this->input->get_post('id'));
		$this->load->model('Customer_model');
		$rs = $this->Customer_model->update(array('state'=>2), $id);
		if (false!==$rs){
			$rd['code'] = 1;
			$this->load->model('log_model');
            $this->log_model->writeLog($id, '提交申请');
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '提交失败,请稍后再试';
		}
		echo json_encode($rd);
	}

	/**
	 * 申请不通过 退回修改 改state为3
	 * @param  Int $id 订单id
	 * @version V1.0
	 * @return Json json数组
	 */
	public function toReturnList () {
		$id = intval($this->input->get_post('id'));
		$this->load->model('Customer_model');
		$rs = $this->Customer_model->update(array('state'=>3), $id);
		if (false!==$rs){
			$rd['code'] = 1;
			$this->load->model('log_model');
            $this->log_model->writeLog($id, '退回修改', '审核不通过退回修改');
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '提交失败,请稍后再试';
		}
		echo json_encode($rd);
	}

	/**
	 * 申请不通过 直接拒绝 改state为4
	 * @param  Int $id 订单id
	 * @version V1.0
	 * @return Json json数组
	 */
	public function reject () {
		$id = intval($this->input->get_post('id'));
		$this->load->model('Customer_model');
		$rs = $this->Customer_model->update(array('state'=>4), $id);
		if (false!==$rs){
			$rd['code'] = 1;
			$this->load->model('log_model');
            $this->log_model->writeLog($id, '拒绝申请');
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '提交失败,请稍后再试';
		}
		echo json_encode($rd);
	}

	/**
	 * 申请通过  改state为5 到已通过等待首付
	 * @param  Int $id 订单id
	 * @version V1.0
	 * @return Json json数组
	 */
	public function pass () {
		$id = intval($this->input->get_post('id'));
		$this->load->model('Customer_model');
		$rs = $this->Customer_model->update(array('state'=>5), $id);
		if (false!==$rs){
			$rd['code'] = 1;
			$this->load->model('log_model');
            $this->log_model->writeLog($id, '审核通过');
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '提交失败,请稍后再试';
		}
		echo json_encode($rd);
	}

	/**
	 * 申请通过  改state为6 
	 * @param  Int $id 订单id
	 * @version V1.0
	 * @return Json json数组
	 */
	public function toFirstList () {
		$id = intval($this->input->get_post('id'));
		$this->load->model('Customer_model');
		$rs = $this->Customer_model->update(array('state'=>6), $id);
		if (false!==$rs){
			$rd['code'] = 1;
			$this->load->model('log_model');
            $this->log_model->writeLog($id, '已经首付');
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '提交失败,请稍后再试';
		}
		echo json_encode($rd);
	}

	/**
	 *  
	 * @param  Int $id 订单id
	 * @version V1.0
	 * @return Json json数组
	 */
	public function reqPay () {
		$id = intval($this->input->get_post('id'));
		$this->load->model('Customer_model');
		$rs = $this->Customer_model->update(array('state'=>7), $id);
		if (false!==$rs){
			$rd['code'] = 1;
			$this->load->model('log_model');
            $this->log_model->writeLog($id, '进入请款中');
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '提交失败,请稍后再试';
		}
		echo json_encode($rd);
	}

	/**
	 *  
	 * @param  Int $id 订单id
	 * @version V1.0
	 * @return Json json数组
	 */
	public function payed () {
		$id = intval($this->input->get_post('id'));
		$this->load->model('Customer_model');
		$rs = $this->Customer_model->update(array('state'=>8), $id);
		if (false!==$rs){
			$rd['code'] = 1;
			$this->load->model('log_model');
            $this->log_model->writeLog($id, '已经请款');
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '提交失败,请稍后再试';
		}
		echo json_encode($rd);
	}

	/**
	 * 异步获取客户数据源
	 */
	public function orderData () {
		$this->load->model('Customer_model');
		$this->Customer_model->ajaxQueryByPage();

		//查询数据
	}

	/**
	 * 添加角色
	 */
	public function roleAdd () {
		$id = $this->input->post_get('id');
		
		$this->load->model('role_model');
		$this->load->model('user_model');
		if ($id!=''){
			$rs = $this->role_model->updatePermiss($id);
			echo json_encode($rs);
		}else{
			$rs = $this->role_model->creatRole();
			echo json_encode($rs);
		}
		
	}

	/**
	 * 添加管理员
	 * 
	 */
	public function userAdd () {
		$id = $this->input->get_post('id');
		if ($id!=''){
			$data['user_name'] = $this->input->post('user_name');
			$data['user_nick'] = $this->input->post('user_nick');
			$data['user_mobile'] = $this->input->post('user_mobile');
			$data['sex'] = $this->input->post('sex');
			$data['role_id'] = $this->input->post('role_id');
			$data['user_des'] = $this->input->post('user_des');
			$this->load->model('user_model');
			$rs = $this->user_model->update($data, $id);
			if (false !== $rs){
				$rd['code'] = 1;
			}else{
				$rd['code'] = -1;
				$rd['errmsg'] = '修改失败';
			}
		}else{
			$data['user_name'] = $this->input->post('user_name');
			$data['user_nick'] = $this->input->post('user_nick');
			$data['user_mobile'] = $this->input->post('user_mobile');
			$data['user_pwd'] = md5($this->input->post('user_pwd'));
			$data['sex'] = $this->input->post('sex');
			$data['role_id'] = $this->input->post('role_id');
			$data['user_des'] = $this->input->post('user_des');
			$data['addtime'] = date("Y-m-d H:i:s");
			$this->load->model('user_model');
			$rs = $this->user_model->insert($data);
			if ($rs){
				$rd['code'] = 1;
			}else{
				$rd['code'] = -1;
				$rd['errmsg'] = '添加失败';
			}
		}
		echo json_encode($rd);
	}

	//删除管理员
	public function roleDel () {
		$id = intval($this->input->post_get('id'));
		$this->load->model('role_model');
		$rd = $this->role_model->roleDel($id);
		
		echo json_encode($rd);
	}

	//删除管理员
	public function userDel () {
		$id = intval($this->input->post_get('id'));
		$this->load->model('user_model');
		$rs = $this->user_model->delete($id);
		if ($rs){
			$rd['code'] = 1;
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '删除失败!';
		}
		echo json_encode($rd);
	}

	//停用管理员
	public function userStop () {
		$id = intval($this->input->post_get('id'));
		$this->load->model('user_model');
		$rs = $this->user_model->update( array('state'=>2), $id);
		if ( false !== $rs){
			$rd['code'] = 1;
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '删除失败!';
		}
		echo json_encode($rd);
	}

	//启用管理员
	public function userStart () {
		$id = intval($this->input->post_get('id'));
		$this->load->model('user_model');
		$rs = $this->user_model->update( array('state'=>1), $id);
		if (false !== $rs){
			$rd['code'] = 1;
		}else{
			$rd['code'] = -1;
			$rd['errmsg'] = '删除失败!';
		}
		echo json_encode($rd);
	}

}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */