<?php

namespace App\Livewire\Chart;

use App\Models\Pengajuan;
use Livewire\Component;
use App\Models\Kendaraan;
use App\Livewire\Chart\KegiatanChart;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class PermohonanChart extends Component
{
    public $startDate, $endDate;
    public function render()
    {

        // return view('livewire.chart.permohonan-chart', [
        //     'columnChartModel' => $columnChartModel,
        // ]);
    }
}
