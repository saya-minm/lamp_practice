<?php
require_once 'functions.php';
require_once 'db.php';

function insert_purchase_details($db, $carts, $id){

    foreach($carts as $value){

        $price = 0;
        $amount = 0;
        $item_id = "";

        $sql="
        INSERT INTO
        purchase_details(
            purchase_id
        )
        VALUES(:purchase_id)
        ";
        $params = array(
            ":purchase_id" => $id,
            $value['item_id'] => $item_id,
            $value['price'] => $price,
            $value['amount'] => $amount
        );
        if(execute_query($db, $sql, $params) === false){
            return false;
        }
    }
    return true;
    
}

