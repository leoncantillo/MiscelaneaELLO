<?php

require_once "connecting.php";

Class ProductModel {

    static public function mdlFetchProductData() {
        $statement = Connection::connect()->prepare("SELECT 
            ellodb_products.id, `product_name`, `description`, `image`, `price`, `promotion_price`, `tag_name`, `category_name`, `color`, `condition`
            FROM ellodb_products 
            INNER JOIN `ellodb_tags` ON ellodb_products.tag_id = ellodb_tags.id
            INNER JOIN `ellodb_categories` ON ellodb_products.category_id = ellodb_categories.id 
            ORDER BY ellodb_products.id DESC");
        $statement->execute();
        $result = $statement->fetchAll();

        $statement->closeCursor();
        $statement = null;

        return $result;
    }

}

?>