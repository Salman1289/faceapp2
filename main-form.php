
<?php 
session_start();
require_once 'Facebook/autoload.php';
require_once 'connection.php';
$fb = new \Facebook\Facebook([
  'app_id' => '1160202704127286',
  'app_secret' => 'a4451d8de8a3c43b4d2f8f90982649f1',
  'default_graph_version' => 'v3.2',
]);
   $permissions = []; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $_SESSION['fb_access_token'];
   
if (isset($accessToken)) {
	
 		// $url = "https://graph.facebook.com/v2.6/me?fields=id,name,gender,email,picture,location,cover&access_token={$accessToken}";
		
		$url = "https://graph.facebook.com/v3.2/me?fields=id,name,email,location&access_token={$accessToken}";
		$headers = array("Content-type: application/json");
		
			 
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		 curl_setopt($ch, CURLOPT_URL, $url);
	         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		 curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		   
		 $st=curl_exec($ch); 
		 $result=json_decode($st,TRUE);
		 $user_name = $result['name'];
		 // print_r($result);
		 // exit;
		 
		
} else {
	$loginUrl = $helper->getLoginUrl('https://www.mindlogicsinc.com/faceapp/main-form.php', $permissions);
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Wedding Countdown</title>
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Homemade+Apple" rel="stylesheet">


<!-- =================== for date picker ================== -->
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- ======================== end for date picker ================= -->

    <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      showWeek: true,
      firstDay: 1
    });
  } );
  </script>
<!-- <script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script> -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script src="https://www.mindlogicsinc.com/faceapp/js/jquery.countdown.js"></script>
<script>


	$(document).ready(function(){
	
$.ajax({

	url : 'check-user.php', // your php file
   type : 'POST',
   data : {'check-user': 'user'},  
        success: function(data) {  
        	 // alert(data);
        	// data = json_decode(data,TRUE);
        	 if(data == "Yes"){
        	  $(location).attr('href', 'https://www.mindlogicsinc.com/faceapp/shared-page.php');
        	 }

              // console.log(data);

        }  
});

// for showing the name of uploaded files after buttons. the buttons are custom styled 
$('#proposal-img').change(function() {
  // var i = $(this).prev('label').clone();
  var file = $('#proposal-img')[0].files[0].name;
  $('#name-span').text(file);
});

$('#ring-img').change(function() {
  // var i = $(this).prev('label').clone();
  var file = $('#ring-img')[0].files[0].name;
  $('#name-span2').text(file);
});


// for image validation

// $('#preview-input,#submit-input').click(function(){
	
// var upload_text ="";
// var inp = document.getElementById('proposal-img');
//     if(inp.files.length === 0){
    	
//         upload_text = "Please upload proposal image";
//         inp.focus();
         
//     }else{
//     	var inp = document.getElementById('ring-img');
//     	if(inp.files.length === 0){
    	
//         upload_text = "Please upload ring image";
//         inp.focus();
        
//     }
// }
// if(upload_text != ""){
// 	alert(upload_text);return false;
// }
// });
// $('.timepicker').timepicker();

});


 </script>
<script src="js/jquery-clock-timepicker.min.js"></script>
<script>
		$(document).ready(function(){
	$('#timepicker').clockTimePicker();
});
</script>
</head>

