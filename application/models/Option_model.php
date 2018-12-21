<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Option_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'options';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'opt_id';

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
        $result = $this->db->get()->result_array();
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
     * 获取opt map
     * @param Int $opt_type 字段类型
     * @return Array 
     */
    public function getOptMap ( $opt_type ) {
    	$rs = $this->db->get_where('opt_map', array('om_id'=>$opt_type))->row_array();
    	return $rs;
    }

    /**
     * 获取所有的field option
     * 
     */
    public function getFields () {
        $sql = "select * from options order by opt_type asc,opt_id desc";
        $rs = $this->db->query($sql)->result_array();
        $rd = array();
        $opt_type_len = $rs[count($rs)-1]['opt_type'];
        for ( $i = 1; $i <= $opt_type_len; $i++ ) {
            foreach ( $rs as $k=>$v ){
                if ($v['opt_type']==$i){
                    $rd[$i][$k] = $v;
                }
            }
        }
        return $rd;
    }

    /**
     * 分页查询
     * @package Lonoa
     * @param int $per_page 每页显示条数
     * @param int $opt_type 类型
     * @author yzk <2273716951@qq.com>
     * @version 1.0 
     */
    public function queryByPage ($per_page = 10, $opt_type) {
        $onset = $this->uri->segment(3)!=''?$this->uri->segment(3):0;
        $sql = "select * from options where opt_type=?";
        $startDate = $this->input->get_post('startDate');
        $endDate = $this->input->get_post('endDate');
        $opt_name = $this->input->get_post('opt_name');
        $where = array($opt_type);
        if ($startDate!='') {
            array_push($where, $startDate);
            $sql .= " and addtime>=?";
        }
        if ($endDate!='') {
            array_push($where, $endDate);
            $sql .= " and addtime<=?";
        }
        if ($opt_name!='') {
            array_push($where, $opt_name);
            $sql .= " and opt_name like ?";
        }
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql, $where)->row_array();
        $sql .= " order by ".self::PRI_INDEX." desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql, $where)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

}
