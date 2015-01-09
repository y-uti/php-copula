<?php
namespace YUti\Copula;

class UniformDistributionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMin()
    {
        $distribution = new UniformDistribution(0, 10);

        $actual = $distribution->getMin();
        $this->assertEquals(0, $actual);
    }

    public function testGetMax()
    {
        $distribution = new UniformDistribution(0, 10);

        $actual = $distribution->getMax();
        $this->assertEquals(10, $actual);
    }

    public function testInvoke_LessThanMin()
    {
        $distribution = new UniformDistribution(0, 10);

        $actual = $distribution(-1);
        $this->assertEquals(0, $actual);
    }

    public function testInvoke_BetweenMinAndMax()
    {
        $distribution = new UniformDistribution(0, 10);

        $actual = $distribution(3.5);
        $this->assertEquals(0.35, $actual);
    }

    public function testInvoke_GreaterThanMax()
    {
        $distribution = new UniformDistribution(0, 10);

        $actual = $distribution(12);
        $this->assertEquals(1, $actual);
    }

    public function testInvoke_ApplyToArray()
    {
        $distribution = new UniformDistribution(0, 10);

        $values = range(-1, 12);
        $expected = array_merge(array(0), range(0, 1, 0.1), array(1, 1));
        $actual = array_map($distribution, $values);
        $this->assertEquals($expected, $actual);
    }
}
