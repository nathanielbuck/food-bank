<?php
error_reporting(E_ALL ^ E_NOTICE);

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

    public function add_household () {
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
            'veteran' => $this->input->post('veteran'),
            'comments' => $this->input->post('comments')
        );
        $this->db->insert('household', $data);
        $household_id = $this->db->insert_id();

		$i = 1;
		$birthday_errors = array();
		while (!empty($_POST['sex' . $i])) {
			$bday_parsed = date_parse($_POST['birthday' . $i]);
            $birthday = $bday_parsed['year'] . '-' .
                $bday_parsed['month'] . '-' .
                $bday_parsed['day'];
            $data = array (
                'household_id' => $household_id,
                'birthday' => $birthday,
                'sex' => $_POST['sex' . $i]
            );
            $this->db->insert('household_members', $data);
            $i++;
        }

        $income_sources = $this->input->post('income_sources');
        if (!empty($income_sources)) {
            foreach ($income_sources as $income_source) {
                $data = array (
                    'household_id' => $household_id,
                    'income_source_id' => $income_source
                );
                $this->db->insert('household_income_source', $data);
            }
        }

        $this->db->trans_complete();

        return $household_id;
    }

    public function get_household_members ($id) {
        $sql = "SELECT
                  DATE_FORMAT(household_members.birthday, '%c/%e/%Y')
                    AS birthday,
                  CASE
                    WHEN household_members.sex = 1
                      THEN 'Male'
                    ELSE
                      'Female'
                  END AS sex
                FROM household
                  JOIN household_members
                    ON (household.household_id = 
                      household_members.household_id)
                WHERE household.household_id = ?";
		$query = $this->db->query($sql, array($id));
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
