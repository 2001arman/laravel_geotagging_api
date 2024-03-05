<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Izin;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CutiTable extends LivewireTableComponent
{
    protected $model = Cuti::class;

    public bool $showButtonOnHeader = false;

    public string $buttonComponent = '';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('cutis.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make('Nama', 'pegawai.name')
                ->view('cuti.templates.nama')
                ->searchable()
                ->sortable(),
            Column::make('NIP', 'pegawai.nip')
                ->view('cuti.templates.nip')
                ->sortable(),
            Column::make('Keterangan', 'keterangan')
                ->view('cuti.templates.keterangan')
                ->sortable(),
            Column::make('Dari Tanggal', 'dari')
                ->view('cuti.templates.dari')
                ->sortable(),
            Column::make('Sampai Tanggal', 'sampai')
                ->view('cuti.templates.sampai')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        /** @var Pegawai $query */
        return Cuti::with('pegawai')->select('cutis.*');
    }
}
