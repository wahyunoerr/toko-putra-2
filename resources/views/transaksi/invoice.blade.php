<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }

        .invoice-header img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 20px;
        }

        .btn-print {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
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
            <img src="{{ asset('logo.png') }}" alt="Company Logo">
            <h1>Invoice</h1>
        </div>
        <div class="invoice-details">
            <p><strong>Customer Name:</strong> {{ $transaction->details->first()->customer->name }}</p>
            <p><strong>Transaction Date:</strong> {{ $transaction->created_at->format('d M Y') }}</p>
            <p><strong>Transaction Time:</strong> {{ $transaction->created_at->format('H:i:s') }}</p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Barang</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->details as $detail)
                    <tr>
                        <td>{{ $transaction->kode_transaksi }}</td>
                        <td>{{ $detail->barang->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp. {{ number_format($detail->barang->hargaJual, 2, ',', '.') }}</td>
                        <td>Rp. {{ number_format($detail->quantity * $detail->barang->hargaJual, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align: right;">Total:</th>
                    <th>Rp.
                        {{ number_format(
                            $transaction->details->sum(function ($detail) {
                                return $detail->quantity * $detail->barang->hargaJual;
                            }),
                            2,
                            ',',
                            '.',
                        ) }}
                    </th>
                </tr>
            </tfoot>
        </table>
        <div class="invoice-footer">
            <a class="btn-print" href="{{ route('transaksi-pos.index') }}">
                <svg width="16" height="16">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-arrow-left') }}"></use>
                </svg>
            </a>
            <a href="#" class="btn-print" onclick="window.print()">
                <svg width="16" height="16">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-print') }}"></use>
                </svg>
            </a>
        </div>
        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>

</html>
