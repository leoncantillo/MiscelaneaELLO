<?php
require_once "controllers/template-controller.php";
require_once "controllers/global-controller.php";
require_once "controllers/messages-controller.php";
require_once "controllers/users-controller.php";
require_once "controllers/products-controller.php";
require_once "model/global-model.php";
require_once "model/products-model.php";

require_once "controllers/test-case-controller.php";

$template = new TemplateController();
$template -> ctrBringTemplate();

?>