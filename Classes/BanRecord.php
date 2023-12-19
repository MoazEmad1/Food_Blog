<?php

class BanRecord {
    private $ban_id;
    private $uid;
    private $admin_id;
    private $banned_at;

     function __construct($uid, $admin_id) {
        $this->uid = $uid;
        $this->admin_id = $admin_id;
        $this->banned_at = date('Y-m-d H:i:s'); // Set the current date and time for banned_at
    }

     function getBanId() {
        return $this->ban_id;
    }

     function getUid() {
        return $this->uid;
    }

     function getAdminId() {
        return $this->admin_id;
    }

     function getBannedAt() {
        return $this->banned_at;
    }

}

?>
