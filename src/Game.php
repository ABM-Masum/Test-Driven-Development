<?php

namespace App;

class Game
{
	/**
	 * The number of frames in a game.
	 */
	const FRAMES_PER_GAME = 10;

	/**
	 * All rolls for the game.
	 * @var array
	 */
	protected $rolls = [];

	/**
	 * Roll the game.
	 * @param  int    $pins 
	 * @return void
	 */
	public function roll(int $pins)
	{
		$this->rolls[] = $pins;
	}

	/**
	 * Calculate the final score.
	 * @return int
	 */
	public function score()
	{
		$score = 0;
		$roll = 0;

		foreach (range(1, self::FRAMES_PER_GAME) as $frame) {

			if ($this->isStrike($roll)) {
				$score += $this->pinCount($roll) + $this->isStrikeBonus($roll);

				$roll += 1;

				continue;
			}

			$score += $this->defaultFrameScore($roll);

			if ($this->isSpare($roll)) {
				$score += $this->isSpareBonus($roll);
			}

			$roll += 2;
		}
		return $score;
	}

	/**
	 * Ditermine if the current roll was a strike.
	 * @param  int     $roll 
	 * @return boolean       
	 */
	protected function isStrike(int $roll)
	{
		return $this->pinCount($roll) == 10;
	}

	/**
	 * Ditermine if the current frame was a spare.
	 * @param  int     $roll
	 * @return boolean      
	 */
	protected function isSpare(int $roll)
	{
		return $this->defaultFrameScore($roll) == 10;
	}

	/**
	 * Calculate the score for a frame.
	 * @param  int    $roll
	 * @return int      
	 */
	protected function defaultFrameScore(int $roll)
	{
		return $this->pinCount($roll) + $this->pinCount($roll + 1);
	}

	/**
	 * Get the bonus for strike.
	 * @param  int     $roll 
	 * @return int       
	 */
	protected function isStrikeBonus(int $roll)
	{
		return $this->pinCount($roll + 1) + $this->pinCount($roll + 2);
	}

	/**
	 * Get the bonus for spare.
	 * @param  int     $roll
	 * @return boolean      
	 */
	protected function isSpareBonus(int $roll)
	{
		return $this->pinCount($roll + 2);
	}

	/**
	 * Count pins for the given roll.
	 * @param  int    $roll 
	 * @return int       
	 */
	protected function pinCount(int $roll)
	{
		return $this->rolls[$roll];
	}
}