<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cases_model extends CI_Model {
    public function __construct(){
    	parent::__construct();
    }

    /**
     * 获取案例
     */
    public function getDetailById () {
    	$id = $this->input->post_get('id');
    	$rs = $this->db->get_where('cases', array('case_id'=>$id))->row_array();
    	$rs['case_content'] = htmlspecialchars_decode($rs['case_content']);
    	return $rs;
    }

    /**
     * 分页查询
     */
    public function queryCasePage ($per_page=10) {
    	$onset = $this->uri->segment(4)!=''?$this->uri->segment(4):0;
    	$sql = "select * from cases";
    	$totalSql = "select count(*) as total from(".$sql.") as a";
    	$total = $this->db->query($totalSql)->row_array();
    	$sql .= " order by case_id desc limit {$onset}, {$per_page}";
    	$rs = $this->db->query($sql)->result_array();
    	$rd['total'] = $total['total'];
    	$rd['data'] = $rs;
    	return $rd;
    }

    /**
     * 
     */
    public function del () {
        header("Content-Type:text/json");
        $id = $this->input->post_get('id');
        $rs = $this->db->delete('cases', array('case_id'=>$id));
        if ($rs!==false){
            $rd['code'] = 1;
        }else{
            $rd['code'] = -2;
            $rd['errmsg'] = '网络错误';
        }
        echo json_encode($rd);
    }

    /**
     * 获取首页的案例
     */
    public function getHomeCase(){
        $sql = "select case_id,case_title,case_img,case_des from cases order by case_id desc limit 6";
        $rs = $this->db->query($sql)->result_array();
        return $rs;
    }

    /***************
     *  后台
     ********/
    /**
     * 分页查询
     */
    public function queryCaseList ($per_page=10) {
        $onset = $this->uri->segment(5)!=''?$this->uri->segment(5):0;
        $sql = "select * from cases";
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql)->row_array();
        $sql .= " order by case_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }
}

?>