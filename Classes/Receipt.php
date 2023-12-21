<?php

class Receipt {
    private $receipt_id;
    private $uid;
    private $giid;
    private $total_price;
    private $quantity_bought;
    private $total_item_price;

    function __construct($uid, $giid, $total_price, $quantity_bought, $total_item_price) {
        $this->uid = $uid;
        $this->giid = $giid;
        $this->total_price = $total_price;
        $this->quantity_bought = $quantity_bought;
        $this->total_item_price = $total_item_price;
    }

    function getReceiptId() {
        return $this->receipt_id;
    }

    function getUid() {
        return $this->uid;
    }

    function getGiid() {
        return $this->giid;
    }

    function getTotalPrice() {
        return $this->total_price;
    }

    function getQuantityBought() {
        return $this->quantity_bought;
    }

    function getTotalItemPrice() {
        return $this->total_item_price;
    }
}
?>
