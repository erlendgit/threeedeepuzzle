<?php

namespace ThreeDeePuzzle\AfterFour;

/**
 * Like ladder, but switched black and white
 */
class LadderWhite extends Ladder {

	protected function coordinates() {

		$coordinates = parent::coordinates();

		foreach($coordinates as &$point) {
			if ($point->color == 'white') {
				$point->color = 'black';
			} else {
				$point->color = 'white';
			}
		}

		return $coordinates;
	}
}