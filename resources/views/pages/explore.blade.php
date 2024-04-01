@extends('layouts.navbar.sidebar')

@section('head')
<style>
    .badge {
        display: inline-block;
        padding: 0.25em 0.5em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #fff;
    }

    .badge-soft-warning {
        color: #f1b44c;
        background-color: rgba(241, 180, 76, .18);
    }

    .badge-success {
        background-color: #2dce89;
        color: #fff;
    }

    .badge-soft-success {
        color: #34c38f;
        background-color: rgba(52, 195, 143, .18);
    }

    .badge-warn-subtle {
        color: #e9bc18;
        background-color: #fcf5dc;
    }

    .badge-info-subtle {
        color: #179faa;
        background-color: #dcf1f2;
    }

    .badge-secondary-subtle {
        color: #438eff;
        background-color: #e3eeff;
    }

    .badge-primary-subtle {
        color: #5a58eb;
        background-color: #e6e6fc;
    }

    .badge-danger-subtle {
        color: #f9554c;
        background-color: #fee6e4;
    }

    .rounded-pill {
        border-radius: 50rem;
    }

    .d-inline {
        display: inline;
    }
</style>
@endsection

@section('content')
@include('layouts.navbar.topnav', ['title' => 'Dashboard'])
<div class="container">
    <div class="header-main">

        <div class="container">

            <a href="#" class="header-logo">
                <img src="asset/img/mini-logo.png" alt="SecondLife's logo" width="120"
                    style="margin-top: -40px; margin-bottom: -40px; margin-right: -25px;">
            </a>

            <div class="header-search-container">

                <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

                <button class="search-btn">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

            </div>

            <div class="header-user-actions">

                <button class="action-btn" title="Profile">
                    <i class="fa fa-user text-secondary" aria-hidden="true"></i>
                </button>

                <button class="action-btn" title="Wishlist">
                    <i class="fa fa-heart text-secondary" aria-hidden="true"></i>
                    <span class="count" id="wishlist-count">0</span>
                </button>

                <button class="action-btn" title="Cart">
                    <i class="fa fa-shopping-bag text-secondary" aria-hidden="true"></i>
                    <span class="count" id="cart-count">0</span>
                </button>

            </div>

        </div>

    </div>

    @include('layouts.footer.footer')
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script src="/js/moment.js"></script>

{{-- Datatable project draft --}}
<script>
    $(document).ready( function () {
           var dataTable;
   
           function loadProjectTable() {
                       $.ajax({
                           url: '{{ route("getAllProjects") }}',
                           type: 'GET',
                           dataType: 'json',
                           success: function (projects) {
                               
                               var tableBody = $('#projectTableBody');
                               tableBody.empty();
   
                               var draftProjects = projects.filter(function (project) {
                                   return project.Status === 'Draft';
                               });
   
                               draftProjects.forEach(function (project) {
                               var row = '<tr>' +
                                   '<td>' + project.CreatedAt + '</td>' +
                                   '<td>' + (project.ProjectNumber ? project.ProjectNumber.toUpperCase() : '') + '</td>' +
                                    '<td>' + (project.ProdNum ? project.ProdNum.toUpperCase() : '') + '</td>' +
                                   '<td>' + project.ProdDesc + '</td>' +
                                   '<td>' + project.Categories + '</td>' +
                                   '<td>' + project.ProductEngineer + '</td>' +
                                   '<td>' + project.Status + '</td>' +
                                   '<td>' + (project.FPRMeetDate ? moment(project.FPRMeetDate).format('MM-DD-YY') : '') + '</td>' +
                                  
                                   '</tr>';
                               tableBody.append(row);
                           });
   
                           if (!dataTable) {
                               dataTable = $('#projectTable').DataTable({
                                   paging: true,
                                   searching: true,
                                   "language": {
                                       "paginate": {
                                           "previous": '<i class="fa fa-angle-left text-center" style="margin-top: 7px;"></i>',
                                           "next": '<i class="fa fa-angle-right text-center" style="margin-top: 7px;"></i>',
                                       },
                                       "search": "",
                                       "searchPlaceholder": "Search"
                                   },
                                   ordering: true,
                                   info: true,
                                   responsive: true,
                                   order: [
                                       [0, 'desc']
                                   ],
                                   columns: [{
                                           data: 'CreatedAt',
                                           title: 'Created At',
                                           visible: false
                                       },
                                       {
                                           data: 'ProjectNumber',
                                           title: 'Project #'
                                       },
                                       {
                                           data: 'ProdNum',
                                           title: 'Product #'
                                       },
                                       {
                                           data: 'ProdDesc',
                                           title: 'Product'
                                       },
                                       {
                                           data: 'Categories',
                                           title: 'Categories'
                                       },
                                       {
                                           data: 'ProductEngineer',
                                           title: 'Product Eng'
                                       },
                                       {
                                           data: 'Status',
                                           title: 'Status',
                                           render: function(data, type, row) {
                                               if (data === 'Draft') {
                                                   return '<span class="badge badge-soft-warning rounded-pill d-inline">' + data + '</span>';
                                               } else if (data === 'Ongoing') {
                                                   return '<span class="badge badge-soft-success rounded-pill d-inline">' + data + '</span>';
                                               } else if (data === 'Preliminary' || data === 'BOM Input' || data === 'Prep 1st Cost' || data === '1st Cost') {
                                                   return '<span class="badge badge-primary-subtle rounded-pill d-inline">' + data + '</span>';
                                               } else if (data === 'CR Cost Done' || data === 'FPR Cost Done') {
                                                   return '<span class="badge badge-success rounded-pill d-inline">' + data + '</span>';
                                               } else if (data === 'Prep CR Model' || data === 'Prep FPR Model') {
                                                   return '<span class="badge badge-warn-subtle rounded-pill d-inline">' + data + '</span>';
                                               } else if (data === 'CR Approval' || data === 'FPR Approval') {
                                                   return '<span class="badge badge-secondary-subtle rounded-pill d-inline">' + data + '</span>';
                                               } else if (data === 'CR Approved' || data === 'FPR Approved' || data === 'CR/FPR Approved') {
                                                   return '<span class="badge badge-info-subtle rounded-pill d-inline">' + data + '</span>';
                                               } else if (data === 'Drop' || data === 'Change Source' || data === 'Re-ICR') {
                                                   return '<span class="badge badge-danger-subtle rounded-pill d-inline">' + data + '</span>';
                                               } else {
                                                   return data;
                                               }
                                           }
                                       },
                                       {
                                           data: 'FPRMeetDate',
                                           title: 'FPR',
                                           render: function(data, type, row) {
                                               return data ? data : '';
                                           }
                                       },
   
                                   ]
                               });
   
                           } else {
                               dataTable.clear().draw();
                           }
                           },
                           error: function(xhr, status, error) {
                           console.log("Error:", error);
                           alert('Error loading project table. See console for details.');
                           }
                           });
                           }
   
                           loadProjectTable();
                           });
