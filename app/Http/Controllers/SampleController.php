<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampleController extends Controller {
  public function index(Request $request) {

    // $insertResult = DB::connection("mysql") -> insert("insert into users(id,email,name,password) values (1,'aa@aa', 'test1', 'testpass1')");
    // $insertResult = DB::connection("mysql") -> insert("insert into users(id,email,name,password) values (2,'bb@aa', 'test2', 'testpass2')");
    // $insertResult = DB::connection("mysql") -> insert("insert into users(id,email,name,password) values (3,'cc@aa', 'test3', 'testpass3')");

    $deleteResult = DB::connection("mysql") -> delete("delete from users where name = 'test2'");

    dd($deleteResult);

    return view("/sample/index", []);
  }
}