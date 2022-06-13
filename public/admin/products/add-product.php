<?php 
    $pageTitle = "Add Product";
    require('../../../src/config.php');

    $message = "";
    $imgUrl = "product-images/placeholder.png";

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
                $errorMessages .= "Invalid file type. Accepted file types are jpeg, png, gif. <br>";
            }

            if ($_FILES['upfile']['size'] > 10000) { 
                $errorMessages .= 'Exceeded filesize limit. <br>';
            }

            if (empty($errorMessages)) {
                $isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);
        
                if ($isTheFileUploaded) {
                    $imgUrl = $newFilePath;
                } else {
                    $errorMessages = "Could not upload the file";
                }
            }
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
            if (is_numeric($stock) === false ){
                $errorMessages .= '<li> Wrong input for <strong> Stock </strong> (Needs to be a number). </li>';
            }
        }

        if (!empty($errorMessages)) {
            $message .= '<div class="alert alert-danger" ><ul>'. $errorMessages. '</ul></div> ' ;
        
        } else {
            $productsDbHandler -> addProduct($title, $description, $price, $stock, $imgUrl);
            redirect('manage-products.php');
        }
    }    
?>

<?php include('../layout/header.php');?> 

    <div class="container mt-3">
        <h1>Add new product</h1>
        <br>

        <?= $message ?>

        <img src= <?= $imgUrl ?> alt="" height="300px">

        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" class="form-control" id="inputGroupFile02" name="uploadedFile">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Product name" id="floatingInput" name= "title"  value=<?= htmlentities($title)?>>
                <label for="floatingInput">Product name *</label>
            </div>  
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Price" id="floatingInput" name= "price" value=<?= htmlentities($price)?>>
                <label for="floatingInput">Price (KR) *</label>
            </div>
            
            <div class="form-floating mb-3">
                <textarea class="form-control" id="floatingTextarea2" style="height: 200px" name="description"><?=htmlentities($product['description'])?></textarea>
                <label for="floatingTextarea2">Description *</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Stock" id="floatingInput" name= "stock" value= <?=htmlentities($stock)?>>
                <label for="floatingInput">Stock *</label>
            </div> 
        
            <div class="d-grid gap-2 col-6 mx-auto ">
                <input type="submit" class="btn btn-primary" name="addProductBtn" value="Add">

                <a href="manage-products.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

<?php include('../layout/footer.php');?> 