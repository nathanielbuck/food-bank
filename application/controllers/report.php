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
		$data['months'] = array(
			1 => 'January',
			2 => 'February',
			3 => 'March',
			4 => 'April',
			5 => 'May',
			6 => 'June',
			7 => 'July',
			8 => 'August',
			9 => 'September',
			10 => 'October',
			11 => 'November',
			12 => 'December'
		);
		$data['month_text'] = date('F');
		$data['year'] = $year;
		$data['start_year'] = 2013;

		$data['present_households'] =
			$this->report_model->get_present_households($month, $year);
		$data['absent_households'] = 
			$this->report_model->get_absent_households($month, $year);

		$data['report'] = self::generate_report($month, $year);

		$this->load->view('templates/header', $data);
		$this->load->view('report/index', $data);
		$this->load->view('templates/footer');
	}

	public function generate_report($month, $year) {
		$report = $this->report_model->get_monthly_report($month, $year);

		$report['new_individuals'] =
			$this->report_model->new_individuals($month, $year);
		$report['new_households'] =
			$this->report_model->new_households($month, $year);
		$report['households_year_to_date'] =
			$this->report_model->households_year_to_date($month, $year);

		return $report;
	} 
}
?>
