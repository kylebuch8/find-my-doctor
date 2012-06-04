<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function search($query) {
		$this->db->where('MATCH (first_name, last_name) AGAINST ("*' . $query . '*" IN BOOLEAN MODE)', NULL, FALSE);
		$query = $this->db->get('doctors');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

}

/* End of file doctor.php */
/* Location: ./application/models/doctor.php */