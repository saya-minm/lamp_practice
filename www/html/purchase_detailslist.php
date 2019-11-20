<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'purchase.php';
require_once MODEL_PATH . 'purchase_details.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$purchase_id = get_post("purchase_id");
$total = get_post("total");


$details = get_purchase_detailslist($db,$user["user_id"], $purchase_id);

include_once '../view/purchase_details_view.php';