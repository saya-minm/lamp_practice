CREATE TABLE purchase (
    purchase_id int(11) AUTO_INCREMENT,
    user_id int(11) NOT NULL,
    total int(11),
    created datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(purchase_id)
)
CREATE TABLE purchase_details (
    detail_id int(11) AUTO_INCREMENT,
    purchase_id int(11),
    item_id int(11),
    price int(11),
    amount int(11),
    created datetime DEFAULT CURRENT_TIMESTAMP,
    primary key(detail_id)
)