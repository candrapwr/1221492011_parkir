<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Konfigurasi_model;
use Image;
use App\Pemesanan_model;
use App\Produk_model;
use PDF;

class Dasbor extends Controller
{
    // Index
    public function index()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	$mysite = new Konfigurasi_model();
		$site 	= $mysite->listing();
        $totalJukir    = DB::table('p_user_assigns')->count();
        
		$dataCart   = DB::select("
		SELECT 
			SUM(IF(month = 'Jan', total, 0)) AS 'a',
			SUM(IF(month = 'Feb', total, 0)) AS 'b',
			SUM(IF(month = 'Mar', total, 0)) AS 'c',
			SUM(IF(month = 'Apr', total, 0)) AS 'd',
			SUM(IF(month = 'May', total, 0)) AS 'e',
			SUM(IF(month = 'Jun', total, 0)) AS 'f',
			SUM(IF(month = 'Jul', total, 0)) AS 'g',
			SUM(IF(month = 'Aug', total, 0)) AS 'h',
			SUM(IF(month = 'Sep', total, 0)) AS 'i',
			SUM(IF(month = 'Oct', total, 0)) AS 'j',
			SUM(IF(month = 'Nov', total, 0)) AS 'k',
			SUM(IF(month = 'Dec', total, 0)) AS 'l'
			FROM (
		SELECT DATE_FORMAT(a.check_in, '%b') AS month, SUM(a.fee) as total
		FROM p_transactions a
		WHERE a.check_in <= NOW() and a.check_in >= Date_add(Now(),interval - 12 month)
		GROUP BY DATE_FORMAT(a.check_in, '%m-%Y')) as sub		
		");
		$dataPie   = DB::select("
		SELECT a.territory_name,SUM(a.fee) AS fee FROM p_transactions a 
		WHERE YEAR(a.check_in)=YEAR(NOW())
		GROUP BY a.territory_name		
		");
		$totalTahun   = DB::select("
		SELECT SUM(a.fee) AS fee FROM p_transactions a 
		WHERE YEAR(a.check_in)=YEAR(NOW())		
		");
		$totalBulan   = DB::select("
		SELECT SUM(a.fee) AS fee FROM p_transactions a 
		WHERE YEAR(a.check_in)=YEAR(NOW()) AND 	MONTH(a.check_in)=MONTH(NOW())	
		");	
		$modelDataTG  = DB::select("
		SELECT 
		CAST(a.check_in AS DATE) AS dates,
		a.parking_lot_name,
		SUM(a.fee) AS fee,
		(a.parking_lot_target_daily_profit) AS target,
		(SUM(a.fee)/(a.parking_lot_target_daily_profit))*100 AS capai
		FROM p_transactions a 
		GROUP BY CAST(a.check_in AS DATE),a.parking_lot	
		ORDER BY CAST(a.check_in AS DATE) DESC
		");		
		$data = array(  'title'     => '',
                        'totalJukir' => $totalJukir,
                        'dataCart'=> $dataCart[0],
                        'totalTahun'=> $totalTahun[0],
                        'totalBulan'=> $totalBulan[0],
                        'dataPie'=> $dataPie,
                        'modelDataTG'=> $modelDataTG,
                        'content'   => 'admin/dasbor/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
}
