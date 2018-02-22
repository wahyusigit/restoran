<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function paginate()
    {
        $users = User::orderBy('name', 'ASC')
            ->paginate(request('limit', 10));
        if (request()->all()) {
            $users->appends(request()->all());
        }

        return response()->json($users);
    }

    public function view()
    {
        return view('view');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
        ]);
        if (is_null($request->id_user)) {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt(str_random()),
            ]);
        } else {
            $user = User::find($request->id_user);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt(str_random());
            $user->save();
        }
        
        return response()->json($user);
    }
    public function show($id_user)
    {
        $user = User::find($id_user);
        if (is_null($user)) {
            return response()->json([
                'message' => 'User Tidak Ditemukan.',
            ], 404);
        }
        return response()->json($user);
    }

    public function delete($id_user)
    {
        $user = User::find($id_user);
        if (is_null($user)) {
            return response()->json([
                'message' => 'User Tidak Ditemukan.',
            ], 404);
        } else {
            $user->delete();
        }
        return response()->json($user);
    }

    public function search($val = ''){
        if (!empty($val)) {
            $users = User::where('name','like','%' . $val . '%')
            ->orWhere('email','like','%' . $val . '%')
            ->orderBy('name', 'ASC')
            ->paginate(request('limit', 10));
            if (request()->all()) {
                $users->appends(request()->all());
            }
        } else {
            $users = User::orderBy('name', 'ASC')
                ->paginate(request('limit', 1));
            if (request()->all()) {
                $users->appends(request()->all());
            }
        }

        return response()->json($users);
    }
}
