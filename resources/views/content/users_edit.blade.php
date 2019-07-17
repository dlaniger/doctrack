@extends('index')
@section('content')
<div class="row">
	<div class="span12">
		<div id="target-1" class="widget">
			<div class="widget-header">
				<h2>&nbsp;&nbsp;<strong>EDIT USER</strong></h2>
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
				
				<div class="tab-pane" id="formcontrols" >
					 {{ Form::open(array('url' => 'users/saveedit', 'method' => 'post', 'class'=>'form-horizontal form-label-left')) }}
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
										<label class="control-label" for="usertype_id">User Type</label>
										<div class="controls">
											{{$user->usertype_desc}}
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="control-group"   id='forassocusers'>											
										<label class="control-label" for="usertype_id">Associate Office</label>
										<div class="controls">
											{{$user->assoc_of_desc}}
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="control-group"   id='forinstusers'>											
										<label class="control-label" for="usertype_id">Institute</label>
										<div class="controls">
											{{$user->institute_name}}
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->


									<div class="control-group">											
										<label class="control-label" for="name">User FullName</label>
										<div class="controls">
											<input type="text" class="span4" required name="name" id="name" value="{{$user->name}}">
											<input type="hidden" class="span4" required name="id" id="id" value="{{$user->id}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->

									<div class="control-group">											
										<label class="control-label" for="email">Email</label>
										<div class="controls">
											<input type="email" class="span4" required name="email" id="email" value="{{$user->email}}">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->


									<div class="control-group">											
										<label class="control-label" for="password">Assign New Password</label>
										<div class="controls">
											<input type="text" class="span4" required name="password" id="password" value="">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->


									<br />




									<br />


									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save User</button> 
										<a href="{{ url('/users')}}" class="btn">Back</a>
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
			
			$( "#usertype_id" ).change(function() {
				var utype = $('#usertype_id').val();
				if (utype == 3)
				{
					$("#forinstusers").css("display", "block");
					$("#forassocusers").css("display", "none");
				}
				else if(utype == 4)
				{
					$("#forinstusers").css("display", "none");
					$("#forassocusers").css("display", "block");
				}
				else
				{
					$("#forinstusers").css("display", "none");
					$("#forassocusers").css("display", "none");
				}
			});



		</script>
		@endsection

		@endsection



