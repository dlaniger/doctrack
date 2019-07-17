<?php

function getSystemName(){
	
	return " College of Science Document Tracking System";
}

function getLogindetails(){
	if (Auth::check())
		{

			$userdetails = DB::table('user_details')
			->select('*')
			->leftjoin('institutes','user_details.institute_id','=','institutes.institute_id')
			->leftjoin('users','user_details.user_id','=','id')
			->leftjoin('assoc_of','user_details.assoc_id','=','assoc_of.assoc_of_id')
			->where('user_id','=',Auth::user()->id)
			->first();

			return $userdetails;
		}
		else
		{
			return ;
		}
	}

