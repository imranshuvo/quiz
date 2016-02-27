<!doctype html>
<html>
    <head></head>
    <body>
        <h3> User statistics </h3>
        <ul class="list-group">
            <li class="list-group-item">User Name : {{ $user->name }} </li>
            <li class="list-group-item">User Email: {{ $user->email }} </li>
        </ul>


        <table class="table table-striped">
            <tr>
                <th>Quiz</th>
                <th>Attempted</th>
                <th>Correct Answered</th>
                <th>Success percentage</th>
                <th>Date</th>
            </tr>
            @foreach($user_stat as $user_s)
                <tr>
                    <td>Quiz {{ $user_s->quiz_id }}</td>
                    <td>{{ $user_s->total_attempt }}</td>
                    <td> {{ $user_s->correct_answers}} </td>
                    <td> {{ $user_s->percentage }}</td>
                    <td> {{ $user_s->added_on }}</td>
                </tr>
            @endforeach
        </table>
	
	<ul class="list-group">
	   @foreach($skill_stat as $key => $value)
	      <li class="list-group-item">{{ $key }} : {{ $value }} @if($value < 40) <span style="color: red;">You should put more effort on your {{ $key }} skills </span>@elseif($value > 40) <span style="color:green">Your {{ $key }} skill is okay</span>@endif</li>
	   @endforeach
	</ul>
          
    </body>
</html>
