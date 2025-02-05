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
<title>Administrar Usuarios</title>

<section>
    <div class="container">
        <h4>Administrar Ususarios</h4>
        <div class="action-buttons">
            <a href="index.php?rute=manage">
                <button class="back-admin"><i class="fa-solid fa-chevron-left"></i> Volver</button>
            </a>
            <a href="index.php?rute=create-user">
                <button class="newone"><i class="fa-solid fa-plus"></i> Nuevo</button>
            </a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Fecha De Registro</th>
                        <th>Admin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $bringUsers = UserController::ctrSelectUsers();
                    $totalUsers = count($bringUsers);

                    $usersPerPage = 10; // Número máximo de usuarios por página
                    
                    // Obtener el número de página actual para cada tabla
                    $userPage = isset($_GET['userPage']) && is_numeric($_GET['userPage']) ? $_GET['userPage'] : 1;
                                        
                    // Calcular el índice inicial y final de los usuarios a mostrar
                    $userStartIndex = ($userPage - 1) * $usersPerPage;
                    $userEndIndex = $userStartIndex + $usersPerPage;
                    
                    // Obtener la sección de usuarios correspondiente a la página actual
                    $userPageUsers = array_slice($bringUsers, $userStartIndex, $usersPerPage);
                    
                    // Calcular el número total de páginas para cada tabla
                    $totalUserPages = ceil($totalUsers / $usersPerPage);

                    try {
                        $adminUsername = $_SESSION["username"];
                        $adminUser = null;
                
                        // Buscar y guardar el usuario administrador actual
                        foreach ($bringUsers as $user) {
                            if ($user["username"] == $adminUsername && $user["useradmin"] == 1) {
                                $adminUser = $user;
                                break;
                            }
                        }
                
                        if ($adminUser) {
                            // Mostrar la fila del usuario administrador primero
                            $counter = $userStartIndex + 1;
                ?>
                    <tr class="actualadmin">
                        <td><?php echo $counter ?></td>
                        <td><?php echo $adminUser["username"] ?></td>
                        <td><?php echo $adminUser["email"] ?></td>
                        <td><?php echo $adminUser["registration_date"] ?></td>
                        <td><?php echo $adminUser["useradmin"] == 1 ? "Si" : "No" ?></td>
                        <td>
                            <button style="pointer-events: none"><i class="fas fa-trash"></i></button>
                            <button style="pointer-events: none"><i class="fas fa-sync-alt"></i></button>
                        </td>
                    </tr>
                <?php
                
                            // Resto del código para mostrar las filas de los demás usuarios
                            for ($i = $userStartIndex; $i < $userEndIndex && $i < $totalUsers; $i++) {
                                $user = $bringUsers[$i];
                                if ($user != $adminUser) {
                                    $counter++;
                ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $user["username"] ?></td>
                        <td><?php echo $user["email"] ?></td>
                        <td><?php echo $user["registration_date"] ?></td>
                        <td><?php echo $user["useradmin"] == 1 ? "Si" : "No" ?></td>
                        <td>
                            <button class="delete" onclick="popUpDeleteConfirm(<?php echo intval($user['id']) ?>, 'user')"><i class="fas fa-trash"></i></button>
                            <a href="index.php?rute=update-user&id=<?php echo intval($user['id']) ?>"><button class="update"><i class="fas fa-sync-alt"></button></i></a>
                        </td>
                    </tr>
                <?php
                                }
                            }
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Navegación de páginas para la tabla de usuarios -->
        <div class="pagination">
        <?php
            $maxPagesToShow = 5; // Máximo número de páginas a mostrar

            // Calcular el rango de páginas a mostrar
            $startPage = max(1, $userPage - floor($maxPagesToShow / 2));
            $endPage = min($startPage + $maxPagesToShow - 1, $totalUserPages);

            // Mostrar flecha para ir a la página anterior si no es la primera página
            if ($userPage > 1) {
        ?>
            <a href="index.php?rute=manage-users&userPage=<?php echo ($userPage - 1); ?>"><i class="fas fa-chevron-left"></i></a>
        <?php
            }

            // Mostrar enlaces de páginas dentro del rango
            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $userPage) {
                ?>
                <a class="active" href="index.php?rute=manage-users&userPage=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php } else { ?>
                <a href="index.php?rute=manage-users&userPage=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php
                }
            }

            // Mostrar flecha para ir a la página siguiente si no es la última página
            if ($userPage < $totalUserPages) {
        ?>
                <a href="index.php?rute=manage-users&userPage=<?php echo ($userPage + 1); ?>"><i class="fas fa-chevron-right"></i></a>
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