<?php

/**
 * User model data access and manipulation (DAM) class.
 *
 * @author jam
 * @version 171117
 */
class UserDAM extends DAM {

    // Database connection is inherited from the parent.
    function __construct() {
        parent::__construct();
    }

    /**
     * Read the User object from the database with the specified ID
     * @param type $userid the user's unique user ID (probably email)
     * @return \User the resulting User object - null if user is
     * not in the database.
     */
    public function readUser($email) {
        $query = 'SELECT * FROM users WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email',$email);
        $statement->execute();
        $userDB = $statement->fetch();
        $statement->closeCursor();
        if ($userDB == null) {
            return null;
        } else {
            return new User($this->mapColsToVars($userDB));
        }
    }

    /**
     * Write the specified user to the database. If the user is not
     * in the database, the object is added. If the user is already in the
     * database, the object is updated (excluding password).
     * @param type $user the User object to be written.
     */
    public function writeUser($user) {

        // Check to see if the user is already in the database.
        $query = 'SELECT userid FROM users
              WHERE userid = :userid';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':userid', $user->id);
        $statement->execute();
        $userDB = $statement->fetch();
        $statement->closeCursor();

        if ($userDB == null) {
            // Add a new user to the database
            $query = 'INSERT INTO users
                (userid, lastName, firstName, password)
              VALUES
                (:userid, :lastName, :firstName, :password)';
            $statement = $this->db->prepare($query);
            $this->bindValues($user, $statement);
            $statement->execute();
            $statement->closeCursor();
        } else {

            // Update an existing administrator.
            $query = 'UPDATE users
              SET lastName = :lastName, firstName = :firstName, password = :password
              WHERE userid = :userid';
            $statement = $this->db->prepare($query);
            $this->bindValues($user, $statement);
            $statement->execute();
            $statement->closeCursor();
        }
    }
    //Creates new user and adds it to the database$user
    public function newUserCreate($user){
        $query = 'SELECT email FROM users WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email',$user->email);
        $statement->execute();
        $userDB = $statement->fetch();
        $statement->closeCursor();

        //Issue might be here
        if($userDB == null){
            //no user by the email, OK to create
            //echo "There isn't email";
            $query =
                    'INSERT INTO users (firstName, lastName, email, password)
                    VALUES(:firstName, :lastName, :email, :password)';

            $statement = $this->db->prepare($query);
            $this->bindValues($user,$statement);
            $statement->execute();
            $statement->closeCursor();
            //echo "Registration works";
        }else{
            //user already exists
            return "User already exists with that email";
        }
    }

    /**
     * Delete the specified User object from the database.
     *
     * @param type $user the User object to be deleted.
     */
    public function deleteUser($user) {
        $this->deleteUserById($user->id);
    }

    /**
     * Delete the User object from the database with the specified username.
     *
     * @param type $userid the ID of the User to be deleted.
     */
    public function deleteUserById($userid) {
        $query = 'DELETE FROM users
              WHERE userid = :userid';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':userid', $userid);
        $statement->execute();
        $statement->closeCursor();
    }

    // Translate database columnames to object instance variable names
    private function mapColsToVars($colArray) {
        $varArray = array();
        foreach ($colArray as $key => $value) {
            if ($key == 'user_id') {
                $varArray ['user_id'] = $value;
            } else if ($key == 'lastName') {
                $varArray ['lastName'] = $value;
            } else if ($key == 'firstName') {
                $varArray ['firstName'] = $value;
            } else if ($key == 'password') {
                $varArray ['password'] = $value;
            } else if ($key == 'email') {
                $varArray ['email'] = $value;
            }
        }
        return $varArray;
    }

    // Binds object instance variables to a prepared statement.
    private function bindValues($user, $statement) {
        // $statement->bindValue(':user_id', $user->user_id);
        $statement->bindValue(':lastName', $user->lastName);
        $statement->bindValue(':firstName', $user->firstName);
        $statement->bindValue(':password', $user->password);
        $statement->bindValue(':email', $user->email);
    }
}
