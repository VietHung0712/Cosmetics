<?php
namespace ClassProject;

class Brand{
    private $id;
    private $name;
    private $address;
    private $phone;

    public function __construct($id, $name, $address, $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getPhone(){
        return $this->phone;
    }
}

class Categories{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Product{
    private $id;
    private $name;
    private $categories;
    private $classification;
    private $brand;
    private $review;
    private $rank;
    private $sum;
    private $sold;
    private $price;
    private $stt;

    public function __construct($id, $name, $categories, $classification, $brand, $review, $rank, $sum, $sold, $price, $stt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->categories = $categories;
        $this->classification = $classification;
        $this->brand = $brand;
        $this->review = $review;
        $this->rank = $rank;
        $this->sum = $sum;
        $this->sold = $sold;
        $this->price = $price;
        $this->stt = $stt;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getClassification()
    {
        return $this->classification;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getReview()
    {
        return $this->review;
    }

    public function getRank()
    {
        return $this->rank;
    }

    public function getSum()
    {
        return $this->sum;
    }

    public function getSold()
    {
        return $this->sold;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStt(){
        return $this->stt;
    }
}

class FlashDeal extends Product{
    private $discount;
    private $starttime;
    private $endtime;

    public function __construct($id, $name, $categories, $classification, $brand, $review, $rank, $sum, $sold, $price, $stt, $starttime, $endtime, $discount)
    {
        parent::__construct($id, $name, $categories,$classification, $brand, $review, $rank, $sum, $sold, $price, $stt);

        $this->discount = $discount;
        $this->starttime = $starttime;
        $this->endtime = $endtime;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getStarttime()
    {
        return $this->starttime;
    }

    public function getEndtime()
    {
        return $this->endtime;
    }
}
?>