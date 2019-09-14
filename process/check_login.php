    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <!-- Custom styles for this template-->
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
<style>
body{
    background-color: #4e73df;
    background-image: -webkit-gradient(linear,left top,left bottom,color-stop(10%,#4e73df),to(#224abe));
    background-image: linear-gradient(180deg,#4e73df 10%,#224abe 100%);
    background-size: cover;
}
.text-center {
  padding-top: 400px;
  padding-right: 30px;
  padding-bottom: 50px;
  padding-left: 80px;
  text-align: center;
}
</style>
<?php
session_start();
// check date expiry
if($_POST["username"] == 'infra20i9' && $_POST["password"] == '12345'){
    $_SESSION["username"] = $_POST["username"];
    echo "<div class='text-center'>";
    echo "<div class='spinner-border text-dark' role='status' style='width: 5rem; height: 5rem;'>";
    echo "<span class='sr-only'>Loading...</span>";
    echo "</div>"."<br>";
    echo "Log In Complete Please Wait Page Loading...";
    echo "</div>";
    echo "<meta http-equiv='refresh' content='2;url=../index.php'>";
}else{  
    echo "<script type=\"text/javascript\">";
    echo "alert(\"Username หรือ Password ไม่ถูกต้อง.<<\");";
    echo "window.history.back();";
    echo "</script>";
}
  session_write_close();
?>