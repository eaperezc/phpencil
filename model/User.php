<?php
/**
 * Description of User Model
 *
 *  With this i can get everything that the users table has and the idea is to use this in 
 *  the Users controller and everywhere I add the Users model
 * 
 * @package Models
 * @subpackage User
 * @author Enrique P�rez Clavier
 * @version 0.1
 */

/**
 * The class definition for the "User" Model
 *
 * This class manages the basic queries, getters, setters, and
 * default functionality for the user model
 * @package Core
 */
class User extends Model {
    
    var $name = 'User';
    var $idField = 'iduser';                          //Id field for the model
    var $table = 'users';                       //The name of the entity table
    var $fields = array('iduser', 'name');      //This contains the field names for the database entity
    
    
}
?>