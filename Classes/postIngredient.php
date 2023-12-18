<?php
class PostIngredient{
    private $ingredientName;
    private $postID;

    function __construct($ingredientName)
    {
        $this->ingredientName = $ingredientName;
        //code to get post id from sql
    } 

    function getIngredient(){
        return $this->ingredientName;
    }

    function getPostID(){
        return $this->postID;
    }
    
}
?>