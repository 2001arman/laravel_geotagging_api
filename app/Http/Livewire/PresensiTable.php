<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PresensiTable extends LivewireTableComponent
{
    protected $model = Absensi::class;

    public bool $showButtonOnHeader = false;

    public string $buttonComponent = '';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('absensis.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make('Nama', 'pegawai.name')
                ->view('presensi.templates.nama')
                ->searchable()
                ->sortable(),
            Column::make('NIP', 'pegawai.nip')
                ->view('presensi.templates.nip')
                ->sortable(),
            Column::make('Waktu', 'created_at')
                ->view('presensi.templates.waktu')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        /** @var Pegawai $query */
        return Absensi::with('pegawai')->select('absensis.*');
    }
}
