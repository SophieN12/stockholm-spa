<?php 
    $pageTitle = "Admin Page";
    require('../../../src/config.php');

    if (isset($_POST["deleteProductBtn"])){
		$productsDbHandler -> deleteProduct($_POST['productId']);
    }

    if (isset($_POST["submitSearch"])){
		$searchResult =  trim($_POST['search-result']);
		$sql = "
			SELECT * FROM products 
			WHERE title like :search
		";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':search', $searchResult .'%');
		$stmt->execute();
		$products = $stmt->fetchAll();

    } else {
		$products = $productsDbHandler -> fetchAllProducts();
	}
?>

<?php include('../layout/header.php'); ?>	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" type=""text/css" href="../css/products.css"/>

	<div class="container">
		<h1> <a href="manage-products.php">Manage product</a> </h1>

		<div id="search-and-add-div">
			<form id="search-form" class="d-flex" role="search" method="post" >
				<input class="form-control me-2" id="search-bar" name="search-result" type="search" placeholder="Search by product name" aria-label="Search">
				<input type="submit" class="btn" id="submit-search" name="submitSearch" value="Search">
			</form>
			<a href="add-product.php" id="add-product-btn">Add new product +</a>
        </div>

		<table id= "products-tbl">
			<thead>
				<tr>
					<th>IMG</th>
					<th>ID</th>
					<th>TITLE</th>
					<th>PRICE</th>
					<th>STOCK</th>
					<th>ACTIONS</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($products as $product) { ?>
					<tr>
						<td><img src=<?=$product['img_url']?>></td>
						<td><?= htmlentities($product['id']) ?></td>
						<td class="title" data-id="<?=$product['id']?>"><?= htmlentities($product['title']) ?></td>
						<td><?= htmlentities($product['price']) ?>:-</td>
						<td><?= htmlentities($product['stock']) ?> st</td>
						<td>
							<form action="update-product.php" method="GET">
								<input type="hidden" name="productId" value="<?= htmlentities($product['id']) ?>">
								<input type="submit" name="updateProductBtn" value="Update">
							</form>
							<form action="" method="POST">
								<input type="hidden" name="productId" value="<?= htmlentities($product['id']) ?>">
								<input type="submit" name="deleteProductBtn" value="Delete">
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table> 
	</div>

<?php include('../layout/footer.php'); ?>

