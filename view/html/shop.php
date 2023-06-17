<head>
    <link rel="stylesheet" href="view/css/slider.css">
    <link rel="stylesheet" href="view/css/shop.css">
    <title>Shop</title>
</head>
<?php $directory = "view/img/jpg/slides"; include 'slider.php'?>
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
            <div class="producto-en-vitrina">
                <div class="imagen-producto">
                    <img src="view/img/jpg/Productos/Cuaderno anillado.jpg" alt="">
                </div>
                <div class="descripcion-del-producto">
                    <div class="info-producto">
                        <h3 class="nombre-producto">Cuaderno Anillado 5 Materias</h3>
                        <span class="precio-descuento"></span>
                        <span class="precio-producto">$ 8000.00 cop</span> <!--Este valor será dinámico -->
                        <p class="info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam iure sit est fugit magni earum enim et inventore quia dolores?</p>
                    </div>
                    <div class="etiquetas-producto">
                        <span>Etiquetas: Taltal</span>
                        <span>Categoría: Blablabla</span>
                        <span>Color: Rojo</span>
                    </div>
                </div>
            </div>
            <div class="producto-en-vitrina">
                <div class="imagen-producto">
                    <img src="view/img/jpg/Productos/Caja Lapiz HB.jpg" alt="">
                </div>
                <div class="descripcion-del-producto">
                    <div class="info-producto">
                        <h3 class="nombre-producto">Caja De Lapices HB Faber Castell</h3>
                        <span class="precio-descuento">$ 6000.00 cop</span>
                        <span class="precio-producto">$ 4800.00 cop</span>
                        <p class="info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam iure sit est fugit magni earum enim et inventore quia dolores?</p>
                    </div>
                    <div class="etiquetas-producto">
                        <span>Etiquetas: </span>
                        <span>Categoría: Útiles</span>
                        <span>Color: Verde</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
