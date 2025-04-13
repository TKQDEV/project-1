<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct(protected UserServiceInterface $userService) {}

    public function index()
    {
        $users = $this->userService->getAll();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->userService->create($request->all());
        return redirect()->route('admin.users.index')->with('success', 'Tạo user thành công');
    }

    public function edit($id)
    {
        $user = $this->userService->findById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->userService->update($id, $request->all());
        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $this->userService->delete($id);
        return back()->with('success', 'Xoá user thành công');
    }
}
