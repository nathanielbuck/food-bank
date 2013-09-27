<?php

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

        if (empty($data['household'])) {
            show_404();
        }

        $data['title'] = $data['household']['first_name'] . 
            $data['household']['last_name'];

        $this->load->view('templates/header', $data);
        $this->load->view('household/view', $data);
        $this->load->view('templates/footer');
    }

    public function add () {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Add a New Household';
        $data['age_ranges'] = $this->household_model->get_age_ranges();

        $this->form_validation->set_rules('first_name', 'First Name', 'required'); 
        $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
        $this->form_validation->set_rules('address', 'Address', 'required'); 
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric'); 
        $this->form_validation->set_rules('food_stamps', 'Food Stamps', 'required'); 
        $this->form_validation->set_rules('disabled', 'Number of Disabled Indivuals', 'numeric'); 
        $this->form_validation->set_rules('veteran', 'Number of Veterans', 'numeric'); 

        foreach ($data['age_ranges'] as $age_range) {
			$this->form_validation->set_rules('age_range' .
				$age_range['age_range_id'], 'Age Range ' . 
				$age_range['min_age'] . ' to ' .
				$age_range['max_age'], 'numeric'); 
        }

        if (FALSE === $this->form_validation->run()) {
            $this->load->view('templates/header', $data);
            $this->load->view('household/add');
            $this->load->view('templates/footer');
            return;
        }

		$household_id = $this->household_model->add_household(
			$data['age_ranges']);

		$this->view($household_id);
    }
}
?>
