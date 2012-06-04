<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function search($query) {
		/*
		 * trying out a full text search
		 */
		$this->db->where('MATCH (first_name, last_name) AGAINST ("*' . $query . '*" IN BOOLEAN MODE)', NULL, FALSE);
		$query = $this->db->get('doctors');

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return NULL;
		}
	}

	function getDoctorsPlans($doctorId) {
		$this->db->select('plans.name, plans.id');
		$this->db->from('doctors_to_plans');
		$this->db->join('plans', 'plans.id = doctors_to_plans.plan_id');
		$this->db->where('doctors_to_plans.doctor_id', $doctorId);
		$query = $this->db->get();

		/*
		 * return the result if we have rows otherwise return
		 * an empty array
		 */
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}

}

/* End of file doctor.php */
/* Location: ./application/models/doctor.php */