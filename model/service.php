<?php


class service
{


    private $idservice=null;
   private $servicetype=null;
    private $price=null;
   private $photo;
   private $qty=null;

    /**
     * room constructor.
     * @param $idroom
     * @param $roomtype
     * @param $price
     * @param $photo
     */
    public function __construct( $servicetype, $price, $photo,$qty)
    {

        $this->servicetype = $servicetype;
        $this->price = $price;
        $this->photo = $photo;
        $this->qty = $qty;
    }/**
 * @return mixed
 */


    /**
     * @return mixed
     */
    public function getIdservice()
    {
        return $this->idservice;
    }

    /**
     * @param mixed $idroom
     */
    public function setIdservice($idservice)
    {
        $this->idservice = $idservice;
    }

    /**
     * @return mixed
     */
    public function getservicetype()
    {
        return $this->servicetype;
    }

    /**
     * @param mixed $roomtype
     */
    public function setservicetype($servicetype)
    {
        $this->servicetype = $servicetype;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param mixed $qty
     */
    public function setQty($qty): void
    {
        $this->qty = $qty;
    }




}