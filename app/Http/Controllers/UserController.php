<?php

namespace AcasReports\Http\Controllers;

use AcasReports\User;
use Illuminate\Http\Request;
use DataTables;
use AcasReports\Services\AddUser;
use AcasReports\Services\UpdateUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*----------  Checks if request is AJAX  ----------*/
        
        if (request()->ajax()) {

            return DataTables::of(User::all())->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AddUser $addUser)
    {
        $user = $addUser->execute($request->all(), request()->ajax());

        /*----------  Checks if request is AJAX  ----------*/
        
        if (request()->ajax()) {

            return $user;
        }

        $request->session('status', 'New user has been added.');

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show single user id = ' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateUser $updateUser)
    {
        $user = $updateUser->execute($request->all(), $id, request()->ajax());

        /*----------  Checks if request is AJAX  ----------*/
        
        if (request()->ajax()) {

            return $user;
        }

        $request->session('status', 'User data updated.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::destroy($id);

        if (request()->ajax()) {

            return response()->json(['success'=>'User deleted.']);
        }


        $request->session('status', 'User data updated.');

        return back();
    }
}
