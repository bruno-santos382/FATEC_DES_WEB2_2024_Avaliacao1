<?php

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

class Session 
{
    public function login(array $data): void
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
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Login bem-sucedido.'
                ]);

                return;
            }
        }

        echo json_encode([
            'success' => false,
            'message' => 'Usuário ou senha inválidos.'
        ]);
    }

    public function logout(): void
    {
        unset(
            $_SESSION['user.id'],
            $_SESSION['user.username'],
            $_SESSION['user.permissions']
        );

        header('Location: login.php');
    }

    public function isLoggedIn(): bool
    {
        return isset(
            $_SESSION['user.id'], 
            $_SESSION['user.username']
        );
    }

    public function getUsername(): ?string
    {
        if ($this->isLoggedIn()) {
            return $_SESSION['user.username'];
        }
        return null;
    }
}
