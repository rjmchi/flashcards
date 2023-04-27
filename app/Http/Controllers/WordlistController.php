<?php

namespace App\Http\Controllers;

use App\Models\Wordlist;
use App\Models\User;
use App\Models\Userlist;
use Illuminate\Http\Request;

class WordlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['words'] = Wordlist::get();
        return view('admin.wordlist')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $word = new Wordlist;
        $word->word = $request->word;
        $word->definition = $request->def;
        $word->save();

        $users = User::all();
        foreach ($users as $user) {
            $ul = new UserList;
            $ul->user_id = $user->id;
            $ul->word = $request->word;
            $ul->definition = $request->def;
            $ul->group_id = 0;
            $ul->learned = false;
            $ul->save();
        }

        return redirect('/wordlist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wordlist  $wordlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wordlist $wordlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wordlist  $wordlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wordlist $wordlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wordlist  $wordlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wordlist $wordlist)
    {
        //
    }
}
