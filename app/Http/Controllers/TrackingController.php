<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use PDF;
use Redirect;
use Mail;
use User;

class TrackingController extends Controller
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


        if(getLogindetails()->usertype_id==3)
        {
            $active = DB::table('tracking')
            ->select('*', 'tracking.date_created as date_created')
            ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
            ->where('institute_id','=',getLogindetails()->institute_id)
            ->where(function ($query) {
                $query  ->where('doc_current_status','=',Null)
                ->orwhere('doc_current_status','=','On-going')
                ->orwhere('doc_current_status','=','Done Process');


            })
            ->orderBy('tracking_id', 'desc')             
            ->get();

            $closed = DB::table('tracking')
            ->select('*')
            ->where('doc_current_status','=','Closed')
            ->where('institute_id','=',getLogindetails()->institute_id)
            ->get();
        }


        elseif(getLogindetails()->usertype_id==4)
        {
            $active = DB::table('tracking')
            ->select('*')
            ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
            ->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
            ->where('tracking_process.flag','=',1)
            ->where('tracking_process.recieve_datetime','=',null)
            ->where('doc_current_status','!=','Cancelled')
            ->get();

            $closed = DB::table('tracking')
            ->select('*')
            ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
            ->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
            ->where('tracking_process.flag','=',1)
            ->where('tracking_process.recieve_datetime','!=',null)
            ->where('tracking_process.release_datetime','=',null)
            ->where('doc_current_status','!=','Cancelled')
            ->get();
        }
        elseif(getLogindetails()->usertype_id==2)
        {
         $active = DB::table('tracking')
         ->select('*')
         ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
         ->where('tracking_process.assoc_id','=',null)
         ->where('tracking_process.flag','=',1)
         ->where('tracking_process.recieve_datetime','=',null)
         ->where('doc_current_status','!=','Cancelled')
         ->get();

         $closed = DB::table('tracking')
         ->select('*')
         ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
         ->where('tracking_process.assoc_id','=',null)
         ->where('tracking_process.flag','=',1)
         ->where('tracking_process.recieve_datetime','!=',null)
         ->where('tracking_process.release_datetime','=',null)
         ->where('doc_current_status','!=','Cancelled')
         ->get();
     }
     else
     {

        $active = DB::table('tracking')
        ->select('*', 'tracking.date_created as date_created')
        ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
        ->where(function ($query) {
            $query  ->where('doc_current_status','=',Null)
            ->orwhere('doc_current_status','=','On-going')
            ->orwhere('doc_current_status','=','Done Process');


        })
        ->orderBy('tracking_id', 'desc')             
        ->get();

        $closed = DB::table('tracking')
        ->select('*')
        ->where('doc_current_status','=','Closed')
        ->get();
    }

// dd($active);
    return view('content.tracking', ['active' => $active, 'closed' =>$closed]);
}

public function finished()
{

  if(getLogindetails()->usertype_id==3)
  {

    $closed = DB::table('tracking')
    ->select('*','tracking.date_created as date_created')
    ->where('institute_id','=',getLogindetails()->institute_id)
    ->where(function ($query) {
        $query  ->where('doc_current_status','=','Closed')
        ->orwhere('doc_current_status','=','Cancelled');


    })
    ->orderBy('tracking_id', 'desc') 
    ->get();
}
else
{
   $closed = DB::table('tracking')
    ->select('*','tracking.date_created as date_created')
    ->where(function ($query) {
        $query  ->where('doc_current_status','=','Closed')
        ->orwhere('doc_current_status','=','Cancelled');


    })
    ->orderBy('tracking_id', 'desc') 
    ->get();
}

return view('content.tracking_closed', ['closed' =>$closed]);
}

public function testmail()
{
    // dd(getLogindetails());
    $sendto='reginald.murillo@iserve.biz';

    $emaildata=[];
    $emaildata['reciever']=getLogindetails()->name;
    $emaildata['reciever_office']=getLogindetails()->assoc_of_desc;
    $emaildata['reciever_date']=date("Y-m-d H:i:s");
    Mail::send('emails.reminder', $emaildata, function ($m) use($sendto)   {
        $m->from('hello@app.com', 'Your Application');

        $m->to($sendto, 'test')->subject('Your Reminder!');
    });

}

