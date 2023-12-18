<?php

class Post{
    private $imgUrl;
    private $title;
    private $publishedAt;
    private $isVeg;
    private $caption;
    private $postID;

    function __construct($imgUrl,$title,$publishedAt,$isVeg,$caption)
    {
        $this -> imgUrl = $imgUrl;
        $this -> title = $title;
        $this -> publishedAt = $publishedAt;
        $this->isVeg = $isVeg;
        $this -> caption  = $caption;
        //use the getPostID
    }

    function getImgUrl(){
        return $this -> imgUrl;
    }

    function getTitle(){
        return $this ->title;
    }

    function getPublishAt(){
        return $this -> publishedAt;
    }
    
    function getIsVeg(){
        return $this-> isVeg;
    }

    function getCaption(){
        return $this->caption;
    }


    function setTitle($newTitle){
        $this ->title = $newTitle;
    }

    function setIsVeg($newVal){
        $this->isVeg = $newVal;
    }

    function setCaption($newCaption){
        $this->caption = $newCaption;
    }


    function getPostIDSQL(){
        //sqlcode here
    }
}

?>