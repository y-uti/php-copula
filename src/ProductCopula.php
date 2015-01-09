<?php
namespace YUti\Copula;

class ProductCopula implements Copula
{
    public function __invoke($u, $v)
    {
        return $u * $v;
    }
}
