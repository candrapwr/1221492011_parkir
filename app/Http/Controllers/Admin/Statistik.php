<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Statistik extends Controller
{
	private $tableOp = '';
	private $tableOpK = 'id';
	private $modulOp = 'statistik';

	public function index()
	{
		if (Session()->get('username') == "") {
			return redirect('login')
				->with(['warning' => 'Mohon maaf, Anda belum login']);
		}

		$data = array(
			'title' => 'Statistik',
			'content' => 'admin/' . $this->modulOp . '/index'
		);
		return view('admin/layout/wrapper', $data);
	}
	public function data(Request $request)
	{
		if (Session()->get('username') == "") {
			return redirect('login')
				->with(['warning' => 'Mohon maaf, Anda belum login']);
		}
		if($request->mode=='bulan'){
			$data   = DB::select("
						SELECT
						hari.tanggal as label,
						(SELECT IFNULL(SUM(t1.fee),0) FROM p_transactions t1 WHERE CAST(t1.check_in AS DATE)=hari.tanggal) AS total
						FROM 
						(
							SELECT tanggal
							FROM
							(
								SELECT
									MAKEDATE(YEAR('".$request->date."-01'),1) +
									INTERVAL (MONTH('".$request->date."-01')-1) MONTH +
									INTERVAL daynum DAY tanggal
								FROM
								(
									SELECT t*10+u daynum
									FROM
										(SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
										(SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
										UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
										UNION SELECT 8 UNION SELECT 9) B
									ORDER BY daynum
								) AA
							) AAA
							WHERE MONTH(tanggal) = MONTH('".$request->date."-01')
						) hari
			");		
			$out = json_encode($data);
			return $out;
		}elseif($request->mode=='tahun'){
			$data   = DB::select("
					SELECT
					bulan.label_bulan as label,
					(SELECT IFNULL(SUM(t1.fee),0) FROM p_transactions t1 WHERE YEAR(t1.check_in)='".$request->date."' AND MONTH(t1.check_in)=bulan.nila_bulan) AS total
					FROM 
					(
						SELECT 'Januari' AS label_bulan, 1 AS nila_bulan 
						UNION
						SELECT 'Februari' AS label_bulan, 2 AS nila_bulan 
						UNION
						SELECT 'Maret' AS label_bulan, 3 AS nila_bulan 
						UNION
						SELECT 'April' AS label_bulan, 4 AS nila_bulan 
						UNION
						SELECT 'Mei' AS label_bulan, 5 AS nila_bulan 
						UNION
						SELECT 'Juni' AS label_bulan, 6 AS nila_bulan 
						UNION
						SELECT 'Juli' AS label_bulan, 7 AS nila_bulan 
						UNION
						SELECT 'Agustus' AS label_bulan, 8 AS nila_bulan 
						UNION
						SELECT 'September' AS label_bulan, 9 AS nila_bulan 
						UNION
						SELECT 'Oktober' AS label_bulan, 10 AS nila_bulan 
						UNION
						SELECT 'November' AS label_bulan, 11 AS nila_bulan 
						UNION
						SELECT 'Desember' AS label_bulan, 12 AS nila_bulan 
					) bulan
			");		
			$out = json_encode($data);
			return $out;			
		}elseif($request->mode=='hari'){
			$data   = DB::select("
				SELECT DATE_FORMAT(a.check_in, \"%H:%i\") AS label,SUM(a.fee) AS total FROM p_transactions a 
				WHERE CAST(a.check_in AS DATE)='".$request->date."'
				GROUP BY DATE_FORMAT(a.check_in, \"%H:%i\")
			");		
			$out = json_encode($data);
			return $out;			
		}
	}
}
