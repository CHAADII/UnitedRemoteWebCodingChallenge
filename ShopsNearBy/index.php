<?php
/**
 * Created by PhpStorm.
 * User: chadi
 */
require_once __DIR__ . '/app/settings/conf.php';
require_once __DIR__ . "/app/class/MysqlSing.php";
require_once __DIR__ . "/app/class/Session.php";

global $s;
$s=Session::getInstance();
$s->start(_ART_USER,_SECURE);

$USER_EXISTS=false;
if($s->__isset("User"))
    $USER_EXISTS=true;


?>

<html>
<head>
    <title>Shops Nearby</title>
    <script src="<?=$_paths['assets'];?>js/tools.js"></script>
<?php require "prefabs/head.php"; ?>
</head>
<body>

<!--NAVBAR-->
<?php require "prefabs/nav.php"; ?>
<!--END NAVBAR-->
<!--MAIN CONTAINER-->
<div class="container-fluid" >
    <div class="row " id="contents">
       <?php if($USER_EXISTS){?>
        <script>
            showShops("");
        </script>
        <?php }?>
    </div>
</div>
</body>
<?php require "prefabs/models.php"; ?>
</html>
