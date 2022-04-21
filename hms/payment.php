<?php
session_start();


//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

$now=date('Y-m',strtotime('+1 month'));





$specilization=$_SESSION["Doctorspecialization"];
  $doctorid=$_SESSION["doctorid"];
  $userid=$_SESSION["userid"];
  $fees=$_SESSION["fees"];
  $appdate=$_SESSION["appdate"];
  $time=$_SESSION['time'];
  $userstatus=$_SESSION['userstatus'];
  $docstatus=$_SESSION['docstatus'];


  

  

if(isset($_POST['submit'])){
  echo "hlo";

// define variables to empty values  
$nameErr = $cnumErr = $cvvErr  = "";  
$name = $cnum = $cvv = "";  
  
//Input fields validation  
//if ($_SERVER["REQUEST_METHOD"] == "POST")
$success=1;{
    //String Validation  
  if (empty($_POST["cardname"])) 
    {  
      $nameErr = "Name is required"; 
      $success=0;

    } 
  else 
    {
        $name = input_data($_POST["cardname"]);  
        
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
        {  
           $nameErr = "Only alphabets and white space are allowed";
           $success=0;  
        }  
    }  
      
    
    
  //Card Number Validation  
  if (empty($_POST["cardnumber"])) 
  {  
    $cnumErr = "Card no is required";  
    $success=0;
  } 
  else
  {  
     $cnum = input_data($_POST["cardnumber"]);  
      // check if card no is well-formed  
      if (!preg_match ("/^[0-9]*$/", $cnum))
      {  
        $cnumErr = "Only numeric value is allowed.";
        $success=0;  
      }  
      //check card no length should not be less and greator than 16 
      if (strlen ($cnum) != 16) 
      {  
        $cnumErr = "Card no must contain 16 digits.";  
        $success=0;
      }  
  }  


  //CVV Number Validation  
  if (empty($_POST["cvv"])) 
  {  
    $cvvErr = "CVV no is required";  
    $success=0;
  } 
  else
  {  
    $cvv = input_data($_POST["cvv"]);  
    // check if mobile no is well-formed  
    if (!preg_match ("/^[0-9]*$/", $cvv) ) 
    {  
      $cvvErr = "Only numeric value is allowed."; 
      $success=0; 
    }  
    //check CVV no length should not be less and greator than 3 
    if (strlen ($cvv) != 3) 
    {  
      $cvvErr = "CVV must contain 3 digits.";  
      $success=0;
    }  
     
  }
  echo $success; 
  if($success==1)
  {
    $query=mysqli_query($con,"insert into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus')");
	if($query)
	{
		
		echo "<script>alert('Your appointment is booked successfully');</script>";
    
		$ready=1;
	}
  /*if($ready)
  {
    header("Location: book-appointment.php");
  }*/
  
  }
  
  
}}

  
   


function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
}  



?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User  | Book Appointment</title>
	
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<script>
function getdoctor(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'specilizationid='+val,
	success: function(data){
		$("#doctor").html(data);
	}
	});
}
</script>	


<script>
function getfee(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'doctor='+val,
	success: function(data){
		$("#fees").html(data);
	}
	});
}
</script>

<style>
  .error {color: #FF0001;
  font-size:20px;}  
  .row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
/*@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}*/
</style>

</head>
<body>
	<div id="app">		
	<?php include('include/sidebar.php');?>
		<div class="app-content">				
			<?php include('include/header.php');?>
				<!-- end: TOP NAVBAR -->
			<div class="main-content" >
				<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">User | Book Appointment</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>User</span>
								</li>
								<li class="active">
									<span>Book Appointment</span>
								</li>
							</ol>
					</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">									
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
										<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Book Appointment</h5>
												</div>
											<div class="panel-body">
												<p style="color:red;"><?php echo htmlentities($_SESSION['msg1']);?>
												<?php echo htmlentities($_SESSION['msg1']="");?></p>	
												<form role="form" name="pay" method="post" action="">
                        <h3>Payment Rs. <?php echo $fees;?></h3>
                        <span class = "error">* required field </span>
                        <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                      </div>
            <label for="cname" >Name on Card *</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" >
            <span class="error"> <?php echo $nameErr; ?> </span>    
            <label for="ccnum" >Enter card number *</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <span class="error"> <?php echo $cnumErr;?></span>

            <div class="row">
              <div class="col-50">
              <label for="expmonth" >Expiry Month/Year *</label>
              <input type="month" id="expmonth" name="expmonthyear" min="<?php echo $now?>" value="2018-05" >
              </div>
              <div class="col-50">
                <label for="cvv" >CVV *</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
                <span class="error"> <?php echo $cvvErr;?></span>
              </div>
            </div>
          </div>

        </div>
       
        <input type="submit" Value="Continue to Pay" name="submit" class="btn">
      </form>

											</div>
										</div>
									</div>
								
								</div>
							</div>
									
						</div>
					</div>
							
						<!-- end: BASIC EXAMPLE -->
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
				</div>
			</div>
	</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});

			$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
		</script>
		  <script type="text/javascript">
            $('#timepicker1').timepicker();
        </script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

	</body>
</html>
