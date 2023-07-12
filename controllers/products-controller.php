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

            $data = array("product_name" => GlobalControllers::test_input($_POST["product-name"]),
                          "description" => GlobalControllers::test_input($_POST["description"]),
                          "image" => GlobalControllers::upload_file($postFile, $destinationFolder),
                          "price" => GlobalControllers::test_input($_POST["price"]),
                          "promotion_price" => GlobalControllers::test_input($_POST["promotion-price"]),
                          "tag_id" => GlobalControllers::test_input($_POST["product-tag"]),
                          "category_id" => GlobalControllers::test_input($_POST["product-category"]),
                          "color" => GlobalControllers::test_input($_POST["product-color"]),
                          "condition" => GlobalControllers::test_input($conditionValue));
            
            $answer = GlobalModel::mdlInsertData($table, $data);
            return $answer;
        }
    }

    # DELETE ----------------------------------
    static public function ctrDeleteProducts() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["id"])) {
                $table = "ellodb_products";
                $idProduct = GlobalControllers::test_input($_GET["id"]);
                $answer = GlobalModel::mdlDeleteData($table, $idProduct);
                return $answer;
            }
        }
    }

    # READ -------------------------------
    static public function ctrSelectProducts() {
        $table = "ellodb_products";
        $answer = GlobalModel::mdlFetchData($table, null, null);
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
}

?>