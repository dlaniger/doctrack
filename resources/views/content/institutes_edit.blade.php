@extends('index')
@section('content')
<div class="row">
	<div class="span12">
		<div id="target-1" class="widget">
			
			<div class="widget-content" >
				<div align="center">
					<h2>Edit Institute / Unit</h2>
				</div>
				<br>
				 @if(isset($response))
                    <div class="alert alert-success alert-dismissible " role="alert">
                     <strong><i class="icon-check"></i>{{$response}}</strong>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>                    
                  @endif
				{{ Form::open(array('url' => '/references/institutes/editsave', 'method' => 'post', 'class'=>'form-horizontal')) }}
				<form id="edit-profile" class="form-horizontal">
					<fieldset>
						<input type="hidden" id="institute_id" name="institute_id" value="{{$ins->institute_id}}">
						<div class="control-group">											
							<label class="control-label" for="institute_name">Institute Name</label>
							<div class="controls">
								<input type="text" class="span4" name="institute_name" id="institute_name" value="{{$ins->institute_name}}" required>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div class="control-group">											
							<label class="control-label" for="institute_Code">Institute Code</label>
							<div class="controls">
								<input type="text" class="span4" name="institute_code" id="institute_Code" value="{{$ins->institute_code}}" required>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->

						<div align="center">
							{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
						</div>
					</fieldset>
					{!! Form::close() !!}
				</form>
			</div>
		</div>
		


		<div class="widget-table action-table" style="padding-bottom: 50px;">
			<div class="widget-header"><i class="icon-book"></i>
				<h3> Institutes / Unit</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content" >
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="td-actions">  </th>
							<th> Institute Name</th>
							<th> Institute Code </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($institutes as $institute)
						<tr>
							<td style="text-align: center;">

								<div class="dropdown">
									<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="icon-cog"></i>
									</button>
									<ul class="dropdown-menu">
											@if($institute->institute_flag == 1)
										<li><a href="{{ url('/references/institutes/edit')}}/{{$institute->institute_id}}">Edit</a></li>
										<li><a href="{{ url('/references/institutes/disable')}}/{{$institute->institute_id}}">Disable</a></li>
										@else
										<li><a href="{{ url('/references/institutes/enable')}}/{{$institute->institute_id}}">Enable</a></li>
										@endif

									</ul>
								</div>
							</td>
							<td>{{$institute->institute_name}}</td>
							<td>{{$institute->institute_code}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- /widget-content --> 
		</div> <!-- /widget -->

	</div> <!-- /span12 -->





</div>
@endsection

@section('scripts')

@endsection

