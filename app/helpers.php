<?php

function appName()
{
	return 'Koperasi Sumber Baru Jaya';
}

function title()
{
	return ' | '.appName();
}

function eng_date($date)
{
	return substr($date, 6, 4).'/'.substr($date, 0, 2).'/'.substr($date, 3, 2);
}

function eng_date2($date)
{
	return substr($date, 5, 2).'/'.substr($date, 8, 2).'/'.substr($date, 0, 4);
}

function month_name($month)
{
	switch ($month) {
		case '01':
			return 'Januari';
			break;
		case '02':
			return 'Februari';
			break;
		case '03':
			return 'Maret';
			break;
		case '04':
			return 'April';
			break;
		case '05':
			return 'Mei';
			break;
		case '06':
			return 'Juni';
			break;
		case '07':
			return 'Juli';
			break;
		case '08':
			return 'Agustus';
			break;
		case '09':
			return 'September';
			break;
		case '10':
			return 'Oktober';
			break;
		case '11':
			return 'November';
			break;
		case '12':
			return 'Desember';
			break;
		
		default:
			return 'Tidak valid!!!';
			break;
	}
}

function indo_date($date)
{
	return substr($date, 8, 2).' '.month_name(substr($date, 5, 2)).' '.substr($date, 0, 4);
}

function indo_date_time($datetime)
{
	return indo_date($datetime).' '.substr($datetime, 10);
}

function upper($string)
{
	return ucwords(strtolower($string));
}

function rupiah($duit)
{
	return number_format($duit, 0, ',', '.');
}

function add_btn($url)
{
	echo '<a data-toggle="tooltip" title="Tambah" href="'.$url.'" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>';
}

function edit_btn($url, $t = 'Ubah')
{
	echo '<a data-toggle="tooltip" title="'.$t.'" href="'.$url.'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>';
}

function delete_btn($id)
{
	echo '<a data-toggle="tooltip" title="Hapus" href="#" onclick="remove(\''.$id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
}

function reset_btn($id)
{
	echo '<a data-toggle="tooltip" title="Reset Password" href="#" onclick="reset(\''.$id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i></a>';
}

function submit_btn()
{
	echo '<button data-toggle="tooltip" title="Simpan" type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-check"></i></button>';
}

function restore_btn($id)
{
	echo '<a data-toggle="tooltip" title="Kembalikan" href="#" onclick="restore(\''.$id.'\')" class="btn btn-primary btn-sm"><i class="fa fa-rotate-left"></i></a>';
}

function print_btn($url)
{
	echo '<a data-toggle="tooltip" title="Cetak" href="'.$url.'" class="btn btn-primary btn-sm pull-right"><i class="fa fa-print"></i></a>';
}