<?php
namespace YUti\Copula;

class ContourPlotWriter implements Writer
{
    public function __construct()
    {
        \JpGraph\JpGraph::load();
        \JpGraph\JpGraph::module('contour');
    }

    public function write(array $data, $filename = false)
    {
        $graph = new \Graph(800,800);
        $graph->SetScale('intint');
        $graph->SetAxisStyle(AXSTYLE_BOXOUT);
        $graph->SetMargin(20,20,20,20);
        $cp = new \ContourPlot($data);
        $graph->Add($cp);

        if ($filename !== false) {
            $graph->Stroke($filename);
        } else {
            $graph->Stroke();
        }
    }
}
