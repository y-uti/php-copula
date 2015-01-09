<?php
namespace YUti\Copula;

class CopulaMain
{
    public function __construct()
    {
        \JpGraph\JpGraph::load();
        \JpGraph\JpGraph::module('contour');
    }

    public function __invoke(array $argv)
    {
        $xs = range(-3.0, 3.0, 0.02);
        $ys = range(-3.0, 3.0, 0.02);
        $delta = 0.001;

        $dist = new NormalDistribution();
        // $dist = new UniformDistribution(-2, 2);

        // $copula = new AliMikhallHaqCopula(0.95);
        $copula = new ClaytonCopula(1);
        // $copula = new FrankCopula(10);
        // $copula = new GumbelCopula(3);
        // $copula = new JoeCopula(10);
        // $copula = new PlackettCopula(10);
        // $copula = new ProductCopula();

        $cdfX = array_map($dist, $xs);
        $cdfY = array_map($dist, $ys);
        $cdfXDelta = array_map($dist, array_map($this->delta($delta), $xs));
        $cdfYDelta = array_map($dist, array_map($this->delta($delta), $ys));

        foreach ($cdfX as $xi => $x) {
            foreach ($cdfY as $yi => $y) {
                $z00[$xi][$yi] = $copula($x, $y);
            }
        }

        foreach ($cdfXDelta as $xi => $x) {
            foreach ($cdfY as $yi => $y) {
                $zx0[$xi][$yi] = $copula($x, $y);
            }
        }

        foreach ($cdfX as $xi => $x) {
            foreach ($cdfYDelta as $yi => $y) {
                $z0y[$xi][$yi] = $copula($x, $y);
            }
        }

        foreach ($cdfXDelta as $xi => $x) {
            foreach ($cdfYDelta as $yi => $y) {
                $zxy[$xi][$yi] = $copula($x, $y);
            }
        }

        foreach (range(0, count($xs) - 1) as $xi) {
            foreach (range(0, count($ys) - 1) as $yi) {
                $z[$xi][$yi] =
                    ($z00[$xi][$yi] + $zxy[$xi][$yi] - $zx0[$xi][$yi] - $z0y[$xi][$yi]) / ($delta * $delta);
            }
        }

        $graph = new \Graph(800,800);
        $graph->SetScale('intint');
        $graph->SetAxisStyle(AXSTYLE_BOXOUT);
        $graph->SetMargin(20,20,20,20);
        $cp = new \ContourPlot($z);
        $graph->Add($cp);
        $graph->Stroke();
    }

    private function delta($delta)
    {
        return function ($a) use ($delta) {
            return $a + $delta;
        };
    }
}
