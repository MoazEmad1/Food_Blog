<?php

class ItemConfirmation {
    private $admin_id;
    private $giid;
    private $item_action;
    private $confirmation_time;
    private $quantity_added;

    function __construct($admin_id, $giid, $item_action, $quantity_added) {
        $this->admin_id = $admin_id;
        $this->giid = $giid;
        $this->item_action = $item_action;
        $this->confirmation_time = date('Y-m-d H:i:s');
        $this->quantity_added = $quantity_added;
    }

    function getAdminId() {
        return $this->admin_id;
    }

    function getGiid() {
        return $this->giid;
    }

    function getItemAction() {
        return $this->item_action;
    }

    function getConfirmationTime() {
        return $this->confirmation_time;
    }

    function getQuantityAdded() {
        return $this->quantity_added;
    }
}

?>
