<?php 
    $pageTitle = "Update Product";
    require('../../../src/config.php');
    
    $message       = "";
    $errorMessages = "";

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
		if ($isFileTypeAllowed === false) {
			$errorMessages .= "<li> Invalid file type. Accepted file types are jpeg, png, gif. </li>";
		}

		if ($_FILES['upfile']['size'] > 1000000) {  // Allows only files under 1 mbyte
			$errorMessages .= '<li> Exceeded filesize limit. </li>';
		}

		if (empty($errorMessages)) {
			$isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);
	
			if ($isTheFileUploaded) {
				$imgUrl = $newFilePath;
			} else {
				$errorMessages .= "<li> Could not upload the file </li>";
			}
		}
	} else {
        $imgUrl = $_POST['currentImg'];
    }

    if (empty($title) || empty($price) || empty($description) || empty($stock)) {
        $errorMessages .= generateErrorMessageForEmptyField($title, "Title");
        $errorMessages .= generateErrorMessageForEmptyField($price, "Price");
        $errorMessages .= generateErrorMessageForEmptyField($stock, "Stock");
        $errorMessages .= generateErrorMessageForEmptyField($description, "Description");
    } 

    if (is_numeric($price) === false || is_numeric($stock) === false) {
        if (is_numeric($price) === false ){
            $errorMessages .= '<li> Wrong input for <strong> Price </strong> (Needs to be a number). </li>';
        }
        else {
            $errorMessages .= '<li> Wrong input for <strong> Stock </strong> (Needs to be a number). </li>';
        }
    }

    if (!empty($errorMessages)) {
        $message .= '<div class="alert alert-danger messages-div"><ul>'. $errorMessages. '</ul></div> ' ;

	} else {
        $productsDbHandler -> updateProduct($_POST['productId'], $title, $description, $price, $stock, $imgUrl);
        redirect("manage-products.php");
    }
}    
    $product =  $productsDbHandler -> fetchSpecificProduct($_GET['productId'])
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $pageTitle ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/products.css"/>
</head>
<body>

    <div class="container mt-3">
        <h1 class="center">Update Product</h1>
        <br>

        <?= $message ?>
        
        <img src=<?=$product['img_url'] ?>  class="mb-3 product-img-form" height= "400px">
        
        <div class="form-background">
            <form class="input-form" action="" method="post" enctype="multipart/form-data">

                <input type="hidden" name="productId" value="<?= $product['id']?>">

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

                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">Product image</label>
                    <input type="hidden" value=<?=$product['img_url']?> name="currentImg">
                    <input type="file" class="form-control" id="inputGroupFile02" name="uploadedFile">
                </div>
        </div>
                <div class="d-grid gap-3 col-6 mx-auto mt-4 ">
                    <input type="submit" class="btn" name="updateProductBtn" value="Update">
                    
                    <a href="manage-products.php" class="btn btn-secondary cancel-btn">Cancel</a>
                </div>
            </form>
    </div>

</body>
</html>