<?php

class Chamado
{
    public function cadastrar(array $data): void
    {
        $session = new Session();
        
        if (!in_array('registrar_solicitacao', $session->getPermissions())) 
        {
            http_response_code(403);
            $response = [
                'success' => false,
                'message' => 'Acesso negado. Você não tem permissão para realizar esta ação.'
            ];
            echo json_encode($response);
            return;
        }
        
        $filters = [
            'laboratorio' => FILTER_DEFAULT,
            'prazo_limite' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => [
                    'regexp' => '/^\d{4}-\d{2}-\d{2}$/', // Regex para validar a data no formato DD-MM-YYYY
                ],
            ],
            'solicitacao' => FILTER_DEFAULT,
            'curso_atendendo' => FILTER_DEFAULT,
        ];

        $validated = filter_var_array($data, $filters);

        if ($validated) 
        {
            $output = implode(" | ", [
                $validated['laboratorio'],
                $validated['prazo_limite'],
                $validated['solicitacao'],
                $validated['curso_atendendo']
            ]) . PHP_EOL;

            if (file_put_contents(__DIR__ . '/chamados.txt', $output, FILE_APPEND | LOCK_EX) !== false) 
            {
                http_response_code(200);
                $response = [
                    'success' => true,
                    'message' => 'Dados processados e salvos com sucesso.'
                ];
            } 
            else 
            {
                http_response_code(500);
                $response = [
                    'success' => false,
                    'message' => 'Erro ao salvar os dados no arquivo.'
                ];
            }
        } 
        else 
        {
            http_response_code(400);
            $response = [
                'success' => false,
                'message' => 'Dados de entrada inválidos.',
                'errors' => $validated
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function todos(): array 
    {
        $tickets = [];

        $fp = fopen(__DIR__.'/chamados.txt', 'rb');

        while ($buf = fgets($fp))
        {
            $data = explode(" | ", trim($buf));

            $tickets[] = [
                'laboratorio' => $data[0],
                'prazo_limite' => $data[1],
                'solicitacao' => $data[2],
                'curso_atendendo' => $data[3],
            ];
        }

        fclose($fp);

        return $tickets;
    }

    public function buscaPorCurso(string $course): array
    {
        return array_filter($this->todos(), fn($ticket) => $ticket['curso_atendendo'] === $course);
    }
}
