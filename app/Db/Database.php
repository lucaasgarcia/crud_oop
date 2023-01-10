<?php

namespace App\Db;

use PDO;
use PDOException;
use PDOStatement;

class Database
{

    /**
     * Host de conexao com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'php_oop';

    /**
     * Usuario do banco
     * @var string
     */
    const USER = 'root';

    /**
     * Senha de acesso ao banco de dados
     * @var string
     */
    const PASS = 'root';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * instancia de conexao com o banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instancia e conexao
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();

    }

    /**
     * Metodo responsavel por criar uma conexao com o banco de dados
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Metodo responsavel por executar query dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Metodo responsavel por inserir dados no banco
     * @param array $values [ field => value]
     * @return integer ID inserido
     */
    public function insert($values)
    {
        //Dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        //Monta a query
        $query = 'INSERT INTO ' . $this->table . '(' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        //Executa o INSERT
        $this->execute($query, array_values($values));

        //Retorna o ID Inserido
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsavel por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //Dados da QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //Monta a query
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //Executa a query
        return $this->execute($query);
    }


    /**
     * Metodo responsavel por executar atualizacoes no banco de dados
     * @param integer $where
     * @param array $values [ field => value ]
     * @return boolean
     */
    public function update($where, $values)
    {
        //Dados da Query
        $fields = array_keys($values);
        //$fields = array_keys($values);

        //Monta a query
        $query ='UPDATE '.$this->table.' SET '.implode('=?,' ,$fields).'=? WHERE '.$where;
        //$query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'= WHERE '.$where;

        //Executar a query
        $this->execute($query,array_values($values));
        //$this->execute($query,array_values($values));

        //Retorna sucesso
        return true;
    }

    /***
     * Metodo responsavel por excluir dados do banco
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        //Monta a query delete
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //Executa a query
        $this->execute($query);

        //Retorna sucesso
        return true;
    }

}
