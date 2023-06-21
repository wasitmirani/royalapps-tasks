<?php

namespace App\Http\Controllers;

use App\libraries\RoyalApps;
use Illuminate\Http\Request;

class BookController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $authors= $this->royal_apps->authors();
        $authors=$authors['status_code'] == 200 ? $authors['response'] : null;
        return view('pages.book.create',['authors'=>$authors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data=[
            'author'=>(object)['id'=>(int)$request->author],
            'title'=>$request->title,
            'release_date'=>$request->release_date,
            'description'=>$request->description,
            'isbn'=>$request->isbn,
            'format'=>$request->format,
            'number_of_pages'=>$request->pages,
            
        ];
       
        $book= $this->royal_apps->storeBook( $data);
        $message=$book['status_code'] == 200? 'New book added!' : 'Something went wrong!';
        return back()->with('message',$message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $author= $this->royal_apps->deleteBook($id);
        // dd($author);
        $message=$author['status_code'] == 204 ? 'book delete successfully' : "Something went wrong!";
        
        return back()->with('message',$message);
    }
}
