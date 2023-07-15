<?php

if (!isset($_SESSION["validate-login"]) || !isset($_SESSION["validate-useradmin"])) {
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
} else if ($_SESSION["validate-login"] != true || $_SESSION["validate-useradmin"] != true) {
    echo "<script>window.location = 'index.php?rute=signin'</script>";
    return;
}

?>

<link rel="stylesheet" href="view/css/tables.css">
<link rel="stylesheet" href="view/css/manage-tables.css">
<title>Administrar Productos</title>

<section>
    <div class="container">
        <h4>Administrar Productos</h4>
        <div class="action-buttons">
            <a href="index.php?rute=manage">
                <button class="back-admin"><i class="fa-solid fa-chevron-left"></i> Volver</button>
            </a>
            <a href="index.php?rute=create-product">
                <button class="newone"><i class="fa-solid fa-plus"></i> Nuevo</button>
            </a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Precio PROMO</th>
                        <th>Etiqueta</th>
                        <th>Categoría</th>
                        <th>Color</th>
                        <th>Condición</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $bringProducts = ProductsController::ctrSelectProducts();
                        $totalProducts = count($bringProducts);

                        $productsPerPage = 3; 

                        // Obtener el número de página actual para cada tabla
                        $productPage = isset($_GET['productPage']) && is_numeric($_GET['productPage']) ? $_GET['productPage'] : 1;

                        // Calcular el índice inicial y final de los productos a mostrar
                        $productStartIndex = ($productPage - 1) * $productsPerPage;
                        $productEndIndex = $productStartIndex + $productsPerPage;

                        // Obtener la sección de productos correspondiente a la página actual
                        $productPageProducts = array_slice($bringProducts, $productStartIndex, $productsPerPage);

                        // Calcular el número total de páginas para cada tabla
                        $totalProductPages = ceil($totalProducts / $productsPerPage);


                        try {
                            if($totalProducts > 0){
                                for($i = $productStartIndex; $i < $productEndIndex && $i < $totalProducts; $i++){
                                    $counter = $i + 1;
                                    $item = $productPageProducts[$i - $productStartIndex];
                    ?>
                    <tr>
                        <td><?php echo $counter?></td>
                        <td>
                            <?php
                                $image = "view/img/products/".$item["image"];
                                if (file_exists($image)) {
                            ?>
                                <img src="<?php echo $image ?>" alt="product image">
                            <?php } else  { ?>
                                <img src="view/img/jpg/img-placeholder.jpg"/>
                            <?php } ?>
                        </td>
                        <td><?php echo $item["product_name"] ?></td>
                        <td>
                            <?php
                                $description = $item["description"];
                                $truncatedDescription = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                                echo $truncatedDescription;
                            ?>
                        </td>
                        <td><?php echo $item["price"] ?></td>
                        <td><?php echo $item["promotion_price"] ?></td>
                        <td><?php echo $item["tag_name"] ?></td>
                        <td><?php echo $item["category_name"] ?></td>
                        <td><?php echo $item["color"] ?></td>
                        <td>
                            <?php
                                if($item["condition"] == 1){
                                    echo "Nuevo";
                                }else{
                                    echo "Usado";
                                }
                            ?>
                        </td>
                        <td>
                            <button class="delete" onclick="popUpDeleteConfirm(<?php echo intval($item['id']) ?>, 'product')"><i class="fas fa-trash"></i></button>
                            <a href="index.php?rute=update-product&id=<?php echo intval($item['id']) ?>"><button class="update"><i class="fas fa-sync-alt"></i></button></a>
                        </td>
                    </tr>
                    <?php
                                }
                            } else {
                                echo "<td colspan=11>No hay productos</td>";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- Navegación de páginas para la tabla de productos -->
        <div class="pagination">
        <?php
            $maxPagesToShow = 5; // Máximo número de páginas a mostrar

            // Calcular el rango de páginas a mostrar
            $startPage = max(1, $productPage - floor($maxPagesToShow / 2));
            $endPage = min($startPage + $maxPagesToShow - 1, $totalProductPages);

            // Mostrar flecha para ir a la página anterior si no es la primera página
            if ($productPage > 1) {
        ?>
            <a href="index.php?rute=manage-products&productPage=<?php echo ($productPage - 1); ?>"><i class="fas fa-chevron-left"></i></a>
        <?php
            }

            // Mostrar puntos suspensivos si hay más de una página antes del rango mostrado
            if ($startPage > 1) {
        ?>
            <span>...</span>
        <?php
            }

            // Mostrar enlaces de páginas dentro del rango
            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $productPage) {
                ?>
                <a class="active" href="index.php?rute=manage-products&productPage=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php } else { ?>
                <a href="index.php?rute=manage-products&productPage=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php
                }
            }

            // Mostrar puntos suspensivos si hay más de una página después del rango mostrado
            if ($endPage < $totalProductPages) {
        ?>
            <span>...</span>
        <?php
            }

            // Mostrar flecha para ir a la página siguiente si no es la última página
            if ($productPage < $totalProductPages) {
                ?>
                <a href="index.php?rute=manage-products&productPage=<?php echo ($productPage + 1); ?>"><i class="fas fa-chevron-right"></i></a>
        <?php
            }
        ?>
        </div>
    </div>
</section>

<div class="overlay-delete-confirm" style="display: none;"></div>
<div class="delete-confirm" style="display: none;">
    <h3>Confirmar eliminación</h3>
    <p>¿Estás seguro de realizar esta acción?</p>
    <div class="confirm-buttons">
        <button class="confirm-delete">Eliminar</button>
        <button class="confirm-cancel">Cancelar</button>
    </div>
</div>
<script>
    let idToDelete = null;
    let targetToRemove = null;
    
    function popUpDeleteConfirm(id, target) {
        const popUpDelete = document.querySelector(".delete-confirm");
        const overlay = document.querySelector(".overlay-delete-confirm");
        popUpDelete.style.display = "flex";
        overlay.style.display = "block";
        idToDelete = id;
        targetToRemove = target;
    }

    function cancelDelete() {
        const popUpDelete = document.querySelector(".delete-confirm");
        const overlay = document.querySelector(".overlay-delete-confirm");
        popUpDelete.style.display = "none";
        overlay.style.display = "none";    
    }

    function deleteProduct(idToDelete) {
        if (targetToRemove == "product") {
            window.location.href = "index.php?rute=delete-product&id=" + idToDelete;
        } else if (targetToRemove == "user") {
            window.location.href = "index.php?rute=delete-user&id=" + idToDelete;
        }
    }

    const deleteButton = document.querySelector(".confirm-delete");
    const cancelButton = document.querySelector(".confirm-cancel");
    deleteButton.onclick = () => deleteProduct(idToDelete);
    cancelButton.onclick = cancelDelete;
</script>