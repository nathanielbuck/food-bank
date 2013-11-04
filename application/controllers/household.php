<?php
error_reporting(E_ALL ^ E_NOTICE);

class Household extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('household_model');
	}

	public function index () {
		$data['households'] = $this->household_model->get_households();
		$data['title'] = 'Household';

		$this->load->view('templates/header', $data);
		$this->load->view('household/index', $data);
		$this->load->view('templates/footer');
	}

	public function view ($id) {
		$data['household'] = $this->household_model->get_household($id);
		$data['household_members'] =
			$this->household_model->get_household_members($id);
		$data['income_sources'] =
			$this->household_model->get_household_income_sources($id);

		if (empty($data['household'])) {
			show_404();
		}

		$data['title'] = $data['household']['first_name'] . 
			$data['household']['last_name'];

		$this->load->view('templates/header', $data);
		$this->load->view('household/view', $data);
		$this->load->view('templates/footer');
	}

	public function edit ($id) {
		self::add($id);
	}

	public function add ($id = NULL) {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$birthday = array();
		$sex = array();
		$data['button_text'] = 'Add Household';

		if (!empty($id) && empty($_POST)) {
			$data['household'] = $this->household_model->get_household($id);
			$data['title'] = 'Edit Household';
			$data['editing'] = true;
			$data['button_text'] = 'Save Household';

			$household_members =
				$this->household_model->get_household_members($id);
			$j = 1;
			foreach($household_members as $household_member) {
				$birthday[$j] = $household_member['birthday'];
				$sex[$j] = $household_member['sex'];
			}
			$his = $this->household_model->get_household_income_sources($id);
			$household_income_sources = array();
			foreach ($his as $income_source) {
				$household_income_sources[] = $income_source['income_source'];
			}	
			$data['household_income_sources'] = $household_income_sources;
		}
		else {
			$data['title'] = 'Add a New Household';
		}
		$data['income_sources'] = $this->household_model->get_income_sources();

		$this->form_validation->set_rules('first_name', 'First Name', 'required'); 
		$this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
		$this->form_validation->set_rules('address', 'Address', 'required'); 
		$this->form_validation->set_rules('phone', 'Phone Number', 'numeric'); 
		$this->form_validation->set_rules('food_stamps', 'Food Stamps', 'required'); 
		$this->form_validation->set_rules('disabled', 'Number of Disabled Indivuals', 'numeric'); 
		$this->form_validation->set_rules('veteran', 'Number of Veterans', 'numeric'); 

		$i = 1;
		$birthday_errors = array();
		while (!empty($_POST['sex' . $i])) {
			$bday_post = $_POST['birthday' . $i];
			$bday_parsed = date_parse($bday_post);
			if (!empty($bday_parsed['errors'])) {
				$birthday_errors['birthday' . $i] = 'Household member ' .  $i .
					'\'s birthday is not ' . 'formatted correctly.';
				$birthday[$i] = $_POST['birthday' . $i];
				$sex[$i] = $_POST['sex' . $i];
			}
			else {
				$birthday[$i] = $bday_parsed['month'] . '/' . $bday_parsed['day'] .
					'/' . $bday_parsed['year'];
				$sex[$i] = $_POST['sex' . $i];
			}
			$i++;
		}
		$data['birthday'] = $birthday;
		$data['sex'] = $sex;

		if (FALSE === $this->form_validation->run() ||
			!empty($birthday_errors) ||
			!empty($id)) {
			$CI =& get_instance();
			$CI->form_validation->_error_array =
				array_merge(
					$CI->form_validation->_error_array,
					$birthday_errors);

			$this->load->view('templates/header', $data);
			$this->load->view('household/add');
			$this->load->view('templates/footer');
			return;
		}

		if (empty($_POST['household_id'])) {
			$id = $this->household_model->add_household();
		}
		else {
			$id = $_POST['household_id']; 
			$this->household_model->save_household($id);
		}

		redirect('household/' . $id);
	}
}
?>
