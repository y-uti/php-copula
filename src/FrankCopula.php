<?php
namespace YUti\Copula;

class FrankCopula implements Copula
{
    private $theta;

    public function __construct($theta)
    {
        $this->theta = $theta;
    }

    public function getTheta()
    {
        return $this->theta;
    }

    public function __invoke($u, $v)
    {
        $mt = -1 * $this->theta;
        $uc = exp($mt * $u) - 1;
        $vc = exp($mt * $v) - 1;

        return log(1 + $uc * $vc / (exp($mt) - 1)) / $mt;
    }
}
