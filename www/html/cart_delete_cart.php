<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

if(is_valid_csrf_token(get_post('csrf_token')) === false){
  redirect_to(LOGIN_URL);
}

unset($_SESSION['csrf_token']);

$db = get_db_connect();
$user = get_login_user($db);

$cart_id = get_post('cart_id');

if(delete_cart($db, $cart_id)){
  set_message('カートを削除しました。');
} else {
  set_error('カートの削除に失敗しました。');
}

redirect_to(CART_URL);