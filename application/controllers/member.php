<?php

class Household extends CI_Controller {

    public function __construct () {
        parent::__construct();
        $this->load->model('household_model');
    }

    public function index () {
        $data['household'] = $this->household_model->get_household();
        $data['title'] = 'Household';

        $this->load->view('templates/header', $data);
        $this->load->view('household/index', $data);
        $this->load->view('templates/footer');
    }

    public function view ($id) {
        $data['household'] = $this->household_model->get_household($id);
        $data['household_members'] =
            $this->household_model->get_household_members($id);

        if (empty($data['household']) || empty($data['household_members'])) {
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

        if (FALSE === $this->form_validation->run()) {
            $this->load->view('templates/header', $data);
            $this->load->view('household/add');
            $this->load->view('templates/footer');
            return;
        }

        $this->household_modle->add
    }
}
?>
