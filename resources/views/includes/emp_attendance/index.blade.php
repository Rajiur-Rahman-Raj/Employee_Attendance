@foreach($all_emp_attendance as $attendance)
    <tr>
        <td>
            <div class="custom-control custom-checkbox" cursorshover="true">
                <input type="checkbox" name="id[]" value="{{ $attendance->id }}" id="customCheck{{ $attendance->id }}" class="custom-control-input attendance_check" data-id="{{ $attendance->id }}">
                <label class="custom-control-label" for="customCheck{{ $attendance->id }}" cursorshover="true"></label>
            </div>

        </td>
        <td>{{ $loop->iteration }}</td>
        {{-- <td>{{ $attendance->id }}</td> --}}
        <td>{{ $attendance->name }}</td>
        <td>{{ $attendance->designation }}</td>
        <td class="check_in_time">
            <span>{{ Carbon\Carbon::Parse($attendance->check_in)->format('d-M-Y') }}</span> <span class="badge badge-success">{{ Carbon\Carbon::Parse($attendance->check_in)->format('h:i a') }}</span> 
        </td>
        @if ($attendance->check_out == null)
            <td>
                <span class="badge badge-danger">{{ __('No check out today') }}</span>
            </td>
        @else
            <td class="check_out_time">
                <span>{{ Carbon\Carbon::Parse($attendance->check_out)->format('d-M-Y') }}</span> <span class="badge badge-warning"> {{ Carbon\Carbon::Parse($attendance->check_out)->format('h:i a') }} </span> 
            </td>
        @endif
        @php
            $check_in_time  = \Carbon\Carbon::parse($attendance->check_in);
            $check_out_time = \Carbon\Carbon::parse($attendance->check_out);
            $worked_hour = $check_out_time->diff($check_in_time)->format("%Hh : %Im");
        @endphp

        @if ($attendance->check_out == null)
            <td>
                <span class="badge badge-danger">{{ __('No Count') }}</span>
            </td>
        @else
            <td>
                <span class="badge badge-info">{{ $worked_hour }}</span>
                
            </td>
        @endif
        <td>

            <div class="dropdown d-flex">
                    
                <button type="button" class="btn   dropdown-toggle hide-arrow " data-toggle="dropdown" data-boundary="viewport"> 
                    {{-- <i data-feather="more-vertical"></i> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                </button>
                <div class="dropdown-menu">  
                    {{-- <a class="dropdown-item" href="{{ route('edit.document.generate.form', $document_name->id) }}">
                        <i data-feather="edit" class="mr-50"></i>
                        <span>{{ __('Edit') }}</span>
                    </a>   --}}

                    <a class="dropdown-item" data-toggle="modal" data-target="#delete_emp_attendance{{ $attendance->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        <span>{{ __('Delete') }}</span>
                    </a>  
                </div> 
            </div>
        </td>
    </tr>

    @push('all_modals')
        {{-- Delete document generate modal --}}
        <div class="modal fade" id="delete_emp_attendance{{ $attendance->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Emp Attendance') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('delete.emp.attendance', $attendance->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('delete')
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
    @endpush

    @endforeach