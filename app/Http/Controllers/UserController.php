<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
{
    // List
    public function index()
    {   
        $users = User::all();
        return view('user.index', compact('users'));  
    }

    // store
    public function create(Request $request)
    {   
        // dd($request->all());
        $new_user = new User;
        $new_user->name = $request->name;
        $new_user->position = $request->position;
        // $new_user->role = $request->role;
        $new_user->email = $request->email;
        $new_user->password = bcrypt($request->password);
        $new_user->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function change_password($id)
{
    try {
        $user = User::findOrFail($id);

        $user->password = bcrypt('password'); 
        $user->save();

        Alert::success('Success Title', 'Password changed successfully');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Alert::error('Error Title', 'User not found');
    }

    return back();
}

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back();
    }
}
