<?php

if(!isset($_SESSION["validate-login"]) || !isset($_SESSION["validate-useradmin"])){
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
}else if($_SESSION["validate-login"] != true || $_SESSION["validate-useradmin"] != true){
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
}


if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $fetchProducts = ProductsController::ctrSelectProductsWithId($id);
    if (!$fetchProducts) {
        echo "<script>window.location = 'index.php?rute=manage-products'</script>";
        return;
    }
} else {
    echo "<script>window.location = 'index.php?rute=manage-products'</script>";
    return;
}

$nameProductErr = $descriptionErr = $priceErr = $conditionErr = ""; # Empty Fields
$promotionPriceErr = $imageProductErr = "";
$countError = 0;
$fullFields = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["product-name"])){
        $nameProductErr = "El nombre es obligatorio.";
        $countError += 1;
    }
    
    if(empty($_POST["description"])){
        $descriptionErr = "Es necesaria una descripción del producto.";
        $countError += 1;
    }
    
    if(isset($_FILES["product-image"]) && $_FILES["product-image"]["error"] === 0){  
        $fileType = $_FILES["product-image"]["type"];
        $allowedTypes = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/webp"];
        if(!in_array($fileType, $allowedTypes)){
            $imageProductErr = "* Solo se permiten archivos de imagen (JPEG, PNG, GIF, WebP).";
            $countError += 1;
        }
    }
       

    if(empty($_POST["price"])){
        $priceErr = "Digite un precio para el producto.";
        $countError += 1;
    } else if ($_POST["price"] < 0) {
        $priceErr = "El valor debe ser superior o igual a 0.";
        $countError += 1;
    }

    if (!empty($_POST["promotion-price"]) && $_POST["promotion-price"] < 0) {
        $promotionPriceErr = "* El valor debe ser superior o igual a 0.";
        $countError += 1;
    }

    if(empty($_POST["condition"])){
        $conditionErr = "Es obligatorio indicar la condición del producto.";
        $countError += 1;
    }

    if($countError > 0){
        $fullFields = false;
    }

    if($fullFields){
        $createProduct = ProductsController::ctrUpdateProduct();

        if($createProduct){
            echo "<script>
                alert('El producto ha sido actualizado correctamente');
                window.location = 'index.php?rute=manage-products';
            </script>";
        } else {
            echo "<script> alert('Ha ocurrido un error, intentelo nuevamente') </script>";
        }
    }
}


echo "<script>
    if (window.history.replaceState) {
        window.history.replaceState(null,null,window.location.href);
    }
</script>";

?>

<link rel="stylesheet" href="view/css/forms.css">
<link rel="stylesheet" href="view/css/create-product.css">
<title>Actualizar Producto</title>

<div class="create-products-form fieldset">
    <h4>Datos del producto</h4>
    <p class="required-field">Requerido *</p>
    <form method="post" id="form-create-product" enctype="multipart/form-data">
        <div class="inputbox">
            <input type="hidden" name="product-id" value="<?php echo $fetchProducts["id"] ?>"/>
        </div>
        <div class="inputbox">
            <label for="product-name">Nombre del producto <span class="required-field">* <?php echo $nameProductErr ?></span></label>
            <input type="text" name="product-name" id="product-name" value="<?php echo $fetchProducts["product_name"] ?>" required/>
        </div>
        <div class="inputbox">
            <label for="description">Descripción <span class="required-field">* <?php echo $descriptionErr ?></span></label>
            <textarea name="description" id="description" cols="30" rows="10" required><?php echo $fetchProducts["description"] ?></textarea>
        </div>
        <div class="inputbox">
            <label for="product-image">Imagen <span class="required-field"><?php echo $imageProductErr ?></span></label>
            <input type="file" name="product-image" id="product-image" accept="image/jpg, image/jpeg, image/png, image/gif, image/webp"/>
            <input type="hidden" name="product-image-temp" value="<?php echo $fetchProducts["image"] ?>"/>
        </div>
        <div class="inputbox">
            <label for="price">Precio <span class="required-field">* <?php echo $priceErr ?></span></label>
            <input type="number" step="0.01" min="0.00" name="price" id="price" placeholder="0.00" value="<?php echo $fetchProducts["price"] ?>" required/>
        </div>
        <div class="inputbox">
            <label for="promotion-price">Precio de promoción <span class="required-field"><?php echo $promotionPriceErr ?></span></label>
            <input type="number" step="0.01" min="0.00" name="promotion-price" id="promotion-price" placeholder="0.00" value="<?php echo $fetchProducts["promotion_price"] ?>"/>
        </div>
        <div class="inputbox">
            <label for="tag_select">Etiqueta</label>
            <select name="product-tag" id="tag-select">
            <option value="0">... seleccionar</option>
                <?php 
                    $productTags = ProductsController::ctrSelectTags();
                    $quantityTags = count($productTags);
                    if($quantityTags > 0){
                        for($i = 1; $i < $quantityTags; $i++){
                            $item = $productTags[$i];
                ?>
                    <option value="<?php echo $item["id"] ?>" <?php echo $fetchProducts["tag_id"] == $item["id"] ? "selected" : "" ?>><?php echo $item["tag_name"] ?></option>
                <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div class="inputbox">
            <label for="category-select">Categoría</label>
            <select name="product-category" id="category-select">
            <option value="0">... seleccionar</option>
                <?php 
                    $productCategories = ProductsController::ctrSelectCategories();
                    $quantityCategories = count($productCategories);
                    if($quantityCategories > 0){
                        for($i = 1; $i < $quantityCategories; $i++){
                            $item = $productCategories[$i];
                ?>
                    <option value="<?php echo $item["id"] ?>" <?php echo $fetchProducts["category_id"] == $item["id"] ? "selected":"" ?>><?php echo $item["category_name"] ?></option>
                <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div class="inputbox">
            <label for="product-color">Color</label>
            <input type="text" name="product-color" id="product-color" value="<?php echo $fetchProducts["color"] ?>"/>
        </div>
        <div class="inputbox input-radio">
            <label>Condición <span class="required-field">* <?php echo $conditionErr ?></span></label>
            <div class="input-radio--options">
                <div>
                    <label for="new">Nuevo</label>
                    <input type="radio" name="condition" id="new" value="product-new" <?php echo $fetchProducts["condition"] == "1" ? "checked" : "" ?> required>
                </div>
                <div>
                    <label for="used">Usado</label>
                    <input type="radio" name="condition" id="used" value="product-used" <?php echo $fetchProducts["condition"] == "0" ? "checked" : "" ?>>
                </div>
            </div>
        </div>
        <div class="action-buttons">
            <button type="submit">Actualizar</button>
            <button type="button" onclick="btnCancelar()">Cancelar</button>
            <script>
                function btnCancelar() {
                    document.querySelector("#form-create-product").reset();
                    window.location = 'index.php?rute=manage-products';
                }
            </script>
        </div>
    </form>
</div>