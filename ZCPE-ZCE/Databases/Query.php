<?php

declare(strict_types=1);

final class Query
{
    /**
     * Constructor Method.
     * 
     * @param void
     */
    private function __construct()
    {
    }

    /**
     * Destruct Method.
     * 
     * @param void
     */
    public function __destruct()
    {
    }

    /**
     * Get an Instance.
     * 
     * @param void
     */
    public static function create(): Self
    {
        return new Self();
    }

    /**
     * Método responsável por realizar a consulta ao banco de dados e retornar um objeto de dados.
     */
    public function find(array $standard = []): object
    {
        try {
            $stmt = DB::create()
                ->configure([
                    'host' => '127.0.0.1',   // db host
                    'port' => 5432,          // db port
                    'user' => 'postgres',    // db username
                    'pass' => 'pass@root',   // db password
                    'name' => 'api'          // db name
                ])
                ->connect();
        } catch (\Exception $e) {
            DB::log($e->getMessage(), DB::DEVELOPMENT_ERROR);

            return (object) [];
        }

        $fields = implode(', ', $standard["fields"]);

        $querySQL = "SELECT {$fields} FROM {$standard["table"]}";

        $stmt->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $stmt->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        try {
            $sql = $stmt->prepare($querySQL);

            $sql->execute();
        } catch (\Exception $e) {
            DB::log($e->getMessage(), DB::DEVELOPMENT_ERROR);

            return (object) [];
        }

        return (object) $sql->fetchAll(\PDO::FETCH_OBJ);
    }
}
