<?php
/**
 * Core model class
 *
 * This is the parent class for all the models in our app.
 * Here we will handle validations and data management.
 *
 * @category   Model
 * @package    Core
 * @author     Enrique Perez <eaperezc@gmail.com>
 * @copyright  2015
 * @version    0.1
 * @since      Class available since Version 0.1
 */
abstract class Model
{
    /**
     * This is an array of all the values that were loaded
     * from the database table.
     */
    protected $db_values = [];

    /**
     * This is an array of all the values that are currently
     * available in this object (possibly modified by setters)
     */
    protected $cached_values = [];

    /**
     * Name of the table related to this model
     */
    protected $table = '';

    /**
     * This will be the driver object for the 
     * database operations (probably redbean)
     */
    protected $db = null;

    /**
     * __get Magic Method
     *
     * With this magic method we will create all getter
     * methods for out model objects
     */
    public function __get($name) 
    {
        if (!isset($this->cached_values[$name])) {
            return null;
        }
        return $this->cached_values[$name];
    }

    /**
     * __set Magic Method
     *
     * With this magic method we will create all setter
     * methods for out model objects
     */
    public function __set($name, $value) 
    {
        // Maybe we should validate the existence of the field
        $this->cached_values[$name] = $value;
    }

}


