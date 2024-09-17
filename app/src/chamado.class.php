<?php

class Chamado
{
    public function cadastrar(array $data): void
    {
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
}
