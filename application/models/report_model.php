<?php
error_reporting(E_ALL ^ E_NOTICE);

class Report_model extends CI_Model {

	public function __construct () {
		$this->load->database();
	}

	public function get_present_households ($month, $year) {
		$date = $year . '-' . $month . '-1';
		$sql = "
			SELECT household.household_id, first_name, last_name
			FROM household
			JOIN serve
		  		ON (household.household_id = serve.household_id)
			WHERE date = ?";

		$query = $this->db->query($sql, array($date));
        return $query->result_array();
	}

	public function get_absent_households ($month, $year) {
		$date = $year . '-' . $month . '-1';
		$sql = '
			SELECT household_id, first_name, last_name
			FROM household
			WHERE household_id NOT IN (
				SELECT household_id
				FROM serve
				WHERE date = ? 
			)'; 
		$query = $this->db->query($sql, array($date));
        return $query->result_array();
	}

	public function serve_household($household_id, $month, $year) {
		$date = $year . '-' . $month . '-1';
        $data = array (
			'household_id' => $household_id,
			'date' => $date
		);
		$this->db->insert('serve', $data);

		return TRUE;
	}
}
?>
