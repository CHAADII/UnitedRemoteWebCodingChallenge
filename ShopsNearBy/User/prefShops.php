<?php
/**
 * Created by PhpStorm.
 * User: chadi
 */
require_once __DIR__ . '/../app/settings/conf.php';
require_once __DIR__ . "/../app/class/MysqlSing.php";
require_once __DIR__ . "/../app/class/Session.php";
require_once __DIR__ . "/../app/class/shopsController.php";
require_once "../app/class/entities/User.php";
require_once "../app/class/entities/Shop.php";

global $s;
$s = Session::getInstance();
$s->start(_ART_USER);

$USER_EXISTS = true;
if (!$s->__isset("User"))
    header("location: ../");


$user = $s->__get("User");

shopsController::getPreferedShops($user->getEmail());


$SortedShops = shopsController::sortShops($user->getLat(), $user->getLon());
if(count($SortedShops)==0)
    die("<h1>No Shops Liked Yet</h1>");
?>

<div class="col-md-12 " id="errorlog">

</div>

<?php foreach ($SortedShops as $shop){?>
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header text-center progress-bar progress-bar-striped progress-bar-animated"
                 role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <?= $shop->getTitl() ?>
            </div>
            <div class="card-body text-center">
                <span class="fa fa-shopping-cart fa-4x"></span>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <button href="#" class="btn btn-danger col" onclick="remove('<?= $shop->getId() ?>')">Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }?>
