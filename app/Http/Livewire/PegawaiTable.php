<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PegawaiTable extends LivewireTableComponent
{
    protected $model = Pegawai::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'pegawai.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('pegawais.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('selling_price') || $column->isField('buying_price')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make('Nama', 'name')
                ->view('pegawai.templates.nama')
                ->searchable()
                ->sortable(),
            Column::make('NIP', 'nip')
                ->sortable(),
            Column::make('Email', 'email')
                ->view('pegawai.templates.email')
                ->sortable(),
            Column::make('Jenis Kelamin', 'gender')
                ->view('pegawai.templates.jenis_kelamin')
                ->sortable(),
            Column::make('Phone', 'phone')
                ->view('pegawai.templates.phone')
                ->sortable(),
            Column::make('Divisi', 'divisi')
                ->view('pegawai.templates.divisi')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('pegawai.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var Pegawai $query */
        return Pegawai::select('pegawais.*');
    }
}
