<?php

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

class Session 
{
    public function login(array $data): string
    {
        $validated = filter_var_array($data, [
            'user' => FILTER_DEFAULT, 
            'pass' => FILTER_DEFAULT
        ]);

        $users = json_decode(file_get_contents(__DIR__.'/users.json'), true);

        foreach ($users as $id => $user) 
        {
            if ($validated['user'] === $user['username'] && $validated['pass'] === $user['password']) 
            {
                $_SESSION['user.id'] = $id;
                $_SESSION['user.username'] = $user['username'];
                $_SESSION['user.permissions'] = $user['permissions'];
                
                return json_encode([
                    'success' => true,
                    'message' => 'Login bem-sucedido.'
                ]);
            }
        }

        return json_encode([
            'success' => false,
            'message' => 'Usuário ou senha inválidos.'
        ]);
    }

    public function logout(): void
    {
        unset(
            $_SESSION['user.id'],
            $_SESSION['user.name'],
            $_SESSION['user.permissions']
        );
    }

    public function isLoggedIn(): bool
    {
        return isset(
            $_SESSION['user.id'], 
            $_SESSION['user.name']
        );
    }
}
