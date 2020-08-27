<?php

declare(strict_types=1);

/**
 * Database class using PDO driver
 */
final class DB
{
    /** @var PDO */
    private \PDO $pdo;

    /** @var string */
    private string $host;

    /** @var integer */
    private int $port;

    /** @var string */
    private string $user;

    /** @var string */
    private string $pass;

    /** @var string */
    private string $name;

    /** @var string */
    public const FILENAME_LOG_REGISTER = 'Log.JSON';

    /** @var string */
    public const DEVELOPMENT_ERROR = 'DEVELOPMENT_ERROR';

    /** @var string */
    public const REGULAR_REQUEST = 'REGULAR_REQUEST';

    /** @var string */
    private const QUERY_KILL_CONNECTION = 'SELECT pg_terminate_backend(PID) FROM pg_stat_activity WHERE PID <> pg_backend_pid()';

    /**
     * Get information for connecting to DB
     *
     * @param array $config
     */
    public function configure(array $config): self
    {
        if ((bool) empty($config['host']) === true) {
            throw new \Exception('Missing `host` key at DB::configure');
        }

        if ((bool) empty($config['port']) === true) {
            throw new \Exception('Missing `port` key at DB::configure');
        }

        if ((bool) empty($config['user']) === true) {
            throw new \Exception('Missing `user` key at DB::configure');
        }

        if ((bool) empty($config['pass']) === true) {
            throw new \Exception('Missing `pass` key at DB::configure');
        }

        if ((bool) empty($config['name']) === true) {
            throw new \Exception('Missing `name` key at DB::configure');
        }

        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
        $this->name = $config['name'];

        return $this;
    }

    /**
     * Private Constructor.
     * 
     * @param void
     */
    public function __construct()
    {
    }

    /**
     * Get an Instance.
     * 
     * @param void
     */
    public static function create(): self
    {
        return new Self();
    }

    /**
     * Open database connection
     * 
     * @param void
     */
    public function connect(): \PDO
    {
        $this->pdo = new \PDO(
            "pgsql:dbname={$this->name};host={$this->host};port={$this->port}",
            $this->user,
            $this->pass
        );

        return $this->pdo;
    }

    /**
     * Destructor.
     * 
     * @param void
     */
    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * Close DB Connection;
     * 
     * @param void
     */
    public function disconnect(): void
    {
        $this->log(self::QUERY_KILL_CONNECTION, self::REGULAR_REQUEST);

        $this->pdo->query(self::QUERY_KILL_CONNECTION);
    }

    /**
     * Log.
     * 
     * @param void
     */
    public static function log(string $str, string $status): void
    {
        file_put_contents(self::FILENAME_LOG_REGISTER, json_encode([
            "timestamp" => date('Y/m/d H:i:s'),
            "message" => $str,
            'status' => $status
        ]), FILE_APPEND);
    }
}
