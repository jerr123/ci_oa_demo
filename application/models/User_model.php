<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'user';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'uid';

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

    /**
     * 分页查询角色
     */
    public function queryRoleList ($per_page = 10) {
    	$onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
    	$sql = "select * from role";
    	$totalSql = "select count(*) as total from(".$sql.") as a";
    	$total = $this->db->query($totalSql)->row_array();
    	$sql .= " order by role_id asc";
    	$rs = $this->db->query($sql)->result_array();
    	//查询属于他的员工
    	$user = array();
    	foreach ($rs as $k=>$v){
    		$user = $this->db->get_where('user', array('role_id'=>$v['role_id']))->result_array();
    		$rs[$k]['user'] = $user;
    	}
    	
    	$rd['total'] = $total['total'];
    	$rd['data'] = $rs;
    	return $rd;
    }

    public function getRolePermission ($id) {
    	$rs = $this->db->get_where('role_node_map', array('role_id'=>$id, 'is_has'=>1))->result_array();
    	$rd = array();
    	foreach ($rs as $k=>$v){
    		array_push($rd, $v['node_id']);
    	}
    	return $rd;
    }

    public function getPermission () {
    	$p1 = $this->db->get_where('node', array('parent_id'=>0))->result_array();
    	foreach ($p1 as $k=>$v){
    		//查询对应的二级权限
    		$p2 = $this->db->get_where('node', array('parent_id'=>$v['node_id']))->result_array();
    		$p1[$k]['next'] = $p2;
    		foreach ($p2 as $p2k=>$p2v){
    			$p3 = $this->db->get_where('node', array('parent_id'=>$p2v['node_id']))->result_array();
    			$p1[$k]['next'][$p2k]['next'] = $p3;
    		}
    	}
    	//var_dump($p1[1]['next'][1]);
    	return $p1;
    	
    }

    /**
     * 分页查询员工
     */
    public function queryUserList ($per_page = 10) {
    	$onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
    	$sql = "select u.*,r.role_name from user u,role r where u.role_id=r.role_id";
    	$startDate = $this->input->get_post('startDate');
        $endDate = $this->input->get_post('endDate');
        $user_name = $this->input->get_post('user_name');
        $where = array();
        if ($startDate!='') {
            array_push($where, $startDate);
            $sql .= " and u.addtime>=?";
        }
        if ($endDate!='') {
            array_push($where, $endDate);
            $sql .= " and u.addtime<=?";
        }
        if ($user_name!='') {
            array_push($where, '%'.$user_name.'%');
            $sql .= " and u.user_name like ?";
        }
    	$totalSql = "select count(*) as total from(".$sql.") as a";
    	$total = $this->db->query($totalSql,$where)->row_array();
    	$sql .= " order by u.uid asc";
    	$rs = $this->db->query($sql,$where)->result_array();
    	$rd['total'] = $total['total'];
    	$rd['data'] = $rs;
    	return $rd;
    }
}
