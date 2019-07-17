@extends('index')
@section('content')
<style type="text/css">
.process-step .btn:focus{outline:none}
.process{display:table;width:100%;position:relative}
.process-row{display:table-row}
.process-step button[disabled]{opacity:1 !important;filter: alpha(opacity=100) !important}
.process-row:before{top:40px;bottom:0;position:absolute;content:" ";width:100%;height:1px;background-color:#ccc;z-order:0}
.process-step{display:table-cell;text-align:center;position:relative}
.process-step p{margin-top:4px}
.btn-circle{width:80px;height:80px;text-align:center;font-size:12px;border-radius:50%}

</style>
<div class="row">
	<div class="span12 ">
		<div class="control-group">	
			<div class="controls pull-right">
				@if(Auth::check())
				<a class="btn btn-large btn-primary" href="{{ url('/tracking')}}">Back</a>
				@else
				<a class="btn btn-large btn-primary" href="{{ url('/')}}">Back</a>
				@endif

			</div>	<!-- /controls -->	
			<br>
			<br>

		</div>
	</div>
	<div class="span12">


		
		<div id="target-1" class="widget">
			
			<div class="widget-content">
				@if( session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif

				@if($track_det->doc_current_status !=null or $track_det->doc_current_status != 'Closed' )	
				<!-- 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->
				<div class="process">
					<div class="process-row nav nav-tabs">
						<?php
						$process_cnt=count($track_process);
						$width=100/($process_cnt+1);
						$style='style=width:'.$width.'%!important';
						
						?>
						@if($track_det->doc_current_status == null)
						<div class="process-step"  {{$style}}>
							<button type="button" class="btn btn-info btn-circle" data-toggle="tab" href="#"><i class="fa fa-file fa-3x"></i></button>
							<p>Start</p>
						</div>
						@else
						<div class="process-step"  {{$style}}>
							<button type="button" class="btn btn-info btn-circle" data-toggle="tab" href="#"><i class="fa fa-file fa-3x"></i></button>
							<p>Start</p>
						</div>
						@endif
						@foreach ($track_process as $process)
						

						@if($process->process_step == 1 and $process->recieve_datetime == null)
						
						<div class="process-step"  {{$style}}>
							<button type="button" class="btn btn-default btn-circle" data-toggle="tab" href={{'#menu'.$process->track_proc_id}}><i class="fa fa-file fa-3x"></i></button>

							<p>{{ $process->assoc_id == Null ? "Dean's Office" : $process->assoc_of_desc }}</p>
						</div>
						@elseif($process->recieve_datetime !=null)
						
						<div class="process-step" {{$style}}>
							<button type="button" class="btn btn-info btn-circle" data-toggle="tab" href={{'#menu'.$process->track_proc_id}}><i class="fa fa-file fa-3x"></i></button>
							@if($process->flag == 1)
							<p style="font-size: 15px"><strong>[{{ $process->assoc_id == Null ? "Dean's Office" : $process->assoc_of_desc }}]</strong></p>
							@else
							<p>{{ $process->assoc_id == Null ? "Dean's Office" : $process->assoc_of_desc }}</p>
							@endif
						</div>
						@elseif($process->recieve_datetime == null && $process->flag == 1)
						<div class="process-step" {{$style}}>
							<button type="button" class="btn btn-info btn-circle" data-toggle="tab" href={{'#menu'.$process->track_proc_id}}><i class="fa fa-file fa-3x"></i></button>
							<p style="font-size: 15px"><strong>[{{ $process->assoc_id == Null ? "Dean's Office" : $process->assoc_of_desc }}]</strong></p>
						</div>
						@else
						<div class="process-step" {{$style}}>
							<button type="button" class="btn btn-default btn-circle" disabled data-toggle="tab" href={{'#menu'.$process->track_proc_id}}><i class="fa fa-file fa-3x"></i></button>
							<p>{{ $process->assoc_id == Null ? "Dean's Office" : $process->assoc_of_desc }}</p>
						</div>
						@endif

					<!-- 	<div class="process-step">
							<button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu2"><i class="fa fa-file-text-o fa-3x"></i></button>
							<p><small>Fill<br />description</small></p>
						</div> -->
						@endforeach
					</div>
				</div>
@if($track_det->doc_current_status!=null)
				<div class="tab-content">

					@foreach ($track_process as $process)
					@if($process->process_step == 1 and $process->recieve_datetime == null)
					<div id="menu{{$process->track_proc_id}}" class="tab-pane active fade in">
						<h3>Current Process: {{$process->assoc_of_desc}}</h3>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Recieve Date: </label>
							<div class="controls">
								<h4>{{$process->recieve_datetime}}</h4>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<br/>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Release Date: </label>
							<div class="controls">
								<h4>{{$process->release_datetime}}</h4>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->
						
						<br/>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Remarks: </label>
							<div class="controls">
									<textarea class="form-control span6" name="remarks" readonly id="remarks" rows="5">{{$process->remarks}}</textarea>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->						
					</div>
					@elseif($process->assoc_of_desc==null && $process->flag == 1)
					<div id="menu{{$process->track_proc_id}}" class="tab-pane {{ $process->flag == 1 ? 'active' : '' }} fade in">
						<h3>Current Process: Deans Office</h3>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Recieve Date: </label>
							<div class="controls">
								<h4>{{$process->recieve_datetime}}</h4>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<br/>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Release Date: </label>
							<div class="controls">
								<h4>{{$process->release_datetime}}</h4>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->
						
						<br/>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Remarks: </label>
							<div class="controls">
								<textarea class="form-control span6" name="remarks" readonly id="remarks" rows="5">{{$process->remarks}}</textarea>
							</div> <!-- /controls -->				
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->						
					</div>
					@else
					<div id="menu{{$process->track_proc_id}}" class="tab-pane {{ $process->flag == 1 ? 'active' : '' }} fade in">
						<h3>Current Process: {{$process->assoc_of_desc}}</h3>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Recieve Date: </label>
							<div class="controls">
								<h4>{{$process->recieve_datetime}}</h4>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<br/>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Release Date: </label>
							<div class="controls">
								<h4>{{$process->release_datetime}}</h4>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->
						
						<br/>
						<div class="control-group">											
							<label class="control-label" for="doc_title">Remarks: </label>
							<div class="controls">
								<textarea class="form-control span6" name="remarks" readonly id="remarks" rows="5">{{$process->remarks}}</textarea>
							</div> <!-- /controls -->				
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->		

						<!-- <ul class="list-unstyled list-inline pull-right">
							<li><button type="button" class="btn btn-info next-step">Next <i class="fa fa-chevron-right"></i></button></li>
						</ul> -->
					</div>
					@endif
					@endforeach
				</div>
				@endif
				<hr/>
				<br/>
				@endif

				<div class="span5">
					<div class="widget">
						<div class="tab-pane" id="formcontrols">
							<h2>Document Details</h2>
							<div class="control-group">											
								<label class="control-label" for="doc_title">Type: </label>
								<div class="controls">
									<h4>{{$track_det->doctype_desc}}</h4>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<br/>
							<div class="control-group">											
								<label class="control-label" for="doc_title">Title: </label>
								<div class="controls">
									<h4>{{$track_det->doc_title}}</h4>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<br/>
							<div class="control-group">											
								<label class="control-label" for="doc_title">Description: </label>
								<div class="controls">
									<h4>{{$track_det->doc_desc}}</h4>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<br/>
							<div class="control-group">											
								<label class="control-label" for="doc_title">Staff Remarks: </label>
								<div class="controls">
									<table>
										<tr>
											<td><strong>{{date('m/d/Y g:i a',strtotime($track_det->date_created))}}</strong></td>
											<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Tracking created: {{$track_det->doc_remarks}}</strong></td>
										</tr>


										@if(isset($track_remarks))

										@foreach($track_remarks as $remarks)
										<tr>
											<td><strong>{{date('m/d/Y g:i a',strtotime($remarks->date_created))}}</strong></td>
											<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;{{$remarks->remarks}}</strong></td>
										</tr> 
										@endforeach

										@endif
									</table>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<br/>


						</div>
						@if (Auth::check())  
						@if(getLogindetails()->usertype_id==3 and getLogindetails()->institute_id == $track_det->institute_id and ($track_det->doc_current_status == null or $track_det->doc_current_status == 'On-going') )
						<br/>
						<a href="{{url('/tracking/cancelprocess')}}/{{$track_det->tracking_id}}" onclick="return confirm('Are you sure you want to cancel this tracking?')" class="btn btn-danger" id="cancel-tracking"><i class="fa fa-close" aria-hidden="true"></i> Cancel Tracking </a>
						@endif  
						@if(getLogindetails()->usertype_id==3 and getLogindetails()->institute_id == $track_det->institute_id and ($track_det->doc_current_status == null or $track_det->doc_current_status == 'Done Process') )
						{{ Form::open(array('url' => 'tracking/addremark', 'method' => 'post', 'enctype'=>'multipart/form-data')) }}
						<div class="control-group">											
							<label class="control-label" for="doc_title">Add New Remarks: </label>
							<div class="controls">
								<div class="controls">
									<input type="hidden" name="tracking_id" value="{{$track_det->tracking_id}}">
									<textarea class="form-control span4" name="remarks" id="doc_desc" rows="5" required=""></textarea>
								</div>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->
						<button type="submit" class="btn btn-primary">Save Remarks</button> 
						{!! Form::close() !!}
						<br/>
						
						<br/>
						<br/>
						@if($track_det->doc_current_status == null)
						<a href="{{url('/tracking/printattach')}}/{{$track_det->tracking_id}}" class="btn btn-success" ><i class="fa fa-file" aria-hidden="true"></i>  Print Tracking Attachment </a> &nbsp;&nbsp;
						<a href="{{url('/tracking/startprocess')}}/{{$track_det->tracking_id}}" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>  Start Proccess </a>
						@endif
						@if($track_det->doc_current_status == 'Done Process')
						<a href="{{url('/tracking/finishprocess')}}/{{$track_det->tracking_id}}" class="btn btn-succes"><i class="fa fa-check" aria-hidden="true"></i>  Finish Tracking </a>
						@endif
						@endif
						@endif
					</div>

				</div>
				<div class="span5" align="center">
					<div id="target-2" class="widget">
						<br/>
						<br/>
						<?php

						$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
						echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($track_det->tracking_barcode, $generator::TYPE_CODE_128)) . '">';

						?>
						<h4>{{$track_det->tracking_barcode}}</h4>
						<br/>
						<h3>File Attachment:</h3>
						<a href="{{url('fileattachment_uploads')}}/{{$track_det->tracking_attachment}}">Original Upload - {{$track_det->tracking_attachment}} </a>
    				
						@if(isset($otherattachment))
						@foreach($otherattachment as $other)
						<br/>
						<a href="{{url('fileattachment_uploads')}}/{{$other->attachment_name}}">{{$other->attachment_name}} </a>
						@endforeach
						@endif
						<br/>
						<br/>
						<br/>
						<br/>
						@if (Auth::check()) 
						@if(getLogindetails()->usertype_id==3 and getLogindetails()->institute_id == $track_det->institute_id)
						{{ Form::open(array('url' => 'tracking/updateattachment', 'method' => 'post', 'enctype'=>'multipart/form-data')) }}   
						<div class="control-group" align="center">											
							<label class="control-label" for="doc_title"><h4>Add Attachment</h4></label>
							<div class="controls">
								<input type="file" class="span4" id="tracking_attachment" required name="tracking_attachment" style="margin-bottom:0px; padding-bottom: 0px">
								<p class="help-block" style="color:red; margin-top: 0px;padding-top: 0px;">Max upload size is 20mb and in pdf format.</p>
								<input type="hidden" name="tracking_id" value="{{$track_det->tracking_id}}">
								<input type="hidden" name="attachment" value="{{$track_det->tracking_attachment}}">
								<!-- 	<input type="text" class="span4" name="doc_title" id="doc_title" value=""> -->
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->
						<button type="submit" class="btn btn-primary">Add Attachments</button> 
						{!! Form::close() !!}
						@endif
						@endif


					</div>

				</div>


			</div> <!-- /widget-content -->

		</div> <!-- /widget -->

	</div> <!-- /span12 -->







</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(function(){
		$('.btn-circle').on('click',function(){
			// $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
			// $(this).addClass('btn-info').removeClass('btn-default').blur();
			console.log(this);
		});

		$('.next-step, .prev-step').on('click', function (e){
			var $activeTab = $('.tab-pane.active');

			$('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

			if ( $(e.target).hasClass('next-step') )
			{
				var nextTab = $activeTab.next('.tab-pane').attr('id');
				$('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
				$('[href="#'+ nextTab +'"]').tab('show');
			}
			else
			{
				var prevTab = $activeTab.prev('.tab-pane').attr('id');
				$('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
				$('[href="#'+ prevTab +'"]').tab('show');
			}
		});
	});
</script>

<script type="text/javascript">
	$('#tracking_attachment').on('change', function() {
      	//because this is single file upload I use only first index
      	var exts = ['PDF','pdf']
      	var f = this.files[0];
      	var file = $('#tracking_attachment').val();
      	var get_ext= file.split('.');

      	get_ext=get_ext.reverse();
      	if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
      		console.log( 'Allowed extension!' );
      	} else {
      		alert( 'Invalid file!' );
      		this.value = null;
      	}

               //here I CHECK if the FILE SIZE is bigger than 8 MB (numbers below are in bytes)
               if (f.size > 20971520 || f.fileSize > 20971520)
               {
           //show an alert to the user
           alert("Allowed file size exceeded. (Max. 20 MB)")

           //reset file upload control
           this.value = null;
       }


   });
</script>
@endsection

