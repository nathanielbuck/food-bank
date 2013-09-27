<?php

class Login extends ActiveRecord\Model {

	public function __construct () {
		$this->load->database();
	}

	public function get_household ($id = NULL) {
        $sql = "SELECT *
		        FROM `household`
		        WHERE household.household_id = ?";
		return $this->db->query($sql, array($id));
	}


	public function get_household_member ($id = NULL) {
		$sql = "SELECT DISTINCT household_age_range.member, age_range.min_age, age_range.max_age
		        FROM `household`
		          JOIN household_age_range
		            ON (household.household_id = household_age_range.household_id)
				  JOIN age_range
		            ON (household_age_range.age_range_id = age_range.age_range_id)
		        WHERE household.household_id = ?";
		return $this->db->query($sql, array($id));
	}
}

?>
