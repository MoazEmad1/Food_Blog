<?php

class GroceryItem {
    private $quantity;
    private $price;
    private $item_name;
    private $img_url;
    private $is_veg;

    public function __construct($quantity, $price, $item_name, $img_url, $is_veg) {
        $this->quantity = $quantity;
        $this->price = $price;
        $this->item_name = $item_name;
        $this->img_url = $img_url;
        $this->is_veg = $is_veg;
    }

     function getQuantity() {
        return $this->quantity;
    }

     function getPrice() {
        return $this->price;
    }

     function getItemName() {
        return $this->item_name;
    }

     function getImgUrl() {
        return $this->img_url;
    }

     function getIsVeg() {
        return $this->is_veg;
    }

     function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

     function setPrice($price) {
        $this->price = $price;
    }

     function setItemName($item_name) {
        $this->item_name = $item_name;
    }

     function setImgUrl($img_url) {
        $this->img_url = $img_url;
    }

     function setIsVeg($is_veg) {
        $this->is_veg = $is_veg;
    }

}

?>
