<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table, $fields = "*", $order_fields = 1, $limit = 100)
    {
        $statement = $this->pdo->prepare("select {$fields} from {$table} order by {$order_fields} limit {$limit}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Select all records from a database table given a where condition.
     *
     * @param string $table
     * @param array $where
     */
    public function select($table, $where, $fields = ["*"], $order = "1", $limit = 500, $between = [])
    {
        $ps = array_keys($where);
        $pf = [];
        foreach ($ps as $p) {
            $pf[] = $p . " = :" . $p;
        }
        $bt = " ";
        foreach ($between as $b => $bp) {
            if (sizeof($bp) == 2) {
                $bt .= " AND " . $b . " BETWEEN :" . $b . "1 AND :" . $b . "2 ";
                $where[$b . "1"] = $bp[0];
                $where[$b . "2"] = $bp[1];
            }
        }

        $sql = sprintf(
            'select %s from %s where %s order by %s limit %s',
            implode(', ', $fields),
            $table,
            implode(' AND ', array_values($pf)) . $bt,
            $order,
            $limit
        );

        $statement = $this->pdo->prepare($sql);

        $statement->execute($where);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Select all records from a database table given a where condition.
     *
     * @param string $table
     * @param array $where
     */
    public function hasResult($table, $where, $fields = ["id"])
    {
        $result = $this->select($table, $where, $fields);

        return sizeof($result) > 0;
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s ( %s ) values ( %s )',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            return $statement->execute($parameters);
        } catch (\Exception $e) {
            return $e;
        }
    }


    /**
     * Update records of a table.
     *
     * @param  string $table
     * @param  array  $parameters
     * @param  string  $where
     */
    public function update($table, $parameters, $where)
    {
        $ps = array_keys($parameters);
        $pf = [];
        foreach ($ps as $p) {
            $pf[] = $p . " = :" . $p;
        }

        $sql = sprintf(
            'update %s SET %s where %s',
            $table,
            implode(', ', array_values($pf)),
            $where
        );
        //echo $sql;
        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            //
        }
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $sql
     * @param  array  $parameters
     */
    public function customQuery($sql, $parameters = [])
    {
        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            //
        }
    }
}
