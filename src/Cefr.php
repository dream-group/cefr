<?php

/**
 * CEFR (Common European Framework of Reference for Languages) operations.
 * 
 * This is useful for duing calculations with CEFR values, e.g get an average
 * of B1 and C2. To do that, one would first convert the CEFR values to their
 * numeric counterparts, do the arithmetic and then convert back to CEFR.
 * 
 * @author Lauri Elevant <lauri.elevant@dreamgroup.info>
 */


namespace Dream;

use InvalidArgumentException;

class Cefr {

	/**
	 * Return a list of all possbile CEFR levels
	 *
	 * @param bool $extended Also return half-values
	 * @return array 
	 */
	
	public static function getLevels($extended = false) {

		$levels = [
			'A1','A2',
			'B1','B2',
			'C1','C2',
		];

		if ($extended) {

			$temp = [];

			foreach ($levels as $level) {
				$temp[] = $level;
				$temp[] = $level . '+';
			}
			
			$levels = $temp;

		}

		return $levels;

	}
	
	
	/**
	 * Determine if the supplied string represents a valid
	 * CEFR level name.
	 * 
	 * @param type $test		The CEFR level to validate
	 * @param type $extended	Also consider half-values
	 * @return bool
	 */

	public static function isLevel($test, $extended = true) {

		$levels = self::getLevels($extended);
		
		return in_array($test, $levels);

	}

	
	/**
	 * Convert the CEFR name to a numeric counterpart, starting with
	 * A1 = 1 ... C2 = 6. Half-values (e.g. B2+) add an additional 0.5
	 * 
	 * @param string $cefr
	 * @return float 
	 * @throws InvalidArgumentException
	 */
	
	public static function toNum($cefr) {

		switch ($cefr) {

			case 'A1':	return 1;
			case 'A1+':	return 1.5;
			case 'A2':	return 2;
			case 'A2+':	return 2.5;
			case 'B1':	return 3;
			case 'B1+':	return 3.5;
			case 'B2':	return 4;
			case 'B2+':	return 4.5;
			case 'C1':	return 5;
			case 'C1+':	return 5.5;
			case 'C2':	return 6;
			case 'C2+':	return 6.5;

			default:
				throw new InvalidArgumentException('Illegal CEFR');

		}

	}
	
	
	/**
	 * Convert the numeric value back to CEFR, applying the normal round-5-up
	 * rounding algorithm.
	 *
	 * @param float $num A numeric value returned originally by Cefr::toNum()
	 * @return string The CEFR value 
	 * @throws InvalidArgumentException
	 */
	
	public static function fromNum($num) {

		$num = round($num * 2) / 2;

		switch ($num) {

			case 1:		return 'A1';
			case 1.5:	return 'A1+';
			case 2:		return 'A2';
			case 2.5:	return 'A2+';
			case 3:		return 'B1';
			case 3.5:	return 'B1+';
			case 4:		return 'B2';
			case 4.5:	return 'B2+';
			case 5:		return 'C1';
			case 5.5:	return 'C1+';
			case 6:		return 'C2';
			case 6.5:	return 'C2+';

			default:
				throw new InvalidArgumentException('Illegal CEFR-num');

		}

	}

	/**
	 * Get the name of a CEFR value.
	 * 
	 * @param type $cefr
	 * @return string
	 * @throws InvalidArgumentException
	 */
	public static function toName($cefr) {
		
		$cefr = substr($cefr, 0, 2);
		
		switch ($cefr) {

			case 'A1': return 'Basic Speaker / Breakthrough or beginner';
			case 'A2': return 'Basic Speaker / Waystage or elementary';
			case 'B1': return 'Independent Speaker / Threshold or pre-intermediate';
			case 'B2': return 'Independent Speaker / Vantage or intermediate';
			case 'C1': return 'Proficient Speaker / Effective Operational Proficiency or upper intermediate';
			case 'C2': return 'Proficient Speaker / Mastery or advanced';
			
			default:
				throw new InvalidArgumentException('Illegal CEFR');
				
		}
	}
	
}