public function view($id)
{
    date_default_timezone_set("Asia/Manila");




    $track_det = DB::table('tracking')
    ->select('tracking.*','document_type.doc_desc as doctype_desc')
    ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
    ->where('tracking.tracking_id','=',$id)
    ->first();


    $track_process = DB::table('tracking_process')
    ->select('*')
    ->leftjoin('assoc_of','tracking_process.assoc_id','=','assoc_of.assoc_of_id')
    ->where('tracking_id','=',$track_det->tracking_id)
    ->orderby('process_step','asc')
    ->get();

    $track_remarks = DB::table('admin_staff_remarks')
    ->select('*')
    ->where('tracking_id','=',$track_det->tracking_id)
    ->get();

    $otherattachment = DB::table('tracking_update_attachments')
    ->select('*')
    ->where('tracking_id','=',$track_det->tracking_id)
    ->get();


    return view('content.tracking_search' , ['track_det' => $track_det , 'track_process'=>  $track_process, 'track_remarks'=> $track_remarks, 'otherattachment'=>$otherattachment]);


}

public function recieve($id, $proc_id)
{
    date_default_timezone_set("Asia/Manila");


    $proc_id=$proc_id;

    $track_det = DB::table('tracking')
    ->select('tracking.*','document_type.doc_desc as doctype_desc')
    ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
    ->where('tracking.tracking_id','=',$id)
    ->first();


    $track_process = DB::table('tracking_process')
    ->select('*')
    ->leftjoin('assoc_of','tracking_process.assoc_id','=','assoc_of.assoc_of_id')
    ->where('tracking_id','=',$track_det->tracking_id)
    ->orderby('process_step','asc')
    ->first();


    $track_remarks = DB::table('admin_staff_remarks')
    ->select('*')
    ->where('tracking_id','=',$id)
    ->get();


    $otherattachment = DB::table('tracking_update_attachments')
    ->select('*')
    ->where('tracking_id','=',$track_det->tracking_id)
    ->get();
        // dd($track_process);






    return view('content.tracking_recieve' , ['track_det' => $track_det , 'track_process'=>  $track_process, 'proc_id'=>$proc_id, 'track_remarks'=> $track_remarks, 'otherattachment'=>$otherattachment]);


}

public function release($id, $proc_id)
{
    date_default_timezone_set("Asia/Manila");


    $proc_id=$proc_id;

    $track_det = DB::table('tracking')
    ->select('tracking.*','document_type.doc_desc as doctype_desc')
    ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
    ->where('tracking.tracking_id','=',$id)
    ->first();


    $track_process = DB::table('tracking_process')
    ->select('*')
    ->leftjoin('assoc_of','tracking_process.assoc_id','=','assoc_of.assoc_of_id')
    ->where('track_proc_id','=',$proc_id)
    ->first();

    $track_remarks = DB::table('admin_staff_remarks')
    ->select('*')
    ->where('tracking_id','=',$track_det->tracking_id)
    ->get();

    $otherattachment = DB::table('tracking_update_attachments')
    ->select('*')
    ->where('tracking_id','=',$track_det->tracking_id)
    ->get();


    return view('content.tracking_release' , ['track_det' => $track_det , 'track_process'=>  $track_process, 'proc_id'=>$proc_id,'track_remarks' => $track_remarks, 'otherattachment'=>$otherattachment]);


}

public function recieveSave(Request $request)
{
    date_default_timezone_set("Asia/Manila");



    $remarks=$request->remarks;
    $track_id=$request->tracking_id;
    DB::table('tracking_process')
    ->where('track_proc_id', $track_id)
    ->update(['remarks' => $remarks, 'recieve_by'=>Auth::user()->id, 'recieve_datetime'=> date("Y-m-d H:i:s") ]);

    $responses="Document Recieved";


    $active = DB::table('tracking')
    ->select('*')
    ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
    ->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
    ->where('tracking_process.flag','=',1)
    ->where('tracking_process.recieve_datetime','=',null)
    ->get();

    $closed = DB::table('tracking')
    ->select('*')
    ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
    ->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
    ->where('tracking_process.flag','=',1)
    ->where('tracking_process.recieve_datetime','!=',null)
    ->where('tracking_process.release_datetime','=',null)
    ->get();

    $track_det = DB::table('tracking')
    ->select('tracking.*','document_type.doc_desc as doctype_desc', 'users.email as email')
    ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
    ->leftjoin('users', 'tracking.created_by','=','users.id')
    ->where('tracking.tracking_id','=',$request->track_id)
    ->first();

    // dd($track_det);
    $sendto=$track_det->email;
    // $sendto='reginald.murillo@iserve.biz';
    $emaildata=[];
    $emaildata['reciever']=getLogindetails()->name;
    $emaildata['reciever_office']=getLogindetails()->assoc_of_desc;
    $emaildata['reciever_date']=date("m-d-Y H:i:s");
    $emaildata['document_title']=$track_det->doc_title;
    Mail::send('emails.receive_notif', $emaildata, function ($m) use($sendto)  {
        $m->from('hello@app.com', 'CS DOCUMENT TRACKING SYSTEM');

        $m->to($sendto, 'test')->subject('DOCUMENT RECEIVED');
    });

    return view('content.tracking', ['active' => $active, 'closed' =>$closed, 'responses'=>$responses]);

}

