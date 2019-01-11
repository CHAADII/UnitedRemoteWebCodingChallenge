<?php
/**
 * Created by PhpStorm.
 * User: chadi
 * Date: 09/01/19
 * Time: 23:31
 */

class shop
{
    private $id;
    private $Titl;
    private $lat;
    private $lon;

    public function __construct($arr)
    {
        $this->id=$arr[0];
        $this->Titl=$arr[1];
        $t=explode(",",$arr[2]);
        $this->lat=$t[0];
        $this->lon=$t[1];

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitl()
    {
        return $this->Titl;
    }

    public function setTitl($Titl)
    {
        $this->Titl = $Titl;
    }

    public function getLon()
    {
        return $this->lon;
    }

    public function getLat()
    {
        return $this->lat;
    }


}