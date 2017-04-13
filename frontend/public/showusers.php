<?php
ob_start();

require_once ("../vendor/autoload.php");

$headers = new \TailorTest\Frontend\LinkHeader("http://localhost:8100/");
$headers->addStylesheet("css/main.css")
    ->addStylesheet("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", false)
    ->addScript("https://code.jquery.com/jquery-3.2.1.min.js", false)
    ->addScript("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js", false)
    ->addScript("js/script.js")
    ->sendHeaders();

$client = new \TailorTest\Frontend\UserClient();

$users = $client->getAll();
?>
<main class="container-fluid">
    <?php
    foreach ($users as $user): ?>
        <div class="row">
            <div class="col-xs-12">
                <h3><?= $user["username"] ?></h3>
                <p><?= $user["mail"] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</main>
