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
class Model extends ActiveRecord\Model
{
    /**
     * Prepares the data to create a new model.
     * @return array $data with valid Model data
     */
    public static function prepareData ($raw_data)
    {
        // First we get the columns for the model
        $columns = self::table()->columns;

        // Now we prepare a clean array with valid values
		$data = [];
		foreach ($columns as $name => $values) {
			$data[$name] = isset($raw_data[$name])?$raw_data[$name]:null;
		}
        return $data;
    }
}
