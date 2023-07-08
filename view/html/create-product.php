<?php

if(!isset($_SESSION["validate-login"]) || !isset($_SESSION["validate-useradmin"])){
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
}else if($_SESSION["validate-login"] != true || $_SESSION["validate-useradmin"] != true){
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
}

$nameProductErr = $descriptionErr = $imageProductErr = $priceErr = $conditionErr = ""; # Empty Fields
$nameProduct = $description = $price = ""; # Required Fields
$promotionPrice = $tag = $category = $color = ""; # No Required Fields
$countError = 0;
$fullFields = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["product-name"])){
        $nameProductErr = "El nombre es obligatorio.";
        $countError += 1;
    }else{
        $nameProduct = $_POST["product-name"];
    } 
    
    if(empty($_POST["description"])){
        $descriptionErr = "Es necesaria una descripción del producto.";
        $countError += 1;
    }else{
        $description = $_POST["description"];
    }
    
    if(isset($_FILES["product-image"]) && $_FILES["product-image"]["error"] === 0){  
        $fileType = $_FILES["product-image"]["type"];
        $allowedTypes = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/webp"];
        if(!in_array($fileType, $allowedTypes)){
            $imageProductErr = "Solo se permiten archivos de imagen (JPEG, PNG, GIF, WebP).";
            $countError += 1;
        }
    }else {
        $imageProductErr = "Por favor, seleccione una imagen.";
        $countError += 1;
    }

    if(empty($_POST["price"])){
        $priceErr = "Digite un precio para el producto.";
        $countError += 1;
    }else{
        $price = $_POST["price"];
    }

    if(isset($_POST["promotion-price"])){
        $promotionPrice = $_POST["promotion-price"];
    }

    if(isset($_POST["product-tag"])){
        $tag = $_POST["product-tag"];
    }

    if(isset($_POST["product-category"])){
        $category = $_POST["product-category"];
    }

    if(isset($_POST["product-color"])){
        $color = $_POST["product-color"];
    }

    if(empty($_POST["condition"])){
        $conditionErr = "Es obligatorio indicar la condición del producto.";
        $countError += 1;
    }

    if($countError > 0){
        $fullFields = false;
    }
}

?>

<link rel="stylesheet" href="view/css/forms.css">
<link rel="stylesheet" href="view/css/create-product.css">
<title>Crear Producto</title>

<div class="create-products-form fieldset">
    <h4>Datos del producto</h4>
    <p class="required-field">Requerido *</p>
    <form method="post" id="form-create-product" enctype="multipart/form-data">
        <div class="inputbox">
            <label for="product-name">Nombre del producto <span class="required-field">* <?php echo $nameProductErr ?></span></label>
            <input type="text" name="product-name" id="product-name" value="<?php echo $nameProduct ?>" required/>
        </div>
        <div class="inputbox">
            <label for="description">Descripción <span class="required-field">* <?php echo $descriptionErr ?></span></label>
            <textarea name="description" id="description" cols="30" rows="10" required><?php echo $description?></textarea>
        </div>
        <div class="inputbox">
            <label for="product-image">Imagen <span class="required-field">* <?php echo $imageProductErr ?></span></label>
            <input type="file" name="product-image" id="product-image" accept="image/jpg, image/jpeg, image/png, image/gif, image/webp" required/>
        </div>
        <div class="inputbox">
            <label for="price">Precio <span class="required-field">* <?php echo $priceErr ?></span></label>
            <input type="number" name="price" id="price" placeholder="0.00" value="<?php echo $price ?>" required/>
        </div>
        <div class="inputbox">
            <label for="promotion-price">Precio de promoción</label>
            <input type="number" name="promotion-price" id="promotion-price" placeholder="0.00" value="<?php echo $promotionPrice ?>"/>
        </div>
        <div class="inputbox">
            <label for="tag_select">Etiqueta</label>
            <select name="product-tag" id="tag-select">
                <option value="">... seleccionar</option>
                <option  value="pencils">Lápices</option>
                <option name="product-tag" value="etiqueta1">etiqueta1</option>
                <option name="product-tag" value="etiqueta2">etiqueta2</option>
                <option name="product-tag" value="etiqueta3">etiqueta3</option>
            </select>
        </div>
        <div class="inputbox">
            <label for="category-select">Categoría</label>
            <select name="product-category" id="category-select">
                <option value="">... seleccionar</option>
                <option name="product-category" value="utiles">Útiles Escolares</option>
            </select>
        </div>
        <div class="inputbox">
            <label for="product-color">Color</label>
            <input type="text" name="product-color" id="product-color" value="<?php echo $color ?>"/>
        </div>
        <div class="inputbox input-radio">
            <label>Condición <span class="required-field">* <?php echo $priceErr ?></span></label>
            <div class="input-radio--options">
                <div>
                    <label for="new">Nuevo</label>
                    <input type="radio" name="condition" id="new" value="product-new" required>
                </div>
                <div>
                    <label for="used">Usado</label>
                    <input type="radio" name="condition" id="used" value="product-used">
                </div>
            </div>
        </div>
        <div class="action-buttons">
            <button type="submit">Guardar</button>
            <button type="button" onclick="btnCancelar()">Cancelar</button>
            <script>
                function btnCancelar() {
                    document.querySelector("#form-create-product").reset();
                    window.location = 'index.php?rute=manage';
                }
    </script>
        </div>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($fullFields){
                $createProduct = FormsController::ctrCreateProduct();

                if($createProduct){
                    echo "<script>
                        alert('El producto se ha sido creado correctamente');   
                    </script>";
                }
            }
        }
        

        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null,null,window.location.href);
            }
        </script>";
        ?>
</div>