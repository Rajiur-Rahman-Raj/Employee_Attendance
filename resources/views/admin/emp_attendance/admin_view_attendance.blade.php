@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Attendance
@endsection

{{-- Active Menu --}}
@section('admin.view.attendance')
    active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0"> Admin Dashboard </h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}"> Home </a>
            </li>
            <li class="breadcrumb-item active">
                Employee Attendance
            </li>
        </ol>
    </div>
@endsection

{{-- Main Content --}}
@section('content')
<div class="row" id="basic-table">
    <div class="col-md-12 col-12 m-auto">
        <div class="card shadow">
            {{-- <h4 class="card-title"> Attendance List </h4> --}}
            <div class="card-header">
                <div class="row align-items-end mt-2">

                    <div class="col-md">
                        <div class="form-group">
                            <label for="emp_name">{{ __('Employee') }}</label>
                            <select name="emp_name" id="emp__name" class="form-control">
                                <option value="">-- Select One--</option>
                                @foreach ($all_emp_name as $name)
                                    <option value="{{ $name->name }}">{{ $name->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group">
                            <label for="from__date">{{ __('From') }}</label>
                            <input type="date" name="from_date" id="from__date" class="form-control">
                        </div>
                    </div>
    
                    <div class="col-md">
                        <div class="form-group">
                            <label for="to__date">{{ __('To') }}</label>
                            <input type="date" name="to_date" id="to__date" class="form-control">
                        </div>
                    </div>
    
                    <div class="col-md-auto mt-2">
                        <div class="form-group">
                            <button class="btn btn-primary" id="filter__date">{{ __('filter') }}</button>
                            <button class="btn btn-danger d-none" id="clear__filter__date">{{ __('Clear filter') }}</button>
                            <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#import_attendance_excel">{{ __('Import Excel') }}</button>
                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#import_attendance_csv">{{ __('Import Csv') }}</button>
                        </div>
                    </div>

                    <div class="col-md-12 attendance_search">
                        <input id="search_attendance" type="search" class="form-control" name="search" placeholder="{{ __('Search Attendance') }}...">
                    </div>

                    <div class="col-md-auto attendance_export_delete mt-2 d-none">
                        <div class="form-group">
                            
                            <form action="{{ route('export.emp.attendance.excel') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                @csrf
                                <input type="hidden" name="attendance_id" class="export_selected_attendance">
                                <button type="submit" class="btn btn-info btn-sm">{{ __('Export Excel') }}</button>
                            </form>
                            
                            <form action="{{ route('export.emp.attendance.pdf') }}" method="POST" enctype="multipart/form-data" class="d-inline" target="_blank">
                                @csrf
                                <input type="hidden" name="attendance_id" class="export_selected_attendance">
                                <button type="submit" class="btn btn-warning btn-sm">{{ __('Export Pdf') }}</button>
                            </form>
        
                            <form action="{{ route('export.emp.attendance.csv') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                @csrf
                                <input type="hidden" name="attendance_id" class="export_selected_attendance">
                                <button type="submit" class="btn btn-success btn-sm">{{ __('Export Csv') }}</button>
                            </form>
                            <button class="btn btn-danger d-inline btn-sm" data-toggle="modal" data-target="#delete_selected_emp_attendance">{{ __('Delete') }}</button>
                        </div>
                    </div>

                    @push('all_modals')
                        {{-- Delete selected attendance --}}
                        <div class="modal fade" id="delete_selected_emp_attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Emp Attendance') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('selected.attendance.delete') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="attendance_id" class="attendance_id_checked">
                                            <p class="text-danger text center">{{ __('Are you sure delete?') }}</p>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Import csv Attendance --}}
                        <div class="modal fade" id="import_attendance_csv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Import CSV Emp Attendance') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('import.emp.attendance.csv') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{-- <input type="hidden" name="attendance_id" class="attendance_id_checked"> --}}
                                            {{-- <p class="text-danger text center">{{ __('Are you sure delete?') }}</p> --}}
                                            <input type="file" name="import_emp_attendance_csv" id="import_emp_attendance_csv" class="form-control" accept=".csv">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Import Excel Attendance --}}
                        <div class="modal fade" id="import_attendance_excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Import Excel Emp Attendance') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('import.emp.attendance.excel') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="import_emp_attendance_excel" id="import_emp_attendance_excel" class="form-control" accept=".xlsx">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endpush
                    
                </div>
                    
            </div>



            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox" cursorshover="true">
                                        <input type="checkbox" name="check_all" value="1" data-status="all" id="customCheck" class="check_all custom-control-input">
                                        <label class="custom-control-label" for="customCheck" cursorshover="true"></label>
                                    </div>
                                </th>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th class="text-center">{{ __('Check In') }}</th>
                                <th class="text-center">{{ __('Check Out') }}</th>
                                <th>{{ __('Worked Hour') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="render_attendance">
                            @include('includes.emp_attendance.index')
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div id="render_emp_present_history">
    @if ($emp_present != null)
        @include('includes.emp_attendance.view_present_absent')
    @endif
</div>

<div id="check_all_render_attendance">
    {{-- @include('includes.emp_attendance.check_all_attendance') --}}
</div>

@endsection

@section('js')
    {{-- filter by date js --}}
    <script>
        $(document).ready(function() {
                $('#filter__date').on('click',function(){
                    let from_date = $('#from__date').val();
                    let to_date = $('#to__date').val();

                    let emp_name = $('#emp__name').val();

                    if (emp_name) {
                        
                        if (from_date && to_date) {

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                type: 'POST',
                                url: "{{ route('date.wise.attendance') }}",
                                data: {
                                    from_date: from_date,
                                    to_date: to_date,
                                    emp_name: emp_name,
                                },
                                success: function(response) {
                                    console.log(response);
                                    if ((response.count)*1 <  1) {
                                        $('#render_attendance').html('<tr ><td colspan="1000" class="text-danger text-center py-3">No Attendance Found</td></tr>');
                                        $('#render_emp_present_history').html('');
                                        toastr.error('No emp attendance found for this selected date');
                                    } else {
                                        $('#render_attendance').html(response.data);
                                        $('#render_emp_present_history').html(response.data_two);
                                        toastr.success('Showing Filtered Result');
                                    }


                                    $("#clear__filter__date").removeClass("d-none");
                                    
                                    if (!(1*response.count) < 1) {
                                        $('#render_emp_present_history').removeClass("d-none");  
                                    }
                                    
                                }
                            })

                        }else{
                            toastr.error('please select from date & to date');
                        }

                    }else{

                        if (from_date && to_date) {

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                type: 'POST',
                                url: "{{ route('date.wise.attendance') }}",
                                data: {
                                    from_date: from_date,
                                    to_date: to_date,
                                    emp_name: emp_name,
                                },
                                success: function(response) {
                                    console.log(response);
                                    if ((response.count)*1 <  1) {
                                        $('#render_attendance').html('<tr ><td colspan="1000" class="text-danger text-center py-3">No Attendance Found</td></tr>');
                                    } else {
                                        $('#render_attendance').html(response.data);
                                        $('#render_emp_present_history').html(response.data_two);
                                    }

                                    if ((1*response.count) < 2) {
                                        $('.load_more_button').hide();
                                    }else{
                                        $('.load_more_button').show();

                                    }

                                    $("#clear__filter__date").removeClass("d-none");
                                    
                                    if (!(1*response.count) < 1) {
                                        $('#render_emp_present_history').removeClass("d-none");  
                                    }
                                    
                                }
                            })
                        }else{
                            toastr.error('please select from date & to date');
                        }

                    }

                });


                // clear filter
                $("#clear__filter__date").on("click", function(){
                    $(this).addClass("d-none");
                    $('#render_emp_present_history').addClass("d-none");

                    $("#from__date").val("");
                    $("#to__date").val("");
                    $("#emp__name").val("");

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('date.clear.wise.attendance') }}",

                        success: function(response) {
                            $('#render_attendance').html(response.data);

                            if ((1*response.count) < 2) {
                                $('.load_more_button').hide();
                            }else{
                                $('.load_more_button').show();

                            }
                        }
                    })
                });
            });
    </script>

    {{-- search wise Attendance --}}
    <script>
        $(document).ready(function() {
                $('#search_attendance').on('keyup',function(){
                    let search_value = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('search.wise.attendance') }}",
                        data: {
                            search_value: search_value,
                        },
                        success: function(response) {
                            console.log(response);
                            if ((response.count)*1 <  1) {
                                $('#render_attendance').html('<tr ><td colspan="1000" class="text-danger text-center py-3">No Attendance Found</td></tr>');
                            } else {
                                $('#render_attendance').html(response.data);
                            }
                        }
                    })

                });
            });
    </script>

    {{-- check all/uncheck all attendance --}}
    <script>
        $(document).ready(function(){
            
            var attendance_array = [];
            $('.check_all').on('click', function(){
                attendance_array = [];
                if(this.checked){
                    
                    $('.attendance_export_delete').removeClass('d-none');
                    $('.attendance_export_delete').removeClass('d-none');

                    $('.attendance_check').each(function(){
                        $(this).prop('checked', true);
                        attendance_array.push($(this).attr('data-id'));
                        $('.attendance_id_checked').val(attendance_array);
                        $('.export_selected_attendance').val(attendance_array);
                        
                        
                    });

                }else{

                    $('.attendance_export_delete').addClass('d-none');
                    $('#check_all_render_attendance').addClass('d-none');
                    
                    $('.attendance_check').each(function(){

                        $(this).prop('checked', false); 
                        $('.attendance_id_checked').val(attendance_array);
                        $('.export_selected_attendance').val(attendance_array);

                    });
                }

                if(attendance_array.length == 0)
                { 
                    $('#check_all_render_attendance').addClass('d-none');
                    $('.attendance_export_delete').addClass('d-none');
                }else{
                    $('#check_all_render_attendance').removeClass('d-none');
                    $('.attendance_export_delete').removeClass('d-none'); 
                }

                // Ajax Setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('filter.by.all.attendance') }}",
                    data: {
                        attendance_array :attendance_array,
                    },
                    success: function (response) {
                        console.log(response);
                        if ((response.count)*1 <  1) {
                            $('#check_all_render_attendance').html('<tr ><td colspan="1000" class="text-danger text-center py-3">No Attendance Found</td></tr>');
                        } else {
                            $('#check_all_render_attendance').html(response.data);
                        }
                        toastr.success("Showing Filtered Result");
                    },
                    error: function(response) {
    
                    }   
                });

                // console.log(attendance_array);

            });




            $('body').on("click", ".attendance_check", function(){

                var data_id = $(this).attr('data-id');

                $('.attendance_check').each(function(){ 
                    if($(this).is(':checked')){
                        $('.check_all').prop('checked', true) 
                    } else{
                        $('.check_all').prop('checked', false) 
                        return false;
                    }
                });

                if(attendance_array.indexOf(data_id)  != -1){
                    attendance_array = attendance_array.filter(item => item !== data_id) 
                    $('.attendance_id_checked').val(attendance_array);
                    $('.export_selected_attendance').val(attendance_array);
                }
                else{
                    attendance_array.push(data_id)
                    $('.attendance_id_checked').val(attendance_array);
                    $('.export_selected_attendance').val(attendance_array);
                }


                if(attendance_array.length == 0)
                { 
                    $('#check_all_render_attendance').addClass('d-none');
                    $('.attendance_export_delete').addClass('d-none');
                }else{
                    $('#check_all_render_attendance').removeClass('d-none');
                    $('.attendance_export_delete').removeClass('d-none'); 
                }


                // Ajax Setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('filter.by.single.attendance') }}",
                    data: {
                        attendance_array :attendance_array,
                    },
                    success: function (response) {
                        console.log(response);
                        if ((response.count)*1 <  1) {
                            $('#check_all_render_attendance').html('<tr ><td colspan="1000" class="text-danger text-center py-3">No Attendance Found</td></tr>');
                        } else {
                            $('#check_all_render_attendance').html(response.data);
                        }
                        toastr.success("Showing Filtered Result");
                    },
                    error: function(response) {
    
                    }   
                });

                console.log(attendance_array);

            });

        });
    </script>
@endsection