@extends('index')
@section('content')
<div class="row">
	<div class="span12">
		
		<div id="target-1" class="widget">
			
			<div class="widget-content" align="center" style="height:350px!important">
				@if(isset($response))
				<div class="alert alert-danger alert-dismissible " role="alert">
					<strong><i class="icon-close"></i>{{$response}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>                    
				@endif
				{{ Form::open(array('url' => 'tracking/guest_search', 'method' => 'post', 'class'=>'form-horizontal form-label-left')) }}
				<h3>SEARCH BY TRACKING NUMBER</h3>


				<input type="text" class="span4" required name="track_num" id="track_num" value="">
				<br/>
				<br/>

				
				<button type="submit" class="btn btn-primary">Search</button> 
				

				{!! Form::close() !!}
				
			</div> <!-- /widget-content -->
			
		</div> <!-- /widget -->
		
	</div> <!-- /span12 -->

</div>
@endsection

@section('scripts')

@endsection

