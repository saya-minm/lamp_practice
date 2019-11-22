<?php
require_once 'functions.php';
require_once 'db.php';

function sort_new($db, $kind = 0){

    
    
    $sql = '
        SELECT
        item_id, 
        name,
        stock,
        price,
        image,
        status,
        created
        FROM
        items
    ';
    if($kind === 0){
        $sql .= '
        WHERE status = 1
        ORDER BY created DESC
        ';
    } else if($kind === 1){
        $sql .='
        WHERE status = 1
        ORDER BY price ASC
        ';
    } else if($kind === 2){
        $sql .='
        WHERE status = 1
        ORDER BY price DESC
        ';
    }
    
    return fetch_all_query($db, $sql);
    }
    