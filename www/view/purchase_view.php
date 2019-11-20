<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'cart.css')); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>購入履歴</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if(count($list) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>合計金額</th>
            <th>購入明細画面</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($list as $value){ ?>
          <tr>
              <td><?php print(h($value['purchase_id'])); ?></td>
              <td><?php print(h($value['created'])); ?></td>
              <td><?php print(h($value['total'])); ?></td>
              <td>
                <form action="purchase_detailslist.php" method="post">
                  <input type = "submit" value = "購入明細へ" onclick="location.href='/purchase_details_view.php'"> 
                  <input type="hidden" name="purchase_id" value="<?php print(h($value['purchase_id'])); ?>">
                  <input type="hidden" name="total" value="<?php print(h($value['total'])); ?>">
                </form>
              </td>
          </tr>
          <?php } ?>
        </tbody>
     </table>
    <?php } else { ?>
      <p>購入履歴はありません。</p>
    <?php } ?> 
  </div>
</body>
</html>