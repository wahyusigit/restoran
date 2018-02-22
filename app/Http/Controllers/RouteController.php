<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function routes($asd){
        return view('view');
    }
    public function paginate()
    {
        $datas = User::orderBy('name', 'ASC')
            ->paginate(request('limit', 20));
        if (request()->all()) {
            $datas->appends(request()->all());
        }
        return response()->json($datas);
    }
    public function view()
    {
        return view('user');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|string|max:50',
            'email' => 'required|email|unique:datas,email',
        ]);
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt(str_random()),
        ]);
        return response()->json($user);
    }
    public function show($id_user)
    {
        $user = User::find($id_user);
        if (is_null($user)) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }
        return response()->json($user);
    }
}
