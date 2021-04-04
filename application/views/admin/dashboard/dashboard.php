<div class="container" style="margin-top:5px !important; font-size:10px;">
  <div class="row">
    <div class="col-md-12">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4 class="pull-left">Today</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <table class="table table-bordered">
                <h4>Today</h4>
                <tr>
                  <td style="color:green">
                    <h5>Total Test</h5>
                  </td>
                  <td style="color:green">
                    <h4><strong><?php echo $total_test; ?></strong></h4>
                  </td>
                </tr>
                <tr>
                  <td style="color:green">
                    <h5>Price</h5>
                  </td>
                  <td style="color:green">
                    <h4><strong><?php echo $price; ?></strong></h4>
                  </td>
                </tr>
                <tr>
                  <td style="color:green">
                    <h5>Discount</h5>
                  </td>
                  <td style="color:green">
                    <h4><strong><?php echo $discount; ?></strong></h4>
                  </td>
                </tr>
                <tr>
                  <td style="color:green">
                    <h5>Income</h5>
                  </td>
                  <td style="color:green">
                    <h4><strong><?php echo $total_income; ?></strong></h4>
                  </td>
                </tr>
              </table>
            </div>

            <div class="col-md-5">
              <table class="table table-bordered">
                <h4>Refered By Doctors</h4>
                <tr>
                  <td>#</td>
                  <td>Name</td>
                  <td>Total Refered</td>
                  <td>Previous Month</td>
                  <td>Current Month</td>
                  <td>Refered Today</td>
                </tr>
                <?php
                $count = 1;
                foreach ($doctors_refereds as $key => $doctors_refered) { ?>
                  <tr>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo $doctors_refered->doctor_name;   ?> - <?php echo $doctors_refered->doctor_designation;   ?></td>
                    <td><?php echo $doctors_refered->total_refered;   ?></td>
                    <td><?php echo $doctors_refered->total_refered_previous_month;   ?></td>
                    <td><?php echo $doctors_refered->total_refered_current_month;   ?></td>
                    <td><?php echo $doctors_refered->total_refered_today;   ?></td>
                  </tr>

                <?php } ?>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4 class="pull-left">Current Month Day Wise Report</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="hidden-xs col-md-6">
              <div id="current_month_report"></div>
            </div>
            <div class="col-md-6">
              <h2>Current Month Day Wise Report</h2>
              <div style=" width:100%; height:350px !important; overflow:scroll; overflow-x: hidden;">
                <table class="table table-bordered">
                  <tr>
                    <th>Date</th>
                    <th>Total Tests</th>
                    <th>Test Price</th>
                    <th>Discount</th>
                    <th>Total</th>

                  </tr>
                  <?php
                  $count = 0;
                  $total_income = 0;

                  $income_expence_reportarray = $income_expence_report;
                  krsort($income_expence_reportarray);

                  //var_dump($income_expence_reportarray);

                  foreach ($income_expence_reportarray as $date => $report) {


                    $total_income += $report['income']; ?>
                    <tr <?php if ($count == 0) { ?> style="background-color:#9F9 !important; " <?php $count++;
                                                                                              } ?>>
                      <td><?php echo $date; ?></td>
                      <td><?php echo $report['total_test']; ?></td>
                      <td><?php echo $report['price']; ?></td>
                      <td><?php echo $report['discount']; ?></td>

                      <td><?php echo $report['income']; ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </div>
              <table class="table">
                <tr>
                  <td>
                    <h5>Total Income</h5>
                  </td>
                  <td>
                    <h5><strong><?php echo "Rs " . $total_income; ?></strong></h5>
                  </td>

                </tr>
              </table>
            </div>





          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="box border blue" id="messenger">
        <div class="box-title">
          <h4 class="pull-left">Monthly Report</h4>
        </div>


        <div class="box-body">
          <div class="row">
            <div class="hidden-xs col-md-6">
              <div id="year_monthly_report"></div>
            </div>
            <div class="col-md-6">
              <h2>Monthly Report</h2>
              <div style=" width:100%; height:350px !important; overflow:scroll; overflow-x: hidden;">
                <table class="table table-bordered">
                  <tr>
                    <th>Date</th>
                    <th>Total Tests</th>
                    <th>Test Price</th>
                    <th>Discount</th>
                    <th>Total</th>
                  </tr>
                  <?php

                  foreach ($month_income_expence_report as $date => $report) {  ?>
                    <tr <?php if ($date == date("F, Y", time())) { ?> style="background-color:#9F9 !important; font-size:16px;" <?php $count++;
                                                                                                                              } ?>>
                      <td><?php echo $date; ?></td>
                      <td><?php echo $report['total_test']; ?></td>
                      <td><?php echo $report['price']; ?></td>
                      <td><?php echo $report['discount']; ?></td>
                      <td><?php echo $report['income']; ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </div>
            </div>





          </div>

          <hr />

          <div class="row" style="margin-top:10px;">
            <div class="col-md-6">
              <div id="year_report"></div>
            </div>
            <div class="col-md-6">
              <h2>Yearly Report</h2>
              <table class="table table-bordered">
                <tr>
                  <th>Year</th>
                  <th>Total Tests</th>
                  <th>Test Price</th>
                  <th>Discount</th>
                  <th>Total</th>
                </tr>
                <tr>
                  <td>2019</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>2020</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                  <td>0</td>
                </tr>
                <?php

                foreach ($years_report as $report) {  ?>
                  <tr <?php if ($report->year == date("Y", time())) { ?> style="background-color:#9F9 !important; font-size:16px;" <?php $count++;
                                                                                                                                  } ?>>
                    <td><?php echo $report->year; ?></td>
                    <td><?php echo $report->total_test; ?></td>
                    <td><?php echo $report->price; ?></td>
                    <td><?php echo $report->discount; ?></td>
                    <td><?php echo $report->income_per_year; ?></td>
                  </tr>
                <?php } ?>
              </table>


            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function() {
    $('#year_monthly_report').highcharts({
      title: {
        text: 'Monthly Report',
        x: -20 //center
      },
      subtitle: {
        text: 'Monthly Report',
        x: -20
      },
      xAxis: {
        categories: [
          <?php
          $income = "";
          foreach ($month_income_expence_report as $date => $report) {
            $income .= $report['income'] . ", ";
          ?> '<?php echo $date; ?>',
          <?php } ?>
        ]
      },
      yAxis: {
        title: {
          text: 'Income / Expenses'
        },
        plotLines: [{
          value: 0,
          width: 1,
          color: '#808080'
        }]
      },
      tooltip: {
        valueSuffix: ' Total'
      },
      // legend: {
      //   layout: 'vertical',
      //   align: 'right',
      //   verticalAlign: 'middle',
      //   borderWidth: 0
      // },
      series: [{
          name: 'Incomes',
          data: [<?php echo $income; ?>]
        }

      ]
    });
  });



  $(function() {
    $('#current_month_report').highcharts({
      title: {
        text: 'Current Month ',
        x: -20 //center
      },
      subtitle: {
        text: 'Current Month Days Wise Report',
        x: -20
      },
      xAxis: {
        categories: [
          <?php
          $income = "";
          foreach ($income_expence_report as $date => $report) {
            $income .= $report['income'] . ", ";
          ?> '<?php echo $date; ?>',
          <?php } ?>
        ]
      },
      yAxis: {
        title: {
          text: 'Income'
        },
        plotLines: [{
          value: 0,
          width: 1,
          color: '#808080'
        }]
      },
      tooltip: {
        valueSuffix: ' Total'
      },
      // legend: {
      //   layout: 'vertical',
      //   align: 'right',
      //   verticalAlign: 'middle',
      //   borderWidth: 0
      // },
      series: [{
          name: 'Incomes',
          data: [<?php echo $income; ?>]
        }

      ]
    });
  });



  $(function() {
    $('#year_report').highcharts({
      title: {
        text: 'Yearly Report',
        x: -20 //center
      },
      subtitle: {
        text: 'Yearly Report',
        x: -20
      },
      xAxis: {
        categories: ['2019', '2020',
          <?php
          $income = "";
          foreach ($years_report as $report) {
            $income .= $report->income_per_year . ", ";
          ?> '<?php echo $report->year; ?>',
          <?php } ?>
        ]
      },
      yAxis: {
        title: {
          text: 'Income'
        },
        plotLines: [{
          value: 0,
          width: 1,
          color: '#808080'
        }]
      },
      tooltip: {
        valueSuffix: ' Total'
      },
      // legend: {
      //   layout: 'vertical',
      //   align: 'right',
      //   verticalAlign: 'middle',
      //   borderWidth: 0
      // },
      series: [{
          name: 'Incomes',
          data: [0, 0, <?php echo $income; ?>]
        }

      ]
    });
  });
</script>
<script src="<?php echo site_url("assets/" . ADMIN_DIR); ?>/Highcharts/js/highcharts.js"></script>
<script src="<?php echo site_url("assets/" . ADMIN_DIR); ?>/Highcharts/js/highcharts-more.js"></script>
<script src="<?php echo site_url("assets/" . ADMIN_DIR); ?>/Highcharts/js/modules/exporting.js"></script>
<script src="<?php echo site_url("assets/" . ADMIN_DIR); ?>/Highcharts/js/modules/drilldown.js"></script>