<?php
require_once "controllers/template-controller.php";
require_once "controllers/global-controller.php";
require_once "controllers/forms-controller.php";
require_once "controllers/products-controller.php";
require_once "model/global-model.php";

$template = new TemplateController();
$template -> ctrBringTemplate();

?>