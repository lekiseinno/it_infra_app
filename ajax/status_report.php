<?php include("../class/connect.php"); ?>
<?php 
        error_reporting(0);
        if($_POST["Method"]=="Year"){
            $Year = $_POST["Year"];     
            $class_con_quotation = new Sqlsrv_quotation_approve();
            $class_con_quotation->getConnect();
            // Select
            $query=$class_con_quotation->getQuery("
                SELECT department,SUM(price) AS sum_price
                FROM Quotation_Approve 
                WHERE quotation_status = '1'
                AND approve = '1'
                AND YEAR(date_create) = '".$Year."'
                GROUP BY department
            ");
            while($result=$class_con_quotation->getResult($query)){
                $department[] = $result["department"];
                $sum_price[] = $result["sum_price"];     
            }
        }elseif($_POST["Method"]=="Month"){
            $Year = $_POST["Year"];            
            $Month = $_POST["Month"];
            $date_sum = $Year."-".$Month;
            $class_con_quotation = new Sqlsrv_quotation_approve();
            $class_con_quotation->getConnect();
            // Select
            $query=$class_con_quotation->getQuery("
                SELECT department,SUM(price) AS sum_price
                FROM Quotation_Approve 
                WHERE quotation_status = '1'
                AND approve = '1'  
                AND YEAR(date_create) = '".$Year."'  
                AND MONTH(date_create) = '".$Month."'      
                GROUP BY department
            ");
            while($result=$class_con_quotation->getResult($query)){
                $department[] = $result["department"];
                $sum_price[] = $result["sum_price"];     
            }
        }
?>
                        <table class="table table-bordered" id="report_quotation" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ลำดับที่1</th>
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
<script type="text/javascript">
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
  </script>