<?php

namespace App\DataTables;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\SearchPane;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query)
    {
        $columns = array_column($this->getColumns(), 'data');

        return (new EloquentDataTable($query))
            ->editColumn('parent_id', function ($role) {
                return Str::of(getRoleParentByParentId($role->parent_id))->ucfirst();
            })
            ->editColumn('created_at', function ($role) {
                return editDateColumn($role->created_at);
            })
            // ->editColumn('updated_at', function ($role) {
            //     return editDateColumn($role->updated_at);
            // })
            ->editColumn('default', function ($role) {
                return editBooleanColumn($role->default);
            })
            ->editColumn('actions', function ($role) {
                return '
                <div class="d-flex justify-content-cetner align-items-center" onclick="roles_menu(' . $role->id . ')">
                    <div class="btn-group">
                        <button class="btn btn-flat-primary custom_dotted" type="button" id="dropdownMenuButton100"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>

                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                            <div id="loader_' . $role->id . '">
                            Loading...   <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                                <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="20px" height="20px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#000000"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(30 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(60 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(90 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#cecece" transform="rotate(120 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#b7b7b7" transform="rotate(150 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#9f9f9f" transform="rotate(180 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#898989" transform="rotate(210 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#727272" transform="rotate(240 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#5c5c5c" transform="rotate(270 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#444444" transform="rotate(300 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#2e2e2e" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>
                            </div>
                            <div id="dropDownMenu_' . $role->id . '">

                            </div>
                        </div>
                    </div>
                </div>
                ';
                // return view('app.roles.actions', ['id' => $role->id]);
            })
            ->editColumn('check', function ($role) {
                return $role;
            })
            ->setRowId('id')
            ->rawColumns(array_merge($columns, ['action', 'check']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\Role  $model
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery()->where('is_child', false);
    }

    public function html(): HtmlBuilder
    {
        $selectedDeletePermission = Auth::user()->hasPermissionTo('roles.destroy-selected');

        return $this->builder()
            ->setTableId('roles-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->scrollCollapse(true)
            ->scrollY('1000px')
            ->searchPanes(SearchPane::make())
            ->languageSearchPlaceholder('Search...')
            ->scrollCollapse(true)
            ->fixedColumns(true)
            ->fixedColumnsLeftColumns()
            // ->select()
            // ->selectClassName('bg-primary')
            ->serverSide()
            ->processing()
            ->dom('BlfrtipC')
            ->languageSearchPlaceholder('Search...')
            ->lengthMenu([10, 20, 30, 50, 70, 100])
            ->pageLength(50)
            ->dom('<"card-header custom_button_card pt-0 pe-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row custom_datatable_label"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')

                // Button::make('export')->addClass('dt-button buttons-collection btn btn-secondary dropdown-toggle')->buttons([
                //     Button::make('print')->addClass('dropdown-item'),
                //     Button::make('copy')->addClass('dropdown-item'),
                //     Button::make('csv')->addClass('dropdown-item'),
                //     Button::make('excel')->addClass('dropdown-item'),
                //     Button::make('pdf')->addClass('dropdown-item'),
                // ]),
            ->buttons(
                Button::make('collection')->text('<i class="ti ti-dots-vertical"></i>')->addClass('ms-1 btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light custom_more float-right text-right')->buttons([
                    Button::raw('delete-selected')->addClass('dropdown-item mt-1')->addClass($selectedDeletePermission ? '' : ' d-none')
                        ->text('<svg xmlns="http://www.w3.org/2000/svg" width="20" style="margin-right: 15px" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                      </svg>Delete Selected')->attr([
                            'onclick' => 'deleteSelected()',
                        ]),
                ]),
            )
            ->rowGroupDataSrc('parent_id')
            ->columnDefs([
                [
                    'targets' => 0,
                    'className' => 'text-primary',
                    'width' => '10%',
                    'orderable' => false,
                    'searchable' => false,
                    'responsivePriority' => 3,
                    'render' => "function (data, type, full, setting) {
                        var role = JSON.parse(data);
                        return '<div class=\"form-check\"> <input class=\"form-check-input dt-checkboxes\" onchange=\"changeTableRowColor(this)\" type=\"checkbox\" value=\"' + role.id + '\" name=\"chkRole[]\" id=\"chkRole_' + role.id + '\" /><label class=\"form-check-label\" for=\"chkRole_' + role.id + '\"></label></div>';
                    }",
                    'checkboxes' => [
                        'selectAllRender' => '<div class="form-check"> <input class="form-check-input" onchange="changeAllTableRowColor()" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>',
                    ],
                ],
            ])
            ->orders([
                [2, 'asc'],

            ]);
    }

    /**
     * Get columns.
     */
    protected function getColumns(): array
    {
        $selectedDeletePermission = Auth::user()->hasPermissionTo('roles.destroy-selected');
        $editPermission = Auth::user()->hasPermissionTo('roles.edit');
        $destroyPermission = Auth::user()->can('roles.destroy');
        $defaultPermission = Auth::user()->hasPermissionTo('roles.make-default');

        return [
            ($selectedDeletePermission ?
                Column::computed('check')->exportable(false)->printable(false)->width(60)
                :
                Column::computed('check')->exportable(false)->printable(false)->width(60)->addClass('hidden')
            ),
            Column::make('name')->title('Role Name'),
            // Column::make('guard_name')->title('Guard Name'),
            // Column::make('default')->title('Default'),
            Column::make('parent_id')->title('Parent'),
            Column::make('created_at')->addClass('text-nowrap'),
            // Column::make('updated_at'),
            (
                ($editPermission || $defaultPermission || $destroyPermission) ?
                Column::computed('actions')->exportable(false)->printable(false)->width(60)
                :
                Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('hidden')
            ),
            // Column::computed('actions')->exportable(false)->printable(false)->width(60),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Roles_'.date('YmdHis');
    }

    /**
     * Export PDF using DOMPDF
     *
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = Pdf::loadView($this->printPreview, ['data' => $data])->setOption(['defaultFont' => 'sans-serif']);

        return $pdf->download($this->filename().'.pdf');
    }
}
