<?php
@include("./config.php");

if (empty($_SERVER['HTTPS']) && !constant('GITHUB_DEV')) {
    $host = preg_replace('/\s/', '', $_SERVER['HTTP_HOST']);
    header("Location: https://$host/pulls/");
    exit;
}

include("../include/functions.php");
include("../include/release-qa.php");

$TITLE = "PHP-QA: GitHub Pull Requests";
$SITE_UPDATE = date("D M d H:i:s Y T", filectime(__FILE__));

$extra_headers = array(
	'<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular.min.js"></script>',
	'<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-route.min.js"></script>',
	'<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-resource.js"></script>',
);
common_header($extra_headers);

?>
<script type="text/javascript">
  var GITHUB_BASEURL = <?php echo json_encode(GITHUB_BASEURL); ?>;
  var GITHUB_ORG     = <?php echo json_encode(GITHUB_ORG); ?>;
  var API_URL        = "api.php";
</script>
<h1>Github Pull Requests</h1>
<?php
if (constant('GITHUB_DEV')) {
    echo '<div style="width: 100%; border: 2px solid green; padding:10px;"><b>Notice:</b> Running in development mode</div><br>';
}

if (!getenv('AUTH_TOKEN')) {
    echo '<div style="width: 100%; border: 2px solid red; padding:10px;"><b>Error:</b> AUTH_TOKEN not set</div><br>';
}

if (!constant('GITHUB_TOKEN')) {
    echo '<div style="width: 100%; border: 2px solid red; padding:10px;"><b>Error:</b> config.php not configured correctly.</div><br>';
    common_footer();
    exit;
}
?>
<script src="js/app.js"></script>
<script src="js/controllers.js"></script>
<script src="js/services.js"></script>

<div ng-app="pullsApp">
<div ng-controller="UserCtrl">
<div ng-show="!user.username">
	<form ng-submit="doLogin()">
		Username: <input ng-model="loginuser"> Password: <input ng-model="loginpassword" type="password"><input type="submit" value="Login">
	</form>
</div>
<div ng-show="user.username">
        Welcome {{user.username}}!
</div>
</div>

<div ng-view></div>
</div>

<?php

//common_footer();

