<?php

namespace App\DataTables;

use App\Models\Civilian;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CivilianDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'civilians.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Civilian $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Civilian $model)
    {
        return $model->newQuery();
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
            ->addAction(['width' => '120px', 'printable' => false]) 
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => false,
                'order'     => [[7, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
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
        $status = ['Normal', 'Suspected', 'Negative', 'Positive', 'Recovered', 'Death'];
        
        return [
            'first_name',
            'last_name', 
            'phone',
            'age',
            'gender',
            'address',
            'status'=> new \Yajra\DataTables\Html\Column([
                'name' => 'status',
                'data' => 'status',
                'title' =>  'Status'
            ]), 
            'created_at'
        ];
    }


    protected function filename()
    {
        return 'civilians_datatable_' . time();
    }
}
