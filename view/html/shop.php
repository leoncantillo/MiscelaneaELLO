<link rel="stylesheet" href="view/css/slider.css">
<link rel="stylesheet" href="view/css/shop.css">
<title>Shop</title>

<?php $directory = "view/img/slides"; include 'slider.php'?>
<section class="tienda-home">
    <h4 class="titulo-producto-filtro">Filtros</h4>
    <aside class="aside-filtros">
        <ul class="filtros">
            <li>Etiquetas</li>
            <li>Categorías</li>
            <li>Ubicación</li>
            <li>Condición
                <ul class="sub-filtros">
                    <li>Nuevo</li>
                    <li>Usado</li>
                </ul>
            </li>
        </ul>
    </aside>
    <div class="ordenar-productos">Ordenar por <span class="filtros-de-orden">Más Vendidos <?php include 'view/img/svg/icon-chevron-down.svg'?></span></div>
    <section class="showcase">
        <div class="productos-en-venta">
        <?php
            $bringProducts = ProductsController::ctrSelectProducts();
            $totalProducts = count($bringProducts);

            $productsPerPage = 10; 

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
            <div class="producto-en-vitrina">
                <div class="imagen-producto">
                <?php
                    $image = "view/img/products/".$item["image"];
                    if (!empty($item["image"]) && file_exists($image)) {
                ?>
                    <img src="<?php echo $image ?>" alt="product image">
                <?php } else  { ?>
                    <img src="view/img/jpg/img-placeholder.jpg"/>
                <?php } ?>
                </div>
                <div class="descripcion-del-producto">
                    <div class="info-producto">
                        <h3 class="nombre-producto"><?php echo $item["product_name"]?></h3>
                        <span class="precio-descuento">$ <?php echo $item["promotion_price"] ?> cop</span>
                        <span class="precio-producto">$ <?php echo $item["price"] ?> cop</span>
                        <p class="info">
                        <?php
                            $description = $item["description"];
                            $truncatedDescription = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                            echo $truncatedDescription;
                        ?>
                        </p>
                    </div>
                    <div class="etiquetas-producto">
                        <?php if (!empty($item["tag_name"])) { ?>
                            <span>Etiquetas: <?php echo $item["tag_name"] ?></span>
                        <?php } ?>
                        <?php if (!empty($item["category_name"])) { ?>
                            <span>Categoría: <?php echo $item["category_name"] ?></span>
                        <?php } ?>
                        <?php if (!empty($item["color"])) { ?>
                                <span>Color: <?php echo $item["color"] ?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
                    }
                } else {
                    echo "No hay productos";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
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

            // Mostrar flecha para ir a la página siguiente si no es la última página
            if ($productPage < $totalProductPages) {
        ?>
                <a href="index.php?rute=manage-products&productPage=<?php echo ($productPage + 1); ?>"><i class="fas fa-chevron-right"></i></a>
        <?php
            }
        ?>
        </div>
    </section>
</section>
