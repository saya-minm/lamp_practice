<?php
require_once 'functions.php';
require_once 'db.php';

function insert_purchase($db, $user, $carts){

    $total = 0;
    foreach($carts as $value){
        $total = $value['price'] * $value['amount'] + $total;
    }

    $sql="
    INSERT INTO
    purchase(
        user_id,
        total
    )
    VALUES(:user_id, :total)
    ";
    $params = array(
        ":user_id" => $user['user_id'],
        ":total" => $total
    );
    
    return execute_query($db, $sql, $params);
}

