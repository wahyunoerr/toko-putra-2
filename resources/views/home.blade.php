<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>

    @extends('layouts.app')

    @section('title', 'Dashboard')

    @section('content')
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Dashboard</h5>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <!-- Total Transaksi -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card text-white bg-primary shadow-sm rounded-3">
                            <div class="card-body d-flex align-items-center p-4">
                                <i class="bi bi-cart-check-fill fs-1 me-3"></i>
                                <div>
                                    <h4 class="fw-bold mb-1">{{ number_format($transaction) }}</h4>
                                    <p class="mb-0">Total Transaksi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pendapatan Kotor -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card text-white bg-success shadow-sm rounded-3">
                            <div class="card-body d-flex align-items-center p-4">
                                <i class="bi bi-cash-stack fs-1 me-3"></i>
                                <div>
                                    <h4 class="fw-bold mb-1">Rp {{ number_format($TPkotor, 0, ',', '.') }}</h4>
                                    <p class="mb-0">Pendapatan Kotor</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pendapatan Bersih -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card text-white bg-danger shadow-sm rounded-3">
                            <div class="card-body d-flex align-items-center p-4">
                                <i class="bi bi-graph-up-arrow fs-1 me-3"></i>
                                <div>
                                    <h4 class="fw-bold mb-1">Rp {{ number_format($TPbersih, 0, ',', '.') }}</h4>
                                    <p class="mb-0">Pendapatan Bersih</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>