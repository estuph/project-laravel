 @extends('layouts.master')

@section('title', 'Dashboard Admin')
@section('top', 'Dashboard Admin')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-box"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Produk</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalProducts }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Varian</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalVariants }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pengguna</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalUsers }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pendapatan</h4>
                    </div>
                    <div class="card-body" style="font-size: 17px">
                        {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
        <form method="GET" action="{{ route('admin.dashboard') }}">
            <div class="form-group">
                <label for="tanggal_awal">Tanggal Awal:</label>
                <input type="date" id="tanggal_awal" name="tanggal_awal" value="{{ request('tanggal_awal', $tanggal_awal) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="tanggal_akhir">Tanggal Akhir:</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir', $tanggal_akhir) }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        
    </div>
</div>
@endsection





