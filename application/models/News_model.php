<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'news';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'news_id';

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

    public function queryNewsPage($per_page=10) {
    	$onset = $this->uri->segment(4)!=''?$this->uri->segment(4):0;
    	$sql = "select n.*,t.nt_id,t.type_name from news n,news_type t where t.nt_id=n.news_type";
    	if ($this->input->get_post('type_id')!='') $sql .= " and t.nt_id=".$this->input->get_post('type_id');
    	$totalSql = "select count(*) as total from(".$sql.") as a";
    	$total = $this->db->query($totalSql)->row_array();
    	$sql .= " order by news_id desc limit {$onset}, {$per_page}";
    	$rs = $this->db->query($sql)->result_array();
    	$rd['total'] = $total['total'];
    	foreach ($rs as $k => $v) {
    		$rs[$k]['news_content'] = htmlspecialchars_decode($v['news_content']);
    	}
    	$rd['data'] = $rs;
    	return $rd;
    }

    public function queryNewsList($per_page=10) {
        $onset = $this->uri->segment(5)!=''?$this->uri->segment(5):0;
        $sql = "select n.*,t.nt_id,t.type_name from news n,news_type t where t.nt_id=n.news_type";
        if ($this->input->get_post('type_id')!='') $sql .= " and t.nt_id=".$this->input->get_post('type_id');
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql)->row_array();
        $sql .= " order by news_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql)->result_array();
        $rd['total'] = $total['total'];
        foreach ($rs as $k => $v) {
            $rs[$k]['news_content'] = htmlspecialchars_decode($v['news_content']);
        }
        $rd['data'] = $rs;
        return $rd;
    }

    public function getNewsDetail ($id) {
    	$rs = $this->db->get_where('news', array('news_id'=>$id))->row_array();
    	$rs['news_content'] = htmlspecialchars_decode($rs['news_content']);
    	return $rs;
    }

    public function getNewestArtical() {
    	return $this->db->select('news_title,news_id,news_adddate')->order_by('news_id', 'desc')->limit(10)->get('news')->result_array();
    }

    /**
     * 新闻类型相关
     */
    /** 新闻类型获取 */
    public function getType () {
    	return $this->db->get('news_type')->result_array();
    }
}

?>