public function releaseSave(Request $request)
{
    date_default_timezone_set("Asia/Manila");


    $remarks=$request->remarks;
    $track_id=$request->tracking_id;
    DB::table('tracking_process')
    ->where('track_proc_id', $track_id)
    ->update(['remarks' => $remarks, 'release_by'=>Auth::user()->id, 'release_datetime'=> date("Y-m-d H:i:s"), 'flag'=>0 ]);

    $current_active=DB::table('tracking_process')
    ->select('*')
    ->leftjoin('assoc_of','tracking_process.assoc_id','=','assoc_of.assoc_of_id')
    ->where('track_proc_id','=',$track_id)
    ->first();


    $tracking_id=$current_active->tracking_id;

    $process_step=$current_active->process_step;

    $next_step=$process_step+1;

    $next_process=DB::table('tracking_process')
    ->select('*')
    ->leftjoin('assoc_of','tracking_process.assoc_id','=','assoc_of.assoc_of_id')
    ->where('tracking_id','=',$tracking_id)
    ->where('process_step','=',$next_step)
    ->first();


    if(count($next_process)>=1)
    {
        $next_process_id=$next_process->track_proc_id;
        DB::table('tracking_process')
        ->where('track_proc_id', $next_process_id)
        ->update(['flag' => 1]);
    }
    elseif(count($next_process)==0)
    {
       DB::table('tracking')
       ->where('tracking_id', $tracking_id)
       ->update(['doc_current_status' => 'Done Process']);

       $track_det = DB::table('tracking')
       ->select('tracking.*','document_type.doc_desc as doctype_desc','users.email as email')
       ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
       ->leftjoin('users', 'tracking.created_by','=','users.id')
       ->where('tracking.tracking_id','=',$request->track_id)
       ->first();

       $sendto=$track_det->email;
       // $sendto='reginald.murillo@iserve.biz';
       $emaildata=[];
       $emaildata['reciever']=getLogindetails()->name;
       $emaildata['reciever_date']=date("m-d-Y H:i:s");
       $emaildata['document_title']=$track_det->doc_title;
       Mail::send('emails.finish_notif', $emaildata, function ($m) use($sendto)  {
        $m->from('hello@app.com', 'CS DOCUMENT TRACKING SYSTEM');

        $m->to($sendto, 'test')->subject("DOCUMENT RELEASED BY DEAN'S OFFICE");
    });
   }

   $track_det = DB::table('tracking')
   ->select('tracking.*','document_type.doc_desc as doctype_desc', 'users.email as email')
   ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
   ->leftjoin('users', 'tracking.created_by','=','users.id')
   ->where('tracking.tracking_id','=',$request->track_id)
   ->first();

   if($next_process!=null)
   {
       $next=DB::table('tracking_process')
       ->where('track_proc_id', $next_process->track_proc_id)
       ->first();

       if($next->assoc_id!=null)
       {
        $next_det=DB::table('tracking_process')
        ->leftjoin('assoc_of','tracking_process.assoc_id','=','assoc_of.assoc_of_id')
        ->where('track_proc_id', $next_process_id)
        ->first();
        $assocusers=DB::table('user_details')
        ->leftjoin('users','user_details.user_id','=','users.id')
        ->where('assoc_id', $next_det->assoc_id)
        ->where('is_active', 1)
        ->get();
        $next_rec=$next_det->assoc_of_desc;
        foreach ($assocusers as $user) {
         $sendto=$user->email;

         // $sendto='reginald.murillo@iserve.biz';
         $emaildata=[];
         $emaildata['reciever_office']=$next_rec;
         $emaildata['reciever_date']=date("m-d-Y H:i:s");
         $emaildata['document_title']=$track_det->doc_title;
         Mail::send('emails.for_recieve', $emaildata, function ($m) use($sendto)  {
            $m->from('hello@app.com', 'CS DOCUMENT TRACKING SYSTEM');

            $m->to($sendto, 'test')->subject('PENDING DOCUMENTS FOR RECEIVING');
        });
     }

 }
 else
 {
    $next_rec='Deans Office';
    $deanusers=DB::table('user_details')
    ->leftjoin('users','user_details.user_id','=','users.id')
    ->where('usertype_id', 2)
    ->where('is_active', 1)
    ->get();
    foreach ($deanusers as $user) {
     $sendto=$user->email;
     // $sendto='reginald.murillo@iserve.biz';
     $emaildata=[];
     $emaildata['reciever_office']="Deans's Office";
     $emaildata['reciever_date']=date("m-d-Y H:i:s");
     $emaildata['document_title']=$track_det->doc_title;
     Mail::send('emails.for_recieve', $emaildata, function ($m) use($sendto)  {
        $m->from('hello@app.com', 'CS DOCUMENT TRACKING SYSTEM');

        $m->to($sendto, 'test')->subject('PENDING DOCUMENTS FOR RECEIVING');
    });
 }
}
$sendto=$track_det->email;
// $sendto='reginald.murillo@iserve.biz';
$emaildata=[];
$emaildata['reciever']=getLogindetails()->name;
$emaildata['reciever_office']=getLogindetails()->assoc_of_desc;
$emaildata['reciever_date']=date("m-d-Y H:i:s");
$emaildata['document_title']=$track_det->doc_title;
$emaildata['next_reciever']=$next_rec;
Mail::send('emails.release_notif', $emaildata, function ($m) use($sendto)  {
    $m->from('hello@app.com', 'Your Application');

    $m->to($sendto, 'test')->subject('DOCUMENT RELEASED');
});
}




$responses="Document Released";


$active = DB::table('tracking')
->select('*')
->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
->where('tracking_process.flag','=',1)
->where('tracking_process.recieve_datetime','=',null)
->where('doc_current_status','!=','Cancelled')
->get();

$closed = DB::table('tracking')
->select('*')
->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
->where('tracking_process.flag','=',1)
->where('tracking_process.recieve_datetime','!=',null)
->where('tracking_process.release_datetime','=',null)
->where('doc_current_status','!=','Cancelled')
->get();

return view('content.tracking', ['active' => $active, 'closed' =>$closed, 'responses'=>$responses]);

}

