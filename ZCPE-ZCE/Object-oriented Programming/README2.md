# Repositório de Estudo de TDD utilizando PHP Unit

Repositório exemplo para a utilização de testes para aplicações em PHP.

# Ciclo TDD (TEST DRIVEN DEVELOPMENT)

Fases: RED (Write a Test that Fails) -> GREEN (Make the Code Work) -> REFACTOR (Eliminate Redundancy)

# Links

<https://phpunit.de/>

<https://github.com/sebastianbergmann/phpunit>

# Configuração do PHP e do Banco de Dados (postgres) no Manjaro

<https://github.com/MagicalStrangeQuark/shell-scripts/blob/master/PackagesManjaro.sh>

# Configuração da biblioteca e da estrutura de diretórios do nosso projeto

1. Criar o arquivo `phpunit.xml.dist`, contendo o seguinte conteúdo:

```
    <?xml version="1.0" encoding="UTF-8"?>
    <phpunit
        backupGlobals="false"
        backupStaticAttributes="false"
        bootstrap="./vendor/autoload.php"
        cacheTokens="true"
        colors="true"
        convertErrorsToExceptions="true"
        convertNoticesToExceptions="true"
        convertWarningsToExceptions="true"
        processIsolation="false"
        stopOnFailure="false"
        verbose="false">
        <testsuites>
            <testsuite name="GetStarted Tests">
                <directory>./tests/</directory>
            </testsuite>
        </testsuites>
    </phpunit>
```

3. Configuração do arquivo de autoload através no composer

```
    "autoload": {
        "psr-4": {
            "MyApp\\": "src/"
        }
    }
```

4. Mapear o namespace, rodando, na raíz do projeto `composer dump`

5. Verificar se está tudo correto com a biblioteca: `vendor/bin/phpunit`

## Criando nosso primeiro teste

`./vendor/bin/phpunit --bootstrap vendor/autoload.php tests`