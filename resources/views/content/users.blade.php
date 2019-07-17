@extends('index')
@section('content')
<div class="row">
	<div class="span12">
		    	@if(Session::has('message'))
				<div class="alert alert-success alert-dismissible " role="alert">
					<strong><i class="icon-check"></i>&nbsp;{{Session::get('message')}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>   
				@endif 

		<div class="control-group">	
			<div class="controls pull-right">

				<a class="btn btn-large btn-primary" href="{{ url('/users/addnew')}}">Add New User</a>

			</div>	<!-- /controls -->			
		</div>
		<br>
		<br>
		
		<div class="widget-table action-table" style="padding-bottom: 50px;">
			<div class="widget-header"><i class="icon-user"></i>
				<h3> Users</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="td-actions"> </th>
							<th> Name </th>
							<th> Email </th>
							<th> User Type </th>
							<th> Institute </th>
							<th> Associate Office </th>
							<th> Status </th>

							
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td style="text-align: center;">

								<div class="dropdown">
									<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="icon-cog"></i>
									</button>
									<ul class="dropdown-menu">
											@if($user->is_active == 1)
										<li><a href="{{ url('/users/edit')}}/{{$user->id}}">Edit</a></li>
										<li><a href="{{ url('/users/disable')}}/{{$user->id}}">Disable</a></li>
										@else
										<li><a href="{{ url('/users/enable')}}/{{$user->id}}">Enable</a></li>
										@endif

									</ul>
								</div>
							</td>

							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->usertype_desc}}</td>
							<td>{{ $user->institute_name != null ? $user->institute_name : " "}}</td>
							<td>{{ $user->assoc_of_desc != null ? $user->assoc_of_desc : " "}}</td>
							@if($user->is_active==1)
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

