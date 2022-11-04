<?php


namespace Core\Database;

use Core\Database\Connection;
use Exception;
use PDO;
use PDOStatement;

abstract class Model extends Connection
{
    private PDOStatement $query;

    private function prepExec($prep, $exec)
    {
        $this->query = $this->prepare($prep);
        $this->query->execute($exec);
    }

    /**
     * Retorna todos as colunas de uma tabela
     *
     * @param $table
     * @return array|false
     */
    public function all($table): array
    {
        $statement = $this->prepare("select * from {$table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Retorna campos de uma tabela
     *
     * @param $campos
     * @param $tabela
     * @param $prep
     * @param $exec
     * @return array|false
     */
    public function select($campos, $tabela, $prep, $exec): array
    {
        $this->prepExec('SELECT ' . $campos . ' FROM ' . $tabela . ' ' . $prep . ' ', $exec);
        return $this->query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Faz o update e dados em uma tabela
     *
     * @param $tabela
     * @param $prep
     * @param $exec
     * @return PDOStatement
     */
    public function update($tabela, $prep, $exec): PDOStatement
    {
        $this->prepExec('UPDATE ' . $tabela . ' SET ' . $prep . ' ', $exec);
        return $this->query;
    }

    /**
     * Adiciona novos dados em uma tabela
     *
     * @param $table
     * @param $parameters
     * @return bool|void
     */
    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
        return true;
    }

    /**
     * Remove dados de uma tabela
     *
     * @param $tabela
     * @param $prep
     * @param $exec
     * @return PDOStatement
     */
    public function delete($tabela, $prep, $exec): PDOStatement
    {
        $this->prepExec('DELETE FROM ' . $tabela . ' ' . $prep . ' ', $exec);
        return $this->query;
    }

//    public function selectJoin($campos,$tabela,$prep,$exec)
//    {
//        $this -> prepExec('SELECT '. $campos .' FROM '. $tabela .' '. $prep .'', $exec);
//        return $this->query;
//    }
}