<?php
ini_set('display_errors', 1);
class connectionFactory
{
	private $servidor;
	private $username;
	private $password;
	private $banco_dados;
	function __construct()
	{
		$this->servidor = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->banco_dados = "milkway";
		// $this->servidor    = "sql307.infinityfree.com";
		// $this->username    = "if0_36348142";
		// $this->password    = "awlfZSNLXeFwSZ";
		// $this->banco_dados = "if0_36348142_milkway";
	}
	public static function conexaoMysqli()
	{
		$instancia = new self();
		$conn = new mysqli($instancia->servidor, $instancia->username, $instancia->password, $instancia->banco_dados);
		return $conn;
	}
	public static function conexaoPDO()
	{
		$instancia = new self();
		$dbh = new PDO("mysql:host=$instancia->servidor;dbname=$instancia->banco_dados", $instancia->username, $instancia->password);
		return $dbh;
	}
}
