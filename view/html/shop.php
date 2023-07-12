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
    <section>
        <div class="productos-en-venta">
        <?php
            $bringProducts = ProductsController::ctrSelectProducts();
            $quantityProducts = count($bringProducts);
            try {
                if($quantityProducts > 0){
                    for($i = 0; $i < $quantityProducts; $i++){
                        $counter = $i + 1;
                        $item = $bringProducts[$i];
        ?>
            <div class="producto-en-vitrina">
                <div class="imagen-producto">
                <?php
                    $image = "view/img/products/".$item["image"];
                    if (file_exists($image)) {
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
    </section>
</section>
