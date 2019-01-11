<?php
/**
 * Created by PhpStorm.
 * User: chadi
 * Date: 10/01/19
 * Time: 20:45
 */

class shopsController
{

    private static $instance;
    private static $shops = [];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public static function likeShop($id, $email)
    {
        MysqlSing::getInstance();
        try {
            $stm = MysqlSing::$con->prepare("INSERT INTO `likedShops`(`Email`, `Id`) VALUES (?,?)");
            $stm->execute([$email, $id]);
        } catch (PDOException $e) {
            if (_VERBOSE)
                throw new PDOException("Error in likeshop() , " . $e->getMessage(), $e->getCode());
        }
    }

    public static function dislikeShop($id, $email)
    {
        MysqlSing::getInstance();
        try {
            $stm = MysqlSing::$con->prepare("INSERT INTO `DislikedShops`(`Email`, `Id`, `Date`) VALUES (?,?,?)");
            $stm->execute([$email, $id,date("Y-m-d h:i:s")]);
        } catch (PDOException $e) {
            if (_VERBOSE)
                throw new PDOException("Error in likeshop() , " . $e->getMessage(), $e->getCode());
        }
    }

    public static function removeFromLiked($id, $email)
    {
        MysqlSing::getInstance();
        try {
            $stm = MysqlSing::$con->prepare("DELETE FROM `likedShops` WHERE Email=? and id=?");
            $stm->execute([$email, $id]);
        } catch (PDOException $e) {
            if (_VERBOSE)
                throw new PDOException("Error in removefromliked() , " . $e->getMessage(), $e->getCode());
        }
    }

    //Get All shops in DB
    public static function getAllShops($notLiked = true)
    {
        MysqlSing::getInstance();
        try {
            if ($notLiked)
                $stm = MysqlSing::$con->prepare("SELECT * FROM `Shop` WHERE Shop.Id not in (SELECT likedShops.Id from `likedShops`) and Shop.Id not in (SELECT DislikedShops.Id from DislikedShops where (unix_timestamp(?) - unix_timestamp(DislikedShops.Date)) < 7200 ) ");
            else
                $stm = MysqlSing::$con->prepare("SELECT * FROM `Shop` where Shop.Id not in (SELECT DislikedShops.Id from DislikedShops where (unix_timestamp(?) - unix_timestamp(DislikedShops.Date)) < 7200)");

            $stm->execute([date("Y-m-d h:i:s")]);
        } catch (PDOException $e) {
            if (_VERBOSE)
                throw new PDOException("Error in GETALLSHOPS() , " . $e->getMessage(), $e->getCode());
        }
        self::getInstance();

        while ($row = $stm->fetch(PDO::FETCH_BOTH)) {
            self::$shops[] = new shop($row);
        }
    }

    public static function getPreferedShops($email)
    {
        MysqlSing::getInstance();
        try {
            $stm = MysqlSing::$con->prepare("SELECT Shop.Id, `Name`, `Location` FROM `Shop`,`likedShops` WHERE Shop.Id = likedShops.Id and likedShops.Email=?");
            $stm->execute([$email]);
        } catch (PDOException $e) {
            if (_VERBOSE)
                throw new PDOException("Error in getpreferedshops() , " . $e->getMessage(), $e->getCode());
        }
        self::getInstance();

        while ($row = $stm->fetch(PDO::FETCH_BOTH)) {
            self::$shops[] = new shop($row);
        }
    }

    //Sort Shops by distance
    public static function sortShops($l1, $l2)
    {

        self::getInstance();
        $current = "";
        for ($i = 0; $i < count(self::$shops); $i++) {
            for ($j = 0; $j < count(self::$shops) - 1; $j++) {
                if (self::distance($l1, $l2, self::$shops[$j]->getLat(), self::$shops[$j]->getLon()) >
                    self::distance($l1, $l2, self::$shops[$j + 1]->getLat(), self::$shops[$j + 1]->getLon())) {
                    $current = self::$shops[$j];
                    self::$shops[$j] = self::$shops[$j + 1];
                    self::$shops[$j + 1] = $current;
                }
            }
        }
        return self::$shops;
    }

    //Distance in KM
    public static function distance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515 * 1.609344;
            return $miles;
        }
    }

    public static function serializeShops()
    {
        $s = array();
        for ($i = 0; $i < count(self::$shops); $i++) {
            $s[] = array("ID" => self::$shops[$i]->getId(), "Title" => self::$shops[$i]->getTitl());
        }
        return $s;
    }
}