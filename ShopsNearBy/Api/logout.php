<?php
/**
 * Created by PhpStorm.
 * User: chadi
 */
require_once "../app/class/Session.php";
require_once "../app/settings/conf.php";

$token=filter_input(INPUT_POST,"token",FILTER_DEFAULT);

if(isset($token))
{
    global $s;
    $s = Session::getInstance();
    $s->start(_ART_USER, _SECURE);
    if($s->__get("CSRF")==$token)
    {
        $s-> __unset("User");
        $s-> __unset("CSRF");
        $s->close();
        $s->destroy();
        header("location:../index.php");
    }else
    {
        echo"<h1>Invalid User token, get back <a href='../index.php'>Home</a> !</h1>";
    }
}else
{
    header("location:../index.php");
    die();
}