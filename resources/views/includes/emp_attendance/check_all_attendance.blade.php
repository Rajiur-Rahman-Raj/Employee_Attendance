<div class="card">
    <div class="card-header">
        {{ __('Day Wise Attendance Report For Employee') }}
    </div>
    <div class="card-body pr-0">
        <div class="row w-100">
            <div class="col-md-12 pl-0 pr-0">
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('Emp Name') }}</th>
                                    <th>{{ __('Designation') }}</th> 
                                    {{-- <th>{{ __('Month') }}</th> --}}
                                    <th>{{ __('Working Days') }}</th>
                                    {{-- <th>{{ __('Working Date') }}</th> --}}

                                    <th>{{ __('Total Worked Hour') }}</th>
                                    <th>{{ __('Per Day Work') }}</th>
                                    {{-- <th>{{ __('Present') }}</th> --}}
                                    {{-- <th>{{ __('Absent') }}</th> --}}
                                </tr>
                            </thead>
                            
                            
                            <tbody>
                                <td>{{ $emp_name->name }}</td>
                                <td>{{ $emp_designation->designation }}</td>
                                {{-- <td>{{ $selected_month }}</td> --}}
                                {{-- <td>
                                    <span class="badge badge-warning">{{ $emp_present }}</span>
                                </td> --}}
                                {{-- <td>
                                    <span class="badge badge-danger">{{ $emp_absent }}</span>
        
                                </td> --}}
                                <td>
                                    <span class="badge badge-info">{{ $count }}</span>
                                </td>
                                {{-- <td>
                                    @foreach ($attendance_date as $date)
                                    <span class="badge badge-warning">{{ $date }}</span>
                                    @endforeach
                                </td> --}}
                                <td>
                                    <span class="badge badge-success">{{ $emp_total_worked_hours }}h : {{ $emp_total_worked_minutes }}m</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $emp_per_day_worked_hours }}h : {{ $emp_per_day_worked_minutes }}m</span>
                                </td>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

