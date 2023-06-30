<link rel="stylesheet" href="view/css/forms.css">
<link rel="stylesheet" href="view/css/create-product.css">

<div class="create-products-form fieldset">
    <h4>Datos del producto</h4>
    <p class="require-field">Requerido *</p>
    <form method="post">
        <div class="inputbox">
            <label for="product-name">Nombre del producto:</label>
            <input type="text" name="product-name" id="product-name"/>
        </div>
        <div class="inputbox">
            <label for="description">Descripción:</label>
            <textarea name="" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="inputbox">
            <label for="category-select">Categoría</label>
            <select name="category-select" id="category-select">
                <option value="">... seleccionar</option>
            </select>
        </div>
        <div class="inputbox">
            <label for="product-image">Imagen:</label>
            <input type="file" name="" id="product-image">
        </div>
        <div class="inputbox">
            <label for="price">Precio:</label>
            <input type="text" name="price" id="price" placeholder="0.00"/>
        </div>
        <div class="action-buttons">
            <button type="submit">Guardar</button>
            <button type="button">Cancelar</button>
        </div>
    </form>
</div>