<?php
	//Returns rating change for team 1
	//Rating change for team 2 is the negative return value
	
	//Result = 1 => Team 1 wins
	//Result = 0 => Team 2 wins
	//Result = 0.5 => Tie
	function get_rating_change($team_1_rating, $team_2_rating, $result)
	{
		$k_factor = 100;
		$expected_result = get_expected_result($team_1_rating, $team_2_rating);
		return $k_factor*($result-$expected_result);
	}

	function get_expected_result($team_1_rating, $team_2_rating) {
		$expected_result_table = [ 
				4, 11,  18,  26,  33,  40,  47,  54,  62, 69,
			 77, 84,  92,  99, 107, 114, 122, 130, 138, 146,
			154, 163, 171, 180, 189, 198, 207, 216, 226, 236,
			246, 257, 268, 279, 291, 303, 316, 329, 345, 358,
			375, 392, 412, 433, 457, 485, 518, 560, 620];

		$higher_rated;
		$rating_difference;
		
		if($team_1_rating > $team_2_rating) {
			$higher_rated = true;
			$rating_difference = $team_1_rating - $team_2_rating;
		}
		else
		{
			$higher_rated = false;
			$rating_difference = $team_2_rating - $team_1_rating;
		}
		
		for ($i = 0; $i <= 49; $i++) {
			if($expected_result_table[$i] > $rating_difference)
			{
				if($higher_rated)
				{
					return 0.50 + 0.01 * $i;
				}
				else
				{
					return 0.50 - 0.01 * $i;
				}
			}
		}
		//code only gets here if the rating difference is 620 or higher
		if($higher_rated) {
			return 0.99;
		}
		else
		{
			return 0.01;
		}
	}
?>