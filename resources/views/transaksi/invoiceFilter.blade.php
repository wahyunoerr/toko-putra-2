<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Filter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            margin: 0;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-details th,
        .invoice-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-details th {
            background-color: #f2f2f2;
        }

        .invoice-details td[rowspan] {
            vertical-align: middle;
            text-align: center;
        }

        .invoice-footer {
            text-align: right;
            margin-top: 20px;
        }

        @media print {
            .invoice-footer {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <p>From: {{ $start_date->format('d M Y') }} To: {{ $end_date->format('d M Y') }}</p>
        </div>
        <div class="invoice-details">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaction Date</th>
                        <th>Customer Name</th>
                        <th>Transaction Code</th>
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
                                    <td rowspan="{{ $rowSpan }}">{{ $loop->parent->iteration }}</td>
                                    <td rowspan="{{ $rowSpan }}">{{ $transaction->kode_transaksi }}</td>
                                    <td rowspan="{{ $rowSpan }}">{{ $transaction->created_at->format('d M Y') }}
                                    </td>
                                    <td rowspan="{{ $rowSpan }}">{{ $detail->customer->name }}</td>
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
                        <th colspan="7" style="text-align: right;">Total:</th>
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
        <div class="invoice-footer">
            <a href="#" class="btn-print" onclick="window.print()">
                <svg width="16" height="16">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-print') }}"></use>
                </svg>
            </a>
        </div>
    </div>
</body>

</html>
