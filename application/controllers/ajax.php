<?php
error_reporting(E_ALL ^ E_NOTICE);

class Ajax extends CI_Controller {

	public function serve_household() {
		if (empty($_POST)) {
			return;
		}

		$this->load->model('report_model');

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
}

?>
