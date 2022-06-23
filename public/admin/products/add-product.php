<?php 
    $pageTitle = "Add Product";
    require('../../../src/config.php');

    $message = "";
    
    $title       = "";
    $price       = "";
    $description = "";
    $stock       = "";

    if (isset($_POST['addProductBtn'])) {
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

            if ($_FILES['upfile']['size'] > 10000) { 
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
        } 	

        if (empty($title) || empty($price) || empty($description) || empty($stock) || empty($imgUrl)) {
            $errorMessages .= generateErrorMessageForEmptyField($title, "Title");
            $errorMessages .= generateErrorMessageForEmptyField($price, "Price");
            $errorMessages .= generateErrorMessageForEmptyField($stock, "Stock");
            $errorMessages .= generateErrorMessageForEmptyField($description, "Description");
            $errorMessages .= generateErrorMessageForEmptyField($imgUrl, "Product image");
        }

        if (is_numeric($price) === false && !empty($price) || is_numeric($stock) === false && !empty($stock)) {
            if (is_numeric($price) === false ){
                $errorMessages .= '<li> Wrong input for <strong> Price </strong> (Needs to be a number). </li>';
            }
            if (is_numeric($stock) === false ){
                $errorMessages .= '<li> Wrong input for <strong> Stock </strong> (Needs to be a number). </li>';
            }
        }
        if (!empty($errorMessages)) {
            $message .= '<div class="alert alert-danger messages-div" ><ul>'. $errorMessages. '</ul></div> ' ;
        
        } else {
            $productsDbHandler -> addProduct($title, $description, $price, $stock, $imgUrl);
            redirect('manage-products.php');
        }
    }    
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container mt-3">
        <h1 class="center" >Add new product</h1>
        <br>

        <?= $message ?>
        <img src="product-images/placeholder.png" class="mb-3 product-img-form"height="300px">

        <div class="form-background">
            <form class="input-form" action="" method="post" enctype="multipart/form-data">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Product name" id="floatingInput" name= "title" value= <?=htmlentities($title)?>>
                    <label for="floatingInput">Product name *</label>
                </div>  
                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Price" id="floatingInput" name= "price" value= <?=htmlentities($price)?>>
                    <label for="floatingInput">Price (KR) *</label>
                </div>
                
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="floatingTextarea2" style="height: 200px" name="description"> <?=htmlentities($description)?></textarea>
                    <label for="floatingTextarea2">Description *</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Stock" id="floatingInput" name= "stock" value= <?=htmlentities($stock)?>>
                    <label for="floatingInput">Stock *</label>
                </div> 

                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">Product image</label>
                    <input type="file" class="form-control" id="inputGroupFile02" name="uploadedFile">
                </div>
        </div>
                <div class="d-grid gap-3 col-6 mx-auto mt-4">
                    <input type="submit" class="btn" name="addProductBtn" value="Add">

                    <a href="manage-products.php" class="btn btn-secondary cancel-btn">Cancel</a>
            </form>

        </div>
    </div>
</body>
</html>