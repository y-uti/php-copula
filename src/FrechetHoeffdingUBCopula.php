<?php
namespace YUti\Copula;

class FrechetHoeffdingUBCopula implements Copula
{
    public function __invoke($u, $v)
    {
        return min($u, $v);
    }
}
