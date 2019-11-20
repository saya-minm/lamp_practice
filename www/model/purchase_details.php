<?php
require_once 'functions.php';
require_once 'db.php';

function insert_purchase_details($db, $value, $id, $date){


    $sql="
    INSERT INTO
    purchase_details(
        purchase_id,
        item_id,
        price,
        amount,
        created
    )
    VALUES(:purchase_id, :item_id, :price, :amount, :created)
    ";
    $params = array(
        ":purchase_id" => $id,
        ":item_id" => $value['item_id'],
        ":price" => $value['price'],
        ":amount" => $value['amount'],
        ":created" => $date
    );

    if(execute_query($db, $sql, $params) === false){

        return false;
      }
    
    return true;
    
}


function get_purchase_detailslist($db, $user_id, $purchase_id){
    $sql = "
    SELECT
      purchase_details.purchase_id,
      purchase_details.item_id,
      items.name,
      purchase_details.amount,
      purchase_details.created,
      purchase_details.price,
      purchase.user_id
    FROM
      purchase_details
    JOIN
      purchase
    ON
      purchase_details.purchase_id = purchase.purchase_id
    JOIN
      items
    ON
      purchase_details.item_id = items.item_id
    WHERE
      user_id = :user_id AND purchase_details.purchase_id = :purchase_id
  ";
  $params = array(
    ':user_id' => $user_id,
    ':purchase_id' => $purchase_id
  );

  return fetch_all_query($db, $sql, $params);

}