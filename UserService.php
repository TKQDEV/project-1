<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function login(array $credentials)
    {
        // Implement login logic
    }

    public function updateProfile($id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function count(): int
    {
        return User::count();
    }
}
