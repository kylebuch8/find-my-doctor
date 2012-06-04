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
		$doctors = $this->doctor->search($query);

		echo json_encode($doctors);
	}
}

/* End of file findmydoctor.php */
/* Location: ./application/controllers/findmydoctor.php */