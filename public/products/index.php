<?php
require('../../src/config.php');
$pageId = "products";
$pageTitle = "products";
$products = $productsDbHandler->fetchAllProducts();

if (isset($_POST['submitSearch'])) {
    $products = $productsDbHandler->searchProduct();
} else {
    $products = $productsDbHandler->fetchAllProducts();
}
?>

<?php include('../layout/header.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Stockholm Spa</title>
    <link rel="stylesheet" href="../../public/css/products-page.css">
</head>

<body>
    <div class="container">
        <div id="title-search-div">
            <h1>Products</h1>

            <div class="search-dropdown dropdown">
                <button class="btn btn-secondary dropdown-toggle dropdown-toggle-search" type="button" id="shoppingCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Search product
                </button>

                <div class="search-dropdown-menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <form id="search-product-form" class="d-flex" role="search" method="POST">
                        <input class="form-control p-2" id="search-bar" name="search-result" type="search" placeholder="Search by product name" aria-label="Search">
                        <input type="submit" class="btn grid-add-btn" id="submit-search" name="submitSearch" value="Search">
                    </form>
                </div>
            </div>
        </div>

        <ul id="product-grid">
            <?php foreach ($products as $product) { ?>
                <li>
                    <a href="product.php?productId=<?= $product['id'] ?>">
                        <img src="../admin/products/<?= $product['img_url'] ?>" class="grid-img">
                        <div class="product-grid-info">
                            <div class="product-grid-info-left">
                                <h3><?= htmlentities($product['title']) ?></h3>
                                <p><?= htmlentities($product['price']) ?> SEK</p>
                            </div>
                    </a>
                    <div class="product-grid-info-right">
                        <form id="add-cart-form" action="../add-cart-item.php" method="POST">
                            <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                            <input type="number" class="grid-qt-input" name="quantity" value="1" min="0">
                            <input type="submit" class="btn grid-add-btn" name="addToCart" value="Add to cart">
                        </form>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>

<?php include('../layout/footer.php'); ?>