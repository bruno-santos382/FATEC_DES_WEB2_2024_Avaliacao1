<?php

require __DIR__.'/load.php';

/**
 * Manipula as requisições recebidas, roteando-as com base na URI.
 *
 * @return void
 */
function handleRequest(): void
{
    $method = $_SERVER['REQUEST_METHOD'];
    $action = filter_input(INPUT_GET, 'action');
    
    switch ($action) 
    {
        case 'login':
            $session = new Session();
            echo $session->login($_POST);
            break;

        default:
            notFound();
            break;
    }
}

/**
 * Manipula erros 404 - Não Encontrado.
 *
 * @return void
 */
function notFound(): void
{
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>The requested page does not exist.</p>";
}

handleRequest();

?>