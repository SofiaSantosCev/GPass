<?php

namespace App\Http\Controllers;

use App\Passwords;
use Illuminate\Http\Request;
use App\LoginController;

class PasswordsController extends Controller
{

    $loggedIn = false;
    $login = new LoginController();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($loggedIn)
        {
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($loggedIn)
        {
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function show(Passwords $passwords)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function edit(Passwords $passwords)
    {
        if ($logged)
        {
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passwords $passwords)
    {
        if ($logged)
        {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passwords  $passwords
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passwords $passwords)
    {
        if ($loggedIn)
        {
            
        }
    }

    private function IsHeLoggedIn()
    {
        $login->token_get_all();
    }
}
