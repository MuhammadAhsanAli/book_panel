<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\Author;

class BookController extends Controller
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
     * Show book manage page.
     *
     */
    public function index()
    {   
        $data = Book::with('author')->get();
        return view('books.manage')->with('data', $data);
    }

    /**
     * Show add book page
     *
     */
    public function add()
    {
        $author = Author::get();
        return view('books.add')->with('author', $author);
    }

    /**
     * Insert book record 
     *
     */
    public function insert(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'author_id' => 'required|numeric',
        ]);
        
        try{
            Book::create([
                'title' => $request->title,
                'author_id' => $request->author_id
            ]);
            return redirect()->back()->with('insert_success', 'Created Successfully.'); 
        }catch(Exception $e){
            return redirect()->back()->with('insert_error', 'Something went wrong please try again later.');   
        }
    }

    /**
     * Show edit book page
     *
     */
    public function edit($id)
    {
        $data = Book::where('id', $id)->first();
        $author = Author::get();
        return view('books.edit')->with(['data' => $data, 'author' => $author]);
    }

    /**
     * Update book record 
     *
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'author_id' => 'required|numeric',
        ]);
        
        try{
            Book::where('id', $request->id)->update([
                'title' => $request->title,
                'author_id' => $request->author_id
            ]);
            return redirect()->route('book.manage')->with('success', 'Updated Successfully.'); 
        }catch(Exception $e){
            return redirect()->back()->with('update_error', 'Something went wrong please try again later.');   
        }
    }

    /**
     * Delete book record 
     *
     */
    public function delete($id)
    {
       try{
            Book::where('id', $id)->delete();
            return redirect()->route('book.manage')->with('success', 'Deleted Successfully.'); 
        }catch(Exception $e){
            return redirect()->back()->with('update_error', 'Something went wrong please try again later.');   
        }
    }

}
