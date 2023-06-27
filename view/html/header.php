<header>
    <div class="header">
        <div class="header__container">
            <a href="index.php?rute=home">
                <figure class="header__logo">
                    <img src="view/img/png/logotipo-normal.png" alt="">
                    <h1>ELLO</h1>
                </figure>
            </a>
            <nav class="header__nav--main">
                <span class="show-menu"><i class="fa-solid fa-bars"></i></span>
                <div class="header__nav--list closed">
                    <span class="hide-menu"><i class="fa-regular fa-circle-xmark"></i></span>
                    <ul>
                        <?php include 'nav-menu.php'?>
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
                    <i class="fa-solid fa-magnifying-glass placeholder-search icon"></i>                   
                    <span class="placeholder-search text">Buscar</span>
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

                        if(isset($_SESSION["validate-login"])) {
                            if($_SESSION["validate-login"] == true){
                                $logueado = true;
                            }
                        }
                        if(isset($_SESSION["validate-useradmin"])) {
                            if($_SESSION["validate-useradmin"] == true){
                                $esAdmin = true;
                            }
                        }

                        // Llamar a la función para generar e imprimir la lista de opciones
                        generarListaOpciones($logueado, $esAdmin);
                    ?>
                </div>
                <script>
                    // Mostrar opciones de usuario ==============================
                    const button = document.querySelector('.header__nav--useroptions--button');
                    const navUser = document.querySelector('.header__nav--useroptions');
                    const userMenu = document.querySelector('.menu-opciones-usuario');

                    function displayMenu (element) {
                        element.addEventListener('mouseover', function() {
                            button.classList.add('hovered');
                        });

                        element.addEventListener('mouseout', function() {
                            button.classList.remove('hovered');
                        }); 
                    }

                    displayMenu(navUser);
                    displayMenu(userMenu);

                    // Buscador en móviles =========================================
                    const header = document.querySelector('.header');
                    const headerContainer = document.querySelector('.header__container');
                    const logo = document.querySelector('.header__logo');
                    const navMenu = document.querySelector('.header__nav--main');
                    const containerSearcher = document.querySelector('.header__searcher--placeholder');
                    const inputSearch = document.querySelector('.header__searcher--input');
                    const iconSearch = document.querySelector('.placeholder-search.icon');
                    let overlaySearch = document.querySelector(".overlay-search");

                    // Función para poder intercalar eventos en el icono de busqueda.
                    iconSearch.addEventListener("click", startSearch)

                    function startSearch() {
                        logo.classList.add('hideItForSearch');
                        navMenu.classList.add('hideItForSearch');
                        navUser.classList.add('hideItForSearch');
                        headerContainer.classList.add('clickToSearch');
                        containerSearcher.classList.add('clickToSearch');
                        inputSearch.classList.add('clickToSearch');
                        inputSearch.focus();
                        iconSearch.classList.add('clickToSearch');

                        if (!overlaySearch) {
                            overlaySearch = document.createElement("div");
                            overlaySearch.classList.add("overlay-search");
                            overlaySearch.addEventListener("click", endSearch);

                            // Insertar el overlay anter del header
                            header.parentNode.insertBefore(overlaySearch, header);
                        }
                    };

                    function endSearch() {
                        logo.classList.remove('hideItForSearch');
                        navMenu.classList.remove('hideItForSearch');
                        navUser.classList.remove('hideItForSearch');
                        headerContainer.classList.remove('clickToSearch');
                        containerSearcher.classList.remove('clickToSearch');
                        inputSearch.classList.remove('clickToSearch');
                        iconSearch.classList.remove('clickToSearch');

                        overlaySearch.remove();
                        overlaySearch = null
                    }
                </script>
            </div>
        </div>
    </div>
</header>