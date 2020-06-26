@extends('layouts.app_consumer')
@section('content')
<section>
   <div class="container" id="support_ticket_details">
      <div class="row ticket-panel">
         <div class="col">
            <div class="card   bg-white">
               <div class="card-header">
                  <div class="titcket-title card-title">{{ $ticket->subject }}</div>
                  <br>
                  <span class="label label-{{ $ticket->status == 'open'  ? 'success' : 'danger'  }}"></span>
               </div>
               <div class="card-body">
                @if (Session::has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   <span class="sr-only">Close</span>
                   </button>
                   <strong>Message!</strong> {{Session::get('success')}}.
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   <span class="sr-only">Close</span>
                   </button>
                   <strong>Error!</strong> {{Session::get('error')}}.
                </div>
                @endif
                  <p>
                      {!! $ticket->description !!}
                  </p>
                  @if( ! $ticketMessages->isEmpty() )
                  @foreach($ticketMessages as $ticketMessage)
                  <div class="row ticket-message-block ticket-message-right justify-content-end">
                     <div class="col-md-10">
                        <span class="avatar">
                        <i class="fa fa-user-circle"></i>
                        </span>
                        <div class="ticket-message">
                           <div class="message">
                              {!! nl2br(e($ticketMessage->message)) !!}
                           </div>
                        </div>
                        <div class="info">
                           <strong>{{ $ticketMessage->user->username }}</strong>
                           <small class="text-muted">{{ $ticketMessage->created_at }}</small>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  @else
                  <p>
                     @lang('general.no_messages')
                  </p>
                  @endif
                  <div class="row">
                     @if($ticket->status === 'open')
                     <div class="col-md-12">
                        <form role="form"
                           method="POST"
                           action="{{ route('ticket.comment.store') }}">
                           {{ csrf_field() }}
                            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                           <div class="form-group panel-border-top {{ $errors->has('content') ? ' has-error' : '' }}">
                              <label for="message" class="control-label">Message</label>
                              <textarea id="content" rows="5" class="form-control" name="content" data-validation="required"></textarea>
                              @if ($errors->has('content'))
                              <span class="help-block">
                              <strong>{{ $errors->first('content') }}</strong>
                              </span>
                              @endif
                           </div>
                           <button type="submit" class="btn btn-green">Submit</button>
                        </form>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
