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

$carts = get_user_carts($db, $user['user_id']);

$db->beginTransaction();

$date = date("Y/m/d H:i:s");

if(insert_purchase($db, $user, $carts, $date) === false){
  $db->rollback();
  redirect_to(CART_URL);
}

if(purchase_carts($db, $carts) === false){
  $db->rollback();
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
}

$id = get_lastid($db);

foreach($carts as $value){

  if(insert_purchase_details($db, $value, $id["MAX(purchase_id)"], $date) === false){
    $db->rollback();
    set_error('商品が購入できませんでした。');
    redirect_to(CART_URL);
    }
  }

$db->commit();

$total_price = sum_carts($carts);

include_once '../view/finish_view.php';