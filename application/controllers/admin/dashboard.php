<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

	/**
	 * constructor method
	 */
	public function __construct()
	{

		parent::__construct();
		$this->lang->load("patients", 'english');
		$this->lang->load("system", 'english');
		$this->load->model("admin/test_group_model");
		$this->load->model("admin/invoice_model");
		$this->load->model("admin/patient_test_model");
		$this->load->model("admin/patient_model");
		// $this->load->model("admin/patient_model");
		//$this->output->enable_profiler(TRUE);
	}
	//---------------------------------------------------------------


	/**
	 * Default action to be called
	 */
	public function index()
	{

		$query = "SELECT YEAR(`invoices`.`created_date`) as `year` 
		          FROM `invoices`  GROUP BY YEAR(`invoices`.`created_date`)";
		$result = $this->db->query($query);
		$years_report = $result->result();
		foreach ($years_report as $year_report) {
			$query = "SELECT sum(`total_price`) as `total_income` 
			          FROM `invoices` 
					  WHERE  `status` = 3
					  AND YEAR(`invoices`.`created_date`)= '$year_report->year'";
			$result = $this->db->query($query);
			$year_report->income_per_year = $result->result()[0]->total_income;
		}
		$this->data['years_report'] = $years_report;

		//today query .........................................................
		$today = date("Y-m-d", time());
		$query = "SELECT sum(`total_price`) as `total_income`,
						 sum(`discount`) as `discount`,
						 sum(`price`) as `price`,
						 COUNT(`invoice_id`) as `total_test` 
							   FROM `invoices`
						WHERE  `status` = 3
						AND DATE(`invoices`.`created_date`) = '" . $today . "'";
		$result = $this->db->query($query);
		$total_income = $result->result()[0]->total_income;

		if ($total_income) {
			$this->data['total_income'] = $total_income;
			$this->data['discount'] = $result->result()[0]->discount;
			$this->data['price'] = $result->result()[0]->price;
			$this->data['total_test'] = $result->result()[0]->total_test;
		} else {
			$this->data['total_income'] = 0;
			$this->data['discount'] = 0;
			$this->data['price'] = 0;
			$this->data['total_test'] = 0;
		}


		//......................................................................

		$month = date("m", time());
		$year = date("Y", time());
		$today = date("d", time());
		$month_income_expence_report = array();

		for ($month = 1; $month <= 12; $month++) {
			$date_query = $year . "-" . $month . "-1";

			//Get income 
			$query = "SELECT SUM(`total_price`) as total_income FROM `invoices`
						  WHERE  YEAR(`invoices`.`created_date`) = '" . $year . "' 
						  AND  MONTH(`invoices`.`created_date`) = '" . $month . "'";

			$query_result = $this->db->query($query);
			$DateQuery = date("F, Y", strtotime($date_query));
			if ($query_result->result()[0]->total_income) {
				$month_income_expence_report[$DateQuery]['income'] = $query_result->result()[0]->total_income;
			} else {
				$month_income_expence_report[$DateQuery]['income'] = 0;
			}
		}
		$this->data['month_income_expence_report'] = $month_income_expence_report;

		$month = date("m", time());
		$year = date("Y", time());

		for ($day = 1; $day <= $today; $day++) {
			$date_query = $year . "-" . $month . "-" . $day;

			//Get income 
			$query = "SELECT SUM(`total_price`) as total_income
					  FROM `invoices`
					  WHERE   DATE(`invoices`.`created_date`) = '" . $date_query . "'";
			$query_result = $this->db->query($query);
			$DateQuery = date("d M, Y", strtotime($date_query));
			if ($query_result->result()[0]->total_income) {
				$income_expence_report[$DateQuery]['income'] = $query_result->result()[0]->total_income;
			} else {
				$income_expence_report[$DateQuery]['income'] = 0;
			}
		}



		$this->data['income_expence_report'] = $income_expence_report;

		$query = "SELECT COUNT(`invoices`.`test_report_by`) AS total_refered, 
						`doctors`.`doctor_name`
						, `doctors`.`doctor_designation`
					FROM `doctors`,
					`invoices` 
					WHERE `doctors`.`doctor_id` = `invoices`.`patient_refer_by`
					GROUP BY `invoices`.`patient_refer_by`
					ORDER BY total_refered DESC";
		$doctors_refereds = $this->db->query($query)->result();
		$this->data['doctors_refereds'] = $doctors_refereds;

		$this->data["view"] = ADMIN_DIR . "dashboard/dashboard";
		$this->load->view(ADMIN_DIR . "layout", $this->data);
	}
}
