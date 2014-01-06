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
<?php

common_footer();

