<?php
/**
 * User Model
 *
 * This is the model class for the user entity
 */
class User extends Model
{
    static $before_save = array('encrypt_password');

    public function encrypt_password() {
        $this->password = sha1($this->password);
    }
}
