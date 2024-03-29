<?php
// All files that need to be included by the GuitarShop application
// @author jam
// @version 180428

// Includes common to other cis 4270 applications
include_once(NON_WEB_BASE_DIR . 'common/includes/cis4270CommonIncludes.php');

// Includes specific to this application.
include_once(APP_NON_WEB_BASE_DIR .'includes/deployment.php');
//include_once(APP_NON_WEB_BASE_DIR .'includes/whitelist.php');
include_once(APP_NON_WEB_BASE_DIR .'includes/whitelistAchtung.php');
include_once(APP_NON_WEB_BASE_DIR .'includes/sessionFunctions.php');
include_once(APP_NON_WEB_BASE_DIR .'includes/tagFunctions.php');
include_once(APP_NON_WEB_BASE_DIR .'includes/file_upload_functions.php');
include_once(APP_NON_WEB_BASE_DIR .'controllers/DefaultController.php');
include_once(APP_NON_WEB_BASE_DIR .'controllers/UserController.php');
include_once(APP_NON_WEB_BASE_DIR .'controllers/HomeController.php');
//include_once(APP_NON_WEB_BASE_DIR .'controllers/CartController.php');
include_once(APP_NON_WEB_BASE_DIR .'controllers/AdminController.php');
// include_once(APP_NON_WEB_BASE_DIR .'models/Category.php');
// include_once(APP_NON_WEB_BASE_DIR .'models/Product.php');
include_once(APP_NON_WEB_BASE_DIR .'db/UserDAM.php');
include_once(APP_NON_WEB_BASE_DIR .'models/User.php');
include_once(APP_NON_WEB_BASE_DIR .'db/dbconfig.php');
include_once(APP_NON_WEB_BASE_DIR .'db/phpmysqlconnect.php');
//include_once(APP_NON_WEB_BASE_DIR .'db/CategoryDAM.php');
// include_once(APP_NON_WEB_BASE_DIR .'db/CategoryDAMAchtung.php');
//include_once(APP_NON_WEB_BASE_DIR .'db/ProductDAM.php');
// include_once(APP_NON_WEB_BASE_DIR .'db/ProductDAMAchtung.php');
// include_once(APP_NON_WEB_BASE_DIR .'viewModels/UsersVM.php');
include_once(APP_NON_WEB_BASE_DIR .'viewModels/LoginVM.php');
include_once(APP_NON_WEB_BASE_DIR .'viewModels/RegisterVM.php');
include_once(APP_NON_WEB_BASE_DIR .'viewModels/Page.php');
include_once(APP_NON_WEB_BASE_DIR .'viewModels/MessageVM.php');
// include_once(APP_NON_WEB_BASE_DIR .'viewModels/ProductsVM.php');

// include_once(APP_NON_WEB_BASE_DIR .'viewModels/ProductsVMAchtung.php');
