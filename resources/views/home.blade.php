@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body text-center">
					@if(isset($quizes) && count($quizes) > 0)
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<ul class="list-group">
							  @foreach($quizes as $quiz)
							  	  <li class="list-group-item"><a class="quiz-set-select" href="{{url('quiz')}}/{{$quiz->id}}">{{ $quiz->quiz_name }}</a>
							  @endforeach
						  </ul>
						</div>
						<div class="col-md-3"></div>
					@else
						<h3 class="alert alert-info">No quiz found!</h3>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
