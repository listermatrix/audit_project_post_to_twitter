<?php

namespace App\DataTables;

use App\AuditTrail;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class AuditTrailDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action',function (){
                return '<a class="btn btn-primary btn-sm" href="">Edit</a>';
            })->addColumn('column B',function ($query){
                    return "CODELIKEICE IS MY NAME " .strtoupper($query->name);
            })->addColumn('email',function ($query){
                return $query->user->email;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AuditTrail $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AuditTrail $model)
    {
        $start_date = $this->request()->get('start_date');
        $end_date   = $this->request()->get('end_date');
        $name       = $this->request()->get('name');




        $query = $model->newQuery();
        if ( !empty($start_date)  &&   !empty($end_date))
        {
            $start_date  = Carbon::parse($start_date);

            $end_date = Carbon::parse($end_date);

            $query = $query->whereBetween('created_at',[$start_date,$end_date]);
        }

        if(!empty($name))
        {
            $query = $query->where('name',$name);
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('audittrail-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
//                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::make('email')->title('Email'),
            Column::make('date'),
            Column::make('activity'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AuditTrail_' . date('YmdHis');
    }
}
