<?php
error_reporting(E_ALL ^ E_NOTICE);

class Report extends CI_Controller {
    public function __construct () {
        parent::__construct();
		$this->load->model('report_model');
    }

    public function index () {
		$month = date('n');
		$year = date('Y');

        $data['title'] = 'Report';

		$data['month'] = $month;
		$data['month_text'] = date('F');
		$data['year'] = $year;

		$data['present_households'] =
			$this->report_model->get_present_households($month, $year);
		$data['absent_households'] = 
			$this->report_model->get_absent_households($month, $year);


        $this->load->view('templates/header', $data);
        $this->load->view('report/index', $data);
        $this->load->view('templates/footer');
    }
}
?>
