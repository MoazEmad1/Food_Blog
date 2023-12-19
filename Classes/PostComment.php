<?php

class PostComment {
    private $uid;
    private $pid;
    private $commented_at;
    private $content;

    function __construct($uid, $pid, $content) {
        $this->uid = $uid;
        $this->pid = $pid;
        $this->commented_at = date('Y-m-d H:i:s');
        $this->content = $content;
    }

    function getUid() {
        return $this->uid;
    }

    function getPid() {
        return $this->pid;
    }

    function getCommentedAt() {
        return $this->commented_at;
    }

    function getContent() {
        return $this->content;
    }
}


?>
