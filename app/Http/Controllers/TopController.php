<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopController extends Controller {
  public function index( Request $request ) {
    $phpValue = "ひとよひとよにひとみごろ";

    // $records = DB::connection('mysql')->select("select * from items");
    // $name = $records[0] -> name; 

    // $insertResult = DB::connection("mysql") -> insert("insert into items (id,name,price) values (2, 'メロン',2000)");

    // $updateResult = DB::connection("mysql") -> update("update items set price = 600 where name = 'test'");

    // $deleteResult = DB::connection("mysql") -> delete("delete from items where name = 'test'");

    // dd($deleteResult);
    
    return view("top/index", [ "phpValue" => $phpValue ]);
  }
}