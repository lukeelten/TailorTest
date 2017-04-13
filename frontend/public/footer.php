<?php
ob_start();

require_once ("../vendor/autoload.php");

$headers = new \TailorTest\Frontend\LinkHeader("http://localhost:8100/");
$headers->addStylesheet("css/footer.css")
    ->sendHeaders();
?>
<footer class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p>Wir sind so geil.</p>
        </div>
    </div>
</footer>