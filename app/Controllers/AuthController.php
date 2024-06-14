<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use CodeIgniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;

class AuthController extends ResourceController
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->roleRepository = new RoleRepository();
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

    public function register()
    {
        $rules = [
            'name' => 'required|string',
            'username' => 'required|string',
            'no_telp' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|valid_email',
            'password' => 'required|string'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $name = $this->request->getVar('name');
        $username = $this->request->getVar('username');
        $no_telp = $this->request->getVar('no_telp');
        $address = $this->request->getVar('address');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Cek apakah email atau username sudah terdaftar
        if ($this->userRepository->findByEmail($email)) {
            // return $this->fail('Email sudah digunakan', 400);
            return createResponse(409, 'Email sudah digunakan !');
        }

        if ($this->userRepository->findByUsername($username)) {
            return createResponse(409, 'Username sudah digunakan !');
        }

        $roleName = str_contains($email, '@student.unsrat.ac.id') ? 'seller' : 'buyer';
        $role = $this->roleRepository->findByName($roleName);

        if (!$role) {
            return $this->fail('Role tidak ditemukan', 400);
        }

        $userData = [
            'name' => $name,
            'username' => $username,
            'no_telp' => $no_telp,
            'address' => $address,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role_id' => $role['id']
        ];

        $userId = $this->userRepository->createUser($userData);

        // if (!$userId) {
        //     return $this->fail('Gagal mendaftarkan pengguna', 500);
        // }

        return createResponse(201, 'Pengguna berhasil didaftarkan !');

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