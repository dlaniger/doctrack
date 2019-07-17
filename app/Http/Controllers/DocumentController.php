<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;

class DocumentController extends Controller
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
        $doctype = DB::table('document_type')
        ->select('*', 'document_type.is_active as is_active')
        ->leftjoin('doc_process', 'document_type.doc_id','=','doc_process.doc_id')
        ->where('doc_process.is_active','=','1')
        ->get();

        if(count($doctype) > 0 ){
            foreach ($doctype as $key => $value) {
               $process=[];
                // dd(json_decode($value->process_flow));
               foreach(json_decode($value->process_flow) as $id)
               {

                 $office=DB::table('assoc_of')->select('assoc_of_desc')->where('assoc_of_id',"=",$id)->first();
                 array_push($process,$office->assoc_of_desc);


             }
             $doctype[$key]->office = $process;
                  // $data =  DB::table('assoc_of')->select('*')->whereIn('assoc_of_id',json_decode($value->process_flow))->whereRaw('FIND_IN_SET(assoc_of_id,'.json_decode($value->process_flow).')')->get();
                  // $doctype[$key]->office = $data;
         }
     }






     return view('content.document', ['doctype' => $doctype]);
 }

 public function docAdd()
 {

   $assocs = DB::table('assoc_of')
   ->select('*')
   ->where('is_active','=',1)
   ->get();

   return view('content.document_new', ['assocs' => $assocs]);
}

public function docEdit($id)
{
    $doc = DB::table('document_type')
    ->select('*')
    ->where('doc_id','=',$id)
    ->first(); 
    $doc_proc = DB::table('doc_process')
    ->select('*')
    ->where('doc_id','=',$doc->doc_id)
    ->where('is_active','=',1)
    ->first();     
    $process = json_decode($doc_proc->process_flow);

    foreach ($process as $key => $value) {
       $proc_type=DB::table('assoc_of')
       ->select('*')
       ->where('assoc_of_id','=',$value)
       ->first();

       $proc[$key]['id']=$value;
       $proc[$key]['desc']=$proc_type->assoc_of_desc;
   }





   $assocs = DB::table('assoc_of')
   ->select('*')
   ->where('is_active','=',1)
   ->get();

   return view('content.document_edit', ['assocs' => $assocs, 'doc'=>$doc, 'proc'=>$proc]);
}

public function docDisable($id)
{

     DB::table('document_type')
    ->where('doc_id', $id)
    ->update(['is_active' => 0]);
   return redirect('references/documents')->with('message', 'Document Disabled');
}


public function docEnable($id)
{
     DB::table('document_type')
    ->where('doc_id', $id)
    ->update(['is_active' => 1]);
   return redirect('references/documents')->with('message', 'Document Enabled');
}

public function docSaveEdit(Request $request)
{

    $doc['doc_desc']=$request->doc_desc;

    DB::table('document_type')
    ->where('doc_id', $request->doc_id)
    ->update(['doc_desc' => $request->doc_desc]);

    DB::table('doc_process')
    ->where('doc_id', $request->doc_id)
    ->update(['is_active' => 0]);

    $process = json_encode($request->process);

        $doc_process['doc_id']=$request->doc_id;
    $doc_process['process_flow']=$process;
    
    DB::table('doc_process')->insert(
      $doc_process);




            return redirect('references/documents')->with('message', 'Document Successfully Edited');
}



public function saveDocty(Request $request)
{
    $assocs = DB::table('assoc_of')
    ->select('*')
    ->where('is_active','=',1)
    ->get();

    $process = json_encode($request->process);
    // $p= json_decode($process);
    $document_type['doc_desc']=$request->doc_desc;

    $id=DB::table('document_type')->insertGetId(
     $document_type);

    $doc_process['doc_id']=$id;
    $doc_process['process_flow']=$process;
    
    DB::table('doc_process')->insert(
      $doc_process);


    $response=' Document '.$document_type['doc_desc'].' Successfully Added';


    return view('content.document_new', ['assocs' => $assocs, 'response'=> $response ]);
}
}
