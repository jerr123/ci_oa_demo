<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'orders';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'order_id';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */
    public function get($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::TABLE_NAME);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where(self::PRI_INDEX, $where);
            }
        }
        $result = $this->db->get()->result();
        if ($result) {
            if ($where !== NULL) {
                return array_shift($result);
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Inserts new data into database
     *
     * @param Array $data Associative array with field_name=>value pattern to be inserted into database
     * @return mixed Inserted row ID, or false if error occured
     */
    public function insert(Array $data) {
        if ($this->db->insert(self::TABLE_NAME, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * Updates selected record in the database
     *
     * @param Array $data Associative array field_name=>value to be updated
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of affected rows by the update query
     */
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }

    /**
     * Deletes specified record from the database
     *
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of rows affected by the delete query
     */
    public function delete($where = array()) {
        if (!is_array($where)) {
            $where = array(self::PRI_INDEX => $where);
        }
        $this->db->delete(self::TABLE_NAME, $where);
        return $this->db->affected_rows();
    }

    public function getDetailAll ($id) {
        //$sql = "select o.*,opt1.opt_name as banking_name,opt2.opt_name as car_brand_name from orders o,options opt1, options opt2 where opt1.opt_id=o.banking_id and opt2.opt_id=o.car_brand_id and o.order_id=?";
        $sql = "select * from orders where order_id=?";
        return $this->db->query($sql, array($id))->row_array();
    }

    /**
     * 分页查询 创建待提交的 state=1 默认
     * @param int $per_page 每页显示条数
     * @author yzk <2273716951@qq.com>
     * @version 1.0 
     */
    public function querySubForReviewList ($per_page = 10) {
        $onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
        $sql = "select * from orders where state=1";
        $startDate = $this->input->get_post('startDate');
        $endDate = $this->input->get_post('endDate');
        $c_name = $this->input->get_post('c_name');
        $where = array();
        if ($startDate!='') {
            array_push($where, $startDate);
            $sql .= " and addtime>=?";
        }
        if ($endDate!='') {
            array_push($where, $endDate);
            $sql .= " and addtime<=?";
        }
        if ($c_name!='') {
            array_push($where, $c_name);
            $sql .= " and c_name like ?";
        }
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql, $where)->row_array();
        $sql .= " order by order_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql, $where)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

    /**
     * 分页查询 审核中即是待审核 state=2 由创建后提交得到该状态
     * @param int $per_page 每页显示条数
     * @author yzk <2273716951@qq.com>
     * @version 1.0 
     */
    public function queryReviewingList ($per_page = 10) {
        $onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
        $sql = "select * from orders where state=2";
        $startDate = $this->input->get_post('startDate');
        $endDate = $this->input->get_post('endDate');
        $c_name = $this->input->get_post('c_name');
        $where = array();
        if ($startDate!='') {
            array_push($where, $startDate);
            $sql .= " and addtime>=?";
        }
        if ($endDate!='') {
            array_push($where, $endDate);
            $sql .= " and addtime<=?";
        }
        if ($c_name!='') {
            array_push($where, $c_name);
            $sql .= " and c_name like ?";
        }
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql, $where)->row_array();
        $sql .= " order by order_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql, $where)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

    /**
     * 分页查询 退回待修改
     * @param int $per_page 每页显示条数
     * @author yzk <2273716951@qq.com>
     * @version 1.0 
     */
    public function queryReturnList ($per_page = 10) {
        $onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
        $sql = "select * from orders where state=3";
        $startDate = $this->input->get_post('startDate');
        $endDate = $this->input->get_post('endDate');
        $c_name = $this->input->get_post('c_name');
        $where = array();
        if ($startDate!='') {
            array_push($where, $startDate);
            $sql .= " and addtime>=?";
        }
        if ($endDate!='') {
            array_push($where, $endDate);
            $sql .= " and addtime<=?";
        }
        if ($c_name!='') {
            array_push($where, $c_name);
            $sql .= " and c_name like ?";
        }
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql, $where)->row_array();
        $sql .= " order by order_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql, $where)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

    /**
     * 分页查询 拒绝 state=4 
     * @param int $per_page 每页显示条数
     * @author yzk <2273716951@qq.com>
     * @version 1.0 
     */
    public function queryRejectList ($per_page = 10) {
        $onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
        $sql = "select * from orders where state=4";
        $startDate = $this->input->get_post('startDate');
        $endDate = $this->input->get_post('endDate');
        $c_name = $this->input->get_post('c_name');
        $where = array();
        if ($startDate!='') {
            array_push($where, $startDate);
            $sql .= " and addtime>=?";
        }
        if ($endDate!='') {
            array_push($where, $endDate);
            $sql .= " and addtime<=?";
        }
        if ($c_name!='') {
            array_push($where, $c_name);
            $sql .= " and c_name like ?";
        }
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql, $where)->row_array();
        $sql .= " order by order_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql, $where)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

    /**
     * 分页查询 通过待请款
     * @param int $per_page 每页显示条数
     * @author yzk <2273716951@qq.com>
     * @version 1.0 
     */
    public function queryPassList ($per_page = 10) {
        $onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
        $sql = "select * from orders where state=5";
        $startDate = $this->input->get_post('startDate');
        $endDate = $this->input->get_post('endDate');
        $c_name = $this->input->get_post('c_name');
        $where = array();
        if ($startDate!='') {
            array_push($where, $startDate);
            $sql .= " and addtime>=?";
        }
        if ($endDate!='') {
            array_push($where, $endDate);
            $sql .= " and addtime<=?";
        }
        if ($c_name!='') {
            array_push($where, $c_name);
            $sql .= " and c_name like ?";
        }
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql, $where)->row_array();
        $sql .= " order by order_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql, $where)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

    /**
     * 订单分页查询
     * @param int $per_page 每页显示条数
     * @param int $state 订单所处的状态 阶段
     * @author yzk <2273716951@qq.com>
     * @version 1.0 
     */
    public function queryByPage ($per_page = 10, $state) {
        $onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
        $sql = "select * from orders where state=?";
        $startDate = $this->input->get_post('startDate');
        $endDate = $this->input->get_post('endDate');
        $c_name = $this->input->get_post('c_name');
        $where = array($state);
        if ($startDate!='') {
            array_push($where, $startDate);
            $sql .= " and addtime>=?";
        }
        if ($endDate!='') {
            array_push($where, $endDate);
            $sql .= " and addtime<=?";
        }
        if ($c_name!='') {
            array_push($where, $c_name);
            $sql .= " and c_name like ?";
        }
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql, $where)->row_array();
        $sql .= " order by order_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql, $where)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

    /**
     * 申请单数据统计
     */
    public function countOrder () {
        $sql = "select sum(if (state=1, 1, 0)) as 创建未提交,sum(if (state=2,1,0)) as 待审核,sum(if (state=3,1,0)) as 退回修改,sum(if (state=4,1,0)) as 拒绝,sum(if (state=5,1,0)) as 通过待首付,sum(if (state=6,1,0)) as 已经首付待请款,sum(if (state=7,1,0)) as 请款中,sum(if (state=8,1,0)) as 已经请款,sum(if (state=9,1,0)) as 已取消 from orders";
        $rs = $this->db->query($sql)->row_array();
        $rd = array();
        foreach ($rs as $k=>$v){
            array_push($rd, array($k,(int)$v));
        }
        return json_encode($rd);
    }

    /**
     * 申请单数据统计
     */
    public function countCompany () {
        $sql = "select opt.opt_name,sum(if (o.banking_id=opt.opt_id, 1, 0)) as num from orders as o,options as opt where opt.opt_id=o.banking_id and opt.opt_type=1 GROUP BY opt.opt_id";
        $rs = $this->db->query($sql)->result_array();
        $rd = array();
        foreach ($rs as $k=>$v){
            array_push($rd, array($v['opt_name'],(int)$v['num']));
        }
        return json_encode($rd);
    }

    /**
     * 异步数据 分页查询
     */
    public function ajaxQueryByPage () {
    	//获取datatable发送的数据
		$draw = $this->input->post('draw');
		//排序
		$order = $this->input->post('order');
		$order_column = $order[0]['column'];
		$order_dir = $order[0]['dir']; //升序或者降序
		//拼接排序sql
		$orderSql = "";
		if (isset($order_column)){
			$i = intval($order_column)-1;
			switch ($i){
				case 0 : $orderSql = " order by order_id ".$order_dir;break;
				case 1 : $orderSql = " order by add_time ".$order_dir;break;
				case 2 : $orderSql = " order by c_name ".$order_dir;break;
				case 4 : $orderSql = " order by c_mobile ".$order_dir;break;
				default : $orderSql = " ";
			}
		}
		//搜索
		$search = $this->input->post('search');
		$search = $search['value'];
		//分页
		$limitSql = "";
		$start = $this->input->post('start')!=''?$this->input->post('start'):0;
		$length = $this->input->post('length');
		//$limitFlag = $start
		$limitSql = " limit ".intval($start).", ".intval($length);

		//表的总记录数
		$tableTotal = $this->db->count_all('orders');

		//拼接条件查询
		$whereSql = " where c_name||c_mobile||sales||c_hj||buy_type||car_type like '%".$search."%'";
		$sourceSql = "select * from orders";
		//$totalSql = "select count(*) as total from(".") as a";
		if (strlen($search)>0){
			$sql = $sourceSql.$whereSql;
			$total = $this->db->query("select count(*) as total from(".$sql.") as a")->row_array();
			$rs = $this->db->query($sql.$orderSql.$limitSql)->result_array();
			$whereTotal = $total['total'];
		}else{
			$whereTotal = $tableTotal;
			$rs = $this->db->query($sourceSql.$orderSql.$limitSql)->result_array();
		}
		$infos = array();
		foreach ($rs as $k=>$v){
			$obj = array('<input type="checkbox" name="" value="">',$v['order_id'],$v['add_time'],$v['c_name'],$v['c_mobile'],$v['sales'],$v['car_type'],$v['car_pl'],$v['car_config_id'],$v['contract_price'],$v['lending_time'],$v['shop_id'],$v['buy_type'],$v['willing_register_area'],$v['addtime']);
			array_push($infos,$obj);
		}
		$rd = array(
			"draw" => $draw,
			"recordsTotal" => $tableTotal,
			"recordsFiltered" => $whereTotal,
			"data" => $infos
			);
		echo json_encode($rd);
    }
}
