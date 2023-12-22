<?php

class Receipt {
    private $receiptId;
    private $uid;
    private $giid;
    private $totalPrice;
    private $quantityBought;
    private $totalItemPrice;

    function __construct($uid, $giid, $totalPrice, $quantityBought, $totalItemPrice) {
        $this->uid = $uid;
        $this->giid = $giid;
        $this->totalPrice = $totalPrice;
        $this->quantityBought = $quantityBought;
        $this->totalItemPrice = $totalItemPrice;
    }

    function getReceiptId() {
        return $this->receiptId;
    }

    function getUid() {
        return $this->uid;
    }

    function getGiid() {
        return $this->giid;
    }

    function getTotalPrice() {
        return $this->totalPrice;
    }

    function getQuantityBought() {
        return $this->quantityBought;
    }

    function getTotalItemPrice() {
        return $this->totalItemPrice;
    }
}
?>
