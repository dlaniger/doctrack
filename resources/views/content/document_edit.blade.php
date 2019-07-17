@extends('index')
@section('content')
<style type="text/css">
.icon-remove {
	color: red;
}
</style>
<div class="row">
	<div class="span12">
		<div id="target-1" class="widget">
			<div class="widget-header">
				<h2>&nbsp;&nbsp;<strong>EDIT DOCUMENT TYPE</strong></h2>
			</div>
			
			<div class="widget-content">
				
				
				<div class="tab-pane" id="formcontrols" >
					{{ Form::open(array('url' => '/references/documents/edit', 'method' => 'post', 'class'=>'form-horizontal form-label-left')) }}
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
										<label class="control-label" for="name">Document Type Name:</label>
										<div class="controls">
											<input type="text" class="span4" required name="doc_desc" id="doc_desc" value="{{$doc->doc_desc}}">
											<input type="hidden" id="doc_id" name="doc_id" value="{{$doc->doc_id}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<hr>
									<h3>ADD PROCESS</h3>
									<div class="control-group"  id='forassocusers'>							
										<label class="control-label" for="usertype_id">Associate Office:</label>
										<div class="controls">
											<select class="form-control span4 assoc_select"  required name="assoc_id" id="assoc_id">
												@foreach($assocs as $assoc)
												<option value="{{$assoc->assoc_of_id}}">{{$assoc->assoc_of_desc}}</option>
												@endforeach
											</select>	

											<input type="button" name="addproc" id="addproc" class="btn btn-success" value="ADD">

										</div>										
									</div> <!-- /control-group -->
									<table style="margin-left: 50px;" class="" id="tblprocess">
										<tbody>			
											@foreach($proc as $procc)

											<tr class="child">
												<td style="vertical-align:middle; text-align: center" width="100px"><i class="icon-remove" onclick="javascript: removeRow(this)"></i></td>
												<td width="200px" style="text-align:center;"><input type="hidden" name="process[]" id=process[] value="{{$procc['id']}}"><input type="text" class="span4" value="{{$procc['desc']}}" readonly></td>
											</tr>	
											@endforeach								

										</tbody>
									</table>

									<br/>
									<div class="form-actions">
										<input type="submit" style="visibility: hidden" id="finalsubmit" class="btn btn-primary" value="Save Document Type">
										<input type="button" id="save" class="btn btn-primary" value="Save Document Type">
										<a href="{{ url('references/documents')}}" class="btn">Back</a>
									</div> <!-- /form-actions -->
								</fieldset>
								{!! Form::close() !!}
							</div>

						</div> <!-- /widget-content -->

					</div> <!-- /widget -->

				</div> <!-- /span12 -->

			</div>
			@section('scripts')
			<script>
				$(document).ready(function() {

					$('.assoc_select').select2();

					$('#addproc').click(function() {
						var ass_id=$('#assoc_id').val();
						var ass_text=$('#assoc_id option:selected').text();
						$('#tblprocess tbody').append('<tr class="child">\
							<td style="vertical-align:middle; text-align: center" width="100px"><i class="icon-remove" onclick="javascript: removeRow(this)"></i></td>\
							<td width="200px" style="text-align:center;"><input type="hidden" name="process[]" id=process[] value="'+ass_id+'"><input type="text" class="span4" value="'+ass_text+'" readonly></td>\
							</tr>');
					});

					removeRow = function(_this) {

						rows = $('#tblprocess tbody tr').length;
						$(_this).parent().parent().remove();
					}

					$('#save').click(function() {
						rows = $('#tblprocess tbody tr').length;
						if(rows==0)
						{
							alert("No process added")
						}
						else
						{
							$( "#finalsubmit" ).click();
						}
					});

				});

			</script>
			@endsection

			@endsection



