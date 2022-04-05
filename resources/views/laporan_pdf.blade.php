<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<center>

    <h3>XI LAUNDRY</h3>
</center>
<p>Nota Pembayaran Laundry :</p>
<body>
    <div class="container mt-4">
       
        <table class="table table-striped table-bordered">
            <tr>
                <th>Nama Member</th>
                @foreach ($member as $members)
                <td>{{$members->nama_member}}</td>
                @endforeach
            </tr>
            <tr>
              
              <th>Paket</th>
              @foreach ($paket as $pakets)
                  
              <td>{{$pakets->jenis}}</td>
              @endforeach
            </tr>
            <tr>
                <th>Tanggal Transaksi</th>
                <td>{{$transaksi->tgl}}</td>
            </tr>
            <tr>
                <th>Batas Waktu</th>
                <td>{{$transaksi->batas_waktu}}</td>
            </tr>
              <tr>
                  <th>Status</th>
                  <td>{{$transaksi->status}}</td>
              </tr>
              <tr>
                  <th>Pembayaran</th>
                  <td>{{$transaksi->dibayar}}</td> 
              </tr>
              <tr>
                  <th>Berat (Kg)</th>
                  <td>{{$transaksi->qty}} Kg</td>
              </tr>
              <tr>
                  <th>Harga</th>
                  @foreach ($detail as $details)
                  <td>{{$details->qty}}</td>
                  @endforeach
              </tr>
      

          </table>
    </div>
</body>

</html>