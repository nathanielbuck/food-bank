<?php
error_reporting(E_ALL ^ E_NOTICE);
include('report.php');

class Ajax extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('report_model');
	}

	public function serve_household() {
		if (empty($_POST)) {
			return;
		}

		$household_id = trim($_POST['household_id']);
		$month = trim($_POST['month']);
		$year = trim($_POST['year']);

		$success = $this->report_model->serve_household(
			$household_id,
			$month,
			$year);

		if ($success) {
			echo '1';
			return;
		}

		echo '0';
	}

	public function get_report() {
		if (empty($_POST)) {
			return;
		}

		$month = trim($_POST['month']);
		$year = trim($_POST['year']);

		$data['present_households'] =
			$this->report_model->get_present_households($month, $year);
		$data['absent_households'] = 
			$this->report_model->get_absent_households($month, $year);

		$report = $this->report_model->get_monthly_report($month, $year);

		$report['new_individuals'] =
			$this->report_model->new_individuals($month, $year);
		$report['new_households'] =
			$this->report_model->new_households($month, $year);
		$report['households_year_to_date'] =
			$this->report_model->households_year_to_date($month, $year);

		echo json_encode(array_merge($data, $report));
	}
}

?>
