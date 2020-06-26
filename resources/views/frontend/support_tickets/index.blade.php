@extends('layouts.app_consumer')
@section('content')
<section>
   <div class="container-fluid" id="support-ticket-index">
      <div class="row payments-panel ticket-panel" id="support_ticket_panel">
         <div class="col-lg-6">
            <div class="card help-panel">
               <div class="card-body">
                  <div class="card-title">
                     Please read the FAQ page before opening a ticket.&nbsp;<br><!--<span style="color:red;font-weight:bold;">We are having a delay with ticket replies. Please DO NOT open a second ticket for the same matter.<br>Spamming in a ticket will result in slower replies as we are replying to oldest tickets first.</span>-->
                  </div>
                  <a href="/faq" class="btn btn-green">FAQ</a>
               </div>
            </div>
            <div class="card">
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
                  <form role="form" method="post" action="{{ route('supportTickets.store') }}" id="ticketsend">
                     {{ csrf_field() }}
                     <div class="alert alert-dismissible alert-danger ticket-danger " style="display: none">
                        <button type="button" class="close">×</button>
                        <div></div>
                     </div>
                     <div class="form-group subject-panel {{ $errors->has('subject') ? ' has-error' : '' }}" >
                        <label for="subject">Subject:</label>
                        <div class="row">
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input subject ticket-options" id="subjectOrder" v-model="ticket_subject" name="subject" value="order">
                              <label class="custom-control-label ticket-options-label" for="subjectOrder">Order</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input subject ticket-options" v-model="ticket_subject" id="subjectPayment" name="subject" value="payment">
                              <label class="custom-control-label ticket-options-label" for="subjectPayment">Payment</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input subject ticket-options" id="subjectService" v-model="ticket_subject" name="subject" value="service">
                              <label class="custom-control-label ticket-options-label" for="subjectService">Service</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input subject ticket-options" id="subjectOther" v-model="ticket_subject" name="subject" value="other">
                              <label class="custom-control-label ticket-options-label" for="subjectOther">Other</label>
                              </span>
                           </div>
                        </div>
                        @if ($errors->has('subject'))
                        <span class="help-block">
                        <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                        @endif
                     </div>
                     <div v-if="order_ids" class="form-group">
                        <label for="ordernumbers">Order ID: </label>
                        <input id="ordernumbers" type="text" class="form-control" name="order_ids" placeholder="For multiple orders, please separate them using comma. (example: 12345,12345,12345)">
                     </div>
                     <div class="form-group" v-if="transaction_ids">
                        <label for="transactionid">Transaction ID: </label>
                        <input id="description" type="text"  name="transaction_id" class="form-control" placeholder="Enter the Transaction ID">
                     </div>
                     <div class="form-group therequest" v-if="order_types">
                        <label for="type">Request</label>
                        <div class="row">
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input second-options" id="requestRefill" name="order_type" value="Refill" v-model='payment_type_value'>
                              <label class="custom-control-label" for="requestRefill">Refill</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input second-options" id="requestCancellation" name="order_type" value="Cancellation" v-model='payment_type_value'>
                              <label class="custom-control-label" for="requestCancellation">Cancellation</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input second-options" id="requestSpeed" name="order_type" value="Speed Up" v-model='payment_type_value'>
                              <label class="custom-control-label" for="requestSpeed">Speed Up</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input second-options" id="requestOther" name="order_type" value="Other" v-model='payment_type_value'>
                              <label class="custom-control-label" for="requestOther">Other</label>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div  class="form-group" v-if="payment_types">
                        <label for="payment">Payment</label>
                        <div class="row">
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input second-options" id="paymentPaypal" name="payment_types" value="Paypal">
                              <label class="custom-control-label" for="paymentPaypal">Paypal</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input second-options" id="paymentPerfect" name="payment_types" value="Perfect Money">
                              <label class="custom-control-label" for="paymentPerfect">Crypto Currency</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input second-options" id="paymentCrypto" name="payment_types" value="Crypto Currency">
                              <label class="custom-control-label" for="paymentCrypto">Skrill</label>
                              </span>
                           </div>
                           <div class="col">
                              <span class="custom-control">
                              <input type="radio" class="custom-control-input second-options" id="paymentOther" name="payment_types" value="Other">
                              <label class="custom-control-label" for="paymentOther">Other</label>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="message">Message</label>
                        <textarea class="form-control" rows="7" id="description" name="description" data-validation="required">
                        {{ old('subject') }}
                        </textarea>
                        @if ($errors->has('description'))
                        <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                     </div>
                     <button type="submit" class="btn btn-green">Submit ticket</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="card my-orders-panel dripfeed-panel" style="overflow-y:auto;height:733px;">
               <div class="card-body">
                  <table class="table ">
                     <thead>
                        <tr>
                           <th></th>
                           <th>Subject</th>
                           <!--<th>Status</th>-->
                           <th>New Message</th>
                           <th class="nowrap">Last update</th>
                        </tr>
                     </thead>
                     <tbody class="ticket-list">
                        @foreach($supports as $item)
                        <tr>
                           <td>{{$item->id}}</td>
                           <td><a href="{{ route('supportTickets.show', ['supportTicket' => $item->id]) }}">{{$item->subject}}</a></td>
                           <!--<td>{{$item->status}}</td>-->
                           <td>0</td>
                           <td><span class="nowrap">{{$item->updated_at}}</span></td>
                        </tr>
                        @endforeach       
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> 
<script type="text/javascript">
   let app = new Vue({
       el: '#support_ticket_panel',
       data: {
          order_types: false,
          payment_types: false,
          payment_type_value: 'Refill',
          order_ids: false,
          transaction_ids: false,
          ticket_subject: 'order',
       },
       watch: {
        ticket_subject(newval, oldval){
            this.init();
        }
       },
       methods: {
            init(){
                if (this.ticket_subject === 'order') {
                    this.order_types = true;
                    this.order_ids = true;
   
                    this.payment_types = false;
                    this.transaction_ids = false;
                }
                else if(this.ticket_subject === 'payment')
                {
                    this.payment_types = true;
                    this.transaction_ids = true;
   
                    this.order_types = false;
                    this.order_ids = false;
                }
                else
                {
                    this.payment_types = false;
                    this.transaction_ids = false;
                    this.order_types = false;
                    this.order_ids = false;
                }
            },
       },
       created(){
           this.init();
       }
   });
   
</script>
@endsection