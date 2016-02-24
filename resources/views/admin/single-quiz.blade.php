@extends('layouts.admin')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $quiz_name }}</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Show the single quiz questions here and let admin to add new questions into it -->

                    @if(isset($question_ids))
                        <ol class="list-group" type="1">
                            @foreach($question_ids as $question_id)
                                <li class="list-group-item"><span>{{ $question_id->id}}</span>. {{ \App::make('App\Http\Controllers\AdminController')->getQuizQuestion($question_id->id)->question_name }}</li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
