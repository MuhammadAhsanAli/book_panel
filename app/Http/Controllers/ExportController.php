<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\Author;
use Excel;
use XMLWriter;
use Response;

class ExportController extends Controller
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
     * Export book data in CSV
     *
     */
    public function csv_export($id){
      $book = Book::with('author')->get();
      $csv_data = Array();
      //book list with title
      if($id == 1){
        foreach($book as $data){
           $csv_data[] = [
              'title' => $data->title
           ]; 
          }
      }
      //author list
      else if($id == 2){
        $csv_data = Author::select('author_name as Author')->get()->toArray();
      }
      //book list with title and author
      else{
        foreach($book as $data){
           $csv_data[] = [
              'title' => $data->title,
              'author' => $data->author->author_name,
           ];
            
          }
      }
    
      return Excel::create('Book_Data', function($excel) use ($csv_data) {
            $excel->sheet('', function($sheet) use ($csv_data)
            {
                $sheet->fromArray($csv_data);
            });
        })->export('csv');
    }

    /**
     * Export book data in XML
     *
     */
    public function xml_export($id){
      $xml_data = Array();

      if($id != 2){
        $xml_data = Book::with('author')->get();
      }else{
        $xml_data = Author::select('author_name')->get();
      }  

      try
      {
        $xml = new XMLWriter();
        $xml->openURI(public_path('temp/').'file.xml');
        $xml->startDocument('1.0');
        $xml->startElement('DataList');
        $xml->setIndent(4);
        foreach ($xml_data as $data){
            //book list with title
            if($id == 1){
                $xml->startElement('book');
                $xml->writeElement('title', $data->title);
            }
            //author list
            else if($id == 2){
                $xml->startElement('author');
                $xml->writeElement('name', $data->author_name);   
            }
            //book list with title and author
            else{
                $xml->startElement('book');
                $xml->writeElement('title', $data->title);
                $xml->writeElement('author', $data->author->author_name);
            }
            $xml->endElement();
    }
        $xml->endElement();
        $xml->endDocument();
        $xml->flush();
        $headers = array(
                  'Content-Type: application/xml',
                );
        return response()->download(public_path("temp/file.xml"), 'Book_Data.xml', $headers);
    }
    catch(Exception $e)
    { 
        return redirect()->back()->with('error', 'Something went wrong please try again later.');
    }
    }



}