<body>
	<style type="text/css">
	.form-main-div{
		background: url(images/countdown-details-bg.png);
		background-repeat: no-repeat;
				width: 485px;
				height: 522px;
				padding: 20px;
		/*margin: 0 auto;*/
		    /*padding-top: 40px;
    padding-bottom: 40px;*/

		/*background-position: 0 50%;*/
	}
		.form-main-div .heading-logo{
			max-width: 100%;
			background-color: #033649;
			padding-top: 10px;
    padding-left: 7%;
    padding-bottom: 7px;
		}
		.form-main-div  .heading-logo h1 img{
			position: relative;
			position: relative;
    left: 8px;
		}
		.form-main-div .inner-texts {
			padding-left: 20px;
			color: #033649;
			/*padding-left: 10%;*/
			font-family: 'Lato', sans-serif;
			padding-top: 15px;
		}
		.form-main-div  .inner-texts h3{
			    text-transform: uppercase;
			        margin-bottom: 12px;
    font-size: 17px;
    text-transform: uppercase;
    font-weight: 800;
		}
		.form-main-div .wedding-form ul{
			padding: 0px;
			margin-top: 3px;
		}
     .form-main-div .wedding-form ul li{
     	display: inline-block;
     	width: 44%;
     	margin-right: 25px;
     }
     .form-main-div .wedding-form ul li input{
         max-width: 100%;
    border: none;
    background: transparent;
    border-bottom: 1px solid #1d5b71;
        font-size: 15px;
            padding: 6px 0px;
            color: #1d5b71;
            font-weight: bold;
                outline: none;
}
.form-main-div .wedding-form .location input,.form-main-div .wedding-form .shared-person input,.names-div input{
         max-width: 100%;
    border: none;
    background: transparent;
    border-bottom: 1px solid #1d5b71;
        font-size: 15px;
            padding: 6px 0px;
            color: #1d5b71;
            font-weight: bold;
                outline: none;
                width: 96%;
}
.form-main-div .wedding-form ul li input::placeholder {
  color: #1d5b71;
 
}
.form-main-div .wedding-form input::placeholder {
  color: #1d5b71;
 
}

.form-main-div  .inner-texts p{
			margin-top: 0px;
			font-size: 17px;
			font-weight: bold;
		}
		.inner-texts p:nth-of-type(2){
			padding-top: 5px;
		}
		.form-main-div .picture-buttons {
    padding-top: 20px;
    width: 100%;
    display: inline-block;
    margin-bottom: 6px;
}
.form-main-div .picture-buttons div{
	width: 50%;
	float: left;
}
.form-main-div .picture-buttons div p{
	    font-size: 16px;
    font-weight: 600;
    margin-bottom: 2px;
    display: inline-block;
    width: 100%;
}
.form-main-div .picture-buttons div #name-span,.form-main-div .picture-buttons div #name-span2{
	margin-left: 0px;
	font-size: 13px;
	display: block;
}
.form-main-div .location{
	padding-top: 0px;
}
.form-main-div .location p,.names-div p{
	margin-bottom: 5px;
}
.form-main-div .picture-buttons div label{
	    padding: 10px 33px;
    border: 1px solid #1d5b71;
    border-radius: 2px;
    color: #1d5b71;
}
.form-main-div .picture-buttons div label:hover{
	cursor: pointer;
}
.form-main-div .wedding-checkmark{
	    float: left;
    margin-top: 14px;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0px;
    /*line-height: 20px;*/
}
.form-main-div .wedding-submit{
	    display: inherit;
    float: left;
    padding-top: 30px;
}
.form-main-div .wedding-submit input{
	       padding: 16px 50px;
	    border-radius: 2px;
	    border:none;
	    color: #ff9800;
	    background-color: #1d5b71;
	    cursor: pointer;
	        margin-right: 15px;
    font-size: 14px;
    text-transform: uppercase;
}
.form-main-div .location-person{
	width: 100%;display: block;
}
.form-main-div .location-person .location{
	width: 100%;
	float: left;
}
.form-main-div .location-person .shared-person{
	width: 38%;
	float: right;
}
.form-main-div .location-person .shared-person p{
	margin-bottom: 5px;
}
.names-div div {
    width: 50%;
    float: left;
}
.names-div{
	display: inline-block;
	margin-bottom: 5px;
	width: 100%;
}

	</style>
<?php

