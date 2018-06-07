<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('auth.delete-account');
    }

    public function delete()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return view('auth.delete-account', ['account_deleted' => true]);
    }
}