public function trackingAdd()
{
        // $test=getLogindetails();
        // dd($test);
    $doctype = DB::table('document_type')
    ->select('*')
    ->leftjoin('doc_process', 'document_type.doc_id','=','doc_process.doc_id')
    ->where('doc_process.is_active','=','1')
    ->get();
        // dd($doctype);
    return view('content.tracking_new' , ['doctype' => $doctype]);
}

public function print_track_attachment($id)
{
  $pdf_data=DB::table('tracking')
  ->select('tracking.*','document_type.doc_desc as doc_type_desc','institutes.institute_name')
  ->leftjoin('institutes','tracking.institute_id','=','institutes.institute_id')
  ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
  ->where('tracking.tracking_id','=',$id)
  ->first();

  $pdf = PDF::loadView('content.pdf_template.attachment',array('pdf_data'=>$pdf_data));
  $pdf->setPaper('letter', 'portrait');
  return $pdf->stream('tracking_attachment.pdf');

}

public function remarkSave(Request $request)
{

   $tracking=DB::table('tracking')
   ->where('tracking_id', $request->tracking_id)
   ->first();

   if($tracking->doc_current_status == 'Done Process')
   {
    $tosave['tracking_id']=$request->tracking_id;
    $tosave['remarks']=$request->remarks;
    $tosave['user_id']=getLogindetails()->user_id;
    $tosave['before_after']=1;
}
else
{
    $tosave['tracking_id']=$request->tracking_id;
    $tosave['remarks']=$request->remarks;
    $tosave['user_id']=getLogindetails()->user_id;
}
            // dd($tosave);
$trackingid=DB::table('admin_staff_remarks')->insert(
    $tosave);
return Redirect::to(url('/tracking/view/').'/'.$request->tracking_id);
}

