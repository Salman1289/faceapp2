
<?php 
session_start();
require_once 'Facebook/autoload.php';
require_once 'connection.php';
$fb = new \Facebook\Facebook([
  'app_id' => '1160202704127286',
  'app_secret' => 'a4451d8de8a3c43b4d2f8f90982649f1',
  'default_graph_version' => 'v2.10',
]);
   $permissions = []; 
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $_SESSION['fb_access_token'];
   
if (isset($accessToken)) {
		
		$url = "https://graph.facebook.com/v2.6/me?fields=id,name,email,location&access_token={$accessToken}";
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
		 // $user_email = $result['email']; user email is not being fetched at frontend
		 
$user_id = $result['id'];
$user_name = $result['name'];
$sql = "SELECT * FROM wedding_data where user_id = $user_id";  
$result = mysqli_query($conn, $sql);

$data = array();

// session is set when user is previewing
if(isset($_SESSION['user-preview'])){
	// $wedding_month = $_SESSION['user-preview']['wedding-month'];
	$wedding_date = $_SESSION['user-preview']['wedding-date'];
	// $wedding_year = $_SESSION['user-preview']['wedding-year'];
	// $wedding_hour = $_SESSION['user-preview']['wedding-hour'];
	$wedding_time = $_SESSION['user-preview']['wedding-time'];
	$wedding_location = $_SESSION['user-preview']['wedding-location'];
	$wedding_person = $_SESSION['user-preview']['wedding-person'];
	$user_id = $_SESSION['user-preview']['user-id'];
	$user_name = $_SESSION['user-preview']['user-name'];
	$proposal_image = $_SESSION['user-preview']['wedding-proposal'];
	$ring_image = $_SESSION['user-preview']['wedding-ring'];
	$proposal_image_path = $_SESSION['user-preview']['wedding-proposal-path'];
	$ring_image_path = $_SESSION['user-preview']['wedding-ring-path'];
	// $user_name_default = $result['name'];


	 $a = array("wedding-date"=>$wedding_date,"wedding-time"=>$wedding_time,"user-id"=>$user_id,"shared-person-id"=>$wedding_person,"wedding-location"=>$wedding_location,"user-name" =>$user_name,"wedding-proposal"=>$proposal_image,"wedding-ring"=>$ring_image,"wedding-proposal-path"=>$proposal_image_path,"wedding-ring-path"=>$ring_image_path);
    array_push($data, $a);
}else{
	// this is code when user submits the data for saving, for it the session $_SESSION['user-preview'] must be destroyed
 	while($enr = mysqli_fetch_assoc($result)){
   $a = array("id"=>$enr['id'],"wedding-date"=>$enr['wed_date'],"wedding-time"=>$enr['wed_time'],"user-id"=>$enr['user_id'],"shared-person-id"=>$enr['shared_person_id'],"wedding-location"=>$enr['location'],"user-name" =>$user_name);
    array_push($data, $a);
 }

}
// username in the above array is added by custom
echo json_encode($data); // sending data back to the file shared page

// for the background image of shared-page
if(isset($_POST['proposal-path'])){
$sql = "SELECT * FROM images where image_type='proposal' and user_id = $user_id";  
$result = mysqli_query($conn, $sql);

$data_image = array();
while($enr_image = mysqli_fetch_assoc($result)){
    $a = array("id"=>$enr_image['id'],"image-name"=>$enr_image['image_name'],"image-type"=>$enr_image['image_type']);
    array_push($data_image, $a);
}

echo json_encode($data_image); // sending data back to the file shared page
}

// for the ring image of shared-page
if(isset($_POST['proposal-path'])){
$sql = "SELECT * FROM images where image_type='ring' and user_id = $user_id";  
$result = mysqli_query($conn, $sql);

$data_image_ring = array();
while($enr_image = mysqli_fetch_assoc($result)){
    $a = array("id"=>$enr_image['id'],"image-name"=>$enr_image['image_name'],"image-type"=>$enr_image['image_type']);
    array_push($data_image_ring, $a);
}

echo json_encode($data_image_ring); // sending data back to the file shared page
}

// ================= for checking the user exists before or not =============

		
} else {
	$loginUrl = $helper->getLoginUrl('https://www.mindlogicsinc.com/faceapp/main-form.php', $permissions);
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
}
