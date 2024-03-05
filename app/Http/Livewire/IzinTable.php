<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use App\Models\Izin;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IzinTable extends LivewireTableComponent
{
    protected $model = Izin::class;

    public bool $showButtonOnHeader = false;

    public string $buttonComponent = '';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('izins.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make('Nama', 'pegawai.name')
                ->view('izin.templates.nama')
                ->searchable()
                ->sortable(),
            Column::make('NIP', 'pegawai.nip')
                ->view('izin.templates.nip')
                ->sortable(),
            Column::make('Alasan', 'alasan')
                ->view('izin.templates.alasan')
                ->sortable(),
            Column::make('Keterangan', 'keterangan')
                ->view('izin.templates.keterangan')
                ->sortable(),
            Column::make('Tanggal', 'created_at')
                ->view('izin.templates.created_at')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        /** @var Pegawai $query */
        return Izin::with('pegawai')->select('izins.*');
    }
}
