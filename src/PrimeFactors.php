<?php

namespace App;

class PrimeFactors
{
	public function generate($number)
	{
		$factors = [];
		//1. Is the $number divisible by 2.
		//2. If true divide by 2.
		//3. If false increase the candidate and try again.
		//4. repeat.
		for ($divisor = 2; $number > 1; $divisor++) {
			for (; $number % $divisor == 0; $number = $number / $divisor) {

				$factors[] = $divisor;
			}
		}

		return $factors;
	}
}