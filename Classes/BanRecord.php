<?php

class BanRecord {
    private $ban_id;
    private $uid;
    private $admin_id;
    private $banned_at;

     function __construct($uid, $admin_id) {
        $this->uid = $uid;
        $this->admin_id = $admin_id;
        $this->banned_at = date('Y-m-d H:i:s');
    }

     function getBanId() {
        return $this->ban_id;
    }

     function getUid() {
        return $this->uid;
    }

     function getadmin_id() {
        return $this->admin_id;
    }

     function getBannedAt() {
        return $this->banned_at;
    }

}

?>
