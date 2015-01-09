<?php
namespace YUti\Copula;

interface Copula
{
    public function __invoke($u, $v);
}
