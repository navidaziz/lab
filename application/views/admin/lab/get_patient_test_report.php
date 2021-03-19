<div class="row">
  <div class="col-md-4">
    <h3>Patient Detail</h3>
    <table class="table table-bordered" style="text-align: left;">
      <tr>
        <th style="width: 30%;">Invoice No:</th>
        <td><?php echo $invoice_detail->invoice_id; ?></td>
      </tr>
      <tr>
        <th>Test Token No.</th>
        <td><?php echo $invoice_detail->test_token_id; ?></td>
      </tr>
      <tr>
        <th>Patient Name: </th>
        <td><?php echo $invoice_detail->patient_name; ?></td>
      </tr>
      <tr>
        <th>Gender:</th>
        <td><?php echo $invoice_detail->patient_gender; ?></td>
      </tr>
      <tr>
        <th>Mobile No:</th>
        <td><?php echo $invoice_detail->patient_mobile_no; ?></td>
      </tr>
      <tr>
        <th>Address</th>
        <td><?php echo $invoice_detail->patient_address; ?></td>
      </tr>
      <tr>
        <th>Refered By:</th>
        <td><?php echo $invoice_detail->doctor_name . "( " . $invoice_detail->doctor_designation . " )"; ?></td>
      </tr>
      <tr>
        <th>Registered:</th>
        <td><?php echo get_timeago($invoice_detail->created_date); ?></td>
      </tr>
    </table>

    <h3>Invoice</h3>
    <table class="table table-bordered" style="text-align: left;">
      <tr>
        <th style="width: 30%;">#</th>
        <td>Test</td>
        <td>Total Rs</td>
      </tr>
      <?php
      $count = 1;
      foreach ($invoice->invoice_details as $invoicedetail) { ?>
        <tr>
          <th style="width: 30%;"><?php echo $count++; ?></th>
          <td><?php echo $invoicedetail->test_group_name; ?></td>
          <td><?php echo $invoicedetail->price; ?></td>
        </tr>
      <?php } ?>
      <tr>
          <th colspan="2" style="text-align: left;">Total</th>
          <td><?php echo $invoice->price; ?></td>
        </tr>

        <tr>
          <th colspan="2" style="text-align: left;">Discount</th>
          <td><?php echo $invoice->discount; ?></td>
        </tr>

        <tr>
          <th colspan="2" style="text-align: left;">Paid</th>
          <td><?php echo $invoice->total_price; ?></td>
        </tr>
    </table>

  </div>
  <div class="col-md-8">

  <table class="table table-bordered" style="text-align: left;">
      <tr>
        <td><table class="table" style="text-align: left;">
      <tr>
        <th>Invoice No:</th>
        <td><?php echo $invoice_detail->invoice_id; ?></td>
      </tr>
      <tr>
        <th>Test Token No.</th>
        <td><?php echo $invoice_detail->test_token_id; ?></td>
      </tr>
      <tr>
        <th>Patient Name: </th>
        <td><?php echo $invoice_detail->patient_name; ?></td>
      </tr>
      <tr>
        <th>Gender:  <?php echo $invoice_detail->patient_gender; ?></th>
        <th>Age:  <?php echo @$invoice_detail->patient_age; ?></th>
      </tr>
     
    </table></td>
        <td>
        
        <table class="table " style="text-align: left;">
      
      <tr>
        <th>Mobile No:</th>
        <td><?php echo $invoice_detail->patient_mobile_no; ?></td>
      </tr>
      <tr>
        <th>Address</th>
        <td><?php echo $invoice_detail->patient_address; ?></td>
      </tr>
      <tr>
        <th>Refered By:</th>
        <td><?php echo $invoice_detail->doctor_name . "( " . $invoice_detail->doctor_designation . " )"; ?></td>
      </tr>
      <tr>
        <th>Date & Time:</th>
        <td><?php echo date("d F, Y h:i:s", strtotime($invoice_detail->created_date)); ?></td>
      </tr>
    </table>
        </td>
      </tr>
  </table>

  

    <?php foreach ($patient_tests_groups as $patient_tests_group) { ?>
      <h3><?php echo $patient_tests_group->test_group_name; ?></h3>
      <table class="table table-bordered" style="text-align: left;">
        <tr>
          <th>#</th>
          <th>Test Name</th>
          <th>Test Result</th>
          <th>Normal Value</th>
          <th>Remarks</th>
        </tr>
        <?php
        $count = 1;
        foreach ($patient_tests_group->patient_tests as $patient_test) { ?>
          <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $patient_test->test_name; ?></td>
            <td> <?php echo $patient_test->test_result; ?> </td>
            <td><?php echo $patient_test->test_normal_value; ?></td>
            <td><?php echo $patient_test->remarks; ?> </td>
          </tr>
        <?php } ?>
      </table>
    <?php  } ?>

    <p style="text-align: right; margin-top: 90px;"><b>Eid Ullah</b><br />Chitral City Medical <br /> Laboratory Chitral</p>
    
      <a target="new"  href="<?php echo site_url(ADMIN_DIR."lab/print_patient_test_report/$invoice_id") ?>" class="btn btn-primary" ><i class="fa fa-print" aria-hidden="true"></i> Print Test Report</a>
  </div>
</div>
