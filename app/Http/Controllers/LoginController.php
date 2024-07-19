<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
  public function index(Request $request)
  {
    $loginId = $request -> session() -> get( "login_id", null);
    $variables = [
      "isLoginActive" => isset( $loginId )
    ];

    return view("login/index", compact("variables"));
  }

  public function register(Request $request)
  {
    $id = $request -> input("id");
    $password = $request -> input("password");

    $oldRecords = DB::connection('mysql') -> select("select count(*) from users where id_str = '" . $id . "'");

    if (count($oldRecords) == 0) {
      return response("処理中に問題が発生しました。<a href='/login'>前のページに戻る</a>");
    }

    $record = (array)($oldRecords[0]);
    if ($record["count(*)"] > 0) {
      return response("すでに存在するアカウントidです。<a href='/login'>前のページに戻る</a>");
    }

    DB::connection("mysql") -> insert("insert into users (id_str, password) values ('" . $id . "','" . $password . "')");

    $records = DB::connection('mysql') -> select("select * from users where id_str = '" . $id . "'");

    if (count($records) == 0) {
      return response("ユーザーデータの登録処理中に問題が発生しました。<a href='/login'>前のページに戻る</a>");
    }

    $request -> session() -> put("login_id", $records[0] -> id_str);

    return response("登録が完了しました。<a href='/login'>前のページに戻る</a>");
  }

  public function sign_in(Request $request)
  {
    $id = $request -> input("id");
    $password = $request -> input("password");

    $records = DB::connection('mysql') -> select("select * from users where id_str = '" . $id . "' and password = '" . $password . "'");
    if (count($records) == 0) {
      return response("処理中に問題が発生しました。<a href='/login'>前のページに戻る</a>");
    }

    $request -> session() -> put("login_id", $records[0] -> id_str);
    return response("ログインが完了しました。<a href='/login'>前のページに戻る</a>");
  }

  public function unregister(Request $request)
  {
    $request -> session() -> flush();
    return response("ログアウトが完了しました。<a href='/login'>前のページに戻る</a>");
  }
}