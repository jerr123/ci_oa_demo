<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
    public function __construct(){
    	parent::__construct();
    }

    public function get () {
    	$username = $this->input->post('username');
    	$password = $this->input->post('password');

    }

    public function get_opt_map () {
    	$opts = $this->db->get('opt_map')->result_array();
    	return $opts;
    }

    public function get_status_map () {
    	$opts = $this->db->get('status_map')->result_array();
    	return $opts;
    }
}

?>