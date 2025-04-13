<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface {
    public function all() {
        return User::all();
    }
    public function find($id) {
        return User::findOrFail($id);
    }
    public function create(array $data) {
        return User::create($data);
    }
    public function update($id, array $data) {
        return User::findOrFail($id)->update($data);
    }
    public function delete($id) {
        return User::destroy($id);
    }
}
