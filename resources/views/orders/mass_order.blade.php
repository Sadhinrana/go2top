<form method="post" action="{{route('massOrder.store')}}" id="mass_order" class="has-validation-callback">
    @csrf
    <div class="form-group">
        <label for="links">One order per line in format</label>
        <textarea class="form-control" name="content" rows="15" id="content" placeholder="service_id|quantity|link">{{ old('content') }}</textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-blue" type="submit">Submit</button>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</form>
