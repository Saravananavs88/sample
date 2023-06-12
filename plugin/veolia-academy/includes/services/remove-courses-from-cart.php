<?php
//remove courses from the cart page
$learing_id=isset($_POST["veolia_lms_removecart_learning_id"])? $_POST["veolia_lms_removecart_learning_id"]:"";
$is_error=0;$my_cart_count=0;
if($learing_id!=""){
    $veolia_lms_cart_list=$_SESSION["veolia_lms_my_cart_list"];
    if (($key = array_search($learing_id, $veolia_lms_cart_list)) !== false) {
        unset($veolia_lms_cart_list[$key]);
        $_SESSION["veolia_lms_my_cart_list"] = $veolia_lms_cart_list;
        if(empty($veolia_lms_cart_list)){
            unset($_SESSION["veolia_lms_my_cart_list"]);
        }
        $my_cart_count=count($veolia_lms_cart_list); 
    }else{
        $is_error=1;
    }   
}else{
    $is_error=1;
}
$response=array("is_error"=>$is_error,"cart_count"=>$my_cart_count);
echo json_encode($response);
