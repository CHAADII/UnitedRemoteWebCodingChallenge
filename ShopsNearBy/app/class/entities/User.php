<?php
/**
 * Created by PhpStorm.
 * User: chadi
 */

class User
{
    private $Email;
    private $password;
    private $lat;
    private $lon;

    public function __construct($arr)
    {
        $this->Email=$arr[0];
        $this->password=$arr[1];
        $t=explode(",",$arr[2]);
        $this->lat=$t[0];
        $this->lon=$t[1];
    }


    public function saveMe()
    {
        MysqlSing::getInstance();
        try {
            $stm=MysqlSing::$con->prepare("INSERT INTO `user`(`Email`, `password`, `Location`) VALUES (?,?,?)");
            $stm->execute([$this->Email,$this->password,$this->lat.",".$this->lon]);
            return true;
        }
        catch (Exception $e){
            if (_VERBOSE)
                throw new PDOException("Error while signing up , ".$e->getMessage(),$e->getCode());

            if ($e->getCode() == 1062 || $e->getCode() == 23000) {
                return "Duplicate";
            }
            return false;
        }
    }

    public function updateLocation($location)
    {
        MysqlSing::getInstance();
        try {
            $stm=MysqlSing::$con->prepare("UPDATE `user` SET `Location`=? WHERE Email=?");
            $stm->execute([$location,$this->Email]);
            $t=explode(",",$location);
            $this->lat=(double)$t[0];
            $this->lon=(double)$t[1];
            return true;
        }catch(PDOException $e)
        {
            if (_VERBOSE)
                throw new PDOException("Error while signing up , ".$e->getMessage(),$e->getCode());

            return false;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getEmail()
    {
        return $this->Email;
    }
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getLon()
    {
        return $this->lon;
    }

    public function getLat()
    {
        return $this->lat;
    }
    public function setLon($l)
    {
        $this->lon=$l;
    }

    public function setLat($l)
    {
        $this->lat=$l;
    }


}
