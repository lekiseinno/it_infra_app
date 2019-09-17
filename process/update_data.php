<?php 
session_start();
include("../class/connect.php");
$class_con_quotation = new Sqlsrv_quotation_approve();
$class_con_quotation->getConnect();
if($_REQUEST["method"]=="printer"){
	if($_REQUEST["method_status"]=="add"){
		// Insert
		$list_status = "1";
		$query=$class_con_quotation->getQuery("
		    INSERT INTO Printer_Approve (brand,model,supplier,remark,department,date_approve,num_date,status,user_create,date_create,list_status)
	    	VALUES ('".$_POST["brand"]."','".$_POST["model"]."','".$_POST["supplier"]."','".$_POST["remark"]."',
	     	'".$_POST["depart"]."','".date("Y-m-d H:i:s")."','".$_POST["num_date"]."','".$_POST["status"]."','".$_SESSION["username"]."','".date("Y-m-d H:i:s")."','".$list_status."')
		");
	}elseif($_REQUEST["method_status"]=="edit"){
		// Update
		$query=$class_con_quotation->getQuery("
			UPDATE Printer_Approve SET brand = '".$_POST["brand"]."',model = '".$_POST["model"]."',supplier = '".$_POST["supplier"]."',remark = '".$_POST["remark"]."',department = '".$_POST["depart"]."',num_date = '".$_POST["num_date"]."',status = '".$_POST["status"]."',user_update = '".$_SESSION["username"]."',date_update = '".date("Y-m-d H:i:s")."'
	 		WHERE id = '".$_REQUEST["id"]."'
		");
	}elseif($_REQUEST["method_status"]=="delete"){
		// Delete
		$list_status = "0";
		$query=$class_con_quotation->getQuery("
			UPDATE Printer_Approve SET list_status = '".$list_status."' WHERE id = '".$_REQUEST["id"]."'
		");
	}
}elseif($_REQUEST["method"]=="quotation"){
	if($_REQUEST["method_status"]=="add"){
		// Insert
		if($_POST["status"]=="0"){
			$approve = "-";
		}else{
			$approve = $_POST["approve"];
		}
		$list_status = "1";
		$query=$class_con_quotation->getQuery("
		    INSERT INTO Quotation_Approve(department,fix_status,remark,price,supplier,quotation_status,approve,user_create,date_create,list_status)
	     	VALUES ('".$_POST["depart"]."','".$_POST["fix"]."','".$_POST["remark"]."','".$_POST["price"]."',
	     	'".$_POST["supplier"]."','".$_POST["status"]."','".$approve."','".$_SESSION["username"]."','".date("Y-m-d H:i:s")."','".$list_status."')
		");
	}elseif($_REQUEST["method_status"]=="edit"){
		// Update
		if($_POST["status"]=="0"){
			$approve = "-";
		}else{
			$approve = $_POST["approve"];
		}
		$query=$class_con_quotation->getQuery("
			UPDATE Quotation_Approve SET department = '".$_POST["depart"]."',fix_status = '".$_POST["fix"]."',remark = '".$_POST["remark"]."',price = '".$_POST["price"]."',supplier = '".$_POST["supplier"]."',quotation_status = '".$_POST["status"]."',approve = '".$approve."',user_update = '".$_SESSION["username"]."',date_update = '".date("Y-m-d H:i:s")."'
	 		WHERE id = '".$_REQUEST["id"]."'
		");
	}elseif($_REQUEST["method_status"]=="delete"){
		// Delete
		$list_status = "0";
		$query=$class_con_quotation->getQuery("
			UPDATE Quotation_Approve SET list_status = '".$list_status."' WHERE id = '".$_REQUEST["id"]."'
		");
	}
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