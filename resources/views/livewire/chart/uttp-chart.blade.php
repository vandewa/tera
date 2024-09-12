<div>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div>
                    <label for="start_date">Dari:</label>
                    <input type="date" id="start_date" wire:model.live="startDate" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <label for="end_date">Sampai:</label>
                    <input type="date" id="end_date" wire:model.live="endDate" class="form-control">
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="col-md-12" style="height: 55vh">
                    <livewire:livewire-column-chart key="{{ $columnChartModel->reactiveKey() }}" :column-chart-model="$columnChartModel" />
                </div>
            </div>
        </div>
    </div>
</div>
