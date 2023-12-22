<?php

require '../config2.php';

$user = $_GET['hide'];
$ingredients = [];
$imgUrl = $_GET['img_url'];
$title = $_GET['title'];
$desc = $_GET['desc'];
$veg = $_GET['is_veg'];
$num = $_GET['numIng'];
for($i=0;$i<$num;$i++){
    $ingredients[$i] = $_GET['item'.$i+1]; 
}
$sql="
insert into post(img_url,title,published_at,is_veg,caption,user_id)
values('Users/test/images/$imgUrl','$title',now(),$veg,'$desc','$user')
";
$ret = mysqli_query($conn,$sql);
$sql = "select * from post order by published_at desc limit 1";
if($ret){
    echo"Successful<br>";
    $ret = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($ret);
    $num = $row['pid'];
    foreach($ingredients as $i){
        $sql = "
        INSERT INTO postingredient
        VALUES ('$i',$num)
        ";
        $ret2 = mysqli_query($conn,$sql);
        if($ret2){
            echo"added $i<br>";
        }else{
            echo"failed to add $i";
        }
    }
}else{
    echo"failed main Insert";
}
mysqli_free_result($ret);
$conn -> close();
?>
