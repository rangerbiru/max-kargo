<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Max Kargo | Invoice</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  {{-- Core Css --}}
  <link rel="stylesheet" href="{{ asset('css/yeti.min.css') }}">

  {{-- Fonts --}}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container-fluid">
      <div class="row mt-5">
          <div class="col">
              <h2>
                  <i class="fa fa-truck"></i> MAX KARGO
                  <small class="float-right">{{ $task->created_at->format('d/m/Y') }}</small>
              </h2>
          </div>
      </div>
      <hr>
      <div class="row">
          <div class="col">
              PENGIRIM
              <address>
                  <strong>{{ $task->sender['name'] }}</strong><br />
                  {{ $task->sender['address'] }}<br />
                  Telepon: {{ $task->sender['phone'] }}<br />
                  Email: {{ $task->sender['email'] }}
              </address>
          </div>
          <div class="col">
              PENERIMA
              <address>
                  <strong>{{ $task->to['name'] }}</strong><br />
                  {{ $task->to['address'] }}<br />
                  Telepon: {{ $task->to['phone'] }}<br />
                  Email: {{ $task->to['email'] }}
              </address>
          </div>
          <div class="col">
              <h3 class="text-center"><strong>{{ $task->order_number }}</strong></h3>
              <p>
                  Kota Asal: {{ $task->cost->origin->name }} <br />
                  Kota Tujuan: {{ $task->cost->destination->name }}
              </p>
          </div>
      </div>

      <div class="row">
          <div class="col">
              <table class="table table-bordered">
                  <thead>
                      <tr class="text-center">
                          <th scope="col">Jenis Barang</th>
                          <th scope="col">Berat Barang</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr class="text-center">
                          <td scope="row">{{ $task->commodity->name }}</td>
                          <td>{{ $task->weight }} Kg</td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="row">
          <div class="col">
              <table class="table">
                  <tbody>
                      <tr>
                          <th scope="row">Metode Pembayaran</th>
                          <td width="1px">:</td>
                          <td><strong>{{ $task->payment['method'] }}</strong></td>
                      </tr>
                      <tr>
                          <th scope="row">Status Pembayaran</th>
                          <td width="1px">:</td>
                          <td>{!! ($task->payment['status'] == 1) ? '<strong>LUNAS</strong>' : '<strong>BELUM LUNAS</strong>' !!}</td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div class="col">
              <table class="table">
                  <tbody>
                      <tr>
                          <th scope="row">Biaya Kirim</th>
                          <td width="1px">:</td>
                          <td>{{ toRupiah($task->payment['total']) }}</td>
                      </tr>
                      <tr>
                          <th scope="row">Total</th>
                          <td width="1px">:</td>
                          <td>{{ toRupiah($task->payment['total']) }}</td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="row">
          <div class="col-6"></div>
          <div class="col-6">
              <table class="table table-bordered">
                  <tbody>
                      <tr>
                          <td>
                              <br />
                              <br />
                              <br />
                              <br />
                          </td>
                          <td>
                              <br />
                              <br />
                              <br />
                              <br />
                          </td>
                      </tr>
                      <tr class="text-center">
                          <td><strong>Petugas</strong></td>
                          <td><strong>Pengirim</strong></td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
</body>
</html>