if(isset($_POST['couple-preview'])){

	 $user_id = $result['id'];

	 $user_name = $result['name'];

	 $user_email = $result['email'];

// echo $_FILES['proposal-pic']['name'];
// echo "-".$_FILES['ring-pic']['name'];
	 // to uplaod proposal image
if($_FILES['proposal-pic']['name']!=''){

		$current_image =$_FILES['proposal-pic']['name'];

	    $extension = substr(strrchr($current_image, '.'), 1);

if (($extension!= "jpg") && ($extension != "jpeg") && ($extension != "gif") && ($extension != "png") && ($extension != "bmp")) 

{

die('Please upload only image, other files are not allowed.');

}

$time = date("fYhis");

$new_image_proposal = $time ."_poposal." . $extension;

$destination_proposal="uploads/".$new_image_proposal;

$action = copy($_FILES['proposal-pic']['tmp_name'], $destination_proposal);

if($action){

	 $sql = "INSERT INTO images (user_id, image_name, image_type)

VALUES ('".$user_id."', '".$new_image_proposal."', 'proposal')";

if ($conn->query($sql) === TRUE) {

	$proposal_image = $current_image;

    echo "proposal image is added successfully";

}

}

if (!$action)

{

die('Proposal..File copy error! Please try again!!');

}

}else{
	if(isset($_SESSION['user-preview'])){

		$proposal_image = $_SESSION['user-preview']['wedding-proposal'];

		$destination_proposal=$_SESSION['user-preview']['wedding-proposal-path'];

	}
}
// to upload ring image
if($_FILES['ring-pic']['name']!=''){

		$current_image =$_FILES['ring-pic']['name'];

	    $extension = substr(strrchr($current_image, '.'), 1);

if (($extension!= "jpg") && ($extension != "jpeg") && ($extension != "gif") && ($extension != "png") && ($extension != "bmp")) 

{

die('Please upload only image, other files are not allowed.');

}

$time = date("fYhis");

$new_image_ring = $time."_ring." . $extension;

$destination_ring="uploads/".$new_image_ring;

$action = copy($_FILES['ring-pic']['tmp_name'], $destination_ring);

if($action){

	 $sql = "INSERT INTO images (user_id, image_name, image_type)
VALUES ('".$user_id."', '".$new_image_ring."', 'ring')";

if ($conn->query($sql) === TRUE) {

	$ring_image = $current_image;

    echo "Ring image is added successfully";
}

}

if (!$action)

{

die('Ring .. File copy error! Please try again!!');

}

}else{

	if(isset($_SESSION['user-preview'])){

		$ring_image = $_SESSION['user-preview']['wedding-ring'];

		$destination_ring = $_SESSION['user-preview']['wedding-ring-path'];

	}
}
	// $first_name = $_POST['first-name'];
	// $second_name = $_POST['second-name'];
	// $wedding_month = $_POST['wedding-month'];
	 $wedding_date = $_POST['wedding-date'];
	 // $wedding_year = $_POST['wedding-year'];
	 // $wedding_hour = $_POST['wedding-hour'];
	  $wedding_time = $_POST['wedding-time'];

 	 $wedding_location = $_POST['wedding-location'];

	 $wedding_person = $_POST['wedding-person'];

	$wedding_countdown_checkbox = $_POST['countdown-checkbox'];
	// echo $wedding_countdown_checkbox;exit;
// creating ession for preview
 $user_data = array(
        'user-name'=>$user_name,

        'user-id'=>$user_id,

        'wedding-date'=>$wedding_date,

        'wedding-location'=>$wedding_location,

        'wedding-person'=>$wedding_person,

        'wedding-time'=>$wedding_time,

        'wedding-checkbox'=>$wedding_countdown_checkbox,

        'wedding-ring'=>$ring_image,

        'wedding-proposal'=>$proposal_image,

        'wedding-proposal-path'=>$destination_proposal,

        'wedding-ring-path'=>$destination_ring,
        
    );

    $_SESSION['user-preview']= $user_data;

    // print_r($_SESSION['user-preview']);
  
     if(isset($_SESSION['user-preview'])){
    	
     	echo "<script>window.location.href = 'shared-page.php';</script>";
     }
     // print_r($_SESSION['user-preview']);


}



