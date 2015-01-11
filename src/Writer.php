<?php
namespace YUti\Copula;

interface Writer
{
    public function write(array $xs, array $ys, array $data, $filename = null);
}
