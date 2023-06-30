<?php
function generarListaOpciones($logueado, $esAdmin) {
    if (!$logueado) {
        // Lista si el usuario es invitado
        echo '
        <ul>
            <li><a href="index.php?rute=signin">Iniciar Sesión <i class="fa-solid fa-right-to-bracket"></i></a></li>
            <li><a href="index.php?rute=signup">Registrarse <i class="fa-solid fa-user-plus"></i></a></li>
        </ul>';
    } elseif ($esAdmin) {
        // Lista de usuario administrador
        echo '
        <ul>
            <li>Perfil</li>
            <li><a href="index.php?rute=profile">Ver Perfil <i class="fa-solid fa-user"></i></a></li>
            <li><a href="#">Configuración <i class="fa-solid fa-gear"></i></a></li>
            <li><a href="#">Notificaciones <i class="fa-solid fa-bell"></i></a></li>
            <li>Administrador</li>
            <li><a href="#">Pedidos <i class="fa-solid fa-tag"></i></a></li>
            <li><a href="#">Gestionar Ventas <i class="fa-solid fa-sack-dollar"></i></a></li>
            <li><a href="#">Preguntas <i class="fa-solid fa-circle-question"></i></a></li>
            <li><a href="index.php?rute=manage">Administrar <i class="fa-solid fa-key"></i></a></li>
            <li><a href="index.php?rute=logout">Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>';
    } else {
        // Lista si el usuario está logueado
        echo '
        <ul>
            <li><a href="index.php?rute=profile">Ver Perfil <i class="fa-solid fa-user"></i></a></li>
            <li><a href="#">Notificaciones <i class="fa-solid fa-bell"></i></a></li>
            <li><a href="#">Configuración <i class="fa-solid fa-gear"></i></a></li>
            <li><a href="index.php?rute=logout">Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>';
    }
}
?>