</script>

{{-- Datatable project lead time --}}
<script>
    $(document).ready( function () {
        var dataTable;

        function loadProjectTable() {
                    $.ajax({
                        url: '{{ route("getAllProjects") }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function (projects) {
                            
                            var tableBody = $('#ltTableBody');
                            tableBody.empty();

                            projects.forEach(function (project) {
                            var row = '<tr>' +
                                    '<td>' + project.CreatedAt + '</td>' +
                                    '<td>' + (project.ProjectNumber ? project.ProjectNumber.toUpperCase() : '') + '</td>' +
                                    '<td>' + (project.ProdNum ? project.ProdNum.toUpperCase() : '') + '</td>' +
                                    '<td>' + project.ProdDesc + '</td>' +
                                    '<td>' + (isValidDate(project.DSPFDate) ? moment(project.DSPFDate).format('MM-DD-YY') : '') + '</td>' +
                                    '<td>' + (isValidDate(project.FPRMeetDate) ? moment(project.FPRMeetDate).format('MM-DD-YY') : '') + '</td>' +
                                    '<td></td>' +
                                    '</tr>';
                            tableBody.append(row);
                        });

                        function isValidDate(date) {
                                return date && moment(date, moment.ISO_8601, true).isValid();
                            }

                            if (!dataTable) {
                                dataTable = $('#ltTable').DataTable({
                                    paging: true,
                                    searching: true,
                                        "language": {
                                            "paginate": {
                                            "previous": '<i class="fa fa-angle-left text-center" style="margin-top: 7px;"></i>',
                                            "next": '<i class="fa fa-angle-right text-center" style="margin-top: 7px;"></i>',
                                            },
                                            "search": "",
                                            "searchPlaceholder": "Search"
                                        },
                                    ordering: true,
                                    info: true,
                                    responsive: true,
                                    order: [[0, 'desc']],
                                    columns: [
                                                { data: 'CreatedAt', title: 'Created At', visible: false },
                                                { data: 'ProjectNumber', title: 'Project #' },
                                                { data: 'ProdNum', title: 'Product #' },
                                                { data: 'ProdDesc', title: 'Product' },
                                                {
                                                    data: 'DSPFDate',
                                                    title: 'DSP (F)',
                                                    render: function(data, type, row) {
                                                        return data ? data : '';
                                                    }
                                                },
                                                {
                                                    data: 'FPRMeetDate',
                                                    title: 'FPR',
                                                    render: function(data, type, row) {
                                                        return data ? data : '';
                                                    }
                                                },
                                                {
                                                    data: null,
                                                    title: 'LT',
                                                    render: function (data, type, row) {
                                                        var dspDate = moment(row.DSPFDate, 'MM-DD-YY');
                                                        var fprDate = moment(row.FPRMeetDate, 'MM-DD-YY');
                                                        
                                                        if (dspDate.isValid() && fprDate.isValid()) {
                                                            var weeksDifference = fprDate.diff(dspDate, 'weeks', true);
                                                            var formattedDifference = Math.ceil(weeksDifference) >= 0 ? Math.ceil(weeksDifference) + ' weeks' : '';
                                                            return formattedDifference;
                                                        } else {
                                                            return '';
                                                        }
                                                    }
                                                }
                                            ],
                                        });
            
                            } else {
                                dataTable.clear().draw();
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("Error:", error);
                            alert('Error loading project table. See console for details.');
                        }
                    });
                }

                loadProjectTable();
        });
</script>
@endsection