<?php
//add learning path to the cart list
$learing_id=isset($_POST["veolia_lms_addcart_learning_id"])? $_POST["veolia_lms_addcart_learning_id"]:"";
$is_error=0;$my_cart_count=0;
if($learing_id!=""){    
    if(isset($_SESSION["veolia_lms_my_cart_list"]) && !empty($_SESSION["veolia_lms_my_cart_list"])){
        $vro_lms_cart_list=$_SESSION["veolia_lms_my_cart_list"];
        if(!in_array($learing_id,$vro_lms_cart_list)){
            array_push($_SESSION["veolia_lms_my_cart_list"],$learing_id);    
        }
    }else{
        $_SESSION["veolia_lms_my_cart_list"]=array($learing_id);
    }  
    $veolia_lms_cart_list=$_SESSION["veolia_lms_my_cart_list"];
    $my_cart_count=count($veolia_lms_cart_list); 
}else{
    $is_error=1;
}
$response=array("is_error"=>$is_error,"cart_count"=>$my_cart_count);
echo json_encode($response);
