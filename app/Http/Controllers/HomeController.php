<?php

namespace App\Http\Controllers;
use App\Models\Wordlist;
use App\Models\Userlist;
use App\Models\Group;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        //If there is not already a user word list, create it
        $userlist = Userlist::where('user_id', '=', $user->id)->take(1)->get();
        if (count($userlist) == 0)  {
            $words = Wordlist::get();
            foreach ($words as $word){
                $userlist = new Userlist;
                $userlist->user_id = $user->id;
                $userlist->word = $word->word;
                $userlist->definition = $word->definition;
                $userlist->learned = false;
                $userlist->group_id = 0;
                $userlist->save();
            }
        }
        //Get all words for a group and check to see if all words have been learned
        $group = Group::where('user_id', '=',$user->id)->orderBy('updated_at', 'DESC')->take(1)->get()->first();
        $learned = true;
        if ($group) {
            $userlist = Userlist::where('user_id', '=', $user->id)
                ->where('group_id', '=', $group->id)
                ->get();
            foreach ($userlist as $word) {
                if (!$word->learned){
                    $learned = false;
                }
            }
        }
        //if the group does not exist, or all of the words are learned, create a new group.
        if (!$group || $learned){
            $group = new Group;
            $group->user_id = $user->id;
            $group->save();
            $userlist = Userlist::where('user_id', '=', $user->id)
                ->where('group_id', '=', 0)
                ->where('learned', '=', false)
                ->inRandomOrder()->take(5)->get();
            foreach ($userlist as $word) {
                $word->group_id = $group->id;
                $word->save();
            }
        }

        //add a showDef flag to each of the words and set it to false.
        foreach ($userlist as $word){
            $word->showDef = false;
        }
        $data['userlist'] = $userlist;
        return view('home')->with($data);
    }
    public function fullList() {
        $user = Auth::user();

        $userlist = Userlist::where('user_id', '=', $user->id)->take(1)->get();
        if (count($userlist) == 0)  {
            $words = Wordlist::get();
            foreach ($words as $word){
                $userlist = new Userlist;
                $userlist->user_id = $user->id;
                $userlist->word = $word->word;
                $userlist->definition = $word->definition;
                $userlist->learned = false;
                $userlist->group_id = 0;
                $userlist->save();
            }
        }
        $userlist = Userlist::where('user_id', '=', $user->id)
                ->where('learned', '=', false)
                ->inRandomOrder()
                ->get();

        $data['userlist'] = $userlist;
        return view('home')->with($data);
    }
    public function english() {
        $user = Auth::user();

        $userlist = Userlist::where('user_id', '=', $user->id)->take(1)->get();
        if (count($userlist) == 0)  {
            $words = Wordlist::get();
            foreach ($words as $word){
                $userlist = new Userlist;
                $userlist->user_id = $user->id;
                $userlist->word = $word->word;
                $userlist->definition = $word->definition;
                $userlist->learned = false;
                $userlist->learned_english = false;
                $userlist->group_id = 0;
                $userlist->save();
            }
        }
        $userlist = Userlist::where('user_id', '=', $user->id)
                ->where('learned_english', '=', false)
                ->inRandomOrder()
                ->get();

        $data['userlist'] = $userlist;
        return view('english')->with($data);
    }
}
