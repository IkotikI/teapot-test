<?php
/**
 *  Class DB
 *  Connects and handle database
 */


define( 'OBJECT', 'OBJECT' );
define( 'object', 'OBJECT' );

define( 'OBJECT_K', 'OBJECT_K' );
define( 'ARRAY_A', 'ARRAY_A' );
define( 'ARRAY_N', 'ARRAY_N' );

class DB
{
	/**
	 * Database table column charset
	 * @var string
	 */
	public $charset;

	/**
	 * Database username
	 * @var string
	 */
	protected $dbuser;

	/**
	 * Database password
	 * @var string
	 */
	protected $dbpassword;

	/**
	 * Database name
	 * @var string
	 */
	protected $dbname;

	/**
	 * Database hostname
	 * @var string
	 */
	protected $dbhost;

	/**
	 * Nuber of rows in the last query
	 * @var integer
	 */
	public $num_rows = 0;

	public $rows_affected = 0;

	public $last_query;

	public $last_result;

	/**
	 * Database handler
	 * @var mysqli
	 */
	protected $dbh;
	
	function __construct( $dbuser, $dbpassword, $dbname, $dbhost )
	{

		$this->dbuser = $dbuser;

		$this->dbpassword = $dbpassword;

		$this->dbname = $dbname;

		$this->dbhost = $dbhost;

		$this->db_connect();
		
	}

	public function db_connect() {

		$this->dbh = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);

		if ($this->dbh->connect_errno) {
			echo 'Database connection error/n';
			echo 'Error number' . $this->dbh->connect_errno . '/n';
			echo 'Error message' . $this->dbh->connect_error . '/n';
			die(); 
		}

	}

	public function __set( $name, $value ) {
		$this->$name = $value;
	}

	public function __get( $name ) {
		if ( isset($this->name) ) {
			return $this->$name;
		}
	}

	public function query( $query ) {

		$this->flush();
		$results = $this->dbh->query( $query );
		$this->last_query = $query;
		$this->last_result = $results;

		return $results;

	}

	public function flush() {
		$this->last_result   = array();
		// $this->col_info      = null;
		$this->last_query    = null;
		$this->rows_affected = 0;
		$this->num_rows      = 0;
		// $this->last_error    = '';
	}

	public function prepare( $query = null, $structure = OBJECT ) {

	}

	public function get_row( $query, $structure = OBJECT ) {	

		if ( strpos( 'LIMIT', $query ) == false ) {
			$query .= ' LIMIT 1';
		}

		$results = $this->query( $query );

		$new_array = array();
		switch ($structure) {
			case OBJECT: 
				$new_array = (array) $results;
			break;
			case ARRAY_A:
				$new_array = $results->fetch_assoc();
			break;
			case ARRAY_N:
				$new_array = $results->fetch_array();
			break;
		}

		$this->last_result = $new_array;

		return $new_array;

	}

	public function get_results( $query = null, $structure = OBJECT ) {

		$results = $this->query( $query );

		$new_array = array();
		switch ($structure) {
			case OBJECT: 
				$new_array = (array) $results;
			break;
			case ARRAY_A:
				$new_array = $results->fetch_all( MYSQLI_ASSOC );
			break;
			case ARRAY_N:
				$new_array = $results->fetch_all( MYSQLI_NUM );
			break;
		}
		
		$this->num_rows = $results->num_rows;
		$this->last_result = $new_array;

		return $new_array;
	}
}