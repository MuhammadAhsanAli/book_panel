<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Author;

class AuthorController extends Controller
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
     * Show authors manage page
     *
     */
    public function index()
    {
        $data = Author::get();
        return view('authors.manage')->with('data', $data);
    }

    /**
     * Show add author page
     *
     */
    public function add()
    {
        return view('authors.add');
    }

    /**
     * Insert author record 
     *
     */
    public function insert(Request $request)
    {
        $this->validate($request, [
            'author_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
        ]);
        
        try{
            Author::create([
                'author_name' => $request->author_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return redirect()->back()->with('insert_success', 'Created Successfully.'); 
        }catch(Exception $e){
            return redirect()->back()->with('insert_error', 'Something went wrong please try again later.');   
        }
    }

    /**
     * Show edit author page
     *
     */
    public function edit($id)
    {
        $data = Author::where('id', $id)->first();
        return view('authors.edit')->with('data', $data);
    }

    /**
     * Update author record 
     *
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'author_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
        ]);
        
        try{
            Author::where('id', $request->id)->update([
                'author_name' => $request->author_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return redirect()->route('author.manage')->with('success', 'Updated Successfully.'); 
        }catch(Exception $e){
            return redirect()->back()->with('update_error', 'Something went wrong please try again later.');   
        }
    }


}
