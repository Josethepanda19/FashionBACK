<?php

class RegisterVM {
    // public $enteredUserEmail;
    // public $enteredFirstName;
    // public $enteredLastName;
    // public $enteredPassword;
    public $regErr;
    public $userType;

    const VALID_REG = 'valid_reg';
    const INVALID_REG = 'invalid_reg';

    public function __construct() {
        $this->userDAM = new UserDAM();
        $this->regErr = [];
    }

    public static function regNewUserInstance() {
        $vm = new self();

        //Calls over input and puts it into variables basically repeating what was done before
        $user_id = '';
        $valid = true;
        $regErr = [];
        $firstName = filter_input(INPUT_POST,'firstName');
        $lastName = filter_input(INPUT_POST,'lastName');
        $email = filter_input(INPUT_POST,'email');

        //checks if fields are filled in
        if($firstName === null or $lastName === null or $email === null){
            $regErr[] = 'Please enter in all fields';
            $valid = false;
        }

        //checks if passwords are the same again
        if(filter_input(INPUT_POST,'password')!= filter_input(INPUT_POST,'pwConfirm')) {
            $valid = false;
            $regErr[] = 'passwords do not match';
        } else {
          //If everything works, hash the password using BCRYPT
            $hashed_pw = password_hash(filter_input(INPUT_POST,'password'),PASSWORD_BCRYPT);

            //Assigns values to Array (maps it out)
            $newUserArray = array(
                'user_id' => $user_id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'password' => $hashed_pw
            );
             //echo var_dump($newUserArray); Things ARE being written here so it works

            //Creates new user from the Array created before
            if($valid === true) {
                //creates user object and asigns values to it
                $vm->user = new User($newUserArray);
                 echo var_dump($vm->user);
                $regErr[] = $vm->userDAM->newUserCreate($vm->user);
        }
            foreach($regErr as $err){
                echo $err;
                if($err === "user already exists with that email"){
                    $valid = false;
                }
            }
        }
        if($valid === false) {
            $vm->userType = self::INVALID_REG;
            return false;
        }else{
            $vm->userType = self::VALID_REG;
            session_start();
            after_successful_login();
            $_SESSION ['userName'] = $vm->user->firstName . ' ' . $vm->user->lastName;
            $_SESSION ['email'] = $vm->user->email;
            return $vm;
        }
    }
}
