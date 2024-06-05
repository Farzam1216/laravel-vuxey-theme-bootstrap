<?php

namespace App\DataTables;

use App\Models\CarCategory;
use App\Services\User\Interface\UserInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CarCategoriesDatatable extends DataTable
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
    $editColumns = (new EloquentDataTable($query))
      ->addIndexColumn()
      ->editColumn('mobile_no', function ($user) {
        return $user->mobile_no ?? '-';
      })

      ->editColumn('name', function ($user) {

        return $user->name ?? '-';
      })
      ->editColumn('residential_city_id', function ($user) {
        return $user->residentialCity->name ?? '-';
      })
      ->editColumn('is_suspended', function ($user) {
        return $user->is_suspended ? '<span class="badge badge-glow rounded-pill bg-label-danger">Suspened</span>' : '<span class="badge rounded-pill badge-glow bg-label-success">Active</span>';
      })
      ->editColumn('created_at', function ($user) {
        return editDateColumn($user->created_at);
      })
      ->editColumn('updated_at', function ($user) {
        return editDateColumn($user->updated_at);
      })
      ->editColumn('actions', function ($user) {
        return '
                <div class="d-flex justify-content-cetner align-items-center" onclick="actions_menu(' . $user->id . ')">
                    <div class="btn-group">
                        <button class="btn btn-flat-primary custom_dotted" type="button" id="dropdownMenuButton100"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>

                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                            <div id="loader_' . $user->id . '">
                            Loading...   <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                                <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="20px" height="20px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%"
                                 fill="#FFFFFF" /><g><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#000000"/><path d="M56.9-.1h15.17V37H56.9V-.1z"
                                 fill="#e5e5e5" transform="rotate(30 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5"
                                 transform="rotate(60 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(90 64 64)"/>
                                 <path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#cecece" transform="rotate(120 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z"
                                 fill="#b7b7b7" transform="rotate(150 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#9f9f9f" transform="rotate(180 64 64)"
                                 /><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#898989" transform="rotate(210 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z"
                                  fill="#727272" transform="rotate(240 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#5c5c5c" transform="rotate(270 64 64)"/>
                                  <path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#444444" transform="rotate(300 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#2e2e2e" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>
                            </div>
                            <div id="dropDownMenu_' . $user->id . '">

                            </div>
                        </div>
                    </div>
                </div>
                ';
      })
      ->editColumn('check', function ($user) {
        return $user;
      })
      ->setRowId('id')
      ->rawColumns(array_merge($columns, ['action', 'check']));



    return $editColumns;
  }

  /**
   * Get query source of dataTable.
   */
  public function query(CarCategory $model): QueryBuilder
  {
    return $model->newQuery()->orderBy('updated_at', 'desc');
  }

  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('user-table')
      ->columns($this->getColumns())
      ->scrollX(true)
      ->languageSearchPlaceholder('Search ...')
      ->scrollCollapse(true)
      ->minifiedAjax()
      ->serverSide()
      ->processing()
      ->lengthMenu([10, 20, 30, 50, 70, 100])
      ->pageLength(50)
      ->dom('<"card-header custom_button_card pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row custom_datatable_label"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
      ->buttons(

        Button::make('collection')->text('Export')->addClass('btn btn-label-secondary dropdown-toggle exportBtn border')->buttons([
          Button::raw('export-csv')->addClass('dropdown-item mt-1 border bg-label-secondary text-dark')
            ->text('<i class="ti ti-file-certificate"></i> CSV')->attr([
              'onclick' => 'ExportCsv(this)',
              'file-type' => 'csv',
              'file-name' => 'internalUsers',
            ]),
        ]),

        Button::make('collection')->text('<i class="ti ti-dots-vertical"></i>')->addClass('ms-1 btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light custom_more')->buttons([
          Button::raw('delete-selected')->addClass('dropdown-item mt-1')->addClass($this->createPermission ? '' : ' d-none')
            ->text('<svg style="margin-right: 13px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <g clip-path="url(#clip0_66_53)">
                  <path d="M19 5.79999C16.8 1.09999 11.4 -1.20001 6.60005 0.69999C2.70005 2.09999 0.500049 4.99999 0.100049 9.09999C-0.0999512 11.2 0.300049 13.3 1.50005 15.1C1.60005 15.3 1.60005 15.4 1.50005 15.6C1.00005 16.7 0.600049 17.7 0.200049 18.8C4.88311e-05 19.1 4.88311e-05 19.4 0.200049 19.7C0.400049 20 0.700049 20 1.10005 19.9C2.50005 19.6 3.90005 19.3 5.30005 18.9C5.50005 18.9 5.60005 18.9 5.80005 18.9C7.10005 19.5 8.60005 19.9 10.4 19.9C11.1 19.9 12.1 19.8 13 19.5C18.7 17.7 21.6 11.3 19 5.79999ZM11.7 18.6C9.70005 19 7.80005 18.7 6.00005 17.8C5.60005 17.6 5.30005 17.6 4.90005 17.7C3.90005 18 2.90005 18.2 1.80005 18.4H1.70005C2.00005 17.6 2.30005 16.8 2.70005 16.1C2.90005 15.6 2.90005 15.3 2.60005 14.8C1.50005 13.2 1.10005 11.5 1.20005 9.59999C1.30005 5.79999 4.00005 2.49999 7.80005 1.49999C12.6 0.19999 17.6 3.29999 18.6 8.19999C19.6 13 16.5 17.7 11.7 18.6Z" fill="#6B6371"/>
                  <path d="M10.8 7.9C10.8 8.3 10.8 8.7 10.8 9C10.8 9.2 10.8 9.2 11 9.2C11.7 9.2 12.5 9.2 13.2 9.2C13.7 9.2 14 9.5 14 10C14 10.5 13.6 10.8 13.1 10.8C12.4 10.8 11.7 10.8 10.9 10.8C10.7 10.8 10.7 10.8 10.7 11C10.7 11.7 10.7 12.4 10.7 13.1C10.7 13.7 10.4 14 9.9 14C9.4 14 9.1 13.6 9.1 13.1C9.1 12.4 9.1 11.7 9.1 11C9.1 10.8 9.1 10.8 8.9 10.8C8.2 10.8 7.5 10.8 6.8 10.8C6.3 10.8 6 10.5 6 10C6 9.5 6.3 9.2 6.9 9.2C7.6 9.2 8.3 9.2 9 9.2C9.2 9.2 9.2 9.2 9.2 9C9.2 8.3 9.2 7.6 9.2 6.8C9.2 6.3 9.5 6 10 6C10.5 6 10.8 6.4 10.8 6.9C10.8 7.2 10.8 7.5 10.8 7.9Z" fill="#6B6371"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_66_53">
                  <rect width="20" height="20" fill="white"/>
                  </clipPath>
                  </defs>
                  </svg> Add New')->attr([
              'onclick' => 'addNew()',
            ]),
          // Button::raw('delete-selected')->addClass('dropdown-item mt-1')->addClass($this->selectedDeletePermission ? '' : ' d-none')
          //   ->text('<svg xmlns="http://www.w3.org/2000/svg" width="20" style="margin-right: 15px" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
          //             <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
          //         </svg> Suspend Selected')->attr([
          //     'onclick' => 'deleteSelected()',
          //   ]),
        ]),

      );
    // ->columnDefs([
    //     [
    //         'targets' => 0,
    //         'className' => 'text-primary',
    //         'width' => '10%',
    //         'orderable' => false,
    //         'searchable' => false,
    //         'responsivePriority' => 3,
    //         'render' => "function (data, type, full, setting) {
    //             var role = JSON.parse(data);
    //             if(role.is_suspended == 1){
    //                 return '<div class=\"form-check\"> <input class=\"form-check-input dt-checkboxes\" onchange=\"changeTableRowColor(this)\" type=\"checkbox\" value=\"' + role.id + '\" name=\"chkUsers[]\" id=\"chkUsers_' + role.id + '\" disabled/><label class=\"form-check-label\" for=\"chkUsers_' + role.id + '\"></label></div>';
    //             }else{
    //                 return '<div class=\"form-check\"> <input class=\"form-check-input dt-checkboxes\" onchange=\"changeTableRowColor(this)\" type=\"checkbox\" value=\"' + role.id + '\" name=\"chkUsers[]\" id=\"chkUsers_' + role.id + '\" /><label class=\"form-check-label\" for=\"chkUsers_' + role.id + '\"></label></div>';
    //             }
    //         }",
    //         'checkboxes' => [
    //             'selectAllRender' => '<div class="form-check"> <input class="form-check-input" onchange="changeAllTableRowColor()" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>',
    //         ],
    //     ],
    // ])
  }

  /**
   * Get columns.
   */
  protected function getColumns(): array
  {
    $editPermission = Auth::user()->hasPermissionTo('car-categories.edit');
    $columns = [
      // ($selectedDeletePermission ?
      //   Column::computed('check')->exportable(false)->printable(false)->width(60)
      //   :
      //   Column::computed('check')->exportable(false)->printable(false)->width(60)->addClass('hidden')
      // ),
      Column::make('name')->title('Name')->addClass('text-nowrap'),
      Column::make('slug')->title('Slug')->addClass('text-nowrap'),



    ];

    $columns[] = Column::make('created_at')->addClass('text-nowrap');
    $columns[] = Column::make('updated_at')->addClass('text-nowrap');

    if ($editPermission) {
      $columns[] = Column::computed('actions')->exportable(false)->printable(false)->width(60);
    } else {
      $columns[] = Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('hidden');
    }

    return $columns;
  }

  /**
   * Get filename for export.
   */
  protected function filename(): string
  {
    return 'Users_' . date('YmdHis');
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

    return $pdf->download($this->filename() . '.pdf');
  }
}
