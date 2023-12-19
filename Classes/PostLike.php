<?php

class PostLike {
    private $uid;
    private $pid;
    private $liked_at;

     function __construct($uid, $pid) {
        $this->uid = $uid;
        $this->pid = $pid;
        $this->liked_at = date('Y-m-d H:i:s');
    }

     function getUid() {
        return $this->uid;
    }

     function getPid() {
        return $this->pid;
    }

     function getLikedAt() {
        return $this->liked_at;
    }

}

?>
