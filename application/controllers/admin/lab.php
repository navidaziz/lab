<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Lab extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
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
    public function index(){
		
		 $where = "`invoices`.`status` IN (1) ORDER BY `invoices`.`invoice_id` DESC";
		 $this->data["forwarded_tests"]= $this->invoice_model->get_invoice_list($where, false);
		 
		 
		 $where = "`invoices`.`status` IN (2) ORDER BY `invoices`.`invoice_id` DESC";
		 $this->data["inprogress_tests"]= $this->invoice_model->get_invoice_list($where, false);
		 
		 $where = "`invoices`.`status` IN (3) ORDER BY `invoices`.`invoice_id` DESC";
		 $this->data["completed_tests"]= $this->invoice_model->get_invoice_list($where, false);
		 
		 
		$this->load->view(ADMIN_DIR."lab/home", $this->data);        
    }
	
	public function save_data(){
		//save patient data and get pacient id ....
		$patient_id = $this->patient_model->save_data();
		//var_dump($_POST);
		$test_group_ids =  implode(',', $this->input->post('test_group_id'));
		
		$discount = $this->input->post("discount");
		$tax = $this->input->post("tax");
		$refered_by = $this->input->post("refered_by");
		
		$query="SELECT SUM(`test_price`) as `total_test_price` 
				FROM `test_groups` 
				WHERE `test_groups`.`test_group_id` IN (".$test_group_ids.")";
		$query_result = $this->db->query($query);
		$total_test_price = $query_result->result()[0]->total_test_price;
		
		
		$inputs = array();
		$inputs["patient_id"]  =  $patient_id;
		$inputs["discount"]  =  $discount;
		$inputs["price"]  =  $total_test_price;
		$inputs["sale_tax"]  =  $tax;
		$inputs["total_price"]  =  ($total_test_price+$tax)-$discount;
		$inputs["patient_refer_by"]  =  $refered_by;
		
		$invoice_id  = $this->invoice_model->save($inputs);						
		
		
		$where = "`test_groups`.`test_group_id` IN (".$test_group_ids.") ORDER BY `test_groups`.`order`";
		$patient_test_groups = $this->test_group_model->get_test_group_list($where, false);
		foreach($patient_test_groups as $patient_test_group){
			$query="INSERT INTO `invoice_test_groups`(`invoice_id`, `patient_id`, `test_group_id`, `price`) 
				    VALUES ('".$invoice_id."', '".$patient_id."', '".$patient_test_group->test_group_id."', '".$patient_test_group->test_price."')";
			$this->db->query($query);
			}
			
			
			$this->session->set_flashdata("msg_success", "Data Save Successfully.");
            redirect(ADMIN_DIR."reception");
			
			
		}
		
	public function save_and_process(){
		
		$invoice_id = (int) $this->input->post("invoice_id");	
		$test_token_id = (int) $this->input->post("test_token_id");
		$group_ids = trim(trim($this->input->post("patient_group_test_ids")), ",");
		
		$query="UPDATE `invoices` 
				SET `test_token_id`='".$test_token_id."',
				    `test_report_by`='".$this->session->userdata("user_id")."',
					`status`='2'
			    WHERE `invoice_id` = '".$invoice_id."'";
		$this->db->query($query);
			
		$query = "SELECT 
				  `test_group_tests`.`test_group_id`,
				  `tests`.`test_id`,
				  `tests`.`test_category_id`,
				  `tests`.`test_type_id`,
				  `tests`.`test_name`,
				  `tests`.`test_description`,
				  `tests`.`normal_values` 
				FROM
				  `tests`,
				  `test_group_tests`
				WHERE  `tests`.`test_id` = `test_group_tests`.`test_id` 
				AND `test_group_tests`.`test_group_id` IN (".$group_ids.") 
				ORDER BY `test_group_tests`.`test_group_id` ASC, `test_group_tests`.`order` ASC";
		$query_result = $this->db->query($query);
		$all_tests = $query_result->result();
		$order=1;
		foreach($all_tests as $test){
			$query = "INSERT INTO `patient_tests`(`invoice_id`, 
												  `test_group_id`, 
												  `test_category_id`, 
												  `test_type_id`, 
												  `test_id`, 
												  `test_name`, 
												  `test_normal_value`, 
												  `test_result`, 
												  `remarks`,
												  `created_by`,
												  `order`) 
										VALUES('".$invoice_id."',
											   '".$test->test_group_id."',
											   '".$test->test_category_id."',
											    '".$test->test_type_id."',
												'".$test->test_id."',
												'".$test->test_name."',
												'".$test->normal_values."',
												'',
												'',
												'".$this->session->userdata("user_id")."',
												'".$order++."')";
		    $this->db->query($query);
			}
		
		
		
	redirect(ADMIN_DIR."lab/");
		
		}
		
	public function get_patient_test_form(){
		//$this->data["view"] = ADMIN_DIR."invoices/invoices";
		$invoice_id = (int) $this->input->post('invoice_id');
		$where = "`invoices`.`status` IN (2,3) AND `invoices`.`invoice_id`= '".$invoice_id."'";
		$this->data["invoice_detail"]= $this->invoice_model->get_invoice_list($where, false)[0];
		
		$where = "`patient_tests`.`invoice_id` = '".$invoice_id."'";
		$this->data["patient_tests"] = $this->patient_test_model->get_patient_test_list($where, false);
		
		
		$this->load->view(ADMIN_DIR."lab/get_patient_test_form", $this->data);
		}
		
	public function update_test_value(){
		
		$patient_test_id = (int) $this->input->post("patient_test_id");
		$partient_test_value = $this->input->post("partient_test_value");
		$query = "UPDATE `patient_tests` 
				  SET `test_result`='".$partient_test_value."' 
				  WHERE `patient_test_id`='".$patient_test_id."'";
		$this->db->query($query);		  
		
		}	
		
		
	public function update_test_remark(){
		
		$patient_test_id = (int) $this->input->post("patient_test_id");
		$partient_test_remark = $this->input->post("partient_test_remark");
		$query = "UPDATE `patient_tests` 
				  SET `remarks`='".$partient_test_remark."' 
				  WHERE `patient_test_id`='".$patient_test_id."'";
		$this->db->query($query);		  
		
		}	
		
	public function complete_test(){
		$invoice_id = (int) $this->input->post("invoice_id");
		$query="UPDATE `invoices` 
				SET `status`='3'
			    WHERE `invoice_id` = '".$invoice_id."'";
		$this->db->query($query);
		redirect(ADMIN_DIR."reception/");
		
		}			
    
    
}        
