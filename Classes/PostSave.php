<?php

class PostSave {
    private $uid;
    private $pid;
    private $savedAt;

     function __construct($uid, $pid) {
        $this->uid = $uid;
        $this->pid = $pid;
        $this->savedAt = date('Y-m-d H:i:s'); 
    }

     function getUid() {
        return $this->uid;
    }

     function getPid() {
        return $this->pid;
    }

     function getSavedAt() {
        return $this->savedAt;
    }

}


?>
