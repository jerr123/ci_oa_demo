<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'log';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'log_id';

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
        if ( is_array($where) ) {
            $result = $this->db->get()->result_array();
        }else{
            $result = $this->db->get()->row_array();
        }
        
        if ($result) {
            if ( isset($result[1]) ) {
                return $result[0];
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
        if (!is_array()) {
            $where = array(self::PRI_INDEX => $where);
        }
        $this->db->delete(self::TABLE_NAME, $where);
        return $this->db->affected_rows();
    }

    /**
     * 所有操作记录都调用该方法
     * @param int $id order_id
     * @param String $act 进行的操作
     * @param String $des 描述
     * @param String $rem 备注remark 操作员输入的文字
     */
    public function writeLog ($id = NULL, $act, $des = '', $rem = '') {
    	if ($id===NULL){
    		$id = $this->input->get_post('id');
    	}
    	$user = $this->session->USER;
    	$data = array(
    		'uid' => $user['uid'],
    		'order_id' => $id,
    		'addtime' => date("Y-m-d H:i:s"),
    		'act' => $act,
    		'des' => $des,
    		'rem' => $rem
    		);
    	return $this->insert($data);
    }

    /**
     * 取出对应order_id的log
     * 按照时间排序
     */
    public function getLogsById ($id) {
        $sql = "select l.*,u.user_name,u.user_nick from log as l, user as u where u.uid=l.uid and order_id=? order by log_id desc";
        $rs = $this->db->query($sql, $id)->result_array();
        return $rs;
    }
}
