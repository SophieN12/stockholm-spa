<?php
require('../../src/config.php');
$pageTitle = 'Checkout';
?>

<!DOCTYPE html>
<html>

<?php include('../layout/header.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pageTitle?></title>
</head>
<body>
    <div class="container">
        <h3>Checkout</h3>
        <section class="cart-item-list">
            <ul>
                <?php foreach($_SESSION['cartItems'] as $cartId => $cartItem): ?>
                    <li>
                        <article class="cart-item-module">
                            <img src="../admin/products/<?=$cartItem['img_url']?>" width="250">
                            <div class="cart-item-details">
                                <h4><?=$cartItem['title']?></h4>
                                <p><?=$cartItem['price']?> SEK</p>
                            </div>
                            <form action="../delete-cart-item.php" method="POST">
                                <input type="hidden" name="cartId" value="<?=$cartId?>">

                                <button type="submit" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>

                            <form class="update-cart-form" action="../update-cart-item.php" method="POST">
                                <input type="hidden" name="cartId" value="<?=$cartId?>">
                                <input type="number" name="quantity" value="<?=$cartItem['quantity']?>" min="0">
                            </form>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="cart-sidebar">
            <tfoot class="table-foot">
                <tr>
                   <th class="total-sum-title">Summa</th> 
                   <th class="total-sum"><?=$cartTotalSum?></th>
                </tr>
            </tfoot>
        </section>
    </div>
     
    <script type="text/javascript">
        $('.update-cart-form input[name="quantity"]').on('change', function () {
           $(this).parent().submit(); 
        });
    </script>

</body>
</html>