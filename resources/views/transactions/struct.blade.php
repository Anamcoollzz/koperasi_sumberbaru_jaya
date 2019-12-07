<!DOCTYPE html>
<html>
<head>
	<title>Struk Penjualan</title>
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<h4 class="text-center">{{ appName() }}</h4>
			<strong>No nota :</strong> {{ $nota }}
			<table class="table">
				<thead>
					<th>No</th>
					<th>Produk</th>
					<th class="text-right">Harga (Rp)</th>
					<th class="text-right">Qty</th>
					<th class="text-right">Subtotal (Rp)</th>
				</thead>
				<tbody>
					<?php 
						$no = 1;
						$total = 0;
					?>
					@foreach($data as $d)
						<tr>
							<td>{{ $no }}</td>
							<td>{{ $d->name }}</td>
							<td class="text-right">{{ rupiah($d->sell_price) }}</td>
							<td class="text-right">{{ $d->quantity }}</td>
							<td class="text-right">{{ rupiah($d->sell_price*$d->quantity) }}</td>
						</tr>
					<?php 
						$no++;
						$payin = $d->payin;
						$total += $d->sell_price*$d->quantity;
					?>
					@endforeach
					<tr>
						<td colspan="4" class="text-right"><strong>Total</strong></td>
						<td class="text-right">{{ rupiah($total) }}</td>
					</tr>
					<tr>
						<td colspan="4" class="text-right"><strong>Pembayaran</strong></td>
						<td class="text-right">{{ rupiah($payin) }}</td>
					</tr>
					<tr>
						<td colspan="4" class="text-right"><strong>Kembalian</strong></td>
						<td class="text-right">{{ rupiah($payin-$total) }}</td>
					</tr>
				</tbody>
			</table>
			<p class="text-center">Terima kasih sudah berbelanja :)</p>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>