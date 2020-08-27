<?php

require_once "default.php";

final class ZipCode
{
    /** @var string */
    private const NOME_ARQUIVO_PADRAO = 'LISTA.JSON';

    /** @var string */
    private const NOME_ARQUIVO_TEMPORARIO = 'LISTA_TEMP.' . self::FORMAT;

    /** @var int */
    private const INICIO = 1014915;

    /** @var int */
    private const FIM = 1017910;
    /** 99999999  */

    /** @var string */
    private const FORMAT = 'json';

    /** @var string */
    private const URL = 'https://viacep.com.br/ws';

    /** @var int */
    private const SLEEP = 4;

    /** @var bool */
    private const SOBRESCRITA_SIMPLES = true;

    /** @var bool */
    private const SOBRESCRITA_EXISTENTE = false;

    /** @var bool */
    private const SOBRESCRITA_INEXISTENTE = false;

    /**
     * Método chamado na instância desta classe.
     * 
     * Seta a exibição de erros.
     *
     * @param void
     */
    public function __construct()
    {
    }

    /**
     * Método chamado no momento em que esta classe é destruída.
     * 
     * Realiza a leitura do arquivo temporário e grava no arquivo principal, sobrescrevendo os dados desse.
     * 
     * @param void
     */
    public function __destruct()
    {
        if (file_exists(self::NOME_ARQUIVO_TEMPORARIO) && file_exists((self::NOME_ARQUIVO_PADRAO))) {

            $dadosRetorno = [];

            foreach ($this->read() as $key => $dado) {
                $dadosRetorno[(string) $key] = (array) $dado;
            }

            foreach ((object) json_decode(file_get_contents(self::NOME_ARQUIVO_TEMPORARIO)) as $key => $dado) {
                $dadosRetorno[(string) $key] = (array) $dado;
            }

            $dadosAgrupamento = array_map(function (string $data) {
                return (string) $data;
            }, array_keys($dadosRetorno));

            array_multisort($dadosAgrupamento,  SORT_STRING);

            $dadosJSON = [];

            foreach ($dadosAgrupamento as $key => $dado) {
                $dadosJSON[$dado] = (array) $dadosRetorno[$dado];
            }

            file_put_contents(self::NOME_ARQUIVO_PADRAO, json_encode($dadosJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
    }

    /**
     * Método responsável pela leitura ou criação do arquivo JSON presente no diretório.
     * 
     * @param void
     */
    private function read(): stdClass
    {
        if (file_exists(self::NOME_ARQUIVO_PADRAO)) {
            return (object) json_decode(file_get_contents(self::NOME_ARQUIVO_PADRAO));
        }

        file_put_contents(self::NOME_ARQUIVO_PADRAO, '');

        return new stdClass();
    }

    /**
     * Método responsável pela escrita no arquivo temporário.
     * 
     * @param void
     */
    public function write(): void
    {
        $data = $this->read();

        $dadosRetorno = [];

        // VAMOS USAR UM ARQUIVO CONTENDO OS CEPS, PARA FACILITAR A BUSCA
        $dadosRetornoTEMP = explode("\n", file_get_contents('tmp.txt'));

        if (
            (bool) ((int) self::INICIO >= 0) === true &&
            (bool) ((int) self::FIM <= 99999999) === true &&
            (bool) ((int) self::INICIO < (int) self::FIM) === true
        ) {
            for ($i = self::INICIO; $i <= SELF::FIM; $i++) {
                $code = (string) str_pad($i, 8, 0, STR_PAD_LEFT);

                // SE NÃO ESTIVER NOS CEPS JÁ CONHECIDOS, NÃO FAREMOS ESSA BUSCA, POR ENQUANTO
                if (!in_array($code, $dadosRetornoTEMP)) {
                    continue;
                }

                // CÓDIGO POSTAL PRESENTE NO ARQUIVO DO SISTEMA
                if (isset($data->{$code}) && self::SOBRESCRITA_SIMPLES === false) {
                    // CÓDIGO POSTAL NÃO EXISTENTE
                    if ((bool) isset($data->{$code}->{'erro'}) === true) {
                        if (self::SOBRESCRITA_INEXISTENTE === true) {
                            $dadosRetorno[$code] = self::find($code);
                        } else {
                            $dadosRetorno[$code] = $data->{$code};
                        }
                    } else {
                        if (self::SOBRESCRITA_EXISTENTE === true) {
                            $dadosRetorno[$code] = self::find($code);
                        } else {
                            $dadosRetorno[$code] = $data->{$code};
                        }
                    }
                } else {
                    $dadosRetorno[$code] = self::find($code);
                }
            }

            sleep(self::SLEEP);

            file_put_contents(self::NOME_ARQUIVO_TEMPORARIO, json_encode($dadosRetorno, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        } else {
            trigger_error('O valor para o inÍcío não pode ser maior que o fim', E_USER_ERROR);
        }
    }

    /**
     * Método responsável por solicitar um JSON.
     */
    public static function find(string $code): object
    {
        return json_decode(file_get_contents(self::URL . DIRECTORY_SEPARATOR . $code . DIRECTORY_SEPARATOR . self::FORMAT . DIRECTORY_SEPARATOR));
    }
}

$zip = new ZipCode();

$zip->write();
