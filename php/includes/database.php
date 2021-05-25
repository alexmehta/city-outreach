<?php


class database
{
    private $host;
    private $superusername;
    private $superpassword;
    private $database_name;
    private $charset;
    private $dsn;
    private $options;

    function connect()
    {
        $this->host = "127.0.0.1";
        $this->superusername = "root";
        $this->superpassword = "root";
        $this->database_name = "cityofhayward";
        $this->charset = 'utf8mb4';
        $this->dsn = "mysql:host=mysql8;dbname=cityofhayward;port=3306";
        $this->options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,];

        try {
            /**
             * @var PDO
             */
            return new PDO($this->dsn, $this->superusername, $this->superpassword, $this->options);
        } catch (PDOException $e) {
            echo 'ERROR!';
            print_r($e);
        }
        return new PDO($this->dsn, $this->superusername, $this->superpassword, $this->options);

    }
}