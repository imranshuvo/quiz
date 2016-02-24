@extends('layouts.admin')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Quiz</div>
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

                    @if(count($quizes) > 0)
                        <ol class="list-group">
                            @foreach($quizes as $quiz)
                                <li class="list-group-item"><a href="{{ url('admin/quiz/')}}/{{$quiz->id}}">{{ $quiz->quiz_name }}</a></li>
                            @endforeach
                        </ol>

                    @endif


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
