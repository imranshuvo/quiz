@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->name }}'s profile page</div>

                <div class="panel-body">
                    <div class="row col-md-12">
                        <h4>General Information : </h4>
                        <dl class="dl-horizontal">
    						<div class="single-dl">
    							<dt>Name</dt>
    							<dd>{{ $user->name }}</dd>
    						</div>
    						<div class="single-dl">
    							<dt>Email</dt>
    							<dd>{{ $user->email }}</dd>
    						</div>
    						<div class="single-dl">
    							<dt>Address</dt>
    							<dd>{{ $user->address }}</dd>
    						</div>
    						<div class="single-dl">
    							<dt>Phone</dt>
    							<dd>{{ $user->phone_number }}</dd>
    						</div>
    					</dl>
                    </div>
                    <div class="row col-md-12">
                        <h4>Today's Score is : </h4>
                        @if(count($user_stats) > 0)
                            <dl class="dl-horizontal">
                                @foreach($user_stats as $user_stat)
                                    @if(date('Ymd') === date('Ymd', strtotime($user_stat->added_on)))
                                        <dt>Quiz {{$user_stat->quiz_id}}</dt>
                                        <dd>{{$user_stat->correct_answers}}/{{ $user_stat->total_attempt }}</dd>
                                    @endif
                                @endforeach
                            </dl>
                        @endif
                    </div>

                    <div class="row col-md-12">
                        <h4>Previous Scores :</h4>
                        @if(count($user_stats) > 0)
                            <dl class="dl-horizontal">
                                @foreach($user_stats as $user_stat)
                                    @if(date('Ymd') !== date('Ymd', strtotime($user_stat->added_on)))
                                        <dt>Quiz {{$user_stat->quiz_id}}</dt>
                                        <dd>{{$user_stat->correct_answers}}/{{ \App::make('App\Http\Controllers\QuizController')->getQuestionNumber($user_stat->quiz_id) }}</dd>
                                    @endif
                                @endforeach
                            </dl>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
