@extends('index')
@section('content')
<div class="row" >
	<div class="span12">

		<div class="widget-content">
				@if(Session::has('message'))
				<div class="alert alert-success alert-dismissible " role="alert">
					<strong><i class="icon-check"></i>&nbsp;{{Session::get('message')}}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>   
				@endif 
		<div id="target-1" class="widget">
			
			<div class="control-group">	
			<div class="controls pull-right">

				<a class="btn btn-large btn-primary" href="{{ url('/references/documents/addnew')}}">Add Document Type</a>

			</div>	<!-- /controls -->			
		</div>
		<br>
		<br>
		
<!-- <?php
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081212312397', $generator::TYPE_CODE_128)) . '">';
?> -->

		<div class=" widget-table action-table">
			<div class="widget-header"><i class="icon-book"></i>
				<h3> Document Types</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered" style="padding-bottom:50px!important">
					<thead>
						<tr>
							<th class="td-actions"> </th>
							<th> Document</th>
							<th> Process</th>
							<th> Status</th>
							
						</tr>
					</thead>
					<tbody>
						
					@foreach ($doctype as $doct)
					
						<tr>
							<td style="text-align: center;">
								<div class="dropdown">
									<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="icon-cog"></i>
									</button>
									<ul class="dropdown-menu">
										@if($doct->is_active == 1)
										<li><a href="{{ url('/references/documents/edit')}}/{{$doct->doc_id}}">Edit</a></li>
										<li><a href="{{ url('/references/documents/disable')}}/{{$doct->doc_id}}">Disable</a></li>
										@else
										<li><a href="{{ url('/references/documents/enable')}}/{{$doct->doc_id}}">Enable</a></li>
										@endif
									</ul>
								</div>
							</td>
							<td> {{$doct->doc_desc}}</td>
							<td> @foreach ($doct->office as $key => $off)
								
								{{$key+1}}. {{$off}}<br>
								
							@endforeach</td>
							@if($doct->is_active==1)
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
</div>


@endsection

@section('scripts')

@endsection

