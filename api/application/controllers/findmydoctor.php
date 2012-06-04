<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FindMyDoctor extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/findmydoctor
	 *	- or -  
	 * 		http://example.com/index.php/findmydoctor/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		
	}

	public function search() {
		$query = $this->input->get_post('query');

		$this->load->model('doctor');

		// first let's get all of the doctors based on the query
		$doctors = $this->doctor->search($query);

		/*
		 * if we have doctors, loop through each doctor and grab all of
		 * the plans that the doctor is associated with. if the doctor is
		 * not associated with any plans, the plans object will be an
		 * empty array
		 */
		if (count($doctors) > 0) {
			foreach ($doctors as $doctor) {
				$plans = $this->doctor->getDoctorsPlans($doctor->id);

				$doctor->plans = $plans;
			}
		}

		echo json_encode($doctors);
	}
}

/* End of file findmydoctor.php */
/* Location: ./application/controllers/findmydoctor.php */