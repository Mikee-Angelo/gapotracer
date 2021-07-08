<?php

namespace App\DataTables;

use App\Models\LogsEstablishment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class LogsEstablishmentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'logs_establishments.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LogsEstablishment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LogsEstablishment $model)
    {
        return $model->newQuery()->with(['civilian', 'host']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'user' => new \Yajra\DataTables\Html\Column([
                'name' => 'civilian.full_name',
                'data' => 'civilian.full_name',
                'title' =>  'Civilian Name'
            ]),  
           'host' => new \Yajra\DataTables\Html\Column([
                'name' => 'host.full_name',
                'data' => 'host.name',
                'title' =>  'Host Name'
            ]), 
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'logs_establishments_datatable_' . time();
    }
}
