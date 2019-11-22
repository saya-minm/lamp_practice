<?php
//定数を読み込み
require_once '../conf/const.php';
//dbを使用しない汎用的な関数を読み込み
require_once MODEL_PATH . 'functions.php';
//dbのusersテーブルを操作する関数を読み込み
require_once MODEL_PATH . 'user.php';
//dbのitemsテーブルを操作する関数を読み込み
require_once MODEL_PATH . 'item.php';

//複数のページで共通して使えるセッションを開始
session_start();

//(ユーザー定義関数is_logined)入力値が間違いなら
if(is_logined() === false){

  //LOGINページにリダイレクトする
  redirect_to(LOGIN_URL);
}

//変数db=ユーザー定義関数get_db_connect(db.php)
$db = get_db_connect();

//変数user=ユーザー定義関数get_login_user(user.php)
$user = get_login_user($db);

//(ユーザー定義関数is_admin)入力値が間違いなら
if(is_admin($user) === false){

  //LOGINページにリダイレクトする
  redirect_to(LOGIN_URL);
}

//変数items=(ユーザー定義関数get_all_items)
$items = get_all_items($db);


//商品管理ページ読み込み

$token = get_csrf_token();


include_once '../view/admin_view.php';
