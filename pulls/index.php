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

common_header();

?>
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
$JS = array(
  '//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular.min.js',
  '//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-route.min.js',
  '//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-resource.js',
  '/../pulls/js/app.js',
  '/../pulls/js/controllers.js',
  '/../pulls/js/services.js',
  '/../pulls/js/user.js',
);
common_footer($JS);
?>
<script type="text/javascript">
var pullsConfig = angular.module('pullsConfig', []);

pullsConfig.factory('Config', [function () {
  return {
    github: {
      baseurl: <?php echo json_encode(GITHUB_BASEURL); ?>,
      org:     <?php echo json_encode(GITHUB_ORG); ?>,
    },
    api: "api.php"
  };
}]);
</script>
