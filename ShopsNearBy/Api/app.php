<?php
/**
 * Created by PhpStorm.
 * User: chadi
 */

require_once "../app/settings/conf.php";
require_once "../app/class/entities/User.php";
require_once "../app/class/entities/Shop.php";
require_once "../app/class/MysqlSing.php";
require_once "../app/class/Session.php";
require_once "../app/class/shopsController.php";

//prevent user from register while online
global $s;
$s=Session::getInstance();
$s->start(_ART_USER,_SECURE);

//get the request type
$request = filter_input(INPUT_POST,'REQUEST', FILTER_SANITIZE_SPECIAL_CHARS);
if($request==null)
    $request = filter_input(INPUT_GET,'REQUEST', FILTER_SANITIZE_SPECIAL_CHARS);

switch($request)
{
    case "signup" :
        {
            $user=array();
            $user[]= filter_input(INPUT_POST,'email', FILTER_SANITIZE_SPECIAL_CHARS);
            $user[]= password_hash(filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS),PASSWORD_DEFAULT);
            $user[]= filter_input(INPUT_POST,'location', FILTER_SANITIZE_SPECIAL_CHARS);
            if(ifNull($user))
                header("location: ../registration/index.php?r=errorSystem");

            $us=new User($user);
            $res=$us->saveMe();
            if($res ===true)
            {
                        global $s;
                        $s=Session::getInstance();
                        $s->start(_ART_USER,_SECURE);
                        $s->__set("User",$us);
                        $s->__set("CSRF",Session::newCSRF());
                        header("location:../");
            }elseif ($res === "Duplicate")
            {
                header("location: ../registration/index.php?r=duplicate");
                    break;
            }else
            {
                header("location: ../registration/index.php?r=errorSystem");
                break;
            }
        }
    case "like" :
        {
            $params = array();
            $params[] = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
            $params[] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            if (ifNull($params))
                die("false");

            if ($s->__get("CSRF") != $params[0])
                die("false");

            $user = $s->__get("User");
            shopsController::likeShop($params[1],$user->getEmail());
            die("true");
            break;
        }
    case "dislike" :
        {
            $params = array();
            $params[] = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
            $params[] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            if (ifNull($params))
                die("false");

            if ($s->__get("CSRF") != $params[0])
                die("false");

            $user = $s->__get("User");
            shopsController::dislikeShop($params[1],$user->getEmail());
            die("true");
            break;
        }
    case "remove" :
        {
            $params = array();
            $params[] = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
            $params[] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            if (ifNull($params))
                die("false");

            if ($s->__get("CSRF") != $params[0])
                die("false");

            $user = $s->__get("User");
            shopsController::removeFromLiked($params[1],$user->getEmail());
            die("true");
            break;
        }
    case "updatelocation" :
        {
            $params = array();
            $params[] = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
            $params[] = filter_input(INPUT_GET, 'location', FILTER_SANITIZE_SPECIAL_CHARS);

            if (ifNull($params))
                die("false");

            if ($s->__get("CSRF") != $params[0])
                die("false");

            if(strpos($params[1], 'null') === false)
                die('false');
            $s->__get("User")->updateLocation($params[1]);
            die("true");
            break;
        }
}


function ifNull($arr)
{
    if(is_null($arr))
        return true;

    foreach ($arr as $a)
        if(is_null($a) || !isset($a)|| $a === "" )
            return true;
    return false;
}
