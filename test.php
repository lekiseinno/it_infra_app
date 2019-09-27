<?php //include("include/head.php"); ?>
<!-- <style>
body {
    background: #eee;
    font-family: sans-serif;
}
.box {
    background: red;
    height: 200px;
    width: 200px;
}
.box h1 {
    color: white;
    font-size: 3.5em;
    text-align: center;
}
.box h2 {
    color: black;
    font-size: 2.5em;
    text-align: center;
}
</style>
<body id="page-top">
<div class="wrap">
    <button id="alphBnt">Alphabetical</button>
    <button id="numBnt">Numerical</button>
    <div id="container">
      <div class="box">
        <h1>B<h1>
        <h2>10.35</h2>  
      </div>
    
      <div class="box">
        <h1>A<h1>
        <h2>100.05</h2>
      </div>
    
      <div class="box">
        <h1>D<h1>
        <h2>200</h2>  
      </div>
    
      <div class="box">
        <h1>C<h1>
        <h2>5,510.25</h2>
      </div>
    </div>
  </div>
<script type="text/javascript">
var $divs = $("div.box");

$('#alphBnt').on('click', function () {
    var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
        return $(a).find("h1").text() > $(b).find("h1").text();
    });
    $("#container").html(alphabeticallyOrderedDivs);
});

$('#numBnt').on('click', function () {
    var numericallyOrderedDivs = $divs.sort(function (a, b) {
        return $(a).find("h2").text() > $(b).find("h2").text();
    });
    $("#container").html(numericallyOrderedDivs);
});
</script> -->
<?php //include("include/footer.php"); ?>

<!DOCTYPE html>
<html lang="en">

	<head>	
		<meta charset="UTF-8">
  
		<!--jQuery-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  
		<!--css-->
  
		<style type="text/css">
      body{
        background: #eee;
        font-family: sans-serif;
      }
      
      .box{
        background: red;
        height: 200px;
        width: 200px;
      }
      .box h1{
        color: white;
        font-size: 3.5em;
        text-align: center;
      }
      
      .box h2{
        color: black;
        font-size: 2.5em;
        text-align: center;
      }
		</style>
    
		<title>Title of the document</title>
	</head>
  
<body>
  
  <div class="wrap">
    
    <button id="alphBnt">Alphabetical</button>
    
    <button id="numBnt">Numerical</button>
    
    <div class="box one">
      <h1>B<h1>
      <h2>10.35</h2>  
    </div>
    
    <div class="box two">
      <h1>C<h1>
      <h2>100.05</h2>
    </div>
    
    <div class="box three">
      <h1>D<h1>
      <h2>200</h2>  
    </div>
    
    <div class="box four">
      <h1>A<h1>
      <h2>5,510.25</h2>
    </div>
      
  </div>  

	<script>
	  
	  $(function(){
	    
	    var alpha = [];
	    var number = [];
	    
	    $('.box').each(function(){
	      
	      var alphaArr = [];
	      var numArr = [];
	      
	      alphaArr.push($('h1', this).text());
	      alphaArr.push($(this));
	      alpha.push(alphaArr);
	      alpha.sort();
	      
	      numArr.push($('h2', this).text());
	      numArr.push($(this));
	      number.push(numArr);
	      number.sort(function(a,b){
	        return a-b
	      });
	    })
	    
	    $('#alphBnt').on('click', function(){
	      $('.box').remove();
	      for(var i=0; i<alpha.length; i++){
	        $('.wrap').append(alpha[i][1]);
	      }
	    })
	    
	    $('#numBnt').on('click', function(){
	      $('.box').remove();
	      for(var i=0; i<number.length; i++){
	        $('.wrap').append(number[i][1]);
	      }
	    })
	    
	  })
	
	</script>
</body>

</html>