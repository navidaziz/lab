<?php $this->load->view(ADMIN_DIR."reception/reception_header"); ?>

<div class="row"> 
  <!-- MESSENGER -->
  
  <div class="col-md-9">
  <div class="col-md-12">
    <div class="box border blue" id="messenger">
      <div class="box-title">
        <h4><i class="fa fa-bell"></i>Patient Detail</h4>
      </div>
      <div class="box-body">
      
      <table class="table">
      <tr>
      	<th>Patient Name</th>
        <th>Mobile No.</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Refered By</th>
      </tr>
      <tr>
      <td> <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "patient_name",
                        "id"            =>  "patient_name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('patient_name'),
                        "value"         =>  set_value("patient_name"),
                        "placeholder"   =>  $this->lang->line('patient_name')
                    );
                    echo  form_input($text);
                ?>
            <?php echo form_error("patient_name", "<p class=\"text-danger\">", "</p>"); ?> </td>
      <td> <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "patient_mobile_no",
                        "id"            =>  "patient_mobile_no",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('patient_mobile_no'),
                        "value"         =>  set_value("patient_mobile_no"),
                        "placeholder"   =>  $this->lang->line('patient_mobile_no')
                    );
                    echo  form_input($text);
                ?>
            <?php echo form_error("patient_mobile_no", "<p class=\"text-danger\">", "</p>"); ?></td>
      <td>  <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "patient_address",
                        "id"            =>  "patient_address",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('patient_address'),
                        "value"         =>  set_value("patient_address"),
                        "placeholder"   =>  $this->lang->line('patient_address')
                    );
                    echo  form_input($text);
                ?>
            <?php echo form_error("patient_address", "<p class=\"text-danger\">", "</p>"); ?> </td>
      <td> <?php 
					$options = array("Male" => "Male", "Female" => "Female");
                        foreach($options as $option_value => $options_name){
                            
                            $data = array(
                                "name"        => "patient_gender",
                                "id"          => "patient_gender",
                                "value"       => $option_value,
                                "style"       => "","required"	  => "required",
                                "class"       => "uniform"
                                );
                            echo form_radio($data)."<label for=\"patient_gender\" style=\"margin-left:10px;\">$options_name</label>";
                            
                        }
                    ?>
            <?php echo form_error("patient_gender", "<p class=\"text-danger\">", "</p>"); ?> </td>
      <td>
	  <select required name="refered_by">
     <option value="">Refered By</option>
	  <?php 
			
			$query="SELECT * FROM `doctors` WHERE `status`=1";
			$query_result = $this->db->query($query);
			$doctors = $query_result->result();
			
                        foreach($doctors as $doctor){ ?>
                        <option value="<?php echo $doctor->doctor_id; ?>"><?php echo $doctor->doctor_name; ?></option>
                        <?php }  ?>
            <?php echo form_error("refered_by", "<p class=\"text-danger\">", "</p>"); ?>
            
            </select>
            
            </td>
      </tr>
      </table>
      
      </div>
    </div>
  </div>
  
  
  
  <div class="col-md-12">
    <div class="box border blue" id="messenger">
      <div class="box-title">
        <h4><i class="fa fa-bell"></i>Select Differet Tests</h4>
      </div>
      <div class="box-body">
      <div class="row">
      
      
        <?php foreach($test_groups as $test_group){ ?>
        <div class="col-md-2" style="">
		<div style="margin:1px; border:1px solid #CCC; border-radius:2px; margin-bottom:5px; -webkit-box-shadow: -2px 0px 14px -3px rgba(0,0,0,0.37);
-moz-box-shadow: -2px 0px 14px -3px rgba(0,0,0,0.37);
box-shadow: -2px 0px 14px -3px rgba(0,0,0,0.37);  ">
		<input name="" type="checkbox" value="" /><strong style="margin-left:10px;"><?php echo $test_group->test_group_name; ?></strong>
        <span style="font-size:9px; display:block; margin-left:30px !important"> Rs: <?php echo $test_group->test_price; ?>- <?php echo $test_group->test_time; ?>min</span>
        </div>
        </div>
        
        <?php } ?>
        
        </div>
        
        
        
      </div>
    </div>
  </div>
  
  
  </div>
  
  
  
  
  
  
  
  
  
  
  <div class="col-md-3">
    <div class="box border blue" id="messenger">
      <div class="box-title">
        <h4><i class="fa fa-bell"></i>Test Status</h4>
      </div>
      <div class="box-body"> </div>
    </div>
  </div>
</div>
<?php $this->load->view(ADMIN_DIR."reception/reception_footer"); ?>
