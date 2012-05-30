<?php
/**
 * MySQL Adapter Class
 *
 * Adapter for MySQL connection
 * @author Giancarlo Sanchez
 * @version 1.0
 */

/**
 * MySQL adapter connection
 * @package Assets
 * @subpackage Database
 */
class MySQLAdapter
{
    protected $_config = array();   //Configuration database parameters
    protected $_link;               //Database link
    protected $_result;             //Data operation result
    private static $_instance;      //Instance singleton
    private $_dbOnDemand;           //(String) Database name to use. It is on demand since it overrides the default for the next query
    /**
     * Constructor. Loads configuration from dbconfig.php file
     */
    private function __construct()
    {
        $this->_config = array(
            'host' => 'localhost',
            'database' => 'test',
            'user' => 'root',
            'password' => ''
        );
    }

    /**
     * Manages the class singleton instantiation and access
     * @return class instance singleton
     */
    public static function singleton()
    {
        if (!isset(self::$_instance)) {
            $c = __CLASS__;
            self::$_instance = new $c;
        }

        return self::$_instance;
    }

    /**
     * Set Database name on demand. USed to override the configuration file database
     * for the following connection. Once the connection is stablished. Default values
     * are restored
     * @param string $name  Database name
     */
    public function SetDbOnDemand($name)
    {
        $this->_dbOnDemand = $name;
    }

    /**
     * Singleton validation method
     */
    public function __clone()
    {
        trigger_error('Clone not allowed.', E_USER_ERROR);
    }

    /**
     * Connect to MySQL
     */
    public function connect()
    {
        $database = null;

        if ($this->_dbOnDemand != null){
            $database = $this->_dbOnDemand;
            $this->_dbOnDemand = null;
        }
        else
            $database = $this->_config['database'];

        // connect only once
        if ($this->_link == null) {
            if ((!$this->_link = mysqli_connect($this->_config['host'], $this->_config['user'], $this->_config['password'], $database))) {
                throw new Exception();
            }
        }
    }

    /**
     * Execute the specified query
     * @param string $query Query to execute for MySQL
     */
    public function query($query)
    {
        if (!is_string($query) || empty($query)) {
            throw new Exception();
        }
        // lazy connect to MySQL
        $this->connect();
        
        if (!$this->_result = mysqli_query($this->_link, $query)) {
            throw new Exception("NO_RESULTS");
        }
    }

    /**
     * Perform a SELECT statement to MySQL
     * @param string $table Execute query over this table(s)
     * @param string $where Where condition (text)
     * @param string $fields Select fields (text)
     * @param string $order Field to order by
     * @param int $limit Max query results to return
     * @param int $offset Record from which order is to be applied
     * @return int Affected rows
     */
    public function select($table, $where = '', $fields = '*', $order = '', $limit = null, $offset = null)
    {

        $query = 'SELECT ' . $fields . ' FROM ' . $table
               . (($where) ? ' WHERE ' . $where : '')
               . (($order) ? ' ORDER BY ' . $order : '')
               . (($limit) ? ' LIMIT ' . $limit : '')
               . ((($offset != null) && $limit) ? ' OFFSET ' . $offset : '');

        $this->query($query);

        $res = $this->countRows();
        $this->disconnect();
        return $res;
    }

    /**
     * Perform an INSERT statement to MySQL
     * @param string $table Target table(s)
     * @param array $data Array of field => value to insert
     * @return id Inserted Id
     */
    public function insert($table, array $data)
    {
        $fields = implode(',', array_keys($data));
        $values = implode(',', array_map(array($this, 'quoteValue'), array_values($data)));
        $query = 'INSERT INTO ' . $table . '(' . $fields . ')' . ' VALUES (' . $values . ')';
        //print_r($query);
        $this->query($query);
        $lastInsert = $this->getInsertId();
        $this->disconnect();
        return $lastInsert;
    }

    /**
     * Perform an UPDATE statement to MySQL
     * @param string $table Target table(s)
     * @param array $data Array of field => value to update
     * @param string $where Where conditions (text)
     * @return int Affected rows
     */
    public function update($table, array $data, $where = '')
    {
        $set = array();
        foreach ($data as $field => $value) {
            $set[] = $field . '=' . $this->quoteValue($value);
        }
        $set = implode(',', $set);
        $query = 'UPDATE ' . $table . ' SET ' . $set
               . (($where) ? ' WHERE ' . $where : '');
        //print_r($query);
        $this->query($query);
        $affectedRows = $this->getAffectedRows();
        $this->disconnect();
        return $affectedRows;
    }

    /**
     * Perform a DELETE statement to MySQL
     * @param string $table Target table(s)
     * @param string $where Where conditions (text)
     * @return int Affected rows
     */
    public function delete($table, $where = '')
    {
        $query = 'DELETE FROM ' . $table
               . (($where) ? ' WHERE ' . $where : '');

        $this->query($query);
        $affectedRows = $this->getAffectedRows();
        $this->disconnect();
        return $affectedRows;
    }

    /**
     * Single quote the specified value
     * @param number $value Value to quote
     * @return string Processed value
     */
    public function quoteValue($value)
    {
        $this->connect();
        if ($value === null) {
            $value = 'NULL';
        }
        else if (!is_numeric($value)) {
            $value = "'" . mysqli_real_escape_string($this->_link, $value) . "'";
        }
        return $value;
    }

    /**
     * Fetch a single row from the current result set (as an associative array)
     * @return array Row data
     */
    public function fetch()
    {
        if ($this->_result !== null) {
            if ((!$row = mysqli_fetch_object($this->_result))) {
                $this->freeResult();
                return false;
            }
            return $row;
        }
    }

    /**
     * Get the insertion ID
     * @return string Id of the inserted element
     */
    public function getInsertId()
    {
        return $this->_link !== null ?
               mysqli_insert_id($this->_link) :
               null;
    }

    /**
     * Get the number of rows returned by the current result set
     * @return int Total rows counted
     */
    public function countRows()
    {
        return $this->_result !== null ?
               mysqli_num_rows($this->_result) :
               0;
    }

    /**
     * Get the number of affected rows
     * @return int Affected rows
     */
    public function getAffectedRows()
    {
        return $this->_link !== null ?
               mysqli_affected_rows($this->_link) :
               0;
    }

    /**
     * Free up the current result set
     */
    public function freeResult()
    {
        if ($this->_result !== null) {
            mysqli_free_result($this->_result);
        }
    }

    /**
     * Close explicitly the database connection
     */
    public function disconnect()
    {
        if ($this->_link !== null) {
            mysqli_close($this->_link);
            $this->_link = null;
        }
    }

    /**
     * Close automatically the database connection when the instance of the class is destroyed
     */
    public function __destruct()
    {
        $this->disconnect();
    }
}
?>