// form data will go here
if(isset($_POST['couple-submit'])){

	// echo $_FILES['proposal-pic']['name'];

	// echo $_FILES['ring-pic']['name']; exit;
	 // $wedding_month = $_POST['wedding-month'];

	 $wedding_date = $_POST['wedding-date'];

	 // $wedding_year = $_POST['wedding-year'];

	 // $wedding_hour = $_POST['wedding-hour'];

	 $wedding_time = $_POST['wedding-time'];

 	 $wedding_location = $_POST['wedding-location'];

	 $wedding_person = $_POST['wedding-person'];

	 $wedding_countdown_checkbox = $_POST['countdown-checkbox'];
	 
	 $user_id = $result['id'];

	 $user_name = $result['name'];

	 $user_email = $result['email'];

// checking user_id in users table
$query = mysqli_query($conn, "SELECT * FROM users WHERE user_id='".$user_id."'");

    if (!$query)
    {
        die('Error: ' . mysqli_error($con));
    }

if(mysqli_num_rows($query) > 0){

    echo "Your data is already taken and is saved in the App!!";

}else{
// if user email id does not exists in database
   $sql = "INSERT INTO users (user_id, user_email, user_name)
 VALUES ('".$user_id."', '".$user_email."', '".$user_name."')";

if ($conn->query($sql) === TRUE) {

    // echo "New record created successfully";
// now inserting record in wedding table after the creation of user
  $sql = "INSERT INTO wedding_data (wed_date, wed_time, user_id, shared_person_id, location,wedding_countdown)
 VALUES ('".$wedding_date."','".$wedding_time."','".$user_id."','".$wedding_person."','".$wedding_location."','".$wedding_countdown_checkbox."')";

if ($conn->query($sql) === TRUE) {

echo "wedding data inserted successfully";
	


}


} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}

// $conn->close();

}
// to uplaod proposal image
if($_FILES['proposal-pic']['name']!=''){

		$current_image =$_FILES['proposal-pic']['name'];

	    $extension = substr(strrchr($current_image, '.'), 1);

if (($extension!= "jpg") && ($extension != "jpeg") && ($extension != "gif") && ($extension != "png") && ($extension != "bmp")) 
{
die('Please upload only image, other files are not allowed.');
}
$time = date("fYhis");

$new_image = $time ."_poposal." . $extension;

$destination="uploads/".$new_image;

$action = copy($_FILES['proposal-pic']['tmp_name'], $destination);

if($action){

$query = mysqli_query($conn, "SELECT * FROM images WHERE user_id='".$user_id."' AND image_type = proposal");

if(mysqli_num_rows($query) > 0){

	

     $sql = "UPDATE images SET image_name ='".$new_image."' WHERE id = '".$user_id."' AND image_type = proposal";

     if ($conn->query($sql) === TRUE) {

    echo "proposal image is updated successfully";
}

}

else

{


$sql = "INSERT INTO images(user_id, image_name, image_type)
VALUES('".$user_id."', '".$new_image."', 'proposal');";
if ($conn->query($sql) === TRUE) {

    echo "proposal image is added successfully";
    
}else{

	die('Error: ' . mysqli_error($con));

}

}

}

if (!$action)

{

die('File copy error! Please try again!!');

}

}

// to upload ring image
if($_FILES['ring-pic']['name']){

		$current_image =$_FILES['ring-pic']['name'];

	    $extension = substr(strrchr($current_image, '.'), 1);

if (($extension!= "jpg") && ($extension != "jpeg") && ($extension != "gif") && ($extension != "png") && ($extension != "bmp")) 
{

die('Please upload only image, other files are not allowed.');

}

$time = date("fYhis");

$new_image = $time."_ring." . $extension;

$destination="uploads/".$new_image;

$action = copy($_FILES['ring-pic']['tmp_name'], $destination);

if($action){

$query = mysqli_query($conn, "SELECT * FROM images WHERE user_id='".$user_id."' AND image_type = ring");

if(mysqli_num_rows($query) > 0){

     $sql = "UPDATE images SET image_name ='".$new_image."' WHERE id = '".$user_id."' AND image_type = ring";

     if ($conn->query($sql) === TRUE) {

    echo "ring image is updated successfully";
}

}else{

$sql = "INSERT INTO images (user_id, image_name, image_type)
VALUES ('".$user_id."', '".$new_image."', 'ring');";

if ($conn->query($sql) === TRUE) {

    echo "Ring image is added successfully";
}

}

}

if (!$action)

{

die('File copy error! Please try again!!');

}

}
// ==================== End Images =====================

		if(isset($_SESSION['user-preview'])){
 
   unset($_SESSION['user-preview']);
									
									}
}

