<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'sort.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$sort = get_post("sort");
$new = array('新着順','価格の安い順','価格の高い順');
$keys = (int)$sort;

$items = sort_new($db, $keys);


include_once '../view/index_view.php';