@extends('index')
@section('content')
<div class="row">
	<div class="span12">
		<div id="target-1" class="widget">
			
			<div class="widget-content">
				<div align="center">
					<h2>Add New Associate Offices</h2>
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

                  	@if(Session::has('message'))
				<div class="alert alert-success alert-dismissible " role="alert">
					<strong><i class="icon-check"></i>&nbsp;{{Session::get('message')}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>   
				@endif 
				{{ Form::open(array('url' => '/references/offices', 'method' => 'post', 'class'=>'form-horizontal')) }}
				<form id="edit-profile" class="form-horizontal">
					<fieldset>
						<div class="control-group">
							{{ Form::label('inst_desc', 'Name', array('class' => 'control-label')) }}									
							<div class="controls">
								<input type="text" class="span6" id="assoc_of_desc" name="assoc_of_desc" value="" required>
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
				<h3> Associate Offices</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="td-actions"> </th>
							<th> Associate Office Name</th>
							<th> Date Created</th>
							<th> Status</th>							
						</tr>
					</thead>
					<tbody>
					@foreach ($offices as $office)
						<tr>
							<td style="text-align: center;">

								<div class="dropdown">
									<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="icon-cog"></i>
									</button>
									<ul class="dropdown-menu">
							@if($office->is_active == 1)
										<li><a href="{{ url('/references/offices/edit')}}/{{$office->assoc_of_id}}">Edit</a></li>
										<li><a href="{{ url('/references/offices/disable')}}/{{$office->assoc_of_id}}">Disable</a></li>
										@else
										<li><a href="{{ url('/references/offices/enable')}}/{{$office->assoc_of_id}}">Enable</a></li>
										@endif
									</ul>
								</div>
							</td>
							<td>{{$office->assoc_of_desc}}</td>
							<td>{{date('m-d-Y',strtotime($office->date_created))}}</td>
							@if($office->is_active==1)
							<td style="color:green; text-align: center;"><strong>Enabled</strong></td>
							@else
							<td style="color:red; text-align: center;"><strong>Disabled</strong></td>
							@endif
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

