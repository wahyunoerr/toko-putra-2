@extends('layouts.app')
@section('title', 'Filter Transaksi')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filter {{ __('Data Transaksi') }}</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('transaksi-pos.filter-results') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="text" placeholder="dd/mm/yyyy" class="form-control datepicker" id="start_date"
                            name="start_date" required readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="text" placeholder="dd/mm/yyyy" class="form-control datepicker" id="end_date"
                            name="end_date" required readonly>
                    </div>
                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('transaksi-pos.filter') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (isset($transactions) && $transactions->isNotEmpty())
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Filtered Transactions</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th>Transaction Date</th>
                                <th>Customer Name</th>
                                <th>Barang</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentTransaction = null;
                                $rowSpan = 0;
                            @endphp
                            @foreach ($transactions as $transaction)
                                @foreach ($transaction->details as $detail)
                                    @if ($currentTransaction !== $transaction->id)
                                        @php
                                            $currentTransaction = $transaction->id;
                                            $rowSpan = $transaction->details->count();
                                        @endphp
                                        <tr>
                                            <td rowspan="{{ $rowSpan }}" class="text-center align-middle">
                                                {{ $loop->parent->iteration }}</td>
                                            <td rowspan="{{ $rowSpan }}" class="text-center align-middle">
                                                {{ $transaction->created_at->format('d M Y') }}</td>
                                            <td rowspan="{{ $rowSpan }}" class="text-center align-middle">
                                                {{ $detail->customer->name }}</td>
                                            <td>{{ $detail->barang->name }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>Rp. {{ number_format($detail->barang->hargaJual, 2, ',', '.') }}</td>
                                            <td>Rp.
                                                {{ number_format($detail->quantity * $detail->barang->hargaJual, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $detail->barang->name }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>Rp. {{ number_format($detail->barang->hargaJual, 2, ',', '.') }}</td>
                                            <td>Rp.
                                                {{ number_format($detail->quantity * $detail->barang->hargaJual, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" style="text-align: right;">Total:</th>
                                <th>Rp.
                                    {{ number_format(
                                        $transactions->sum(function ($transaction) {
                                            return $transaction->details->sum(function ($detail) {
                                                return $detail->quantity * $detail->barang->hargaJual;
                                            });
                                        }),
                                        2,
                                        ',',
                                        '.',
                                    ) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <form method="GET" action="{{ route('transaksi-pos.print-filtered') }}" target="_blank">
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-success">Print</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-body">
                <div class="text-center">No transactions found for the selected date range.</div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                orientation: 'bottom'
            });
        });
    </script>
@endpush
