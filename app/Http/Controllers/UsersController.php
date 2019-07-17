<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App;

class UsersController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//         $pdf = App::make('dompdf.wrapper');
// $pdf->loadHTML('<h1>Test</h1>');
// return $pdf->stream();

         $users = DB::table('users')
       ->select('users.*', 'user_details.is_active','institutes.institute_name','user_types.usertype_desc','assoc_of.assoc_of_desc')
       ->leftjoin('user_details','users.id','=','user_details.user_id')
       ->leftjoin('institutes','user_details.institute_id','=','institutes.institute_id')
       ->leftjoin('assoc_of','user_details.assoc_id','=','assoc_of.assoc_of_id')
       ->leftjoin('user_types','user_details.usertype_id','=','user_types.usertype_id')
       // ->where('user_details.is_active','=',1)
       ->get();
// dd($users);
        return view('content.users', ['users' => $users]);
    }

    public function utype()
    {
        return view('content.usertype');
    }

    public function usersAdd()
    {

       $utypes = DB::table('user_types')
       ->select('*')
       ->where('is_active','=',1)
       ->get();

       $assocs = DB::table('assoc_of')
       ->select('*')
       ->where('is_active','=',1)
       ->get();

       $insts = DB::table('institutes')
       ->select('*')
       ->where('institute_flag','=',1)
       ->get();
       return view('content.users_new', ['utypes' => $utypes, 'assocs' => $assocs, 'insts' => $insts]);
   }

   public function usersEdit($id)
    {
        $user = DB::table('users')
       ->select('users.*', 'user_details.is_active','institutes.institute_name','user_types.usertype_desc','assoc_of.assoc_of_desc')
       ->leftjoin('user_details','users.id','=','user_details.user_id')
       ->leftjoin('institutes','user_details.institute_id','=','institutes.institute_id')
       ->leftjoin('assoc_of','user_details.assoc_id','=','assoc_of.assoc_of_id')
       ->leftjoin('user_types','user_details.usertype_id','=','user_types.usertype_id')
       ->where('users.id','=',$id)
       ->first();


       $utypes = DB::table('user_types')
       ->select('*')
       ->where('is_active','=',1)
       ->get();

       $assocs = DB::table('assoc_of')
       ->select('*')
       ->where('is_active','=',1)
       ->get();

       $insts = DB::table('institutes')
       ->select('*')
       ->where('institute_flag','=',1)
       ->get();
       return view('content.users_edit', ['utypes' => $utypes, 'assocs' => $assocs, 'user' => $user]);
   }

   public function usersSave(Request $request)
   {
    $utypes = DB::table('user_types')
    ->select('*')
    ->where('is_active','=',1)
    ->get();

    $assocs = DB::table('assoc_of')
    ->select('*')
    ->where('is_active','=',1)
    ->get();

    $insts = DB::table('institutes')
    ->select('*')
    ->where('institute_flag','=',1)
    ->get();

    $datas=$request->all();

    $user['name']=$datas['name'];
    $user['email']=$datas['email'];
    $password=bcrypt($datas['password']);
    $user['password']=$password;

    $id=DB::table('users')->insertGetId(
        $user);

    $userdetail['user_id']=$id;
    $userdetail['usertype_id']=$datas['usertype_id'];

    if($datas['usertype_id']==3)
    {
      $userdetail['institute_id']=$datas['institute_id'];
  }

  if($datas['usertype_id']==4)
  {
      $userdetail['assoc_id']=$datas['assoc_id'];
  }

  DB::table('user_details')->insert(
      $userdetail);

  $response=' User '.$user['name'].' Successfully Added';


  return view('content.users_new', ['utypes' => $utypes, 'assocs' => $assocs, 'insts' => $insts, 'response'=> $response ]);
}

public function usersSaveedit(Request $request)
   {
  
  DB::table('users')
            ->where('id', $request->id)
            ->update(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);


  return Redirect('users')->with('message', 'User Successfully Edited');
}
}
