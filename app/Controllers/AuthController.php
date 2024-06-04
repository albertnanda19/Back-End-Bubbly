<?php

namespace App\Controllers;

use App\Interfaces\UserRepositoryInterface;
use CodeIgniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;
use Config\Services;

class AuthController extends ResourceController
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = Services::userRepository();
    }

    public function login()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return createResponse(400, 'Validasi gagal !', $this->validator->getErrors());
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->userRepository->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return createResponse(401, 'Email atau password salah !');
        }

        $accessToken = $this->generateAccessToken($user);
        $refreshToken = $this->generateRefreshToken($user);

        return createResponse(200, 'Berhasil login !', [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ]);
    }

    private function generateAccessToken($user)
    {
        $keyPath = WRITEPATH . 'keys/private_key.pem';
        $key = file_get_contents($keyPath);
        $payload = [
            'iss' => 'back-end-bubbly',
            'aud' => 'front-end-bubbly',
            'iat' => time(),
            'exp' => time() + 3600,
            'sub' => $user['id'],
            'email' => $user['email'],
            'role_id' => $user['role_id']
        ];

        return JWT::encode($payload, $key, 'RS256');
    }

    private function generateRefreshToken($user)
    {
        $keyPath = WRITEPATH . 'keys/private_key.pem';
        $key = file_get_contents($keyPath);
        $payload = [
            'iss' => 'back-end-bubbly',
            'aud' => 'front-end-bubbly',
            'iat' => time(),
            'exp' => time() + 1209600,
            'sub' => $user['id'],
        ];

        return JWT::encode($payload, $key, 'RS256');
    }
}