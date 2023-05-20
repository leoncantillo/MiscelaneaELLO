<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/slider.css">
    <link rel="stylesheet" href="../css/tienda.css">
    <title>Miscelanea ELLO</title>
</head>
<body>
    <?php include 'header.html'?>
    <?php include 'slider.php'?>
    <section class="tienda-home">
        <aside>
            <h4>Filtros</h4>
            <ul>
                <li>Etiquetas</li>
                <li>Categorías</li>
                <li>Ubicación</li>
                <li>Condición
                    <ul>
                        <li>Nuevo</li>
                        <li>Usado</li>
                    </ul>
                </li>
            </ul>
        </aside>
        <section>
            <div class="ordenar-productos">Ordenar por <span class="filtros-de-orden">Más Vendidos <?php include '../img/svg/icon-chevron-down.svg'?></span></div>
            <div class="productos-en-venta">
                <div class="producto-en-vitrina">
                    <div class="imagen-producto">
                        <img src="../img/jpg/Productos/Cuaderno anillado.jpg" alt="">
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
                        <img src="../img/jpg/Productos/Caja Lapiz HB.jpg" alt="">
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
</body>
</html>