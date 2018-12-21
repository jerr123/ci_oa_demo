<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'role';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'role_id';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */
    public function get($where = NULL, $select = "*") {
        $this->db->select($select);
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

    public function creatRole () {
        $id = $this->input->post_get('id');
        $data['role_name'] = $this->input->post_get('role_name');
        $data['role_des'] = $this->input->post_get('role_des');
        $data['addtime'] = date("Y-m-d H:i:s");
        $insert_id = $this->insert($data);
        if ($insert_id){
            //权限初始化
            $permiss_total = $this->db->get('node')->result_array();
            $flag = true;
            foreach ($permiss_total as $k=>$v){
                $tmp = $this->db->insert('role_node_map', array('role_id'=>$insert_id, 'node_id'=>$v['node_id']));
                if (!$tmp){
                    $flag = false;
                }
            }
            if ($flag){

                //插入权限
                $flag = true;
                $permiss = $this->input->post_get('permiss');
                foreach ($permiss as $v){
                    $up_rs = $this->db->update('role_node_map', array('is_has'=>1),array('role_id'=>$insert_id, 'node_id'=>$v));
                    if (false === $up_rs){
                        $flag = false;
                    }
                }
                if ($flag){
                    $rd['code'] = 1;

                }else{
                    $rd['code'] = -3;
                    $rd['errmsg'] = '权限插入失败';
                }
            }else{
                $rd['code'] = -3;
                $rd['errmsg'] = '权限初始化失败';
            }
        }else{
            $rd['code'] = -3;
            $rd['errmsg'] = '角色插入失败';
        }
        return $rd;
    }

    public function updatePermiss ($id) {
        $data['role_des'] = $this->input->post_get('role_des');
        $data['role_name'] = $this->input->post_get('role_name');
        $permiss = $this->input->post_get('permiss');
        $up_rs = $this->update($data, $id);
        if (false !== $up_rs) {
            //权限初始化
            $permiss_total = $this->db->get('node')->result_array();
            $flag = true;
            foreach ($permiss_total as $k=>$v){
                $tmp = $this->db->update('role_node_map',array('is_has'=>2), array('role_id'=>$id, 'node_id'=>$v['node_id']));
                if (false === $tmp){
                    $flag = false;
                }
            }
            if ($flag){
                $flag = true;
                foreach ($permiss as $v){
                    //echo $v;
                    $rs = $this->db->update('role_node_map', array('is_has'=>1), array('role_id'=>$id, 'node_id'=>(int)$v));
                    if (false === $rs) {
                        $flag = false;
                    }
                }
                if ($flag){
                    $rd['code'] = 1;
                }else{
                    $rd['code'] = -1;
                    $rd['errmsg'] = '更新权限失败';
                }
            }else{
                //
            } 
        }else{
           $rd['code'] = -1;
           $rd['errmsg'] = '更新角色失败';
        }
        return $rd;
    }

    public function roleDel ($id) {
        if ($this->db->delete('role_node_map', array('role_id'=>$id))){
            if ($this->db->delete('role', array('role_id'=>$id))){
                $rd['code'] = 1;
            }else{
                $rd['code'] = -1;
                $rd['errmsg'] = '删除角色失败!';
            }
        }else{
            $rd['code'] = -2;
            $rd['errmsg'] = '删除角色权限失败!';
        }
        return $rd;
    }

    /**
     * 权限插入
     * @param Int $role_id 角色id
     * @param Array $permiss 权限id
     */
    public function roleAdd ( $role_id, $permiss ) {
        
        
    }
}
