<?php

/**
 * Renderiza um arquivo de template com os dados fornecidos.
 *
 * @param string $template O nome do arquivo de template (sem a extensão .php).
 * @param array $data Um array associativo de dados que será disponibilizado como variáveis no template.
 * @return string A saída renderizada do template.
 * @throws Exception Se o arquivo de template não existir.
 */
function render(string $template, array $data = []): void
{
    extract($data);

    $filename = __DIR__ . "/../templates/{$template}.php";
    
    if (!file_exists($filename))
    {
        throw new \Exception("Template não encontrado: $filename");
    }
    
    require __DIR__ . "/../templates/{$template}.php";
}