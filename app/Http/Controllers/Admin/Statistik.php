<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Statistik extends Controller
{
	private $tableOp = 'p_transactions';
	private $tableOpK = 'id';
	private $modulOp = 'statistik';

	public function index()
	{
		if (Session()->get('username') == "") {
			return redirect('login')
				->with(['warning' => 'Mohon maaf, Anda belum login']);
		}

		Session()->put('date_filter', '2020-11-28');

		$modelData   = DB::select("
		SELECT a.*,CAST(a.check_in AS DATE) as dates FROM p_transactions a 
		WHERE CAST(a.check_in AS DATE)='" . Session()->get('date_filter') . "'
		");
		$modelDataJ   = DB::select("
		SELECT 
		CAST(a.check_in AS DATE) as dates,
		a.jukir_name,
		SUM(a.fee) as fee
		FROM p_transactions a
		WHERE CAST(a.check_in AS DATE)='" . Session()->get('date_filter') . "'
		GROUP BY CAST(a.check_in AS DATE),a.jukir_id
		");
		$modelDataAP  = DB::select("
		SELECT 
		CAST(a.check_in AS DATE) as dates,
		a.parking_lot_name,
		SUM(a.fee) as fee
		FROM p_transactions a
		WHERE CAST(a.check_in AS DATE)='" . Session()->get('date_filter') . "'
		GROUP BY CAST(a.check_in AS DATE),a.parking_lot
		");
		$modelDataTK  = DB::select("
		SELECT 
		CAST(a.check_in AS DATE) as dates,
		a.transportation_name,
		SUM(a.fee) as fee
		FROM p_transactions a
		WHERE CAST(a.check_in AS DATE)='" . Session()->get('date_filter') . "'
		GROUP BY CAST(a.check_in AS DATE),a.transportation_name
		");
		$data = array(
			'title' => 'Statistik',
			'modelData' => $modelData,
			'modelDataJ' => $modelDataJ,
			'modelDataAP' => $modelDataAP,
			'modelDataTK' => $modelDataTK,
			'content' => 'admin/' . $this->modulOp . '/index'
		);
		return view('admin/layout/wrapper', $data);
	}
}
