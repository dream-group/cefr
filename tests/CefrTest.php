<?php

use Dream\Cefr;

class CefrTest extends PHPUnit_Framework_TestCase
{
	
    public function testLevels()
    {
		
        $this->assertEquals([
			'A1','A2',
			'B1','B2',
			'C1','C2',
		], Cefr::getLevels());
		
        $this->assertEquals([
			'A1','A1+',
			'A2','A2+',
			'B1','B1+',
			'B2','B2+',
			'C1','C1+',
			'C2','C2+',
		], Cefr::getLevels(true));
		
    }
	
	public function testConversions()
    {
		
		foreach ([
			'A1','A1+',
			'A2','A2+',
			'B1','B1+',
			'B2','B2+',
			'C1','C1+',
			'C2','C2+',
		] as $cefr) {
			$this->assertEquals($cefr, Cefr::fromNum(Cefr::toNum($cefr)));	
		}
		
    }
	
}