public function start_tracking($id)
{
 DB::table('tracking')
 ->where('tracking_id', $id)
 ->update(['doc_current_status' => 'On-going']);

 DB::table('tracking_process')
 ->where('tracking_id', $id)
 ->where('process_step', 1)
 ->update(['flag' => 1]);


 return Redirect::to(url('/tracking').'?tracking=started');
}

public function cancel_tracking($id)
{
 DB::table('tracking')
 ->where('tracking_id', $id)
 ->update(['doc_current_status' => 'Cancelled']);

 $current = DB::table('tracking_process')
 ->leftjoin('tracking','tracking_process.tracking_id','=','tracking.tracking_id')
 ->where('tracking_process.tracking_id', $id)
 ->where('tracking_process.flag', 1)
 ->first();
 if(count($current)>0)
 {
     if($current->assoc_id !=null)
     {
      $assocusers=DB::table('user_details')
      ->leftjoin('users','user_details.user_id','=','users.id')
      ->where('assoc_id', $current->assoc_id)
      ->where('is_active', 1)
      ->get();
      foreach ($assocusers as $user) {
         $sendto=$user->email;

     // $sendto='reginald.murillo@iserve.biz';
         $emaildata=[];
         $emaildata['reciever_date']=date("m-d-Y H:i:s");
         $emaildata['document_title']=$current->doc_title;
         Mail::send('emails.cancel_notif', $emaildata, function ($m) use($sendto)  {
            $m->from('hello@app.com', 'CS DOCUMENT TRACKING SYSTEM');

            $m->to($sendto, 'test')->subject('CANCEL TRACKING');
        });
     }
 }
}


return Redirect::to(url('/tracking').'?tracking=cancelled');
}

public function finish_tracking($id)
{
    date_default_timezone_set("Asia/Manila");

    DB::table('tracking')
    ->where('tracking_id', $id)
    ->update(['doc_current_status' => 'Closed', 'finished_date'=>date("Y-m-d H:i:s")]);


    return Redirect::to(url('/tracking').'?tracking=finish');
}

