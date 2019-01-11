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
$t = "";
$icon = "check";
if (isset($_GET["acc"])) {
    shopsController::getAllShops(false);
    $t = "change";
    $icon = "window-close";
} else {
    shopsController::getAllShops();
}

$SortedShops = shopsController::sortShops($user->getLat(), $user->getLon());
?>
<div class="col-md-6 my-2">
    <button class="btn btn-primary" onclick="showShopsWithoutAcceptedones('<?= $t ?>');">
        <span class="fa fa-<?= $icon ?> "></span>
         Hide Liked Shops
    </button>

</div>
<div class="col-md-6 " id="errorlog"> </div>
<div class="col-md-12 " >
<div class="row">
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
                        <button href="#" class="btn btn-danger col" onclick="dislike('<?= $shop->getId() ?>')">DisLike
                        </button>
                    </div>
                    <div class="col-sm-6">
                        <button href="#" class="btn btn-success col" onclick="like('<?= $shop->getId() ?>')">Like
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }?>
</div>
</div>
