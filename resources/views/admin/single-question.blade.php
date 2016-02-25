@extends('layouts.admin')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $question->question_name }}</div>
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

                    <!-- Show the single quiz questions here and let admin to add new questions into it -->
                    @if($is_answered == false)
                        <div class="row add-answer-form">
                            <div class="col-md-12">
                                <form class="" action="{{ url('admin/question/answer/new') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                    @foreach($question->options as $option)
                                        <div class="form-group">
                                            <input type="checkbox" class="" name="option[]" value="{{ $option->id }}"> {{ $option->option }}
                                        </div>
                                    @endforeach
                                    <div class="form-group">
                                        <button type="submit" name="button" class="btn btn-default">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    @foreach($question->options as $option)
                                        <li>{{ $option->option }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
