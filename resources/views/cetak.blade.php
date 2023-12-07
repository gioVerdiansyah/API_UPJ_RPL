<!DOCTYPE html>
<html lang="en">

<head>
    <title>Table V04</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1 text-center">Jenis <br> Pembelian</th>
                                <th class="cell100 column5 text-center">Tanggal <br> Pembelian</th>
                                <th class="cell100 column2">Harga Bahan</th>
                                <th class="cell100 column3">Harga Jasa</th>
                                <th class="cell100 column4">Total</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @forelse ($dataTransaksi as $item)
                                <tr class="row100 body">
                                    <td class="cell100 column1 pt-5">{{ $item->jenis }}</td>
                                    <td class="cell100 column2 pt-5">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="cell100 column3 pt-5">{{ $item->harga_bahan }}</td>
                                    <td class="cell100 column4 pt-5">{{ $item->harga_jasa }}</td>
                                    <td class="cell100 column5 pt-5">{{ $item->total }}</td>
                                </tr>
                            @empty
                                <tr class="row100 body">
                                    <td rowspan="5" class="cell100 column1 text-center pt-5">Belum ada data
                                        transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
            window.onafterprint = function() {
                window.close();
                window.history.back();
            };
        };
    </script>
</body>

</html>
