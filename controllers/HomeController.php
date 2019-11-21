<?php

/**
 * Controller that handles home page functions of the Guitar Shop application.
 *
 * @author jam
 * @version 180429
 */
class HomeController extends DefaultController {

    protected $model = null;

    public function __construct() {
        parent::__construct();
    }

    public function aboutUs() {
        require(APP_NON_WEB_BASE_DIR . 'views/aboutUs.php');
    }
    public function featured(){
      if(!isset($_SESSION))
      {session_start();}
        //check session logged in
        before_every_protected_page();
        //if session in
        require(APP_NON_WEB_BASE_DIR . 'views/userHome.php');
    }
    public function getProfile() {
        before_every_protected_page();
        $vm = AdminProfileVM::getInstance();
        $this->displayUpdateForm($vm);
    }

    public function updateProfile() {
        $vm = AdminProfileVM::getUpdateInstance();
        if ($vm->errorMsg != '') {
            before_every_protected_page();
            $this->displayUpdateForm($vm);
        } else {
            $this->showMenu();
        }
    }

    //NEW ARTICEL CODE
    public function newPostGET(){
        if(!isset($_SESSION)){session_start();}
        before_every_protected_page();
        //check session logged in
        //if session in
        Page::$title = 'Fashion Advices - New Post';
        require(APP_NON_WEB_BASE_DIR . 'views/newPost.php');
    }

        //Form Processing Code for new Posts
        public function newPostPOST(){
            if(!isset($_SESSION)){session_start();}
            before_every_protected_page();

            //note: the template already has required validation but this is just in case
            if($_POST['articleTitle'] ===null or $_POST['articleClothing'===null]){
              $logErr[] = "Please enter fill out the required fields";
              require(APP_NON_WEB_BASE_DIR .'views/newPost.php');
            }
            else{
              //INSERT VIEW MODEL STUFF HERE EXAMPLE:
              // $vm = LoginVM::getInstance();
              // if ($vm->userType === LoginVM::VALID_LOGIN) {
              //     after_successful_login();
              //     require(APP_NON_WEB_BASE_DIR . 'views/userHome.php');
              // } else {
              //     $delay = true;
              //     $logErr[] = "password or email incorrect";
              //     require(APP_NON_WEB_BASE_DIR . 'views/loginReg.php');
              // }

              //uploads article
              upload_file('article_image');
              echo "Post Successful!";
              require(APP_NON_WEB_BASE_DIR .'views/newPost.php');//Need to change
            }


        }



        public function newArticlePOST(){
            if(!isset($_SESSION)){session_start();}

            //after_successful_logout(); idk what this does



            if(!isset($_POST['email']) && !isset($_POST['password'])){
                $logErr[] = "Please enter in all input fields.";
                $delay = true;
                require(APP_NON_WEB_BASE_DIR .'views/loginReg.php');
            }else{
                $vm = LoginVM::getInstance();
                if ($vm->userType === LoginVM::VALID_LOGIN) {
                    after_successful_login();
                    require(APP_NON_WEB_BASE_DIR . 'views/userHome.php');
                } else {
                    $delay = true;
                    $logErr[] = "password or email incorrect";
                    require(APP_NON_WEB_BASE_DIR . 'views/loginReg.php');
                }
            }
          }

    private function goToView($vm) {

        // if an error message exists, display the error.
        if ($vm->errorMsg != '') {
            $error = $vm->errorMsg;
            include(NON_WEB_BASE_DIR .'views/error.php');
        } else {
            Page::$title = 'Admin Console';
            Page::$userName = $_SESSION ['userName'];
            Page::setNavLinks(array('admin profile', 'logout'));
            require(NON_WEB_BASE_DIR .'views/adminMenu.php');
        }
    }

    private function displayUpdateForm($vm) {
        Page::$title = 'Update Profile';
        Page::$userName = $_SESSION ['userName'];
        Page::setNavLinks(array('admin menu', 'logout', 'contact'));
        include_once(NON_WEB_BASE_DIR .'views/adminProfileUpdate.php');
    }

    private function displayManageAdminForm($vm) {
        Page::$title = 'Manage Administrators';
        Page::$userName = $_SESSION ['userName'];
        Page::setNavLinks(array('admin menu', 'logout', 'contact'));
        include_once(NON_WEB_BASE_DIR .'views/manageAdministrators.php');
    }

    private function protectAdminMgmt($vm) {
        if ($vm->errorMsg === 'Access Denied') {
            $controller = new LoginController();
            $controller->logout();
        } else {
            $this->displayManageAdminForm($vm);
        }
    }
}
