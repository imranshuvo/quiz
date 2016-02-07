@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Your result </div>

                <div class="panel-body">
                    <ul class="list-group text-center">
                          @if(isset($message))
                          <li class="list-group-item">{{$message}}</li>
                          @endif
                          @if(isset($correct_answer))
                          <li class="list-group-item">Correct Answer: <span class="text-success">{{ count($correct_answer) }}</span></li>
                          @endif
                          @if(isset($wrong_answer))
                          <li class="list-group-item">Wrong Answer: <span class="text-danger">{{ count($wrong_answer) }}</span></li>
                          @endif
                          @if(isset($percentage))
                          <li class="list-group-item">Success Percentage: <span class="text-info">{{$percentage}}%</span></li>
                          @endif
                    </ul>

                    @if(isset($wrong_answer))
                        <h2 class="alert alert-danger">Wrong Answers</h2>
                        @foreach($wrong_answer as $key => $value )
                            <h4>{{ \App::make('App\Http\Controllers\QuizController')->getQuestion($key) }}</</h4>
                            <ul class="faq">
                                <?php $options =  \App::make('App\Http\Controllers\QuizController')->getOptions($key);?>
                                <?php $correct_single_answer = \App::make('App\Http\Controllers\QuizController')->getSingleCorrectAnswer($key);?>
                                @foreach($options as $option)
                                    @if($option->id === $value)
                                    <li class="text-danger">{{ $option->option }}</li>
                                    @else
                                    <li>{{ $option->option }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endforeach
                    @endif

                    @if(isset($correct_answer))
                        <h2 class="alert alert-info">Correct Answers</h2>
                        @foreach($correct_answer as $key => $value )
                            <h4>{{ \App::make('App\Http\Controllers\QuizController')->getQuestion($key) }}</</h4>
                            <ul class="faq">
                                <?php $options =  \App::make('App\Http\Controllers\QuizController')->getOptions($key);?>
                                @foreach($options as $option)
                                    <li>{{ $option->option }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    @endif




                    <!-- @if(isset($results))
                        {{--*/ $i = 1 /*--}}
                        @foreach($results as $result)
                            <h4>{{$i}}. {{ \App::make('App\Http\Controllers\QuizController')->getSingleQuestion($result->question_id)->name }}</h4>
                            <ul class="faq">
                                <li>{{ \App::make('App\Http\Controllers\QuizController')->getSingleQuestion($result->question_id)->choice1 }}</li>
                                <li>{{ \App::make('App\Http\Controllers\QuizController')->getSingleQuestion($result->question_id)->choice2 }}</li>
                                <li>{{ \App::make('App\Http\Controllers\QuizController')->getSingleQuestion($result->question_id)->choice3 }}</li>
                                <li>{{ \App::make('App\Http\Controllers\QuizController')->getSingleQuestion($result->question_id)->choice4 }}</li>
                            </ul>
                            <dl class="dl-horizontal">
                                @if($result->user_answer === $result->correct_answer)
                                    <dt>Your Answer: </dt>
                                    <dd class="text-success">{{ $result->user_answer }}</dd>
                                @else
                                    <dt>Your Answer: </dt>
                                    <dd class="text-danger">{{ $result->user_answer }}</dd>
                                @endif
                                <dt>Correct Answer: </dt>
                                <dd class="text-info">{{ $result->correct_answer }}</dd>
                            </dl>
                            {{--*/ $i++ /*--}}
                        @endforeach
                    @else
                    <h4 class="text-warning text-center">Please go back to select a <a href="{{ url('/') }}"> quiz </a></h4>
                    @endif -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
