<?php

Class ProductsController {
# ============================= CRUD PRODUCT ==============================

    # CREATE ----------------------------------
    static public function ctrCreateProduct() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_products";
            # se empieza desde la carpeta /controllers
            $destinationFolder = "/../view/img/products/";

            $postFile = $_FILES["product-image"];

            $conditionValue = 0;
            if(isset($_POST["condition"])){
                if($_POST["condition"] == "product-new")
                    $conditionValue = 1;
            }

            $data = array("product_name" => GlobalController::test_input($_POST["product-name"]),
                          "description" => GlobalController::test_input($_POST["description"]),
                          "image" => GlobalController::upload_file($postFile, $destinationFolder),
                          "price" => GlobalController::test_input($_POST["price"]),
                          "promotion_price" => GlobalController::test_input($_POST["promotion-price"]),
                          "tag_id" => GlobalController::test_input($_POST["product-tag"]),
                          "category_id" => GlobalController::test_input($_POST["product-category"]),
                          "color" => GlobalController::test_input($_POST["product-color"]),
                          "condition" => GlobalController::test_input($conditionValue));
            
            $answer = GlobalModel::mdlInsertData($table, $data);
            return $answer;
        }
    }

    # READ -------------------------------
    static public function ctrSelectProducts() {
        $table = "ellodb_products";
        $answer = GlobalModel::mdlFetchData($table, null, null);
        return $answer;
    }

    static public function ctrSelectProductsWithId($id) {
        $table = "ellodb_products";
        $columnName = "id";
        $idFetch = GlobalController::test_input($id);
        $answer = GlobalModel::mdlFetchData($table, $columnName, $idFetch);
        return $answer;
    }

    static public function ctrSelectTags() {
        $table = "ellodb_tags";
        $answer = GlobalModel::mdlFetchData($table, null, null);
        return $answer;
    }

    static public function ctrSelectCategories() {
        $table = "ellodb_categories";
        $answer = GlobalModel::mdlFetchData($table, null, null);
        return $answer;
    }

    # UPDATE ----------------------------------
    static public function ctrUpdateProduct() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $table = "ellodb_products";
            
            $promotionPrice = GlobalController::test_input($_POST['promotion-price']);
            if (empty($promotionPrice) || floatval($promotionPrice) === 0) {
                $promotionPrice = null;
            }

            $conditionValue = 0;
            if(isset($_POST["condition"])){
                if($_POST["condition"] == "product-new")
                    $conditionValue = 1;
            }

            $data = array("id" => GlobalController::test_input($_POST["product-id"]),
                          "product_name" => GlobalController::test_input($_POST["product-name"]),
                          "description" => GlobalController::test_input($_POST["description"]),
                          "price" => GlobalController::test_input($_POST["price"]),
                          "promotion_price" => $promotionPrice,
                          "tag_id" => GlobalController::test_input($_POST["product-tag"]),
                          "category_id" => GlobalController::test_input($_POST["product-category"]),
                          "color" => GlobalController::test_input($_POST["product-color"]),
                          "condition" => GlobalController::test_input($conditionValue));

            # se empieza desde la carpeta /controllers
            $destinationFolder = "/../view/img/products/";

            if (!empty($_POST["product-image-temp"])) {
                $data["image"] = GlobalController::test_input($_POST["product-image-temp"]);
            }

            if (!empty($_FILES["product-image"]["name"])) {
                $postFile = $_FILES["product-image"];
                $data["image"] = GlobalController::upload_file($postFile, $destinationFolder);
            }
            
            $answer = GlobalModel::mdlUpdateData($table, $data);
            return $answer;
        }
    }

    # DELETE ----------------------------------
    static public function ctrDeleteProducts($id) {
        $table = "ellodb_products";
        $idProduct = GlobalController::test_input($id);
        $answer = GlobalModel::mdlDeleteData($table, $idProduct);
        return $answer;
    }
}

?>