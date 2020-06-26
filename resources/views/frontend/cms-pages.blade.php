@extends('layouts.app_consumer')
@section('content')

    <section style="margin-top:80px;margin-bottom:10px; ">
        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body pt-0">
                             {!! $contents !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


