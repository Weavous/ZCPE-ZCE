<?php
    /**
     * zend_extension=opcache
     * 
     * Após habilitar a extensão, a primeira coisa é saber se de fato o opCache está sendo usado.
     * 
     * Sabemos isso através da função opcache_get_status(), que descobrimos o que está acontecendo.
     */
    var_dump(opcache_get_status());

    /**
     * Além do status do opCache, podemos também verificar quais configurações estão sendo utilizadas pelo PHP através da função.
     * 
     * Essa função também nos retorna um array com várias informações, porém com informações a respeito da configuração utilizada pelo opCache.
     */
    print_r(opcache_get_configuration());

    /**
     * Como estamos tratando de cache em algum determinado momento, vamos precisar resetar esse cache, ou seja, deletá-lo para ser gerado novamente.
     * 
     * Para isso, o opCache do PHP nos fornece uma maneira totalmente simples para fazer isso por meio da função opcache_reset.
     * Com essa simples chamada, todo o opCode armazenado será eliminado e recacheado na próxima requisição.
     * 
     * O retorno dessa função é um valor booleano que retornará true ao resetar o cachecom sucesso, ou false se o opCache estiver desabilitado.
     */
    opcache_reset();

    /**
     * Por último, mas não menos importante, temos a função opcache_compile_file que compila e armazena no cache o arquivo sem executá-lo.
     * 
     * Sua utilização é muito intuitiva, basta chamar a função passando o nome do arquivo.
     */
    opcache_compile_file("tags.php");

    /**
     * E é possível passar o caminho completo junto com o nome doarquivo também.
     */
    opcache_compile_file("/home/wesleyflores/Documents/ZCPE-ZCE/ZCPE-ZCE/PHP Basics/tags.php");
?>