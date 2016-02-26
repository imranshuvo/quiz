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
                          <li class="list-group-item text-warning">{{$message}}</li>
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
                    <ul class="list-group text-center">
                        @if(isset($chart) && count($chart) > 0)
                            <h3>Skill statistics (Based on your correct answer)</h3>
                            @foreach($chart as $key => $value)
                                <li class="list-group-item">{{ $key }} : {{ $value }}% @if($value < 40) <span class="text-danger">You need to work on your on your {{ $key }} skills</span>@elseif($value > 40) <span class="text-info">Your {{ $key }} skill is okay!</span>@endif</li>
                            @endforeach
                        @endif
                    </ul>
                    @if(isset($wrong_answer) || isset($correct_answer))
                    <!-- Start of showing the wrong answers with the correct answers -->
                    @if(isset($wrong_answer))
                        <h2 class="alert alert-danger">Wrong Answers</h2>
                        @foreach($wrong_answer as $key => $value )
                            <h4>{{ \App::make('App\Http\Controllers\QuizController')->getQuestion($key) }}</</h4>
                            <ul class="faq">
                                <?php $options =  \App::make('App\Http\Controllers\QuizController')->getOptions($key);?>
                                <?php $wrong_single_answers = \App::make('App\Http\Controllers\QuizController')->getSingleCorrectAnswer($key);?>
                                @foreach($options as $option)
                                    @if(!is_array($value))
                                        @if($option->id === $value )
                                            <li class="text-danger">{{ $option->option }}</li>
                                        @else
                                            <li>{{ $option->option }}</li>
                                        @endif
                                    @else
                                        <!-- For multiple values -->
                                        @if(in_array($option->id,$value))
                                            <li class="text-danger"> {{ $option->option }} </li>
                                        @else
                                            <li>{{ $option->option }}</li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                            <dl class="dl-horizontal">
                                <dt>Correct Answers</dt>
                                @if(count($wrong_single_answers) === 1)
                                <dd class="text-success">{{ \App::make('App\Http\Controllers\QuizController')->getAnswer($wrong_single_answers[0]->option_id)->option }}</dd>
                                @else
                                    @foreach($wrong_single_answers as $answers)
                                        <dd class="text-success">{{ \App::make('App\Http\Controllers\QuizController')->getAnswer($answers->option_id)->option }}</dd>
                                    @endforeach
                                @endif
                            </dl>
                        @endforeach
                    @endif
                    <!-- End of showing the wrong answers -->


                    <!-- Showing the correct answers -->
                    @if(isset($correct_answer))
                        <h2 class="alert alert-info">Correct Answers</h2>
                        @foreach($correct_answer as $key => $value )
                            <h4>{{ \App::make('App\Http\Controllers\QuizController')->getQuestion($key) }}</</h4>
                            <ul class="faq">
                                <?php $options =  \App::make('App\Http\Controllers\QuizController')->getOptions($key);?>
                                @foreach($options as $option)
                                @if(!is_array($value))
                                    @if($option->id === $value )
                                        <li class="text-success">{{ $option->option }}</li>
                                    @else
                                        <li>{{ $option->option }}</li>
                                    @endif
                                    @else
                                        <!-- For multiple values -->
                                        @if(in_array($option->id,$value))
                                            <li class="text-success"> {{ $option->option }} </li>
                                        @else
                                            <li>{{ $option->option }}</li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        @endforeach
                    @endif
                    <!-- End of showing the correct answers -->
                @else
                    <h4 class="text-center">Please go back to select a <a href="{{ url('/') }}"> quiz </a></h4>
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
