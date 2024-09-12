<?php

namespace App\Livewire\Chart;

use App\Models\Uttp;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class UttpChart extends Component
{
    public $startDate, $endDate;

    public function render()
    {

        $jingan = Uttp::withCount([

            'pengajuan' => function ($a) {

                $a->whereHas('pengajuannya', function ($a) {
                    $a->where('pengajuan_st', 'PENGAJUAN_ST_04');
                });
                if ($this->startDate && $this->endDate) {
                    $this->dispatch('jmbt', start: $this->startDate, end: $this->endDate)->to(UttpChart::class);
                    $a->whereBetween('created_at', [$this->startDate, $this->endDate . ' 23:59:59']);
                }
            }
        ])->get();


        // dd($jingan);
        $columnChartModel = $jingan
            ->reduce(
                function ($columnChartModel, $data) {
                    $type = $data->nama;
                    $value = $data->pengajuan_count;


                    return $columnChartModel->addColumn($type, $value, '#017bfe');
                },
                LivewireCharts::columnChartModel()
                    ->setTitle('Jumlah Permohonan')
                    ->setAnimated(true)
                    ->withOnColumnClickEventName('onColumnClick')
                    ->setLegendVisibility(false)
                    ->setDataLabelsEnabled(true)
                    //->setOpacity(0.25)
                    // ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                    ->setColumnWidth(90)
                    ->withGrid()
            );


        return view('livewire.chart.uttp-chart', [
            'columnChartModel' => $columnChartModel,
        ]);
    }
}
