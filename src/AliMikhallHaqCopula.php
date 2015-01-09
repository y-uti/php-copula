<?php
namespace YUti\Copula;

class AliMikhallHaqCopula implements Copula
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

        return $u * $v / (1 - $t * (1 - $u) * (1 - $v));
    }
}
