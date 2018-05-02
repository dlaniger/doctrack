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
				{{ Form::open(array('url' => 'admin/materials/store', 'method' => 'post', 'class'=>'form-horizontal')) }}
				<form id="edit-profile" class="form-horizontal">
					<fieldset>
						<div class="control-group">
							{{ Form::label('inst_desc', 'Name', array('class' => 'control-label')) }}									
							<div class="controls">
								<input type="text" class="span6" id="inst_desc" name="inst_desc" value="">
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
		


		<div class="widget widget-table action-table">
			<div class="widget-header"><i class="icon-book"></i>
				<h3> Associate Offices</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th> Free Resource </th>
							<th> Download</th>
							<th class="td-actions"> </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td> Fresh Web Development Resources </td>
							<td> http://www.egrappler.com/ </td>
							<td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"> </i></a><a href="javascript:;" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
						</tr>
						<tr>
							<td> Fresh Web Development Resources </td>
							<td> http://www.egrappler.com/ </td>
							<td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"> </i></a><a href="javascript:;" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
						</tr>
						<tr>
							<td> Fresh Web Development Resources </td>
							<td> http://www.egrappler.com/ </td>
							<td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"> </i></a><a href="javascript:;" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
						</tr>
						<tr>
							<td> Fresh Web Development Resources </td>
							<td> http://www.egrappler.com/ </td>
							<td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"> </i></a><a href="javascript:;" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
						</tr>
						<tr>
							<td> Fresh Web Development Resources </td>
							<td> http://www.egrappler.com/ </td>
							<td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"> </i></a><a href="javascript:;" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
						</tr>

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

