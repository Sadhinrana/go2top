@extends('reseller.layouts.app')

@section('title', 'Ticket show')

@section('pageName', 'Ticket show')

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase p-3 bg-info text-white">Ticket details</h5>

                    <table class="table table-hover table-striped">
                        <tr>
                            <th>Client name</th>
                            <td>{{ $ticket->user->username }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $ticket->subject }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{!! nl2br($ticket->description) !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                {{$ticket->status}}
                            </td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{ $ticket->created_at->format('M d, Y h:iA') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase p-3 bg-info text-white">Give a reply</h5>
                    <form class="form-material" method="post" action="{{ route('reseller.tickets.comment', $ticket->id) }}" enctype="multipart/form-data" novalidate>
                        @csrf
                      {{--   <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required data-validation-required-message="This field is required">
                                            <option value="" selected>Status</option>
                                            <option {{ old('status') == 'Pending' ? 'selected' : '' }} value="1">Pending</option>
                                            <option {{ old('status') == 'Resolved' ? 'selected' : '' }} value="2">Resolved</option>
                                            <option {{ old('status') == 'Answer' ? 'selected' : '' }} value="3">Answer</option>
                                        </select>

                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="controls">
                                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}" >
                                        <textarea style="height: 200px" name="content" class="form-control @error('comment') is-invalid @enderror" placeholder="Message" required data-validation-required-comment="This field is required">{{ old('comment') }}</textarea>

                                        @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase p-3 bg-info text-white">Comments</h5>

                    <div class="chat-box scrollable" style="height:434px;">
                        <!--chat Row -->
                        <ul class="chat-list">
                            @foreach($ticket->comments as $comment)
                                @if($comment->commentor_role == 'user')
                                <!--chat Row -->
                                <li class="chat-item">
                                    <div class="chat-img"><img src="../../assets/images/users/1.jpg" alt="user"></div>
                                    <div class="chat-content">
                                        <div class="box bg-light-success">
                                            <h5 class="font-medium">User</h5>
                                            <p class="font-light mb-0">{{ nl2br($comment->message) }}</p>
                                            <div class="chat-time">{{ $comment->created_at->format('M d, Y h:ia') }}</div>
                                        </div>
                                    </div>
                                </li>
                                @else
                                <!--chat Row -->
                                <li class="odd chat-item">
                                    <div class="chat-content">
                                        <div class="box bg-light-success">
                                            <h5 class="font-medium">Admin</h5>
                                            <p class="font-light mb-0">{{ nl2br($comment->message) }}</p>
                                            <div class="chat-time">{{ $comment->created_at->format('M d, Y h:ia') }}</div>
                                        </div>
                                    </div>
                                    <div class="chat-img"><img src="../../assets/images/users/2.jpg" alt="user"></div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
@endsection
