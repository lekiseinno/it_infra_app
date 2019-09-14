<?php 
include("../class/connect.php");
$class_con_quotation = new Sqlsrv_quotation_approve();
$class_con_quotation->getConnect();
if($_POST["method"]=="printer"){
$query=$class_con_quotation->getQuery("
    SELECT id,brand,model,supplier
    FROM Printer_Approve
    WHERE brand = '".$_POST["brand"]."' AND model = '".$_POST["model"]."' AND supplier = '".$_POST["supplier"]."'
");
while ($result=$class_con_quotation->getResult($query)) {
	$id = $result["id"];
	$brand = $result["brand"];
	$model = $result["model"];
	$supplier = $result["supplier"];
}
if($brand=="" && $model=="" && $suplier==""){
// Insert
	$query=$class_con_quotation->getQuery("
	    INSERT INTO Printer_Approve (brand,model,supplier,remark,department,date_approve,num_date,status)
    	VALUES ('".$_POST["brand"]."','".$_POST["model"]."','".$_POST["supplier"]."','".$_POST["remark"]."',
     	'".$_POST["depart"]."','".date("Y-m-d H:i:s")."','".$_POST["num_date"]."','".$_POST["status"]."')
	");
}else{
// Update
	$query=$class_con_quotation->getQuery("
		UPDATE Printer_Approve SET brand = '".$_POST["brand"]."',model = '".$_POST["model"]."',supplier = '".$_POST["supplier"]."',remark = '".$_POST["remark"]."',department = '".$_POST["depart"]."',date_approve = '".date("Y-m-d H:i:s")."',num_date = '".$_POST["num_date"]."',status = '".$_POST["status"]."'
 		WHERE id = '".$id."'
	");
}
}elseif($_POST["method"]=="quotation"){
	// Insert
	if($_POST["approve"]==""){
		$approve = "-";
	}else{
		$approve = $_POST["approve"];
	}
	$query=$class_con_quotation->getQuery("
	    INSERT INTO Quotation_Approve(department,fix_status,remark,price,supplier,quotation_status,approve)
     	VALUES ('".$_POST["depart"]."','".$_POST["fix"]."','".$_POST["remark"]."','".$_POST["price"]."',
     	'".$_POST["supplier"]."','".$_POST["status"]."','".$approve."')
	");
}
if(!$query)
{
	echo "<script type=\"text/javascript\">";
	echo "alert(\"Record already exist!".'\n'."Please enter again.\");";
	echo "window.history.back();";
	echo "</script>";
	exit();
}else{
	echo "<script type=\"text/javascript\">";
	echo "alert(\"Save Successfully!<<\");";
	echo "window.history.back();";
	echo "</script>";
}
?>