<header>
    <div class="header">
        <div class="header__container">
            <figure class="header__logo">
                <img src="../img/png/logotipo-normal.png" alt="">
                <h1>ELLO</h1>
            </figure>
            <nav class="header__nav--main">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="tienda.php">Tienda</a></li>
                    <li><a href="nosotros.php">Nosotros</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </nav>
            <div class="header__searcher">
                <!-- cambiar por un input -->
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path d="M17.545 15.467l-3.779-3.779c0.57-0.935 0.898-2.035 0.898-3.21 0-3.417-2.961-6.377-6.378-6.377s-6.186 2.769-6.186 6.186c0 3.416 2.961 6.377 6.377 6.377 1.137 0 2.2-0.309 3.115-0.844l3.799 3.801c0.372 0.371 0.975 0.371 1.346 0l0.943-0.943c0.371-0.371 0.236-0.84-0.135-1.211zM4.004 8.287c0-2.366 1.917-4.283 4.282-4.283s4.474 2.107 4.474 4.474c0 2.365-1.918 4.283-4.283 4.283s-4.473-2.109-4.473-4.474z"></path>
                </svg>                    
                <span class="header__searcher--placeholder">Buscar</span>
            </div>
            <div class="header__nav--useroptions">
                <input type="checkbox" name="" id="active-useroptions">
                <label class="header__nav--useroptions--button">
                    <i class="fa-regular fa-user"></i>
                    <i class="fa-solid fa-chevron-down"></i>
                </label>
                <!-- menu desplegable -->
                <div class="menu-opciones-usuario">
                    <?php
                        include 'user-options-menu-header.php';

                        $logueado = true; // Esto cambia según la lógica de la aplicación
                        $esAdmin = false; // Esto cambia según la lógica de la aplicación

                        // Llamar a la función para generar e imprimir la lista de opciones
                        generarListaOpciones($logueado, $esAdmin);
                    ?>
                </div>
                <script>
                    const checkbox = document.getElementById("active-useroptions");
                    const label = document.querySelector(".header__nav--useroptions--button");

                    label.addEventListener("click", function() {
                        checkbox.checked = !checkbox.checked;
                    });
                </script>
            </div>
        </div>
    </div>
</header>