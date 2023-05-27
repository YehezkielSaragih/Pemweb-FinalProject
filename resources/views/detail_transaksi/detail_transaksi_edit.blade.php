<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Aneka ATK - Detail Transaksi</title>
    <!-- Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-primary bg-light sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/home">Toko Aneka ATK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Content -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <div class="navbar-nav">
                    <!-- Transaksi -->
                    <a class="nav-item nav-link" href="/transaksi/transaksi_table">Transaksi</a>
                    <!-- Detail Transaksi -->
                    <a class="nav-item nav-link active" href="/detail_transaksi/detail_transaksi_table">Detail Transaksi</a>                         
                    <!-- Barang -->
                    <a class="nav-item nav-link" href="/barang/barang_table">Barang</a>                    
                    <!-- Kategori -->
                    <a class="nav-item nav-link" href="/kategori/kategori_table">Kategori</a>
                </div>
                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Form Card -->
    <div class="container">
        <div class="card">
            <div class="card-header">Update Data Detail Transaksi {{ $edit->id_transaksi }}</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <!-- Error Message -->
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <!-- Success Message -->
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <!-- Create function redirect back to /detail_transaksi/detail_transaksi_table -->
                    <form action="{{ route('detail_transaksi.update', ['id' => $editId]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" value="{{ $edit->nama_barang }}" required>
                        <label for="jumlah-barang">Jumlah Barang</label>
                        <input type="number" class="form-control" name="jumlah_barang" value="{{ $edit->jumlah_barang }}" required>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Table -->
    <div class="container">
        <div class="card">
            <div class="card-header">Tabel Data Detail Transaksi</div>
            <table class="table table-bordered mt-3" id="detail_transaksi">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>ID Detail Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Harga Barang Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Variable declaration -->
                    @php
                        $previousIdTransaksi = null;
                        $rowspanCount = 0;
                    @endphp
                    <!-- Loop -->
                    @foreach($data as $index => $row)
                        <!-- Rowspan  -->
                        @if($row['id_transaksi'] !== $previousIdTransaksi)
                            <!-- Reset rowspan count -->
                            @php
                                $rowspanCount = 0;
                                $nextIndex = $index;
                                while ($nextIndex < count($data) && $data[$nextIndex]['id_transaksi'] === $row['id_transaksi']) {
                                    $rowspanCount++;
                                    $nextIndex++;
                                }
                            @endphp
                            <!-- Print -->
                            <tr>
                                <td rowspan="{{ $rowspanCount }}">{{ $row['id_transaksi'] }}</td>
                                <td>{{ $row['id_detail_transaksi'] }}</td>
                                <td>{{ $row['nama_barang'] }}</td>
                                <td>{{ $row['jumlah_barang'] }}</td>
                                <td>{{ $row['harga_barang_transaksi'] }}</td>
                            </tr>
                        <!-- Non rowspan -->
                        @else
                            <!-- Print -->
                            <tr>
                                <td>{{ $row['id_detail_transaksi'] }}</td>
                                <td>{{ $row['nama_barang'] }}</td>
                                <td>{{ $row['jumlah_barang'] }}</td>
                                <td>{{ $row['harga_barang_transaksi'] }}</td>
                            </tr>
                        @endif
                        @php
                            $previousIdTransaksi = $row['id_transaksi'];
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <div id="detail_transaksi">{{ $data->links() }}</div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>