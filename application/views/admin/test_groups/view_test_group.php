<!-- PAGE HEADER-->

<link href="<?php echo site_url("assets/".ADMIN_DIR."select2/select2.min.css"); ?>" rel="stylesheet" />
<script src="<?php echo site_url("assets/".ADMIN_DIR."select2/select2.min.js"); ?>"></script>


<div class="row">
	<div class="col-sm-12">
		<div class="page-header">
			<!-- STYLER -->
			
			<!-- /STYLER -->
			<!-- BREADCRUMBS -->
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url(ADMIN_DIR."test_groups/view/"); ?>"><?php echo $this->lang->line('Test Groups'); ?></a>
			</li><li><?php echo $title; ?></li>
			</ul>
			<!-- /BREADCRUMBS -->
            <div class="row">
                        
                <div class="col-md-6">
                    <div class="clearfix">
					  <h3 class="content-title pull-left"><?php echo $title; ?></h3>
					</div>
					<div class="description"><?php echo $title; ?></div>
                </div>
                
                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."test_groups/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."test_groups/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
                    </div>
                </div>
                
            </div>
            
			
		</div>
	</div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
		<!-- MESSENGER -->
	<div class="col-md-3">
	<div class="box border blue" id="messenger">
		<div class="box-title">
			<h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
			<!--<div class="tools">
            
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
				

			</div>-->
		</div><div class="box-body">
			
            <div class="table-responsive">
                
                    <table class="table">
						<thead>
						  
						</thead>
						<tbody>
					  <?php foreach($test_groups as $test_group): ?>
                         
                         
            <tr>
                <th><?php echo $this->lang->line('test_group_name'); ?></th>
                <td>
                    <?php echo $test_group->test_group_name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('test_price'); ?></th>
                <td>
                    <?php echo $test_group->test_price; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('test_time'); ?></th>
                <td>
                    <?php echo $test_group->test_time; ?>
                </td>
            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('Status'); ?></th>
                                <td>
                                    <?php echo status($test_group->status); ?>
                                </td>
                            </tr>
                         
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      
                      
                      

            </div>
			
			
		</div>
		
	</div>
	</div>
    
    
    
    <div class="col-md-6">
	<div class="box border blue" id="messenger">
		<div class="box-title">
			<h4><i class="fa fa-bell"></i> Group Tests List</h4>
			<!--<div class="tools">
            
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
				

			</div>-->
		</div><div class="box-body">
			
            <div class="table-responsive">
                
                    <table class="table table-bordered">
						<thead>
                        
						  <tr>
                        <th>#</th>  
							
<th><?php echo $this->lang->line('test_name'); ?></th><th><?php echo $this->lang->line('Order'); ?></th><th><?php echo $this->lang->line('Action'); ?></th>
                        </tr>
						</thead>
						<tbody>
					  <?php 
					  $count = 1;
					  foreach($test_group_tests as $test_group_test): ?>
                         
                         <tr>
                         
                             
            <td><?php echo $count++; ?></td>
            <td>
                <?php echo $test_group_test->test_name; ?>
            </td>
                                <td>
                                  <a class="llink llink-orderup" href="<?php echo site_url(ADMIN_DIR."test_groups/up_test/".$test_group_test->test_group_test_id."/".$test_groups[0]->test_group_id); ?>"><i class="fa fa-arrow-up"></i> </a>
                                  <a class="llink llink-orderdown" href="<?php echo site_url(ADMIN_DIR."test_groups/down_test/".$test_group_test->test_group_test_id."/".$test_groups[0]->test_group_id); ?>"><i class="fa fa-arrow-down"></i></a>
                                </td><td>
                                
                                <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR."test_groups/delete_test/".$test_group_test->test_group_test_id."/".$test_groups[0]->test_group_id); ?>"><i class="fa fa-trash-o"></i></a>
                            </td>
                         </tr>
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      
                      <?php //echo $pagination; ?>
                      

            </div>
			
			
		</div>
		
	</div>
	</div>
    
    
    
    <div class="col-md-3">
	<div class="box border blue" id="messenger">
		<div class="box-title">
			<h4><i class="fa fa-bell"></i> Add New Test</h4>
		</div>
        <div class="box-body">

            <?php
                $add_form_attr = array("class" => "form-horizontal");
                echo form_open_multipart(ADMIN_DIR."test_groups/save_test_group_data/".$test_groups[0]->test_group_id, $add_form_attr);
            ?>
            
            <div class="form-group" >
               

                <div class="col-md-12">
                   <select name="test_id[]"  class="form-control js-example-basic-multiple" multiple="" required="" >
                <?php foreach($test_types as $test_type){ ?>
                <optgroup label = "<?php echo $test_type->test_type;  ?>">
                	<?php foreach($test_type->tests as $test_id => $test_name){ ?>
                    <option value="<?php echo $test_id; ?>"><?php echo $test_name; ?></option>
                	<?php } ?>
                </optgroup>
				<?php } ?>
                </select>
                </div>
                <?php echo form_error("test_id", "<p class=\"text-danger\">", "</p>"); ?>
            </div>
            
            
            <div class="col-md-offset-2 col-md-10">
            <?php
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  $this->lang->line('Save'),
					 "class" =>  "btn btn-primary",
                    "style" =>  ""
                );
                echo form_submit($submit); 
            ?>
            
            
            
            <?php
                $reset = array(
                    "type"  =>  "reset",
                    "name"  =>  "reset",
                    "value" =>  $this->lang->line('Reset'),
                    "class" =>  "btn btn-default",
                    "style" =>  ""
                );
                echo form_reset($reset); 
            ?>
            </div>
            <div style="clear:both;"></div>
            
            <?php echo form_close(); ?>
            
        </div>
		
	</div>
	</div>
    
    
	<!-- /MESSENGER -->
</div>

<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>


