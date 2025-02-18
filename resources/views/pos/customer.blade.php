@extends('layouts.app')
@section('title', 'Input Customer')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Input Customer Name</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('pos.setCustomer') }}">
                @csrf
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Kostumer</label>
                    <select class="form-control form-select" id="customer_name" name="customer_name" required>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('customer_name'))
                        <div class="text-danger">{{ $errors->first('customer_name') }}</div>
                    @endif
                </div>
                <div class="mb-3" id="phone-input" style="display: none;">
                    <label for="customer_phone" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="customer_phone" name="customer_phone">
                    @if ($errors->has('customer_phone'))
                        <div class="text-danger">{{ $errors->first('customer_phone') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Next</button>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#customer_name').select2({
                placeholder: 'Pilih Customer',
                tags: true,
                createTag: function(params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                },
                templateResult: function(data) {
                    var $result = $("<span></span>");
                    $result.text(data.text);
                    if (data.newOption) {
                        $result.append(" <em>(new)</em>");
                    }
                    return $result;
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;
                if (data.newOption) {
                    $('#phone-input').show();
                } else {
                    $('#phone-input').hide();
                }
            });
        });
    </script>
@endpush
