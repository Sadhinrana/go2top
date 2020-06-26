@extends('reseller.layouts.app')

@section('title', 'Tickets')

@section('pageName', 'Tickets')

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="material-card card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <a href="javascript:void(0)" type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ticketAddModal"><i class="fa fa-plus"></i> </a>
                        </div>
                        <div class="col-md-2 text-right">
                            <a class="btn btn-primary" href="javascript:void(0)" onclick="$('#search-form').append('<input type=\'hidden\' name=\'seen_at\' value=\'seen_at\'>').submit()">Show unread</a>
                        </div>
                        <div class="col-md-2">
                            <form class="text-right" id="search-form">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" aria-label="Text input with checkbox" placeholder="Search tickets">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped border table-hover" id="tickets">
                            <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" onchange="checkAllTicket()"></th>
                                <th colspan="7" style="display: none">
                                    <span id="user-no"></span> tickets selected
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <form method="post" id="bulk-delete" action="{{ route('reseller.tickets.destroy') }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <form method="post" id="bulk-close" action="{{ route('reseller.tickets.close') }}">
                                                @csrf
                                                @method('put')
                                            </form>
                                        {{--  <form method="post" id="bulk-update" action="{{ route('reseller.tickets.update') }}">
                                             @csrf
                                             @method('put')
                                             <input type="hidden" name="status">
                                         </form> --}}
                                        <!-- Default dropright button -->
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="bulkClose()">Mark as Closed</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="bulkDelete()">Delete</a>
                                        </div>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Client name</th>
                                <th>Subject</th>
                                <th>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('reseller.tickets.index') }}">All ({{ auth()->guard('reseller')->user()->users->map(function ($item) { return $item->tickets; })->collapse()->count() }})</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="searchTickets('status', 1)">Pending ({{ auth()->guard('reseller')->user()->users->map(function ($item) { return $item->tickets; })->collapse()->where('status', 1)->count() }})</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="searchTickets('status', 2)">Resolved ({{ auth()->guard('reseller')->user()->users->map(function ($item) { return $item->tickets; })->collapse()->where('status', 2)->count() }})</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="searchTickets('status', 3)">Answered ({{ auth()->guard('reseller')->user()->users->map(function ($item) { return $item->tickets; })->collapse()->where('status', 3)->count() }})</a>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="searchTickets('status', 4)">User Reply ({{ auth()->guard('reseller')->user()->users->map(function ($item) { return $item->tickets; })->collapse()->where('status', 4)->count() }})</a>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <th>Created at</th>
                                <th>Last update</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td><input type="checkbox" name="tickets[]" value="{{ $ticket->id }}" class="ticket_check" onchange="checkTicket()" {{ $ticket->status == 2 ? 'disabled' : '' }}></td>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->user->username }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>
                                        @if($ticket->status == 1)
                                            Pending
                                        @elseif($ticket->status == 2)
                                            Resolved
                                        @elseif($ticket->status == 3)
                                            Answer
                                        @else
                                            User Replay
                                        @endif
                                    </td>
                                    <td>{{ $ticket->created_at->format('M d, Y h:iA') }}</td>
                                    <td>{{ $ticket->updated_at->format('M d, Y h:iA') }}</td>
                                    <td>
                                        <a href="{{ route('reseller.tickets.show', $ticket->id) }}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($tickets->total())
                        <div class="row mt-4">
                            <div class="col-md-6">
                                {{ $tickets->links() }}
                            </div>
                            <div class="col-md-6 text-right">
                                Showing {{ $tickets->firstItem() }} to {{ $tickets->lastItem() }} of {{ $tickets->total() }} entries
                            </div>
                        </div>
                    @else
                        <div class="text-center mt-4">No data available in table</div>
                    @endif
                    <div class="modal bs-example-modal-lg" id="ticketAddModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <form class="form-material" method="post" action="{{ route('reseller.tickets.store') }}" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Add ticket</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <select name="subject" class="form-control @error('subject') is-invalid @enderror" required data-validation-required-message="This field is required">
                                                            <option value="" selected>Choose subject</option>
                                                            <option  value="order">Order</option>
                                                            <option  value="payment">Payment</option>
                                                            <option  value="service">Request</option>
                                                            <option  value="other">Other</option>
                                                        </select>

                                                        @error('subject')
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <select name="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" required data-validation-required-message="This field is required">
                                                            <option selected>Select user</option>
                                                            @foreach(auth()->guard('reseller')->user()->users as $user)
                                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->username }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('user_id')
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <textarea style="height: 200px" name="message" class="form-control summernote @error('message') is-invalid @enderror" placeholder="Message" required data-validation-required-message="This field is required">{{ old('message') }}</textarea>

                                                        @error('message')
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        </div>
                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function searchTickets(column, value) {
            let form = $('#search-form');
            form.prepend(`<input type="hidden" name="columns[${column}]" value="${value}">`);
            form.submit();
        }

        function checkAllTicket() {
            if (event.target.checked) {
                $('.ticket_check').prop('checked', true);
                $('#tickets thead > tr > th:not(:first-child)').hide();
                $('#tickets thead > tr').children().eq(1).show();
                $('#user-no').text($('.ticket_check').length);
            } else {
                $('.ticket_check').prop('checked', false);
                $('#tickets thead > tr > th').show();
                $('#tickets thead > tr').children().eq(1).hide();
            }
        }

        function checkTicket() {
            let count = 0;

            $('.ticket_check').each(function () {
                if (this.checked) {
                    count += 1;
                }
            });

            if (count) {
                $('input[name=select_all]').prop('checked', true);
                $('#tickets thead > tr > th:not(:first-child)').hide();
                $('#tickets thead > tr').children().eq(1).show();
                $('#user-no').text(count);
            } else {
                $('input[name=select_all]').prop('checked', false);
                $('#tickets thead > tr > th').show();
                $('#tickets thead > tr').children().eq(1).hide();
            }
        }

        function bulkDelete() {
            Swal.fire({
                title: 'Are you sure want to delete all these tickets?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.value) {
                    $('#bulk-delete').append($('.ticket_check')).submit();
                }
            });
        }

        function bulkClose() {
            Swal.fire({
                title: 'Are you sure want to close & lock all these tickets?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, close & lock!'
            }).then((result) => {
                if (result.value) {
                    $('#bulk-close').append($('.ticket_check')).submit();
                }
            });
        }

        /*  function bulkUpdate(status) {
             Swal.fire({
                 title: 'Are you sure want to change status of all these tickets?',
                 type: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, change!'
             }).then((result) => {
                 if (result.value) {
                     $('#bulk-update').find('input[name=status]').val(status);
                     $('#bulk-update').append($('.ticket_check')).submit();
                 }
             });
         } */

        $('.btn-group.dropright').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });

        @if($errors->any())
        Swal.fire({
            type: 'error',
            title: 'Error!',
            html: '@if ($errors->any())\n' +
                '    <div class="alert alert-danger">\n' +
                '        <ul>\n' +
                '            @foreach ($errors->all() as $error)\n' +
                '                <li>{{ $error }}</li>\n' +
                '            @endforeach\n' +
                '        </ul>\n' +
                '    </div>\n' +
                '@endif',
        });
        @endif
    </script>
@endsection()
