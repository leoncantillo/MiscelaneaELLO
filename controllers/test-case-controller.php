<?php 

Class TestCase {
    
    # CREATE 100 PRODUCTS -------------------------------------
    static public function ctrCreate100Products() {
        for ($i = 1; $i < 100; $i++) {
            $products = array(
                "product-name" => "Producto $i",
                "description" => "This is the product number $i",
                "product-image" => "",
                "price" => "14000",
                "promotion-price" => "12200",
                "product-tag" => rand(0,4),
                "product-category" => rand(0,4),
                "product-color" => "Nigger",
                "condition" => rand(0,1)
            );

            $table = "ellodb_products";

            $data = array("product_name" => $products["product-name"],
                            "description" => $products["description"],
                            "image" => $products["product-image"],
                            "price" => $products["price"],
                            "promotion_price" => $products["promotion-price"],
                            "tag_id" => $products["product-tag"],
                            "category_id" => $products["product-category"],
                            "color" => $products["product-color"],
                            "condition" => $products["condition"]);
            
            $answer = GlobalModel::mdlInsertData($table, $data);
        }
        return $answer;
    }

}

?>