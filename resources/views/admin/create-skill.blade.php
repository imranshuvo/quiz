@extends('layouts.admin')


@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create a New Quiz</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-info">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<h3 class="alert alert-info">Check the skill list below first. If you don't find the required one then create one!</h3>

					<form class="form-horizontal" role="form" method="POST" action="{{ url('new-skill') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name of the Skill</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="skill_name" value="{{ old('name') }}">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>

					</form>

					<div class="row">
						<div class="col-md-12">
							@if(count($skills) > 0)
							<ul class="list-group">
								@foreach($skills as $skill)
									<li class="list-group-item">{{ $skill->title }}</li>
								@endforeach
							</ul>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
