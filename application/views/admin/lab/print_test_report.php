
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice</title>
<link rel="stylesheet" href="style.css">
<link rel="license" href="http://www.opensource.org/licenses/mit-license/">
<script src="script.js"></script>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Al-Khidmat Diagnostic Center Chitral</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" type="text/css" href="http://localhost/lab/assets/admin/js/magic-suggest/magicsuggest-1.3.1-min.css" />
  <link rel="stylesheet" type="text/css" href="http://localhost/lab/assets/admin/css/cloud-admin.css" />
  <link rel="stylesheet" type="text/css"  href="http://localhost/lab/assets/admin/css/themes/default.css" id="skin-switcher" />
  <link rel="stylesheet" type="text/css"  href="http://localhost/lab/assets/admin/css/responsive.css" />
  <script> var site_url='http://localhost/lab/admin';</script>
  <!--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
  <script src="http://localhost/lab/assets/admin/js/jquery/jquery-2.0.3.min.js"></script>
  <script  src="http://localhost/lab/assets/admin/bootstrap-dist/js/bootstrap.min.js"></script>
  <!-- jstree resources -->
  <script src="http://localhost/lab/assets/admin/jstree-dist/jstree.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://localhost/lab/assets/admin/jstree-dist/themes/default/style.min.css" />
  <link rel="stylesheet" type="text/css"  href="http://localhost/lab/assets/admin/css/custom.css" />
  <!-- Select2- Css -->
  <link rel="stylesheet" href="http://localhost/lab/assets/admin/plugins/select2/select2.min.css">
  <!-- SLIDENAV -->
  <link rel="stylesheet" type="text/css" href="http://localhost/lab/assets/admin/js/slidernav/slidernav.css" />


  <!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->

<style>
body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  /* height: 29.7cm;  */
  height: auto;
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}

        
        table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
          padding: 2px !important;
        }
       
</style>
</head>
<body  >
<page size='A4'>
<div style="padding: 50px;">
<table  style="text-align: left; margin-top: 120px; width:100%">
      <tr>
        <td><table class="table" style="text-align: left;">
      
      <tr>
        <th>Patient Name: </th>
        <td><?php echo $invoice_detail->patient_name; ?></td>
      </tr>
      <tr>
        <th>Gender:  <?php echo $invoice_detail->patient_gender; ?></th>
        <th>Age:  <?php echo @$invoice_detail->patient_age; ?></th>
      </tr>
      <tr>
        <th>Mobile No:</th>
        <td><?php echo $invoice_detail->patient_mobile_no; ?></td>
      </tr>
      <tr>
        <th>Address</th>
        <td><?php echo $invoice_detail->patient_address; ?></td>
      </tr>
     
    </table></td>
    <td style="width: 10%;"></td>
        <td>
        
        <table class="table " style="text-align: left;">
      
      

      <tr>
        <th>Invoice No:</th>
        <td><?php echo $invoice_detail->invoice_id; ?></td>
      </tr>
      <tr>
        <th>Test Token No.</th>
        <td><?php echo $invoice_detail->test_token_id; ?></td>
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
      <h5><strong><?php echo $patient_tests_group->test_group_name; ?></strong></h5>
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
<br />
<br />
<br />

    <p style="text-align: right;"><b>Eid Ullah</b><br />Chitral City Medical <br /> Laboratory Chitral</p>
</div>

</page>
</body>
</html>
