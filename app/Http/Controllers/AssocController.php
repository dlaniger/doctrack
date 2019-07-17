<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AssocController extends Controller
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

        $offices = DB::table('assoc_of')
        ->select('*')
        ->get();

        return view('content.offices', ['offices' => $offices]);
    }

    public function assEdit($id)
    {
        
        $off = DB::table('assoc_of')
        ->select('*')
        ->where('assoc_of_id','=',$id)
        ->first();
            $offices = DB::table('assoc_of')
        ->select('*')
        ->get();

        



        return view('content.offices_edit', ['offices' => $offices, 'off'=> $off]);
    }

    public function saveEditOff(Request $request)
    {
       

        $data=$request->all();
        unset($data['_token']);
        unset($data['assoc_of_id']);
        
        DB::table('assoc_of')
         ->where('assoc_of_id', $request->assoc_of_id)
        ->update(
            $data);

        $offices = DB::table('assoc_of')
        ->select('*')
        ->get();


        return redirect('references/offices')->with('message', 'Associate Office Successfully Edited');
        // return view('content.institutes', ['institutes' => $institutes, 'response'=> $response]);
    }

    public function offDisable($id)
{

     DB::table('assoc_of')
    ->where('assoc_of_id', $id)
    ->update(['is_active' => 0]);
   return redirect('references/offices')->with('message', 'Associate Office Disabled');
}


public function offEnable($id)
{
     DB::table('assoc_of')
    ->where('assoc_of_id', $id)
    ->update(['is_active' => 1]);
   return redirect('references/offices')->with('message', 'Associate Office Enabled');
}



     public function saveAssoc(Request $request)
    {
        

        $data=$request->all();
        unset($data['_token']);
        
        DB::table('assoc_of')->insert(
            $data);

        $offices = DB::table('assoc_of')
        ->select('*')
        ->get();


        $response=' Associate Office '.$data['assoc_of_desc'].' Successfully Added';

        return view('content.offices', ['offices' => $offices, 'response'=>$response]);
    }
}
