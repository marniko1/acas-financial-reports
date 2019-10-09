<?php

namespace AcasReports\Http\Controllers;

use AcasReports\Http\Controllers\UserController;
use AcasReports\User;
use AcasReports\Services\AddUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


	protected $redirectTo = '/dashboard';


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('dashboard');
    }

}
