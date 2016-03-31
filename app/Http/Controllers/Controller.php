<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getBegin(Request $Request) {
    	return view('welcome');
    }

	public function refreshMulti(Request $request, \App\Classes\Multiplications $multi) {
		$multi->refresh();

		$request->session()->put('multi', $multi);
		$request->session()->put('multiId', 0);
		$request->session()->put('isCorrect', true);

		return redirect()->action('Controller@getMulti');
	}

    public function getMulti(Request $request) {
    	$multi = $request->session()->get('multi');
    	$multiId = $request->session()->get('multiId');

    	return view('exercise', [
    		'multi' => $multi->getMulti($multiId),
    		'isCorrect' => $request->session()->get('isCorrect')
    	]);
	}

	public function postMulti(Request $request) {
    	$multi = $request->session()->get('multi');
    	$multiId = $request->session()->get('multiId');
    	$answer = (int) $request->input('answer', 0);
    	$response = $multi->answer($multiId, $answer);

    	if ($response == "true") {
    		$multiId += 1;
    		$request->session()->put('multiId', $multiId);
    		$request->session()->put('isCorrect', "true");
    	} elseif ($response == "false") {
    		$request->session()->put('isCorrect', "false");
    	} elseif ($response == "stillFalse") {
    		$multiId += 1;
    		$request->session()->put('multiId', $multiId);
    		$request->session()->put('isCorrect', "stillFalse");

    	}

    	if ($multi->isEnd($multiId)) {
    		return redirect()->action('Controller@getScore');
    	}

    	return redirect()->action('Controller@getMulti');
	}

	public function getScore(Request $request) {
		$multi = $request->session()->get('multi');

    	return view('score', [
    		'multis' => $multi->getMultis(),
    		'answers' => $multi->getAnswers(),
    		'score' => $multi->getScore()
    	]);
	}
}
