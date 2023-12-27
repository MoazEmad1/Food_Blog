<?php

use function PHPSTORM_META\type;

require '../config.php';
session_start();
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
if(!isset($ingredients[0])){
    $_SESSION['empty']=true;
    header("Location: ../addPost.php");
}
echo "$sql";
try{
    $ret = mysqli_query($conn,$sql);
    $sql = "select * from post order by published_at desc limit 1";
    $ret = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($ret);
    $num = $row['pid'];
    foreach($ingredients as $i){
        $sql = "
        INSERT INTO postingredient(ingredient_name,post_id)
        VALUES ('$i',$num)
        ";
        try{
            $ret2 = mysqli_query($conn,$sql);
        }catch(Exception $e){
            echo"here";
            $sql = "delete from postingredient where post_id = $num";
            try{
                $ret3 = mysqli_query($conn,$sql);
            }catch(Exception $e){
                echo"$e";
            }
            $sql = "delete from post where pid = $num";
            try{
                $ret4 = mysqli_query($conn,$sql);
                $_SESSION['failed']=true;
                header("Locattion: ../addPost.php");
            }catch(Exception $e){
                echo"$e";
            }
        }
    }
    $_SESSION['succ'] = true;
    header("Location: ../addPost.php");
}catch(Exception $e){
    echo $e;
    $_SESSION['failed']=true;
    //header("Locattion: ../addPost.php");
}
//mysqli_free_result($ret);
$conn -> close();
?>
