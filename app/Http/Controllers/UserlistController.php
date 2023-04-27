<?php

namespace App\Http\Controllers;

use App\Models\Userlist;
use Illuminate\Http\Request;

class UserlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Userlist::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Userlist  $userlist
     * @return \Illuminate\Http\Response
     */
    public function show(Userlist $userlist)
    {
        return $userlist;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Userlist  $userlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userlist $userlist)
    {
        $userlist->learned = true;
        $userlist->save();
        return $userlist->word;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Userlist  $userlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userlist $userlist)
    {
        //
    }
}
