<?php

require_once "default.php";

/**
 * Função responsável por quebrar uma string em tantas colunas quanto for informado por parâmetro e não quebrar as palavras ao meio.
 */
function breakStrings(string $string, int $size = 32): array
{
    if ((bool) ((int) strlen($string) === 0) === true) {
        return [];
    }

    $str_exploded = explode(' ', preg_replace('/\s\s+/', ' ', $string));

    $str_exploded = array_filter($str_exploded);

    $data_line = [];

    $nr = 1;

    foreach ($str_exploded as $key => $single_string) {
        if (!isset($data_line[$nr])) {
            $data_line[$nr] = $single_string;
        } else {
            if (strlen($data_line[$nr] . ' ' . $single_string) <= $size) {
                $data_line[$nr] .= ' ' . str_replace('  ', ' ', $single_string);
            } else {
                $data_line[++$nr] = $single_string;
            }
        }
    }

    return $data_line;
}

$string = "
            Mussum Ipsum, cacilds vidis litro abertis.
        Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo! Sapien in monti palavris qui num significa nadis
        i pareci latim. Per aumento de cachacis, eu reclamis. Em pé sem cair, deitado sem dormir, sentado sem
        cochilar e fazendo pose.

            Quem num gosta di mim que vai caçá sua turmis! Cevadis im ampola pa arma uma pindureta. Pra lá, depois divoltis
        porris, paradis. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per.
          ";

dd([$string]);

dd(breakStrings($string, 40));
