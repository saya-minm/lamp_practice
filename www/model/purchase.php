<?php
require_once 'functions.php';
require_once 'db.php';

function insert_purchase($db, $user, $carts, $date){

    $total = 0;
    foreach($carts as $value){
        $total = $value['price'] * $value['amount'] + $total;
    }

    $sql="
    INSERT INTO
    purchase(
        user_id,
        total,
        created
    )
    VALUES(:user_id, :total, :created)
    ";
    $params = array(
        ":user_id" => $user['user_id'],
        ":total" => $total,
        ":created" => $date
    );
    
    return execute_query($db, $sql, $params);
}

function get_lastid($db){

    $sql = "
  SELECT MAX(purchase_id)
  FROM
   purchase
  ";

  return fetch_query($db, $sql);
  
}

function get_purchaselist($db, $user_id){
    $sql = "
    SELECT
      purchase_id,
      total,
      created
    FROM
      purchase
    WHERE
      user_id = :user_id
  ";
  $params = array(
    ':user_id' => $user_id
  );

  return fetch_all_query($db, $sql, $params);

}