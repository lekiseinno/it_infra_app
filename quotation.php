<?php include("include/head.php"); ?>
<?php include("class/connect.php"); ?>
<?php 
			$class_con_LeKise_Group = new Sqlsrv_LeKise_Group();
            $class_con_LeKise_Group->getConnect();
            // Select
            $query=$class_con_LeKise_Group->getQuery("
                SELECT company_Code,department_Code,department_Name
                FROM department
                WHERE company_Code='LKL'
                OR company_Code='LKS'
                OR company_Code='LKT'
                OR company_Code='OMP'
                OR company_Code='WTL'
            ");
            while($result=$class_con_LeKise_Group->getResult($query)){
                $company_Code[] = $result["company_Code"];
                $department_Code[] = $result["department_Code"];
                $department_Name[] = $result["department_Name"];
            }
?>
<style type="text/css">
	.bg-green{
		background-color: #008000;	
		color: #FFFFFF;
	}
	.bg-red{
		background-color: #FF0000;	
		color: #FFFFFF;
	}
	.btn-icon-split .icon{
		padding: .600rem .75rem !important;
	}
</style>
<body id="page-top">
	<!-- Page Wrapper -->
  <div id="wrapper">

    <?php include("include/sidebar.php") ?>
	<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
      	<!-- Topbar -->
        <?php include("include/Topnav.php"); ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        		<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">

					<!-- Circle Buttons -->
					<form action="process/update_data.php" method="POST">
		              <div class="card shadow mb-4">
		                <div class="card-header py-3">
		                  <h6 class="m-0 font-weight-bold text-primary">Quotation Form (ใบเสนอราคา)</h6>
		                </div>
		                <div class="card-body" style="display: inline-flex;">
							<div class="col-lg-3">
								<select name="depart" id="depart" class="form-control" style="width: 100%;" required>
									<option value='#'>แผนกที่ส่งซ่อม</option>
									<?php foreach ($company_Code as $key => $value) {?>
									<option value="<?php echo $value." | ".$department_Name[$key] ?>"><?php echo $value." | ".$department_Name[$key]; ?></option>
									<?php  } ?>
								</select>
							</div>
							<div class="col-lg-3">
								<select name="fix" id="fix" class="form-control" style="width: 100%;" required>
									<option value="1">ซ่อม</option>
									<option value="0">ซื้อใหม่</option>
								</select>
							</div>
							<div class="col-sm-3">
								<textarea name="remark" id="remark" class="form-control" placeholder="สาเหตุ" required></textarea>
							</div>
							<div class="col-sm-3">
								<input type="number" name="price" id="price" class="form-control" placeholder="ราคา" required>
							</div>
						</div>
						<div class="card-body" style="display: inline-flex;">
							<div class="col-sm-3">
								<input type="text" name="supplier" id="supplier" placeholder="Supplier" class="form-control" required> 
							</div>	
							<div class="col-sm-3" style="padding-bottom: 1%;">
								<select name="status" id="status" class="form-control" style="width: 100%;" required>
									<option value="#">สถานะ</option>
									<option value="1">ได้รับ</option>
									<option value="0">รอ</option>
								</select>
							</div>
							<div class="col-sm-3" style="padding-bottom: 1%;text-align: center;">
							<div class="result"></div>
							</div>
							<div class="col-sm-3" style="text-align: right;">
								<input type="hidden" name="method" id="method" value="quotation">
								<input type="hidden" name="method_status" id="method_status" value="add">
								<button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Save</button>
							</div>
						</div>
					</div>
				   </form>
				</div>
			</div>
<?php 
			$class_con_quotation = new Sqlsrv_quotation_approve();
			$class_con_quotation->getConnect();
            // Select
            $query=$class_con_quotation->getQuery("
                SELECT *
                FROM Quotation_Approve
            ");
            while($result=$class_con_quotation->getResult($query)){
                $id[] = $result["id"];
                $department[] = $result["department"];
                $fix_status[] = $result["fix_status"];
                $price[] = $result["price"]; 
                $remark[] = $result["remark"];
                $supplier[] = $result["supplier"];
                $quotation_status[] = $result["quotation_status"];
                $approve[] = $result["approve"];
                $user_create[] = $result["user_create"];
                $date_create[] = $result["date_create"];
                $user_update[] = $result["user_update"];
                $date_update[] = $result["date_update"];
                $list_status[] = $result["list_status"];	
            }
				// $id = array("1","2");
    //             $department = array("inno","infra");
    //             $fix_status = array("1","0");
    //             $price = array("15000","10000");
    //             $remark = array("ถาดใส่หมึกเสีย","ถาดใส่กระดาษเสีย");
    //             $supplier = array("HP","Epson");
    //             $quotation_status = array("1","0");
    //             $approve = array("1","-");
?>
				<div class="row">
					<div class="col-lg-12">
						<!-- DataTales Example -->
				          <div class="card shadow mb-4">
				            <div class="card-header py-3">
				              <h6 class="m-0 font-weight-bold text-primary">Quotation Table</h6>
				            </div>
				            <div class="card-body">
				              <div class="table-responsive">
								<table class="table table-bordered" id="dataTable_quotation" width="100%" cellspacing="0">
									<thead>
										<tr align="center">
											<th>ID</th>
											<th>ชื่อแผนกที่ขอ</th>
											<th>สถานะการซ่อม</th>
											<th>สาเหตุ</th>
											<th>ราคา</th>
											<th>Suplier</th>
											<th>Status การขอ</th>
											<th>Status Approve</th>
											<th>ผู้บันทึก</th>
											<th>วันที่บันทึก</th>
											<!-- <th>ผู้อัพเดต</th> -->
											<!-- <th>วันที่อัพเดต</th> -->
											<th>สถานะรายการ</th>
											<th>Update</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($id as $row => $ids) { ?>
										<tr align="center">
											<td><?php echo $ids ?></td>
											<td><?php echo $department[$row] ?></td>
											<?php 
												if($fix_status[$row]=="1"){
													$fix_status_bg = "ซ่อม";
												}else{
													$fix_status_bg = "ซื้อใหม่";
												}
											?>
											<td><?php echo $fix_status_bg ?></td>
											<td><?php echo $remark[$row] ?></td>
											<td><?php echo $price[$row] ?></td>
											<td><?php echo $supplier[$row] ?></td>
											<?php 
												if($quotation_status[$row]=="1"){
													$quotation_status_bg = "ได้รับ";
												}else{
													$quotation_status_bg = "รอ";
												}
											?>
											<td><?php echo $quotation_status_bg ?></td>
											<?php 
												if($approve[$row]=="1"){
													$approves = "<div class='bg-green'>อนุมัติ</div>";
												}elseif($approve[$row]=="0"){
													$approves = "<div class='bg-red'>ไม่อนุมัติ</div>";
												}else{
													$approves = "<div class='bg-red'>-</div>";
												}
											?>
											<td><?php echo $approves; ?></td>

											<td><?php echo $user_create[$row] ?></td>
											<td><?php echo date("Y-m-d H:i", strtotime($date_create[$row])); ?></td>
											<!-- <td><?php echo $user_update[$row] ?></td> -->
											<!-- <td><?php echo $date_update[$row] ?></td> -->
											<?php 
												if($list_status[$row]=="1"){
													$list_status_sys = "<div class='bg-green'>ใช้งาน</div>";
												}else{
													$list_status_sys = "<div class='bg-red'>ยกเลิกรายการนี้ </div>";
												}
											?>
											<td><?php echo $list_status_sys ?></td>
											<td><a class="btn btn-warning btn-icon-split" href="#" data-toggle="modal" data-target="#EditModalID<?php echo $ids ?>">
							                    <span class="icon text-white-50">
							                      <i class="fas fa-edit"></i>
							                    </span>
							                    <span class="text">Edit</span>
							                </a></td>
											<!-- Edit Modal-->
											  <div class="modal fade" id="EditModalID<?php echo $ids ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											    <div class="modal-dialog" role="document">
											      <div class="modal-content">
											        <div class="modal-header">
											          <h5 class="modal-title" id="exampleModalLabel">Edit Quotation</h5>
											          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
											            <span aria-hidden="true">×</span>
											          </button>
											        </div>
											        <form action="process/update_data.php" method="POST">
											        <div class="modal-body">
											        <div class="form-group row">
												    	<label for="inputEmail3" class="col-sm-3 col-form-label">แผนกที่ส่งซ่อม</label>
												    	<div class="col-sm-9">	
											        	<select name="depart" id="depart_edit<?php echo $ids ?>" style="width: 100%;" class="form-control" required>
															<?php foreach ($company_Code as $key => $value) {?>
															<option value="<?php echo $value." | ".$department_Name[$key] ?>" <?php if($value." | ".$department_Name[$key] == $department[$row]){ echo " selected=\"selected\""; } ?>><?php echo $value." | ".$department_Name[$key]; ?></option>
															<?php  } ?>
														</select>
														<script type="text/javascript">
																$(document).ready(function() {
																    $('#depart_edit<?php echo $ids ?>').select2();
																});
														</script>
														</div>
												  	</div>
												  	<div class="form-group row">
												    	<label for="inputEmail3" class="col-sm-3 col-form-label">สถานะการซ่อม</label>
												    	<div class="col-sm-9">	
														<select name="fix" id="fix" class="form-control" style="width: 100%;" required>
															<option value="1" <?php if($fix_status[$row] == 1){ echo " selected=\"selected\""; } ?>>ซ่อม</option>
															<option value="0" <?php if($fix_status[$row] == 0){ echo " selected=\"selected\""; } ?>>ซื้อใหม่</option>
														</select>
														</div>
												  	</div>
												  	<div class="form-group row">
												    	<label for="inputEmail3" class="col-sm-3 col-form-label">สาเหตุ</label>
												    	<div class="col-sm-9">
														<textarea name="remark" id="remark" class="form-control" placeholder="สาเหตุ" required><?php echo $remark[$row] ?></textarea>
														</div>
												  	</div>
												  	<div class="form-group row">
												    	<label for="inputEmail3" class="col-sm-3 col-form-label">ราคา</label>
												    	<div class="col-sm-9">
														<input type="number" name="price" id="price" value="<?php echo $price[$row] ?>" class="form-control" placeholder="ราคา" required>
														</div>
												  	</div>
												  	<div class="form-group row">
												    	<label for="inputEmail3" class="col-sm-3 col-form-label">Supplier</label>
												    	<div class="col-sm-9">
														<input type="text" name="supplier" id="supplier" value="<?php echo $supplier[$row] ?>" placeholder="Supplier" class="form-control" required> 
														</div>
												  	</div>
												  	<div class="form-group row">
												    	<label for="inputEmail3" class="col-sm-3 col-form-label">Status การขอ</label>
												    	<div class="col-sm-9">
														<select name="status" id="status<?php echo $ids ?>" class="form-control" style="width: 100%;" required>
															<option value="1" <?php if($quotation_status[$row] == 1){ echo " selected=\"selected\""; } ?>>ได้รับ</option>
															<option value="0" <?php if($quotation_status[$row] == 0){ echo " selected=\"selected\""; } ?>>รอ</option>
														</select>
														</div>
												  	</div>
												  	<div class="result_edit">
												  		<div class="form-group row">
												    	<label for="inputEmail3" class="col-sm-3 col-form-label">Status Approved</label>
												    	<div class="col-sm-9">
														<div class="btn-group btn-group-toggle" data-toggle="buttons">
														  <label class="btn btn-success active">
														    <input type="radio" name="approve" id="approve1" value="1" autocomplete="off" <?php if($approve[$row]=="1"){ echo "checked"; } ?>><i class="fas fa-check"></i> อนุมัติ
														  </label>
														  <label class="btn btn-danger">
														    <input type="radio" name="approve" id="approve2" value="0" autocomplete="off" <?php if($approve[$row]=="0"){ echo "checked"; } ?>><i class="fas fa-times"></i> ไม่อนุมัติ
														  </label>
														</div>
														</div>
														</div>
												  	</div>
													<!-- <script type="text/javascript">
														$(document).ready(function(){
														$("#status<?php echo $ids ?>").change(function(){
													      $.post("ajax/status_edit.php",
													      {
													        status: $("#status<?php echo $ids ?>").val()
													      },
													      function(data){
													        $(".result_edit").html(data);
														});
													   });
													 });
													</script> -->
														<input type="hidden" name="id" id="id" value="<?php echo $ids ?>">
														<input type="hidden" name="method" id="method" value="quotation">
														<input type="hidden" name="method_status" id="method_status" value="edit">
											        </div>
											        <div class="modal-footer">
											          <button class="btn btn-secondary" type="reset"><i class="fas fa-redo-alt"></i> Cancel</button>
											          <button class="btn btn-success" type="submit"><i class="fas fa-edit"></i> Edit</button>
											        </div>
											        </form>
											      </div>
											    </div>
											  </div>
											<td><a href="process/update_data.php?method=quotation&method_status=delete&id=<?php echo $ids ?>" class="btn btn-danger btn-icon-split" onclick="return confirm('คุณต้องการยกเลิกรายการนี้?')">
											<span class="icon text-white-50">
						                      <i class="fas fa-trash"></i>
						                    </span>
						                    <span class="text">DELETE</span></a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
				            </div>
				          </div>
						</div>
					</div>
				</div>
			</div>
			 <!-- Footer -->
	      <footer class="sticky-footer bg-white">
	        <div class="container my-auto">
	          <div class="copyright text-center my-auto">
	            <span>Copyright &copy; Data Approved 2019</span>
	          </div>
	        </div>
	      </footer>
	      <!-- End of Footer -->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#depart').select2();
	});
	$(document).ready(function() {
    	$('#dataTable_quotation').DataTable({
    		responsive: true,
    		"lengthMenu": [[-1,50 ,25 ,10], ["All",50 ,25 ,10]]
    	});
	} );
</script>
<script type="text/javascript">
	$(document).ready(function(){
	$("#status").change(function(){
      $.post("ajax/status.php",
      {
        status: $("#status").val()
      },
      function(data){
        $(".result").html(data);
	});
   });
 });
</script>
<?php include("include/footer.php"); ?>