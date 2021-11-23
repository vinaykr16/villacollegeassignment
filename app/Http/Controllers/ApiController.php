<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\author;
use DB;
class ApiController extends Controller
{
    public function getAuthors()
    {
        
        $author_data=DB::table('author')->paginate(10);
        return response()->json([
            'status' => 'success',
            'data' => $author_data,
        ]);
    }
    public function getBooks()
    {
        
        $book_data=DB::table('book')->paginate(10);
        return response()->json([
            'status' => 'success',
            'data' => $book_data,
        ]);
    }

    public function getAuthor(Request $request)
    {
        $author_id=$request->id;
        $author_data=DB::table('author')->where('id',$author_id)->get();

        if(count($author_data)>0)
        {
            return response()->json([
                'status' => 'success',
                'data' => $author_data,
            ]);
        }
        else{
            return response()->json([
                'status' => 'failed',
                'data' => array(),
                'msg'=>'No record found'
            ]);
        }
       
    }

    public function getBook(Request $request)
    {
        $book_id=$request->id;
        $book_data=DB::table('book')
        ->join('author', 'book.author_id', '=', 'author.id')
        ->where('book.id',$book_id)
        ->get();
        
        if(count($book_data)>0){
            return response()->json([
                'status' => 'success',
                'data' => $book_data,
            ]);
        }
        else{
            return response()->json([
                'status' => 'failed',
                'data' => array(),
                'msg'=>'No record found'
            ]);
        }
      
    }

}
