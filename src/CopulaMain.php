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

        $cdf = new JointDistributionByCopula($copula, $dist, $dist);
        $pdf = new JointDensity($cdf, $delta);

        $z = array_fill(0, count($xs), array_fill(0, count($xs), 0));
        foreach ($xs as $xi => $x) {
            foreach ($ys as $yi => $y) {
                $z[$xi][$yi] = $pdf($x, $y);
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
}
