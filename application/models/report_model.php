<?php
error_reporting(E_ALL ^ E_NOTICE);

class Report_model extends CI_Model {

	public function __construct () {
		$this->load->database();
	}

	public function get_present_households ($month, $year) {
	    $date = self::generate_date($month, $year);
		$sql = "
			SELECT household.household_id, first_name, last_name
			FROM household
			JOIN serve
		  		ON (household.household_id = serve.household_id)
            WHERE date = ?
            ORDER BY last_name ASC, first_name ASC";

		$query = $this->db->query($sql, array($date));
	    return $query->result_array();
	}

	public function get_absent_households ($month, $year) {
	    $date = self::generate_date($month, $year);
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

	public function serve_household ($household_id, $month, $year) {
	    $date = self::generate_date($month, $year);
	    $data = array (
			'household_id' => $household_id,
			'date' => $date
		);
		$this->db->insert('serve', $data);

		return TRUE;
	}

	public function get_monthly_report($month, $year) {
	    $date = self::generate_date($month, $year);
	    $date_5 = self::generate_date($month, $year - 5);
	    $date_12 = self::generate_date($month, $year - 12);
	    $date_17 = self::generate_date($month, $year - 17);
	    $date_34 = self::generate_date($month, $year - 34);
	    $date_59 = self::generate_date($month, $year - 59);
	    $sql = "SELECT DISTINCT
	                (SELECT COUNT(*)
                    FROM household_members
	                JOIN serve ON (household_members.household_id = serve.household_id)
                    WHERE date = ?) AS total_individuals,
	                (SELECT COUNT(*)
                    FROM household
	                JOIN serve ON (household.household_id = serve.household_id)
                    WHERE date = ?) AS total_households,
	                (SELECT COUNT(*)
	                 FROM household_members
	                 JOIN serve ON (household_members.household_id = serve.household_id)
                     WHERE birthday >= ? AND date = ?) AS ageRange1,
	                (SELECT COUNT(*)
	                 FROM household_members
	                 JOIN serve ON (household_members.household_id = serve.household_id)
	                 WHERE birthday < ? AND birthday >= ? AND date = ?) AS ageRange2,
	                (SELECT COUNT(*)
	                 FROM household_members
	                 JOIN serve ON (household_members.household_id = serve.household_id)
	                 WHERE birthday < ? AND birthday >= ? AND date = ?) AS ageRange3,
	                (SELECT COUNT(*)
	                 FROM household_members
	                 JOIN serve ON (household_members.household_id = serve.household_id)
	                 WHERE birthday < ? AND birthday >= ? AND date = ?) AS ageRange4,
	                (SELECT COUNT(*)
	                 FROM household_members
	                 JOIN serve ON (household_members.household_id = serve.household_id)
	                 WHERE birthday < ? AND birthday >= ? AND date = ?) AS ageRange5,
	                (SELECT COUNT(*)
	                 FROM household_members
	                 JOIN serve ON (household_members.household_id = serve.household_id)
	                 WHERE birthday < ? AND date = ?) AS ageRange6,
	                (SELECT COUNT(*)
	                 FROM household_members
	                 JOIN serve ON (household_members.household_id = serve.household_id)
	                 WHERE sex = '1' AND date = ?) AS male,
	                (SELECT COUNT(*)
	                 FROM household_members
	                 JOIN serve ON (household_members.household_id = serve.household_id)
                     WHERE sex = '2' AND date = ?) AS female,
                    CASE
                      WHEN SUM(DISTINCT disabled) IS NULL
                        THEN '0'
                      ELSE
                        SUM(DISTINCT disabled)
                    END AS disabled,
                    CASE
                      WHEN SUM(DISTINCT veteran) IS NULL
                        THEN '0'
                      ELSE
                        SUM(DISTINCT veteran)
                    END AS veteran,
                    CASE
                      WHEN SUM(DISTINCT food_stamps) IS NULL
                        THEN '0'
                      ELSE
                        SUM(DISTINCT food_stamps)
                    END AS food_stamps 
	            FROM household
	            JOIN serve ON (household.household_id = serve.household_id)
	            JOIN household_members as members ON (household.household_id = members.household_id)
	            WHERE date = ?";
        $data = array(
            $date,
            $date,
            $date_5, $date,
            $date_5, $date_12, $date,
            $date_12, $date_17, $date,
            $date_17, $date_34, $date,
            $date_34, $date_59, $date,
            $date_59, $date,
            $date,
            $date,
            $date
        );
		$query = $this->db->query($sql, $data);
	    return $query->row_array();
	}

	public function new_households($month, $year) {
	    $date = self::generate_date($month, $year);
        $sql = "SELECT COUNT(*) AS new_households
                FROM serve
                WHERE date = ?
                    AND serve.household_id NOT IN (
                        SELECT DISTINCT household_id
                        FROM serve
                        WHERE date < ?)";
        $data = array($date, $date);

		$query = $this->db->query($sql, $data);
        $result = $query->row_array();
	    return $result['new_households'];
    }
	public function new_individuals($month, $year) {
	    $date = self::generate_date($month, $year);
        $sql = "SELECT COUNT(birthday) AS new_individuals
                FROM serve
                JOIN household_members
                    ON (serve.household_id = household_members.household_id)
                WHERE date = ?
                    AND serve.household_id NOT IN (
                        SELECT household_id
                        FROM serve
                        WHERE date < ?)";
        $data = array($date, $date);

		$query = $this->db->query($sql, $data);
        $result = $query->row_array();
	    return $result['new_individuals'];
    }

	public function households_year_to_date($month, $year) {
	    $date = self::generate_date($month, $year);
	    $january = self::generate_date(1, $year);
        $sql = "SELECT COUNT(DISTINCT household_id) as households
                FROM serve
                WHERE date <= ? 
                    AND date >= ?";
        $data = array($date, $january);

		$query = $this->db->query($sql, $data);
        $result = $query->row_array();
	    return $result['households'];
    }

	protected function generate_date ($month, $year) {
		return $year . '-' . $month . '-1';
	}
}
?>
