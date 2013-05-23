<?php
class Database
{
	
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	private $dbh;  //Database Handler
	private $error;

	private $statment;

	public function __construct(){
		// Set Database Source Name for MySQL
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		// Set options
		$options = array(
    	PDO::ATTR_PERSISTENT => true, 					//Persistent database connections can increase performance by checking to see if there is already an established connection to the database.
    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION		//Using ERRMODE_EXCEPTION will throw an exception if an error occurs.
		);

		//Create a new PDO instance
		try{
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		} 
		//Catch any errors
		catch(PDOException $e) {
			$this->error = $e->getMessages();
		}
	}


	/**
    * Method: query
    * ------------------
    * The prepare function allows you to bind values into your SQL statements. 
    *
    * @param $query SQL Statement, example 'INSERT INTO someTable VALUES(:name)''
    */
	public function query($query) {
		$this->statment = $this->dbh->prepare($query);
	}

	/**
	* Method: bind
	* ------------------
	* Bind the inputs with the placeholders. WARNING: class constants require PHP 5.1 or greater.
	*
	*@param $parameter For a prepared statement using named placeholders, this will be a parameter name of the form :name.
	*@param $value The value to bind to the parameter,	 example “John Smith”.
	*@param $data_type Explicit data type for the parameter using the PDO::PARAM_* constants. example string
	*
	*/
	public function bind($parameter, $value, $data_type = NULL) {
		if(is_null($data_type)){
			switch (true) {
				case is_int($value):
					$data_type = PDO::PARAM_INT;
					break;
				
				case is_bool($value):
					$data_type = PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$data_type = PDO::PARAM_NULL;
					break;

				default:
					$data_type = PDO::PARAM_STR;
			}
		}

		$this->statment->bindValue($parameter, $value, $data_type);
	}


	/**
	* Method: execute
	* ------------------
	* Executes the prepared statement.
	*
	*@return 
	*/
	public function execute(){
		return $this->statment->execute();
	}


	/**
	* Method: resultSet
	* ------------------
	* Returns an array containing all of the result set rows.
	*
	*@return array returns an array of the result set rows.
	*/
	public function resultSet() {
		$this->execute();
		return $this->statment->fetchAll(PDO::FETCH_ASSOC);
	}



	/**
	* Method: single
	* ------------------
	* Fetches the next row from a result set.
	*
	*@return 
	*/
	public function single() {
		$this->execute();
		return $this->statment->fetch(PDO::FETCH_ASSOC);
	}


	/**
	* Method: rowCount
	* ------------------
	* returns the number of rows affected by the last DELETE, INSERT, or UPDATE statement executed.
	*
	*@return int numbers of rows.
	*/
	public function rowCount(){
		return $this->statment->rowCount();
	}


	/**
	* Method: lastInsertId
	*
	*/
	public function lastInsertId(){
		//TODO
	}

	/**
	* Method: beginTransaction
	*
	*/
	public function beginTransaction() {
		//TODO
	}


	/**
	* Method: endTransaction
	*
	*/
	public function endTransaction() {
		//TODO
	}

	/**
	* Method: cancelTransaction
	*
	*/
	public function cancelTransaction() {
		//TODO
	}


	/**
	* Method: debugDumpParams
	*
	*/
	public function debugDumpParams() {
		//TODO
	}

}