?> 
<div class="form-main-div">
	<!-- <div class="heading-logo">
		<img src="images/countdown-details-logo.png">	
	</div> -->
	<div class="inner-texts">
		<!-- <h3>Create your facebook wedding counterdown:</h3> -->
		
		<!-- <form class="wedding-form" enctype="multipart/form-data" method="post" onSubmit="return validate();"> -->
			<form class="wedding-form" enctype="multipart/form-data" method="post">

				<div class="names-div">

					<div class="first-name">

					<p>Your First Name</p>

					<input type="text" name="first-name" placeholder="" value="<?php if(isset($_SESSION['user-preview'])){echo $_SESSION['user-preview']['user-name'];}else{ echo $user_name;}?>" required="required">

				</div>

				<div class="second-name">

					<p>Your Second Half Name</p>

				<!-- 	<input type="text" name="second-name" placeholder="" value="<?php echo $_SESSION['user-preview']['second-name'];?>" required="required"> -->
				
				<input type="text" name="wedding-person" placeholder="" value="<?php echo $_SESSION['user-preview']['wedding-person'];?>" required="required">

				</div>

				
				</div>


				<p>Enter Your wedding Date and Time:</p>

		<ul>

			<li><input type="text" id="datepicker" name="wedding-date" placeholder="Date" value="<?php echo $_SESSION['user-preview']['wedding-date'];?>" required="required"></li>
			
			<li><input type="text" id="timepicker" name="wedding-time" placeholder="Time" value="<?php echo $_SESSION['user-preview']['wedding-time'];?>" required="required"></li>
			
			<!-- <li><input type="text" name="wedding-year" placeholder="Year" value="<?php echo $_SESSION['user-preview']['wedding-year'];?>" required="required"></li>
			
			<li><input type="text" name="wedding-hour" placeholder="Hour" value="<?php echo $_SESSION['user-preview']['wedding-hour'];?>" required="required"></li>
			
			<li><input type="text" name="wedding-min" placeholder="Min" value="<?php echo $_SESSION['user-preview']['wedding-minute'];?>" required="required"></li> -->
		
		</ul>
		
		<div class="location-person">
		
		<div class="location">
		
		<p>Add your Wedding Venu Location</p>
		
		<input type="text" name="wedding-location" placeholder="Location" value="<?php echo $_SESSION['user-preview']['wedding-location'];?>" required="required">
	
	</div>
	<!-- 
	<div class="shared-person">
		
		<p>Wedding Person</p>
		
		<input type="text" name="wedding-person" placeholder="Person" value="<?php echo $_SESSION['user-preview']['wedding-person'];?>" required="required">
	</div> -->

</div>
	
	<div class="picture-buttons">
		<!-- <div><span>Proposal Picture:</span><br><label class="custom-file-upload">
    <input type="file" accept="image/*" name="proposal-pic" style="display: none;" />Browse</label></div> -->
    <div>

    	<p>Proposal Picture:</p>

    	<span id="name-span">

    		<?php echo $_SESSION['user-preview']['wedding-proposal'];?>

    </span>

    <br>

    <label class="custom-file-upload">

    <input type="file" id="proposal-img" accept="image/*" name="proposal-pic" style="display: none;" />Browse</label>

</div>
		<div>

			<p>Ring Picture:</p>

			<span id="name-span2">

				<?php echo $_SESSION['user-preview']['wedding-ring'];?>

    </span><br><label class="custom-file-upload">

    <input type="file" id="ring-img" accept="image/*" name="ring-pic" style="display: none;" />Browse</label>

</div>

	<!-- 	<div class=""><span>Proposal Picture:</span><br><input type="file" name="ring-pic" accept="image/*"></div> -->
	</div>

	<div class="wedding-checkmark">

		<input type="checkbox" name="countdown-checkbox" checked="checked">

		<span>Add my wedding clock countdown to DiamondBLVSD's Upcomming Weddings</span>

	</div>

	<div class="wedding-submit">

		<input type="submit" id="preview-inputs" name="couple-preview" value="Preview">

		<input type="submit" id="submit-inputs"  name="couple-submit" value="Submit">

	</div>

		</form>

	</div> 

</div>

</body>

</html>