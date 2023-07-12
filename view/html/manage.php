<link rel="stylesheet" href="view/css/manage.css">
<title>Administrador</title>

<section>
    <div class="container">
        <h4>Administrar Productos</h4>
        <a href="index.php?rute=create-product">
            <button class="new-product"><i class="fa-solid fa-plus"></i> Nuevo</button>
        </a>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Precio PROMO</th>
                        <th>Etiqueta</th>
                        <th>Categoría</th>
                        <th>Color</th>
                        <th>Condición</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $bringProducts = FormsController::ctrSelectProducts();
                        $quantityProducts = count($bringProducts);
                        try {
                            if($quantityProducts > 0){
                                for($i = 0; $i < $quantityProducts; $i++){
                                    $counter = $i + 1;
                                    $item = $bringProducts[$i];
                    ?>
                    <tr>
                        <td><?php echo $counter?></td>
                        <td>
                            <?php
                                $image = "view/img/products/".$item["image"];
                                if (file_exists($image)) {
                            ?>
                                <img src="<?php echo $image ?>" alt="product image">
                            <?php } else  { ?>
                                <img src="view/img/jpg/img-placeholder.jpg"/>
                            <?php } ?>
                        </td>
                        <td><?php echo $item["product_name"] ?></td>
                        <td>
                            <?php
                                $description = $item["description"];
                                $truncatedDescription = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                                echo $truncatedDescription;
                            ?>
                        </td>
                        <td><?php echo $item["price"] ?></td>
                        <td><?php echo $item["promotion_price"] ?></td>
                        <td><?php echo $item["tag_name"] ?></td>
                        <td><?php echo $item["category_name"] ?></td>
                        <td><?php echo $item["color"] ?></td>
                        <td>
                            <?php
                                if($item["condition"] == 1){
                                    echo "Nuevo";
                                }else{
                                    echo "Usado";
                                }
                            ?>
                        </td>
                        <td>
                            <button class="delete-product" onclick="popUpDeleteConfirm(<?php echo intval($item['id']) ?>)"><i class="fas fa-trash"></i></button>
                            <a href="index.php?rute=update-product"><button class="update"><i class="fas fa-sync-alt"></button></i></a>
                        </td>
                    </tr>
                    <?php
                                }
                            } else {
                                echo "<td colspan=11>No hay productos</td>";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <h4>Administrar Ususarios</h4>
        <a href="index.php?rute=signup">
            <button class="new-product"><i class="fa-solid fa-plus"></i> Nuevo</button>
        </a>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Contraseña</th>
                        <th>Fecha De Registro</th>
                        <th>Admin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $bringUsers = FormsController::ctrSelectUsers();
                        try {
                            $quantityUsers = count($bringUsers);
                            if($quantityUsers > 0){
                                for($i = 0; $i < $quantityUsers; $i++){
                                    $counter = $i + 1;
                                    $item = $bringUsers[$i];
                    ?>
                    <tr>
                        <td><?php echo $counter?></td>
                        <td><?php echo $item["username"] ?></td>
                        <td><?php echo $item["email"] ?></td>
                        <td><?php echo $item["password"] ?></td>
                        <td><?php echo $item["registration_date"] ?></td>
                        <td>
                            <?php
                                if($item["useradmin"] == 1){
                                    echo "Si";
                                }else{
                                    echo "No";
                                }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?rute=delete-product"><button class="delete"><i class="fas fa-trash"></i></button></a>
                            <a href="index.php?rute=update-product"><button class="update"><i class="fas fa-sync-alt"></button></i></a>
                        </td>
                    </tr>
                    <?php
                                }
                            }
                        } catch(Exception $e) {
                            echo "No se encontraron resultados";
                            print_r($bringUsers->ErrorInfo);
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="overlay-delete-confirm" style="display: none;"></div>
<div class="delete-confirm" style="display: none;">
    <h3>Confirmar eliminación</h3>
    <p>¿Estás seguro de eliminar el producto?</p>
    <div>
        <button class="confirm-delete">Eliminar</button>
        <button class="confirm-cancel">Cancelar</button>
    </div>
</div>
<script>
    let idToDelete = null
    
    function popUpDeleteConfirm(id) {
        const popUpDelete = document.querySelector(".delete-confirm");
        const overlay = document.querySelector(".overlay-delete-confirm");
        popUpDelete.style.display = "flex";
        overlay.style.display = "block";
        idToDelete = id;
    }

    function cancelDelete() {
        const popUpDelete = document.querySelector(".delete-confirm");
        const overlay = document.querySelector(".overlay-delete-confirm");
        popUpDelete.style.display = "none";
        overlay.style.display = "none";    
    }

    function deleteProduct(idToDelete) {
        window.location.href = "index.php?rute=delete-product&id=" + idToDelete;
    }

    const deleteButton = document.querySelector(".confirm-delete");
    const cancelButton = document.querySelector(".confirm-cancel");
    deleteButton.onclick = () => deleteProduct(idToDelete);
    cancelButton.onclick = cancelDelete;
</script>