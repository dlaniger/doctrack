<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use DB;

class GuestController extends Controller
{
	public function index()
	{
		return view('content.guest');
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



			return view('content.guest', ['response'=> $response]);
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
}
