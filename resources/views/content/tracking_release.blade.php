@extends('index')
@section('content')
<style type="text/css">

</style>
<div class="row">
	<div class="span12 ">
		<div class="control-group">	
			<div class="controls pull-right">

				<a class="btn btn-large btn-primary" href="{{ url('/tracking')}}">Back</a>

			</div>	<!-- /controls -->	
			<br>
			<br>

		</div>
	</div>
	<div class="span12">
		
		<div id="target-1" class="widget">
			
			<div class="widget-content">
				<div align="center" class="span12"><h1>RELEASE DOCUMENT</h1></div>
				<div class="span5">
					<div class="widget">
						<div class="tab-pane" id="formcontrols">
							<br/>

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
						<h3>Attachment:</h3>
						<a href="{{url('fileattachment_uploads')}}/{{$track_det->tracking_attachment}}">Original Upload - {{$track_det->tracking_attachment}} </a>
						@if(isset($otherattachment))
						@foreach($otherattachment as $other)
						<br/>
						<a href="{{url('fileattachment_uploads')}}/{{$other->attachment_name}}">{{$other->attachment_name}} </a>
						@endforeach
						@endif

					</div>

				</div>

				<div class="tab-pane" id="formcontrols" >
					{{ Form::open(array('url' => 'tracking/trackingrelease', 'method' => 'post', 'class'=>'form-horizontal form-label-left')) }}
					<fieldset>
						<div class="control-group">											
							<label class="control-label" for="doc_desc">Remarks</label>
							<div class="controls">
								<textarea class="form-control span6" name="remarks" id="remarks" rows="5">{{$track_process->remarks}}</textarea>
								<!-- <p class="help-block" style="color:red">This remarks are only visible within the Application</p> -->
								<input type="hidden" name="tracking_id" id="tracking_id" value="{{$proc_id}}">
								<input type="hidden" name="track_id" id="track_id" value="{{$track_det->tracking_id}}">
									<br />
									<br />
									<input type="button" class="btn btn-success" onclick="saveremarks()" value="Save Remarks">
							</div> <!-- /controls -->
								
						</div> <!-- /control-group -->


						<br />




						<br />


						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Release</button> 
						</div> <!-- /form-actions -->
					</fieldset>
					{!! Form::close() !!}
				</div>

				
			</div> <!-- /widget-content -->
			
		</div> <!-- /widget -->
		
	</div> <!-- /span12 -->

	

	

	

</div>
@endsection

@section('scripts')

<script>
         function saveremarks() {

         	var remark=$('#remarks').val();
         	var process_i=$('#tracking_id').val();
         		
            $.ajax({
               type:'POST',
                url: "{{ url('/tracking/trackingremarks') }}",
              
               data:{remarks:remark,process_id:process_i,_token: "{{ csrf_token() }}"},


               success:function(data) {
                  alert('Remarks Saved!')
               }
            });
         }
      </script>

@endsection

