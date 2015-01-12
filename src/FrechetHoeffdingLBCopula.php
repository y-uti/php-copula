<?php
namespace YUti\Copula;

class FrechetHoeffdingLBCopula implements Copula
{
    public function __invoke($u, $v)
    {
        return max($u + $v - 1, 0);
    }
}
