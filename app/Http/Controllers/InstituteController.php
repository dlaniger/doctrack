<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class InstituteController extends Controller
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
        $institutes = DB::table('institutes')
        ->select('*')
        ->get();

        return view('content.institutes', ['institutes' => $institutes]);
    }

    public function saveIns(Request $request)
    {
        

        $data=$request->all();
        unset($data['_token']);
        
        DB::table('institutes')->insert(
            $data);

        $institutes = DB::table('institutes')
        ->select('*')
        ->get();

        $response=' Institute '.$data['institute_name'].' Successfully Added';



        return view('content.institutes', ['institutes' => $institutes, 'response'=> $response]);
    }

    public function insDisable($id)
{

     DB::table('institutes')
    ->where('institute_id', $id)
    ->update(['institute_flag' => 0]);
   return redirect('references/institutes')->with('message', 'Institute Disabled');
}


public function insEnable($id)
{
     DB::table('institutes')
    ->where('institute_id', $id)
    ->update(['institute_flag' => 1]);
   return redirect('references/institutes')->with('message', 'Institute Enabled');
}

    public function saveEditIns(Request $request)
    {
       

        $data=$request->all();
        unset($data['_token']);
        unset($data['institute_id']);
        
        DB::table('institutes')
         ->where('institute_id', $request->institute_id)
        ->update(
            $data);

        $institutes = DB::table('institutes')
        ->select('*')
        ->get();

        $response=' Institute '.$data['institute_name'].' Successfully Added';


        return redirect('references/institutes')->with('message', 'Institute Successfully Edited');
        // return view('content.institutes', ['institutes' => $institutes, 'response'=> $response]);
    }

     public function insEdit($id)
    {
        
        $ins = DB::table('institutes')
        ->select('*')
        ->where('institute_id','=',$id)
        ->first();
              $institutes = DB::table('institutes')
        ->select('*')
        ->get();

        



        return view('content.institutes_edit', ['institutes' => $institutes, 'ins'=> $ins]);
    }
}
