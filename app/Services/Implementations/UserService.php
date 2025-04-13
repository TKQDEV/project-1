<?php

namespace App\Services\Implementations;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface {
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function getAll() {
        return $this->userRepo->all();
    }

    public function getById($id) {
        return $this->userRepo->find($id);
    }

    public function create(array $data) {
        return $this->userRepo->create($data);
    }

    public function update($id, array $data) {
        return $this->userRepo->update($id, $data);
    }

    public function delete($id) {
        return $this->userRepo->delete($id);
    }

    public function findById($id)
    {
        return User::findOrFail($id); // Added implementation
}
}