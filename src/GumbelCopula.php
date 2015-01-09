<?php
namespace YUti\Copula;

class GumbelCopula implements Copula
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
        $t = $this->theta;
        $uc = pow(-log($u), $t);
        $vc = pow(-log($v), $t);

        return exp(-pow($uc + $vc, 1 / $t));
    }
}
