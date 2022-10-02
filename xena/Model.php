<?php

namespace xena;

use PDO;

abstract class Model
{
    private string $driver="mysql";
    private string $table="";
    private string $user="root";
    private string $pass="";
    public $id;
    protected $connection;
    private $dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    private $status=[];

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @param string $driver
     */
    public function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }

    private $host="localhost";

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass(string $pass): void
    {
        $this->pass = $pass;
    }

    public function getConnection(string $mydatabase="mydatabase"){
        if ($this->connection==null){
            $dns="{$this->driver}:host={$this->host};dname={$mydatabase};charset=utf8";
            try{
                $this->connection=new PDO($dns, $this->user, $this->pass, $this->dsn_Options);
                $this->status["status"]="OK";
                $this->status["connexion"]=$this->connection;
            }
            catch (\PDOException $ex){
                $this->status["status"]="error";
                $this->status["connexion"]=$ex->getMessage();
            }
            return $this->status;
        }

    }

    public function closeConnection(){
        $this->connection=null;

    }

    public function getAll(){
        $sql="SELECT * FROM {$this->table}";
        $this->connection->prepare($sql);
        $query=$this->connection->execute();
        return $query->fetchAll();
    }

    public function getById($id){
        $sql="SELECT * FROM {$this->table} WHERE id={$id}";
        $this->connection->prepare($sql);
        $query=$this->connection->execute();
        return $query->fetch();
    }

    public function deleteById($id){
        $sql="DELETE FROM {$this->table} WHERE id={$id}";
        $this->connection->prepare($sql);
        $query=$this->connection->execute();
        return $query->fetch();
    }

    public function getStatus(){
        return $this->status;
    }


}