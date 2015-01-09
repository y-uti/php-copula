<?php
namespace YUti\Copula;

interface Distribution
{
    public function __invoke($x);
}
