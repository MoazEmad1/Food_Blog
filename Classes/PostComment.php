<?php

class PostComment {
    private $uid;
    private $pid;
    private $commentedAt;
    private $content;

    function __construct($uid, $pid, $content) {
        $this->uid = $uid;
        $this->pid = $pid;
        $this->commentedAt = date('Y-m-d H:i:s');
        $this->content = $content;
    }

    function getUid() {
        return $this->uid;
    }

    function getPid() {
        return $this->pid;
    }

    function getCommentedAt() {
        return $this->commentedAt;
    }

    function getContent() {
        return $this->content;
    }
}


?>