public function trackingSave(Request $request)
{
    date_default_timezone_set("Asia/Manila");

    $tosave=[];

    $series=DB::table('series')
    ->select('lastvalue')
    ->where('id','=',1)
    ->first();
    $series = $series->lastvalue;
    $datas=$request->all();


    $barcode=$series.date("mdY");
    

    $tosave['tracking_barcode']=intval($barcode);
    $tosave['institute_id']=getLogindetails()->institute_id;
    $tosave['doc_type_id']=$datas['doc_type_id'];
    $tosave['doc_title']=$datas['doc_title'];
    $tosave['doc_desc']=$datas['doc_desc'];
    $tosave['doc_keywords']=$datas['doc_keywords'];
    $tosave['doc_remarks']=$datas['doc_remarks'];
    $tosave['created_by']=getLogindetails()->user_id;

   //dd($_FILES["tracking_attachment"]["name"]);
//for uploads
    $maxsize    = 2097152;
    $temp = $_FILES["tracking_attachment"]["name"];
    $file_ext = substr($temp, strripos($temp, '.'));


    $newfilename = $barcode. $file_ext;
    $target_dir = "fileattachment_uploads/";
    $target_file = $target_dir . basename('test'.$_FILES["tracking_attachment"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["tracking_attachment"]["tmp_name"], $target_dir.$newfilename);
    // Check if image file is a actual image or fake image

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    $tosave['tracking_attachment']=$newfilename;

        // dd($tosave);
        // $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        // echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barcode, $generator::TYPE_CODE_128)) . '">';
        // dd(1);

    $trackingid=DB::table('tracking')->insertGetId(
        $tosave);


    $doc = DB::table('document_type')
    ->select('*')
    ->leftjoin('doc_process', 'document_type.doc_id','=','doc_process.doc_id')
    ->where('document_type.doc_id','=',$datas['doc_type_id'])
    ->where('doc_process.is_active','=','1')
    ->first();

        // dd($doctype->process_flow);
    $processes=json_decode($doc->process_flow);
    $step=0;
    foreach ($processes as $process) {
            // var_dump($process);
        $step=$step+1;

        $trackingsave['tracking_id']=$trackingid;
        $trackingsave['process_step']=$step;
        $trackingsave['assoc_id']=$process;
        if($step==1)
        {
            $trackingsave['flag']=0;
        }
        else
        {
            $trackingsave['flag']=0;   
        }
        DB::table('tracking_process')->insert(
            $trackingsave);
    }

    $step=$step+1;
    $eo_step['tracking_id']=$trackingid;
    $eo_step['process_step']=$step;
    $eo_step['assoc_id']=null;
    DB::table('tracking_process')->insert(
        $eo_step);

    $series=$series+1;
    DB::table('series')
    ->where('id', 1)
    ->update(['lastvalue' => $series]);

    $response='Document "'.$datas['doc_title'].'" Successfully Added in Tracking';

    $doctype = DB::table('document_type')
    ->select('*')
    ->leftjoin('doc_process', 'document_type.doc_id','=','doc_process.doc_id')
    ->where('doc_process.is_active','=','1')
    ->get();

    $pdf_data=DB::table('tracking')
    ->select('tracking.*','document_type.doc_desc as doc_type_desc','institutes.institute_name')
    ->leftjoin('institutes','tracking.institute_id','=','institutes.institute_id')
    ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
    ->where('tracking.tracking_id','=',$trackingid)
    ->first();

        // $pdf = PDF::loadView('content.pdf_template.attachment',array('pdf_data'=>$pdf_data));
        // $pdf->setPaper('letter', 'portrait');
        // return $pdf->stream('tracking_attachment.pdf');


    return view('content.tracking_new' , ['doctype' => $doctype , 'response'=> $response]);
}

public function add_attachments(Request $request)
{
    date_default_timezone_set("Asia/Manila");
    
    if($request->attachment)
    {
        $count=DB::table('tracking_update_attachments')
        ->select('*')
        ->where('tracking_id','=',$request->tracking_id)
        ->get();
        $count=count($count)+1;

        $attach = explode(".", $request->attachment);
        $barcode=$attach[0].'-'.$count;
    }
    else
    {
     $count=DB::table('tracking_update_attachments')
     ->select('*')
     ->where('tracking_id','=',$request->tracking_id)
     ->get();
     $count=count($count)+1;

     $series=DB::table('series')
     ->select('lastvalue')
     ->where('id','=',1)
     ->first();
     $series = $series->lastvalue;
     $barcode=$series.date("mdY").'-'.$count+1;
     $series=$series+1;
     DB::table('series')
     ->where('id', 1)
     ->update(['lastvalue' => $series]);
 }

 $tosave=[];
 $tosave['tracking_id']=$request->tracking_id;


 $temp = $_FILES["tracking_attachment"]["name"];
 $file_ext = substr($temp, strripos($temp, '.'));


 $newfilename = $barcode. $file_ext;
 $target_dir = "fileattachment_uploads/";
 $target_file = $target_dir . basename('test'.$_FILES["tracking_attachment"]["name"]);
 $uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 move_uploaded_file($_FILES["tracking_attachment"]["tmp_name"], $target_dir.$newfilename);
    // Check if image file is a actual image or fake image

 if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

$tosave['attachment_name']=$newfilename;

        // dd($tosave);
        // $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        // echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barcode, $generator::TYPE_CODE_128)) . '">';
        // dd(1);

$trackingid=DB::table('tracking_update_attachments')->insert(
    $tosave);






$response='Attachment Successfully Added';

        // $pdf = PDF::loadView('content.pdf_template.attachment',array('pdf_data'=>$pdf_data));
        // $pdf->setPaper('letter', 'portrait');
        // return $pdf->stream('tracking_attachment.pdf');


// return view('content.tracking_new' , ['doctype' => $doctype , 'response'=> $response]);
return redirect('tracking/view/'.$request->tracking_id)->with('status', $response);
}

public function download_attachment($id)
{
    $pdf_data=DB::table('tracking')
    ->select('tracking.*','document_type.doc_desc as doc_type_desc','institutes.institute_name')
    ->leftjoin('institutes','tracking.institute_id','=','institutes.institute_id')
    ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
    ->where('tracking.tracking_id','=',$id)
    ->first();

    $pdf = PDF::loadView('content.pdf_template.attachment',array('pdf_data'=>$pdf_data));
    $pdf->setPaper('letter', 'portrait');
    return $pdf->stream('tracking_attachment.pdf');
}

public function search(Request $request)
{
    date_default_timezone_set("Asia/Manila");


    $tracknum=$request->track_num;

    $track_det = DB::table('tracking')
    ->select('tracking.*','document_type.doc_desc as doctype_desc')
    ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
    ->where('tracking_barcode','=',$tracknum)
    ->first();

    if(count($track_det)==0)
    {
        $response='No Document Found';

        if(getLogindetails()->usertype_id==3)
        {
            $active = DB::table('tracking')
            ->select('*')
            ->where('doc_current_status','=',Null)
            ->orwhere('doc_current_status','=','On-going')
            ->orwhere('doc_current_status','=','Done Process')
            ->where('institute_id','=',getLogindetails()->institute_id)
            ->get();

            $closed = DB::table('tracking')
            ->select('*')
            ->where('doc_current_status','=','Closed')
            ->where('institute_id','=',getLogindetails()->institute_id)
            ->get();
        }
        elseif(getLogindetails()->usertype_id==4)
        {
            $active = DB::table('tracking')
            ->select('*')
            ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
            ->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
            ->where('tracking_process.flag','=',1)
            ->where('tracking_process.recieve_datetime','=',null)
            ->get();

            $closed = DB::table('tracking')
            ->select('*')
            ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
            ->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
            ->where('tracking_process.flag','=',1)
            ->where('tracking_process.recieve_datetime','!=',null)
            ->where('tracking_process.release_datetime','=',null)
            ->get();
        }
        else
        {

            $active = DB::table('tracking')
            ->select('*')
            ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
            // ->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
            ->where('tracking_process.flag','=',1)
            ->where('tracking_process.recieve_datetime','=',null)
            ->get();

            $closed = DB::table('tracking')
            ->select('*')
            ->leftjoin('tracking_process','tracking.tracking_id','=','tracking_process.tracking_id')
            // ->where('tracking_process.assoc_id','=',getLogindetails()->assoc_id)
            ->where('tracking_process.flag','=',1)
            ->where('tracking_process.recieve_datetime','!=',null)
            ->where('tracking_process.release_datetime','=',null)
            ->get();
        }
        

        return view('content.tracking', ['active' => $active, 'closed' =>$closed, 'response'=> $response]);
    }
    else
    {      


     $track_process = DB::table('tracking_process')
     ->select('*')
     ->leftjoin('assoc_of','tracking_process.assoc_id','=','assoc_of.assoc_of_id')
     ->where('tracking_id','=',$track_det->tracking_id)
     ->orderby('process_step','asc')
     ->get();

     $track_remarks = DB::table('admin_staff_remarks')
     ->select('*')
     ->where('tracking_id','=',$track_det->tracking_id)
     ->get();
        //dd($track_remarks);

     return view('content.tracking_search' , ['track_det' => $track_det , 'track_process'=>  $track_process, 'track_remarks'=> $track_remarks]);
 }
}

public function advancesearch(Request $request)
{
    date_default_timezone_set("Asia/Manila");


    $filter=$request->filter;
    $value=$request->Value;

    if($request->filter == "Title")
    {
        $active = DB::table('tracking')
        ->select('*', 'tracking.date_created as date_created')
        ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
        ->where('institute_id','=',getLogindetails()->institute_id)
        ->where('doc_title', 'like', '%'.$request->value.'%')
        ->orderBy('tracking_id', 'desc')             
        ->get();
            // dd($active);
    }

    if($request->filter == "Keyword")
    {
        $active = DB::table('tracking')
        ->select('*', 'tracking.date_created as date_created')
        ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
        ->where('institute_id','=',getLogindetails()->institute_id)
        ->where('doc_keywords', 'like', '%'.$request->value.'%')
        ->orderBy('tracking_id', 'desc')             
        ->get();
            // dd($active);
    }
    if(count($active)==0)
    {
        $response='No Document Found';

        $active = DB::table('tracking')
        ->select('*', 'tracking.date_created as date_created')
        ->leftjoin('document_type', 'tracking.doc_type_id','=','document_type.doc_id')
        ->where('institute_id','=',getLogindetails()->institute_id)
        ->where(function ($query) {
            $query  ->where('doc_current_status','=',Null)
            ->orwhere('doc_current_status','=','On-going')
            ->orwhere('doc_current_status','=','Done Process');


        })
        ->orderBy('tracking_id', 'desc')             
        ->get();

        return view('content.tracking', ['active' => $active, 'response'=> $response]);
    }
    else
    {      



     return view('content.tracking_advance' , ['active' => $active]);
 }
}
public function remarksSave(Request $request)
{
   
   DB::table('tracking_process')
    ->where('track_proc_id', $request->process_id)
    ->update(['remarks' => $request->remarks]);

  return response()->json(['success'=>'Data is successfully added']);
}




}
