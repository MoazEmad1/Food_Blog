<?php

class PostSave {
    private $uid;
    private $pid;
    private $saved_at;

     function __construct($uid, $pid) {
        $this->uid = $uid;
        $this->pid = $pid;
        $this->saved_at = date('Y-m-d H:i:s'); 
    }

     function getUid() {
        return $this->uid;
    }

     function getPid() {
        return $this->pid;
    }

     function getSavedAt() {
        return $this->saved_at;
    }

}


?>
