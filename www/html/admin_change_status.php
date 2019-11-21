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

if(is_valid_csrf_token(get_post('csrf_token')) === false){
  redirect_to(LOGIN_URL);
}

unset($_SESSION['csrf_token']);


$db = get_db_connect();

//変数user=ユーザー定義関数get_login_user(user.php)
$user = get_login_user($db);

//(ユーザー定義関数is_admin)入力値が間違いなら
if(is_admin($user) === false){

  //LOGINページにリダイレクトする
  redirect_to(LOGIN_URL);
}

//変数item_id=ユーザー定義関数get_post
$item_id = get_post('item_id');
//変数changes_to=ユーザー定義関数get_post
$changes_to = get_post('changes_to');
　
//変数changes_toが'open'(公開)であれば
if($changes_to === 'open'){
  update_item_status($db, $item_id, ITEM_STATUS_OPEN);
  set_message('ステータスを変更しました。');
}else if($changes_to === 'close'){
  update_item_status($db, $item_id, ITEM_STATUS_CLOSE);
  set_message('ステータスを変更しました。');
}else {
  set_error('不正なリクエストです。');
}


redirect_to(ADMIN_URL);