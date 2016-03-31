@extends('template')

@section('content')
	@if ($isCorrect === "true")
	<h3>Your previous answer is correct! Please continue to the next problem.</h3>
	@endif

	@if ($isCorrect === "stillFalse")
	<h3> Your previous answer is still wrong. Please continue to the next question.</h3>
	@endif

	<h2>What is product of</h2>
	<h1>{{ $multi[0] }} * {{ $multi[1] }}</h1>

	<form action="{{ url('/exercise') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="number" name="answer" value="">
		<button type="submit" value="Submit">Submit</button>
	</form>

	@if ($isCorrect === "false")
	<h3> Wrong Answer. Please try once again! </h3>
	@endif

	<div id="Quit">
		<a href="./"><button type="button">Quit Exercise</button></a>
	</div>
@stop

