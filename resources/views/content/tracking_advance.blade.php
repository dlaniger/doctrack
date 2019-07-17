@extends('index')
@section('content')
<div class="row">
	<div class="span12">
		
		<div id="target-1" class="widget">
			
			<div class="widget-content" align="left">
				@if(isset($response))
				<div class="alert alert-danger alert-dismissible " role="alert">
					<strong><i class="icon-close"></i>{{$response}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>                    
				@endif
				{{ Form::open(array('url' => 'tracking/search', 'method' => 'post', 'class'=>'form-horizontal form-label-left')) }}
				<h3>SEARCH BY TRACKING NUMBER</h3>


				<input type="text" class="span4" required name="track_num" id="track_num" value="">
				
				<button type="submit" class="btn btn-primary">Search</button> 
				
				{!! Form::close() !!}
				@if(getLogindetails()->usertype_id==3)
				{{ Form::open(array('url' => 'tracking/advancesearch', 'method' => 'post', 'class'=>'form-horizontal form-label-left')) }}
				<h3>ADVANCE SEARCH</h3>


				<label class="control-label" for="usertype_id">Search By:</label>
				<div class="controls">
					<select class="form-control span3 assoc_select"  required name="filter" id="filter">
						<option value="Title">Title</option>
						<option value="Keyword">Keyword</option>									
					</select>											

				</div>	
				<br>

				<label class="control-label" for="usertype_id">Text:</label>	
				<div class="controls">	
					<input type="text" class="span3" required name="value" id="value" value="">
				</div>
				<br>
				<div class="controls">
					<button type="submit" class="btn btn-primary">Search</button> 
				</div>
				@endif
				
				{!! Form::close() !!}


				
			</div> <!-- /widget-content -->
			
		</div> <!-- /widget -->
		
	</div> <!-- /span12 -->
	@if(getLogindetails()->usertype_id==3)
	<div class="span12 ">
		<!-- <div class="control-group">	
			<div class="controls pull-right">

				<a class="btn btn-large btn-primary" href="{{ url('/tracking/addnew')}}">Add New Document</a>

			</div>
			<br>
			<br>

		</div> -->
		@if(isset($_GET['tracking']))
		@if($_GET['tracking']=='started')
		<div class="alert alert-success alert-dismissible " role="alert">
			<strong><i class="icon-close"></i>Tracking Started</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@elseif($_GET['tracking']=='finish')
		<div class="alert alert-success alert-dismissible " role="alert">
			<strong><i class="icon-close"></i>Tracking Finished</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>  
		@else
		<div class="alert alert-success alert-dismissible " role="alert">
			<strong><i class="icon-close"></i>Tracking Cancelled</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>         
		@endif
		@endif
	</div>

	<div class="span12">
		<div align="right">
			<a href="{{ url('/tracking/finished')}}" style="font-size:15px;">View Finished / Cancelled Documents</a>
		</div>

		<div class="widget widget-table action-table">
			<div class="widget-header"> <i class="icon-th-list"></i>
				<h3>Search Result</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="td-actions"> </th>
							<th> Document Title </th>
							<th> Tracking Number </th>
							<th> Description</th>
							<th> Date Created</th>
							<th> Current Status</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach ($active as $act)
						
						<tr>
							<td style="text-align:center">

							<!-- 	<div class="dropdown">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="icon-gear"></i>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="">
										<a class="dropdown-item" href="{{ url('/tracking/view')}}/{{$act->tracking_id}}">View</a>
										<a class="dropdown-item" href="#">Update Attachment</a>
										<a class="dropdown-item" href="#">Cancel Tracking</a>
									</div>
								</div> -->
								<a href="{{ url('/tracking/view')}}/{{$act->tracking_id}}" class="btn btn-small btn-primary">View</a>
							</td>
							<td> {{$act->doc_title}} </td>
							<td> {{$act->tracking_barcode}} </td>
							<td> {{$act->doc_desc}} </td>
							<td>  {{date("m-d-Y", strtotime($act->date_created))}} </td>
							<td> @if ($act->doc_current_status == null)
								<strong><span style="color:red">Stand By</span></strong>
								@elseif($act->doc_current_status == 'On-going')
								<strong><span style="color:green">On-going</span></strong>
								@elseif($act->doc_current_status == 'Done Process')
								<strong><span style="color:blue">Done Process</span></strong>
								@endif

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- /widget-content --> 
		</div> <!-- /widget -->

	</div> <!-- /span6 -->

	

	@endif
	@endsection

	@section('scripts')

	@endsection

