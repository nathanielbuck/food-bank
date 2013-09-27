<?php

class Household_model extends CI_Model {

	public function __construct () {
		$this->load->database();
	}


	public function get_household ($id = null) {
        $sql = "SELECT *
                FROM household
                WHERE household.household_id = ?";

		$query = $this->db->query($sql, array($id));
        return $query->row_array();
	}

	public function get_households () {
        $sql = "SELECT *
                FROM household
                ORDER BY last_name ASC";

		$query = $this->db->query($sql);
        return $query->result_array();
	}

    public function add_household ($age_ranges) {
        $this->db->trans_start();
        $data = array (
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'proxy_first_name' => $this->input->post('proxy_first_name'),
            'proxy_last_name' => $this->input->post('proxy_last_name'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'food_stamps' => $this->input->post('food_stamps'),
            'disabled' => $this->input->post('disabled'), 
            'veteran' => $this->input->post('veteran')
        );
        $this->db->insert('household', $data);
        $household_id = $this->db->insert_id();

        foreach ($age_ranges as $age_range) {
            $individuals = $this->input->post('age_range' .
                $age_range['age_range_id']);

            if (!empty($individuals)) {
                $data = array (
                    'household_id' => $household_id,
                    'age_range_id' => $age_range['age_range_id'],
                    'individuals' => $individuals
                );
                $this->db->insert('household_age_range', $data);
            }
        }

        $income_sources = $this->input->post('income_sources');
        foreach ($income_sources as $income_source) {
            $data = array (
                'household_id' => $household_id,
                'income_source_id' => $income_source
            );
            $this->db->insert('household_income_source', $data);
        }

        $this->db->trans_complete();

        return $household_id;
    }

	public function get_household_members ($id = NULL) {
		$sql = "SELECT DISTINCT household_age_range.individuals, age_range.min_age, age_range.max_age
		        FROM household
		          JOIN household_age_range
		            ON (household.household_id = household_age_range.household_id)
				  JOIN age_range
		            ON (household_age_range.age_range_id = age_range.age_range_id)
		        WHERE household.household_id = ?";
		$query = $this->db->query($sql, array($id));
        return $query->result_array();
	}

	public function get_age_ranges () {
        $query = $this->db->query('SELECT * FROM age_range');
        return $query->result_array();
    }

    public function get_income_sources () {
        $query = $this->db->query('SELECT * FROM income_source');
        return $query->result_array();
    }

	public function get_household_income_sources ($id = NULL) {
        $sql = "SELECT income_source
                FROM income_source
                  JOIN household_income_source
                    ON (income_source.income_source_id = household_income_source.income_source_id)
		        WHERE household_id = ?";
		$query = $this->db->query($sql, array($id));
        return $query->result_array();
	}
}

?>
