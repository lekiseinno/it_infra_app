<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Approved</title>
    
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css">

    <!-- select2 -->
    <link href="../asset/css/select2.min.css" rel="stylesheet">

    <!-- script $post -->
    <script src="../asset/js/jquery-3.1.1.min.js"></script>
<style type="text/css">
    #wrapper #content-wrapper{
        background-color: #FFFFFF;
    }
    .buttons-copy{ 
        background-color: #1E90FF;
        color: white; 
    }
    .buttons-excel{ 
        background-color: green; 
        color: white;
    }
    .ui-datepicker-calendar { display: none; }
</style>
<?php 
    session_start();
    if(@$_SESSION['username'] == ""){?>
        <script>    
        window.location="../login.html";
        </script>
    <?exit();}?>
</head>
<?php include("../class/connect.php"); ?>
<?php 
            $class_con_quotation = new Sqlsrv_quotation_approve();
            $class_con_quotation->getConnect();
            // Select
            $query=$class_con_quotation->getQuery("
                SELECT department,SUM(price) AS sum_price
                FROM Quotation_Approve 
                WHERE quotation_status = '1'
                AND approve = '1'
                GROUP BY department
            ");
            while($result=$class_con_quotation->getResult($query)){
                $department[] = $result["department"];
                $sum_price[] = $result["sum_price"];     
            }
?>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 align="center" style="color:#000000;" id="head_show">Quotation Report (All)</h3>
                            <div class="form-inline" style="padding-bottom: 1%;">
                                <select class="form-control" id="Year" name="Year">
                                    <option value='-'>===== โปรดเลือกปี =====</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                </select> 
                                <select class="form-control" id="Month" name="Month">
                                    <option value='-'>===== โปรดเลือกเดือน =====</option>
                                    <option value="01">01 | มกราคม</option>
                                    <option value="02">02 | กุมภาพันธ์</option>
                                    <option value="03">03 | มีนาคม</option>
                                    <option value="04">04 | เมษายน</option>
                                    <option value="05">05 | พฤษภาคม</option>
                                    <option value="06">06 | มิถุนายน</option>
                                    <option value="07">07 | กรกฏาคม</option>
                                    <option value="08">08 | สิงหาคม</option>
                                    <option value="09">09 | กันยายน</option>
                                    <option value="10">10 | ตุลาคม</option>
                                    <option value="11">11 | พฤศจิกายน</option>
                                    <option value="12">12 | ธันวาคม</option>
                                </select>
                                <input type="hidden" name="year_hidden" id="year_hidden">
                                <input type="hidden" name="month_hidden" id="month_hidden">
                                <!-- <input type="text" name="Year" id="Year" class="date-picker-year form-control" readonly /> -->
                                <!-- <input type="text" name="Month" id="Month" class="date-picker-month form-control" readonly /> -->
                            </div>
                        <div class="result">
                        <table class="table table-bordered" id="report_quotation" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ลำดับที่</th>
                                    <th>ชื่อแผนกที่ขอ</th>
                                    <th>ใบเสนอราคารวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                foreach ($department as $row => $department_ids) { ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $department_ids ?></td>
                                    <td><?php echo number_format($sum_price[$row]) ?></td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- Page Select2 -->
<script src="../asset/js/select2.min.js"></script>
<script type="text/javascript">
    (function($){
    $(document).ready(function() {
        $('#Year').select2();
        $('#Month').select2();
    });
    })(jQuery);
</script>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $("#Month").attr("disabled",true);
            $("#Year").change(function(){
              $.post("../ajax/status_report.php",
              {
                Method: "Year",
                Year: $("#Year").val()
              }, 
              function(data){
                  $(".result").html(data);
                  $("#head_show").html("Quotation Report Year: ("+$("#Year").val()+")");
                  $("#year_hidden").val($("#Year").val());
                  $("#Month").attr("disabled",false);
              });
            });
        });
     })(jQuery);
     (function($){
        $(document).ready(function(){
            $("#Month").change(function(){
              $.post("../ajax/status_report.php",
              {
                Method: "Month",
                Year: $("#Year").val(),
                Month: $("#Month").val()
              }, 
              function(data){
                  $(".result").html(data);
                  $("#head_show").html("Quotation Report Year:("+$("#Year").val()+") | Month:("+$("#Month").val()+")");
                  $("#year_hidden").val($("#Year").val());
                  $("#month_hidden").val($("#Month").val());
              });
            });
        });
    })(jQuery);
  </script>
  <!-- Core plugin JavaScript-->
  <script src="../asset/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../asset/js/sb-admin-2.min.js"></script>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
  
  <script type="text/javascript">
    (function($){
    $(document).ready(function() {
        
        var table = $('#report_quotation').DataTable( {
            lengthChange: false,
            buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i> Copy',
                titleAttr: 'Copy',
                title: 'Quotation Report | <?php echo date("Y-m-d"); ?>'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> Excel',
                titleAttr: 'Excel',
                title: 'Quotation Report | <?php echo date("Y-m-d"); ?>'
            }
            ]
        } );
        
        table.buttons().container()
            .appendTo( '#report_quotation_wrapper .col-sm-6:eq(0)' );
        
    } );
    })(jQuery);
  </script>
</body>

</html>