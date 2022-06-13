<?php 
    $pageTitle = "Admin Page";
    require('../../../src/config.php');

    if (isset($_POST["deleteProductBtn"])){
		$productsDbHandler -> deleteProduct($_POST['productId']);
    }

	$products = $productsDbHandler->fetchAllProducts();
?>

<?php include("../layout/header.php") ?>

	<div class="container">
		<h1>Admin Page</h1>

		<a href="add-product.php">Add new product +</a>

		<table id= "products-tbl">
			<thead>
				<tr>
					<th>Img</th>
					<th>ID</th>
					<th>Title</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($products as $product) {
					if (strlen($product['description']) >= 70){
						$description = substr($product['description'], 0, 70) . '...';
					} else {
						$description = $product['description'];
					}
					?>
					<tr>
						<td width="130px"><img src=<?=$product['img_url']?> width="100px"></td>
						<td><?= htmlentities($product['id']) ?></td>
						<td><?= htmlentities($product['title']) ?></td>
						<td><?= htmlentities($product['price']) ?>:-</td>
						<td><?= htmlentities($product['stock']) ?> st</td>
						<td>
							<form action="" method="POST">
								<input type="hidden" name="productId" value="<?= htmlentities($product['id']) ?>">
								<input type="submit" name="deleteProductBtn" value="Delete">
							</form>

							<form action="update-product.php" method="GET">
								<input type="hidden" name="productId" value="<?=htmlentities($product['id']) ?>">
								<input type="submit" name="updateProductBtn" value="Update">
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table> 
	</div>
    
<?php include("../layout/footer.php") ?>
