<?php

namespace App\Services;

interface UserServiceInterface
{
    public function register(array $data);
    public function login(array $credentials);
    public function updateProfile($id, array $data);
}
