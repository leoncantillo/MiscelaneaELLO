<header>
    <div class="header">
        <div class="header__container">
            <figure class="header__logo">
                <img src="view/img/png/logotipo-normal.png" alt="">
                <h1>ELLO</h1>
            </figure>
            <nav class="header__nav--main">
                <span class="show-menu"><i class="fa-solid fa-bars">H</i></span>
                <div class="header__nav--list closed">
                    <span class="hide-menu"><i class="fa-regular fa-circle-xmark">X</i></span>
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
                <!-- cambiar por un input -->
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path d="M17.545 15.467l-3.779-3.779c0.57-0.935 0.898-2.035 0.898-3.21 0-3.417-2.961-6.377-6.378-6.377s-6.186 2.769-6.186 6.186c0 3.416 2.961 6.377 6.377 6.377 1.137 0 2.2-0.309 3.115-0.844l3.799 3.801c0.372 0.371 0.975 0.371 1.346 0l0.943-0.943c0.371-0.371 0.236-0.84-0.135-1.211zM4.004 8.287c0-2.366 1.917-4.283 4.282-4.283s4.474 2.107 4.474 4.474c0 2.365-1.918 4.283-4.283 4.283s-4.473-2.109-4.473-4.474z"></path>
                </svg>                    
                <span class="header__searcher--placeholder">Buscar</span>
            </div>
            <div class="header__nav--useroptions">
                <div class="header__nav--useroptions--button">
                    <i class="fa-regular fa-user"></i>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
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