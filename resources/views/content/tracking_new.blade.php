@extends('index')
@section('content')
<div class="row">
	<div class="span12">
		
		<div id="target-1" class="widget">
			<div class="widget-header">
				<h2>&nbsp;&nbsp;<strong>ADD NEW DOCUMENT</strong></h2>
			</div>
			
			<div class="widget-content">
				
				@if(isset($response))
				<div class="alert alert-success alert-dismissible " role="alert">
					<strong><i class="icon-check"></i>{{$response}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>                    
				@endif
				
				<div class="tab-pane" id="formcontrols">
					{{ Form::open(array('url' => 'tracking/addnew', 'method' => 'post', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal form-label-left')) }}
					<fieldset>

									<!-- 	<div class="control-group">											
											<label class="control-label" for="username">Username</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="username" value="Example" disabled>
												<p class="help-block">Your username is for logging in and cannot be changed.</p>
											</div> 			
										</div> 
									-->

									<div class="control-group">											
										<label class="control-label" for="doc_type_id">Document Type</label>
										<div class="controls">
											<select class="form-control span4 doc_type"  required name="doc_type_id" id="doc_type_id">
												@foreach ($doctype as $doc)
												<option value="{{$doc->doc_id}}">{{$doc->doc_desc}}</option>
												@endforeach
											</select>
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->


									<div class="control-group">											
										<label class="control-label" for="doc_title">Document Title</label>
										<div class="controls">
											<input type="text" class="span4" required name="doc_title" id="doc_title" value="">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->


									<div class="control-group">											
										<label class="control-label" for="doc_desc">Document Description</label>
										<div class="controls">
											<textarea class="form-control span6" name="doc_desc" id="doc_desc" rows="5"></textarea>
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="control-group">											
										<label class="control-label" for="doc_desc">Document Keywords</label>
										<div class="controls">
											<textarea class="form-control span6" name="doc_keywords" id="doc_keywords" rows="5"></textarea>
											<p class="help-block" style="color:red">Please make sure that the keywords are separated with space.</p>
										</div> <!-- /controls -->
									</div> <!-- /control-group -->

									<div class="control-group">											
										<label class="control-label" for="doc_desc">Document Remarks</label>
										<div class="controls">
											<textarea class="form-control span6" name="doc_remarks" id="doc_remarks" rows="5"></textarea>
											<p class="help-block" style="color:red">This remarks are only visible within the Application</p>
										</div> <!-- /controls -->
									</div> <!-- /control-group -->
									<br />
									<div class="control-group">											
										<label class="control-label" for="doc_title">Scanned copy</label>
										<div class="controls">
											<input type="file" class="span4" id="tracking_attachment" name="tracking_attachment">
											<p class="help-block" style="color:red; margin-top: 0px;padding-top: 0px;">Max upload size is 20mb and in pdf format.</p>
											<!-- 	<input type="text" class="span4" name="doc_title" id="doc_title" value=""> -->
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<br /><br />




									<br />


									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save Document</button> 
										<a href="{{ url('/tracking')}}" class="btn">Back</a>
									</div> <!-- /form-actions -->
								</fieldset>
							</form>
						</div>

					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

			</div> <!-- /span12 -->

		</div>
		@endsection

		@section('scripts')
		<script type="text/javascript">
			$('.doc_type').select2();
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

