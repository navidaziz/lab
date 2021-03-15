<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Reception extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
		$this->lang->load("patients", 'english');
		$this->lang->load("system", 'english');
		$this->load->model("admin/test_group_model");
		$this->load->model("admin/invoice_model");
		
		$this->load->model("admin/patient_model");
       // $this->load->model("admin/patient_model");
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
		
		$where = "`test_groups`.`status` IN (1) ORDER BY `test_groups`.`order`";
		$this->data["test_groups"] = $this->test_group_model->get_test_group_list($where, false);
		$this->load->view(ADMIN_DIR."reception/home", $this->data);        
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
    
    
}        
