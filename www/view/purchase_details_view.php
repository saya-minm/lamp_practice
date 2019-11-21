<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'cart.css')); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>商品一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if(count($details) > 0){ ?>
    <p>注文番号：<?php print(h($purchase_id)); ?></p>
    <p>購入日時：<?php print(h($details[0]['created'])); ?></p>
    <p>合計金額：<?php print(h($total)); ?></p>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>商品名</th>
            <th>金額</th>
            <th>購入数</th>
            <th>小計</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($details as $value){ ?>
          <tr>
              <td><?php print(h($value['name'])); ?></td>
              <td><?php print(h($value['price'])); ?></td>
              <td><?php print(h($value['amount'])); ?></td>
              <td><?php print(h($value['amount']*$value['price'])); ?></td>
          </tr>
          <?php } ?>
        </tbody>
     </table>
    <?php } ?>
  </div>
</body>
</html>
