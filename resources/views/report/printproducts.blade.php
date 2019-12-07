<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penjualan</title>
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/report.css') }}">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center">Koperasi Sumber Baru Jaya</h1>
			<h2 class="text-center">Laporan Penjualan</h2>
			Waktu : {{ $waktu }}
			<br>
			<br>
			<table class="table table-bordered">
				<thead>
					<th width="10px">No.</th>
	                <th>Produk</th>
	                <th>Harga Beli (Rp)</th>
		            <th>Harga Jual (Rp)</th>
		            <th>Laba (Rp)</th>
	                <th>Kuantitas</th>
				</thead>
				<tbody>
					<?php 
	                  $no = 1;
	                  $modal = 0;
	                  $omset = 0;
	                  $income = 0;
	                ?>
					@foreach($data as $d)
						<tr>
							<td>{{ $no }}</td>
			                <td>{{ $d->name }}</td>
			                <td>{{ rupiah($d->price) }}</td>
		                    <td>{{ rupiah($d->sell_price) }}</td>
		                    <td>{{ rupiah($d->sell_price-$d->price) }}</td>
			                <td>{{ $d->quantity }}</td>
						</tr>
					<?php 
	                  $no++; 
	                  $modal += $d->price;
	                  $omset += $d->sell_price;
	                  $income += $d->sell_price-$d->price;
	                ?>
					@endforeach
				</tbody>
			</table>
			<table>
				<tr>
					<td width="200px"><strong>Total Modal</strong></td>
					<td>Rp. {{ rupiah($modal) }}</td>
				</tr>
				<tr>
					<td><strong>Omset</strong></td>
					<td>Rp. {{ rupiah($omset) }}</td>
				</tr>
				<tr>
					<td><strong>Laba yang didapat</strong></td>
					<td>Rp. {{ rupiah($income) }}</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>