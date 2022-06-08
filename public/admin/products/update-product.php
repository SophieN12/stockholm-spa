<?php 
    $pageTitle = "Update Product";
    require('../../../src/dbconnect.php');
    require('../../../src/functions.php');
    
    $message       = "";
    $errorMessages = "";
    $imgUrl        = "";

if (isset($_POST['updateProductBtn'])) {
    $title       = trim($_POST['title']);
    $price       = trim($_POST['price']);
    $description = trim($_POST['description']);
    $stock       = trim($_POST['stock']);

	if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
		$fileName 	    = $_FILES['uploadedFile']['name'];
		$fileType 	    = $_FILES['uploadedFile']['type'];
		$fileTempPath   = $_FILES['uploadedFile']['tmp_name'];
		$path 		    = "product-images/";

		$newFilePath = $path . $fileName; 

		$allowedFileTypes = [
			'image/png',
			'image/jpeg',
			'image/gif',
		];
		
		$isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);
		if (!$isFileTypeAllowed) {
			$errorMessages .= "Invalid file type. Accepted file types are jpeg, png, gif. <br>";
		}

		if ($_FILES['upfile']['size'] > 1000000) {  // Allows only files under 1 mbyte
			$errorMessages .= 'Exceeded filesize limit. <br>';
		}

		if (empty($errorMessages)) {
			$isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);
	
			if ($isTheFileUploaded) {
				$imgUrl = $newFilePath;
			} else {
				$error = "Could not upload the file";
			}
		}
	} else {
        $imgUrl = $_POST['currentImg'];
    }

    if (empty($title) || empty($price) || empty($description) || empty($stock)) {
        $errorMessages .= generateErrorMessages($title, "Title");
        $errorMessages .= generateErrorMessages($price, "Price");
        $errorMessages .= generateErrorMessages($stock, "Stock");
        $errorMessages .= generateErrorMessages($description, "Description");
    } 

    if (!empty($error)) {
        $message .= '<div class="alert alert-danger" ><ul>'. $errorMessages. '</ul></div> ' ;

	}  else {
        updateProduct($_POST['productId'], $title, $description, $price, $stock, $imgUrl);
        redirect("manage-products.php");

    }
}    
    $product = fetchSpecificProduct($_GET['productId'])

?>

<?php include('../layout/header.php'); ?>

    <div class="container mt-3">
        <h1>Update Product</h1>
        <br>

        <form action="" method="post" enctype="multipart/form-data">
            <?= $message ?>
            <?= $errorMessages ?>

            <input type="hidden" name="productId" value="<?= $product['id']?>">

            <div>
                <img src= <?=$product['img_url'] ?> alt="" height= "400px">
                <input type="hidden" value=<?=$product['img_url']?> name= "currentImg">
                <input type="file" class="form-control" id="inputGroupFile02" name="uploadedFile">
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" value="<?=htmlentities($product['title'])?>" name= "title">
                <label for="floatingInput">Product name *</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" value="<?=htmlentities($product['price'])?> "name= "price">
                <label for="floatingInput">Price (KR) *</label>
            </div>
            
            <div class="form-floating mb-3">
                <textarea class="form-control" id="floatingTextarea2" style="height: 200px" name="description"><?=htmlentities($product['description'])?></textarea>
                <label for="floatingTextarea2">Description *</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" value="<?=htmlentities($product['stock'])?> "name= "stock">
                <label for="floatingInput">Stock *</label>
            </div>
            
            <div class="d-grid gap-2 col-6 mx-auto ">
                <input type="submit" class="btn btn-primary" name="updateProductBtn" value="Update">
                
                <a href="manage-products.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

<?php include('../layout/footer.php'); ?>