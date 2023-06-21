<?php

namespace App\Http\Controllers;

use App\libraries\RoyalApps;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $royal_apps;
    
    public function __construct() {
        $this->royal_apps =new RoyalApps();
    }
     
    public function index()
    {
        //
        $authors= $this->royal_apps->authors();
        $authors=$authors['status_code'] == 200 ? $authors['response'] : null;
        return view('pages.author.index',['authors'=>$authors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $author= $this->royal_apps->author($id);
      
        $author=$author['status_code'] == 200 ? $author['response'] : null;
        // dd($author);
        return view('pages.author.show',['author'=>$author]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $author= $this->royal_apps->author($id);
        if(count($author['response']->books) > 0)
        {
            return back()->with('message', $author['response']->first_name.' books are available can`t be deleted');
        }
        $author= $this->royal_apps->deleteAuthor($id);
        // dd($author);
        $message=$author['status_code'] == 204 ? 'author delete successfully' : "Something went wrong!";
        
        return back()->with('message',$message);
        
    }
}
