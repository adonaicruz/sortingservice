<?php

require_once(dirname(__FILE__).'/../lib/SortingService.php');

class UnitTest extends PHPUnit_Framework_TestCase {

	public function UnitTest() {
		$this->json_data = file_get_contents("../example/test.json");
		
    }

    public function testTitleAscending(){
    	$ss = new SortingService($this->json_data);
    	$ss->sort(array(1=>'asc'));
    	$this->assertEquals(Array ( "Book 3","Book 4","Book 1","Book 2"), $ss->getId());
    }
    public function testAuthorAscTitleDesc(){
    	$ss = new SortingService($this->json_data);
    	$ss->sort(array(2=>'asc',1=>'desc'));
    	$this->assertEquals(Array ("Book 1","Book 4","Book 3","Book 2"), $ss->getId());
    }
    public function testEditionDescAuthorDescTitleAsc(){
    	$ss = new SortingService($this->json_data);
    	$ss->sort(array(3=>'desc',2=>'desc',1=>'asc'));
    	$this->assertEquals(Array ("Book 4","Book 1","Book 3","Book 2"), $ss->getId());
    }
    public function testNullData(){
    	
    	try {
            $ss = new SortingService($this->json_data);
    		$ss->sort(null);
        }
        catch (Exception $expected) {
            return;
        }

        $this->fail('Uma exceção esperada para o valor null.');

    }
    public function testEmpty(){
    	$ss = new SortingService($this->json_data);
    	$data = $ss->sort("");
    	$this->assertEquals(is_array($data), true);
   	}
}