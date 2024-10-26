<?php

namespace ClassProject;

class Brand
{
    private $id;
    private $name;
    private $address;
    private $phone;
    private $icon_url;
    private $background_url;
    private $theme_url;

    public function __construct($id, $name, $address, $phone, $icon_url, $background_url, $theme_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->icon_url = $icon_url;
        $this->background_url = $background_url;
        $this->theme_url = $theme_url;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getIconUrl()
    {
        return $this->icon_url;
    }

    public function getBackgroundUrl()
    {
        return $this->background_url;
    }

    public function getThemeUrl()
    {
        return $this->theme_url;
    }
}

class Categories
{
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

class ProductItem{
    private $attributes;
    private $price;
    private $count;

    public function __construct($attributes, $price, $count){
        $this->attributes = $attributes;
        $this->price = $price;
        $this->count = $count;
    }
    
    public function getAttributes() {
        return $this->attributes;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getCount() {
        return $this->count;
    }
}

class Product
{
    private $id;
    private $name;
    private $categories;
    private $brand;
    private $review;
    private $image_url;

    public function __construct($id, $name, $categories, $brand, $review, $image_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->categories = $categories;
        $this->brand = $brand;
        $this->review = $review;
        $this->image_url = $image_url;
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

    public function getBrand()
    {
        return $this->brand;
    }

    public function getReview()
    {
        return $this->review;
    }

    public function getImageUrl()
    {
        return $this->image_url;
    }
}

class FlashDeal extends Product
{
    private $discount;
    private $starttime;
    private $endtime;

    public function __construct($id, $name, $categories, $brand, $review, $image_url, $starttime, $endtime, $discount)
    {
        parent::__construct($id, $name, $categories, $brand, $review, $image_url);

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

class User {
    private $id;
    private $displayName;
    private $userName;
    private $passWord;
    private $gender;
    private $address;
    private $phone;
    private $birthday;
    private $image_url;

    public function __construct($id, $displayName, $userName, $passWord, $gender, $address, $phone, $birthday, $image_url) {
        $this->id = $id;
        $this->displayName = $displayName;
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->gender = $gender;
        $this->address = $address;
        $this->phone = $phone;
        $this->birthday = $birthday;
        $this->image_url = $image_url;
    }

    public function getId() {
        return $this->id;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getPassWord() {
        return $this->passWord;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function getImageUrl() {
        return $this->image_url;
    }
}
