<?php

/**
 * View model for login functions.
 *
 * @author Vincent
 * @version 181117
 */
class PostVM {

    public $enteredTitle;
    public $selectedArticle;
    public $attachment;
    public $bodyText;
    public $errorMsg;

    // User type constants used for switching in the controller. Nah probably won't need this
    // const VALID_LOGIN = 'valid_login';
    // const INVALID_LOGIN = 'invalid_login';

    public function __construct() {
        $this->postDAM = new PostDAM(); //DATABASE SHIT; Need to create: Have Michelle do it or something
        $this->errorMsg = '';
        $this->statusMsg = array();
        //declare variables so they're technically not null
        $this->enteredTitle = '';
        $this->bodyText = '';
    }

    public static function getInstance() {
        $vm = new self();
        $vm->$enteredTitle = hPOST('articleTitle');
        $vm->$selectedArticle = $_POST('articleClothing');
        $vm->$attachment = "IDK MAN HAVEN'T FIGURED THAT OUT";
        $vm->$bodyText = hPOST('body');

        //INSERT DATABASE IN  $user = $vm->userDAM->readUser($vm->enteredUserEmail);



    }


//Old code from loginVM for reference
    private function authenticateUser($user) {
        $userFound = true;
        if ($user === null) {
            $userFound = false;
        }
        return
            // $userFound &&
            password_verify($this->enteredPassword, $user->password);
    }

}
