<?php

class Authentication
{
    function login()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        if($this->user()) {
            $this->jsonResponse(["User already logged in"], 200);
        }

        $this->validatePost($data);
        $this->authenticate($data);
    }

    function user()
    {
        return $_SESSION['user'] ?? null;
    }

    function validatePost($data): void
    {
        $errorMessages = [];

        if (!isset($data['email'])) {
            $errorMessages[] = 'Email is required.';
        }

        if (!isset($data['password'])) {
            $errorMessages[] = 'Password is required.';
        }

        if (!empty($errorMessages)) {
            $this->jsonResponse(['messages' => $errorMessages], 422);
        }
    }

    function jsonResponse($data, $status)
    {
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    function authenticate($data): void
    {
        if (!$this->validateCredentials($data)) {
            $this->jsonResponse(['messages' => "The credentials did not match our records."], 401);
        }

        $user = [
            'user_id' => 1,
            'name' => 'Test User'
            // ...
        ];

        $_SESSION['user'] = $user;

        $this->jsonResponse([], 200);
    }

    function validateCredentials($credentials): bool
    {
        // Logic to validate credentials
        return $credentials['email'] === 'test@test.com' && $credentials['password'] === 'test';
    }

    function redirectTo($to) {
        // TODO Change
        $location = 'localhost:8000/' . $to;
        header("Location $location");
    }
}
