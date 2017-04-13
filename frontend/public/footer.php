<?php
ob_start();

require_once ("../vendor/autoload.php");

$headers = new \TailorTest\Frontend\LinkHeader("http://localhost:8100/");
$headers->addStylesheet("css/footer.css")
    ->sendHeaders();
?>
<footer class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-body">
            This is the site footer
        </div>
    </div>
</footer>