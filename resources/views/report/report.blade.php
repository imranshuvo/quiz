@if(isset($user_stat))
    @foreach($user_stat as $user_s)
        {{ $user_s->percentage }}
    @endforeach
@endif
@if(isset($skill_stat))
    @foreach($skill_stat as $key => $value)
        {{ $key }} : {{ $value }}
    @endforeach
@endif
