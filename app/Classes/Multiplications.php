<?php

namespace App\Classes;

class Multiplications {
	private $arr = [];
	private $answers = [];
	private $tryTimes = 0;
	private $score = 0;

	# Create 10 problems
	public function refresh() {
		$this->arr = [];
		$this->answers = [];
		$this->tryTimes = 0;
		$this->score = 0;

		for ($i = 0; $i < 10; $i++) {
			while (true) {
				#Unique random pair of integers
				$isUnique = true;

				$n1 = rand(1,9);
				$n2 = rand(1,9);

				foreach ($this->arr as $multi) {
					if ($n1 == $multi[0] && $n2 == $multi[1]) {
						$isUnique = false;
						break;
					}
				}

				if ($isUnique) {
					$this->arr[] = [$n1,$n2];
					break;
				}
			}
		}
	}

	public function getMultis() {
		if (count($this->arr) == 0) {
			$this->refresh();
		}

		return $this->arr;
	}

	public function getMulti($id) {
		if (count($this->arr) == 0) {
			$this->refresh();
		}

		return $this->arr[$id];
	}

	public function getAnswers() {
		return $this->answers;
	}

	public function getScore() {
		return $this->score;
	}

	public function answer($id, $answer) {
		// Compare user's answer with the product
		$multi = $this->arr[$id];

		// First Wrong Answer: tryTimes +1, return False
		// Second Wrong Answer: tryTimes = 0, return stillFalse
		if ($answer != $multi[0] * $multi[1]) {
			if ($this->tryTimes >= 1) {
				$this->tryTimes = 0;
				$this->answers[$id] = $answer;

				return "stillFalse";
			}

			$this->tryTimes += 1;
			return "false";
		}

		// Correct Answer: tryTimes = 0, return True
		else {
			$this->tryTimes = 0;
			$this->answers[$id] = $answer;
			$this->score += 1;

			return "true";
		}
	}

	// When the user has answered all problems
	public function isEnd($id) {
		return $id >= count($this->arr);
	}
}
