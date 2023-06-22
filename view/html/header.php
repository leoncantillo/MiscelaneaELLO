<header>
    <div class="header">
        <div class="header__container">
            <figure class="header__logo">
                <img src="view/img/png/logotipo-normal.png" alt="">
                <h1>ELLO</h1>
            </figure>
            <nav class="header__nav--main">
                <span class="show-menu"><i class="fa-solid fa-bars"></i></span>
                <div class="header__nav--list closed">
                    <span class="hide-menu"><i class="fa-regular fa-circle-xmark"></i></span>
                    <ul>
                        <?php if(isset($_GET["rute"])): ?>
                            <!-- HOME -->
                            <?php if($_GET["rute"] == "home"): ?>
                                <li><a class="active" href="index.php?rute=home">Inicio</a></li>
                            <?php else: ?>
                                <li><a href="index.php?rute=home">Inicio</a></li>
                            <?php endif ?>

                            <!-- SHOP -->
                            <?php if($_GET["rute"] == "shop"): ?>
                                <li><a class="active" href="index.php?rute=shop">Tienda</a></li>
                            <?php else: ?>
                                <li><a href="index.php?rute=shop">Tienda</a></li>
                            <?php endif ?>

                            <!-- ABOUT US -->
                            <?php if($_GET["rute"] == "about-us"): ?>
                                <li><a class="active" href="index.php?rute=about-us">Nosotros</a></li>
                            <?php else: ?>
                                <li><a href="index.php?rute=about-us">Nosotros</a></li>
                            <?php endif ?>

                            <!-- CONTACT -->
                            <?php if($_GET["rute"] == "contact"): ?>
                                <li><a class="active" href="index.php?rute=contact">Contacto</a></li>
                            <?php else: ?>
                                <li><a href="index.php?rute=contact">Contacto</a></li>
                            <?php endif ?>

                        <?php else:?>

                            <li><a href="index.php?rute=home">Inicio</a></li>
                            <li><a href="index.php?rute=shop">Tienda</a></li>
                            <li><a href="index.php?rute=about_us">Nosotros</a></li>
                            <li><a href="index.php?rute=contact">Contacto</a></li>

                        <?php endif ?>
                    </ul>
                </div>
                <script>
                    const headerNavList = document.querySelector(".header__nav--list");
                    const showMenu = document.querySelector(".show-menu");
                    const hideMenu = document.querySelector(".hide-menu");

                    showMenu.addEventListener("click", function(){
                        headerNavList.classList.remove("closed");
                    });

                    hideMenu.addEventListener("click", function(){
                        headerNavList.classList.add("closed")
                    })
                </script>
            </nav>
            <div class="header__searcher">
                <input class="header__searcher--input" type="text" required/>
                <div class="header__searcher--placeholder">
                    <i class="fa-solid fa-magnifying-glass"></i>                   
                    <span>Buscar</span>
                </div>
            </div>
            <div class="header__nav--useroptions">
                <input class="header__nav--useroptions--select" type="checkbox" name="" id="useroptions--select">
                <label class="header__nav--useroptions--button" for="useroptions--select">
                    <i class="fa-regular fa-user"></i>
                    <i class="fa-solid fa-chevron-down"></i>
                </label>
                <!-- menu desplegable -->
                <div class="menu-opciones-usuario">
                    <?php
                        include 'user-options-menu-header.php';

                        $logueado = false; // Esto cambia según la lógica de la aplicación
                        $esAdmin = false; // Esto cambia según la lógica de la aplicación

                        // Llamar a la función para generar e imprimir la lista de opciones
                        generarListaOpciones($logueado, $esAdmin);
                    ?>
                </div>
                <script>
                    const button = document.querySelector('.header__nav--useroptions--button');
                    const content = document.querySelector('.header__nav--useroptions');
                    const menu = document.querySelector('.menu-opciones-usuario');

                    function displayMenu (element) {
                        element.addEventListener('mouseover', function() {
                            button.classList.add('hovered');
                        });

                        element.addEventListener('mouseout', function() {
                            button.classList.remove('hovered');
                        }); 
                    }

                    displayMenu(content);
                    displayMenu(menu)
                </script>
            </div>
        </div>
    </div>
</header>