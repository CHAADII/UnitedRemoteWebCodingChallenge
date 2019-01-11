<?php
/**
 * Created by PhpStorm.
 * User: chadi
 * Date: 06/01/19
 * Time: 13:00
 */

require "../app/settings/conf.php";
require "../app/class/entities/User.php";
require "../app/class/MysqlSing.php";
require "../app/class/Session.php";

$username = filter_input(INPUT_POST,'Email', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($username) && $username != null && isset($password) && $password != null)
{
    $username=strtolower($username);
    //var_dump($_POST);
    MysqlSing::getInstance();
    $stm=MysqlSing::$con->prepare("SELECT * FROM `user` WHERE user.Email= ?");
    $stm->execute([$username]);

    if($stm->rowCount()==0)
        die("false");

    $arr = $stm->fetchAll(PDO::FETCH_BOTH);
    if(!password_verify($password,$arr[0]["password"]))
        die("false");

    $s=Session::getInstance();
    $s->start(_ART_USER,_SECURE);
    $s->__set("User",new User($arr[0]));
    $s->__set("CSRF",Session::newCSRF());
    die("true");
}else
    {
        die("false");
    }