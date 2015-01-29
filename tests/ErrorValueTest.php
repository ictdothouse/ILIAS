<?php

require_once("formlets/values.php");

trait ErrorValueTestTrait {
    /** 
     * One can't get a value out.
     * @dataProvider error_values 
     * @expectedException GetError
     */
    public function testErrorHasNoValue(Value $value, $reason, $origin) { 
        $value->get();
    }

    /** 
     * An error value is applicable.
     * @dataProvider error_values 
     */
    public function testErrorIsApplicable(Value $value, $reason, $origin) { 
        $this->assertTrue($value->isApplicable());
    }

    /** 
     * One can apply an error value and gets an error back.
     * @dataProvider error_values 
     */
    public function testErrorAppliedIsError(Value $value, $reason, $origin) { 
        $this->assertTrue($value->apply(_val(1))->isError());
    }

    /** 
     * An error value is an error.
     * @dataProvider error_values 
     */
    public function testErrorIsError(Value $value, $reason, $origin) { 
        $this->assertTrue($value->isError());
    }

    /** 
     * One can get the reason out of the error value.
     * @dataProvider error_values 
     */
    public function testErrorHasMessage(Value $value, $reason, $origin) { 
        $this->assertEquals($value->error(), $reason);
    }

    /** 
     * An Error value tracks origin.
     * @dataProvider error_values 
     */
    public function testErrorOriginsAreCorrect(Value $value, $reason, $origin) { 
        $this->assertEquals($value->origin(), $origin ? $origin : null);
    }
}


class ErrorValueTest extends PHPUnit_Framework_TestCase {
    /**
     * One can get a dictionary out of an error that contains the error messages
     * from the error itself and all the other errors that led to it.
     */
    public function testErrorToDict() {
        $a = _error("a", "a");
        $b = _error("b", "b");
        $c = _error("c", "c");
        $x1 = _error("1","x");
        $x2 = _error("2", "x");
        $all = _error("all"
                     , "all"
                     , array($a, $b, $c, $x1, $x2)
                     );

        $dict = $all->toDict();

        $this->assertArrayHasKey("a", $dict);
        $this->assertArrayHasKey("b", $dict);
        $this->assertArrayHasKey("c", $dict);
        $this->assertArrayHasKey("x", $dict);
        $this->assertArrayHasKey("all", $dict);
        $this->assertCount(5, $dict);

        $this->assertEquals($dict["a"], array("a"));
        $this->assertEquals($dict["b"], array("b"));
        $this->assertEquals($dict["c"], array("c"));
        $this->assertEquals($dict["x"], array("1", "2"));
        $this->assertEquals($dict["all"], array("all"));
    } 
}

?>