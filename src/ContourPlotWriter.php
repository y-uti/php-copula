<?php
namespace YUti\Copula;

\JpGraph\JpGraph::load();
\JpGraph\JpGraph::module('contour');

class ContourPlotWriter implements Writer
{
    private $size;
    private $margin;
    private $ticks;

    public function __construct($size = 500, $margin = 80, $ticks = 10)
    {
        $this->size = $size;
        $this->margin = $margin;
        $this->ticks = $ticks;
    }

    public function write(array $xs, array $ys, array $data, $filename = null)
    {
        $graph = $this->createGraph($xs, $ys);

        $plot = new \ContourPlot($data);
        $graph->Add($plot);

        if ($filename) {
            $graph->Stroke($filename);
        } else {
            $graph->Stroke();
        }
    }

    private function createGraph(array $xs, array $ys)
    {
        $graph = new \Graph($this->size, $this->size);
        $graph->SetMargin(
            $this->margin, $this->margin, $this->margin, $this->margin);
        $graph->SetAxisStyle(AXSTYLE_BOXOUT);

        $this->setScale($graph, $xs, $ys);
        $this->setAxis($graph->xaxis, $xs);
        $this->setAxis($graph->yaxis, $ys);

        $graph->xgrid->Show();
        $graph->ygrid->Show();

        return $graph;
    }

    private function setScale(\Graph $graph, array $xs, array $ys)
    {
        list ($xmin, $xmax) = $this->getMinMax($xs);
        list ($ymin, $ymax) = $this->getMinMax($ys);

        $graph->SetScale('linlin', $ymin, $ymax, $xmin, $xmax);
    }
    
    private function setAxis(\Axis $axis, array $data)
    {
        $majorTickStep = intval(count($data) / $this->ticks);

        $axis->SetTickLabels($data);
        $axis->scale->ticks->Set($majorTickStep);
    }

    private function getMinMax($data)
    {
        $min = $data[0];
        $max = array_pop($data);

        return array($min, $max);
    }
}
