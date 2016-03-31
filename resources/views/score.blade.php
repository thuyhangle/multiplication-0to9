@extends('template')
@section('content')
    <h2>You have completed the exercise!</h2>
    <h1>Your answers</h1>
		@for ($i = 0; $i < count($multis); $i++)
                    <p>{{ $multis[$i][0] }} * {{ $multis[$i][1] }} = {{ $answers[$i] }}</p>
        @endfor

    <h1>Total score: {{ $score }} / 10 points </h1>
    <div id="Quit">
		<a href="./"><button type="button">Quit</button></a>
	</div>
@stop
