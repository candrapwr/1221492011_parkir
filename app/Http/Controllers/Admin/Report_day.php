<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Report_day extends Controller
{
	private $tableOp = 'p_transactions';
	private $tableOpK = 'id';
	private $modulOp = 'report_day';
	
    public function v_report_day()
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
	
        $data = array(
            'title' => 'Laporan Detail Transaksi',
            'content' => 'admin/'.$this->modulOp.'/index'
        );
        return view('admin/layout/wrapper', $data);
    }
    public function r_report_day(Request $request)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
		$modelData   = DB::select("
		SELECT a.*,CAST(a.check_in AS DATE) AS dates FROM p_transactions a
		WHERE CAST(a.check_in AS DATE) BETWEEN '".$request->tgl1."' AND '".$request->tgl2."'
		");

        $data = array(
            'modelData' => $modelData
        );
        return view('admin/'.$this->modulOp.'/r_report_day', $data);
    }
    public function v_report_rekap()
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
	
        $data = array(
            'title' => 'Rekap Transaksi Bulanan',
            'content' => 'admin/'.$this->modulOp.'/index2'
        );
        return view('admin/layout/wrapper', $data);
    }
	
    public function r_report_rekap_a(Request $request)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
		
		$pisah = explode("-",$request->bulan);
		
		$modelData   = DB::select("
		SELECT CAST(a.check_in AS DATE) AS dates,a.parking_lot_name,a.territory_name,SUM(a.fee) AS fee FROM p_transactions a
		WHERE YEAR(a.check_in)='".$pisah[0]."' AND MONTH(a.check_in)='".$pisah[1]."'
		GROUP BY CAST(a.check_in AS DATE),a.parking_lot_name,a.territory_name
		ORDER BY CAST(a.check_in AS DATE)		
		");

        $data = array(
            'modelData' => $modelData
        );
        return view('admin/'.$this->modulOp.'/r_report_rekap_a', $data);
    }

    public function r_report_rekap_w(Request $request)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
		
		$pisah = explode("-",$request->bulan);
		
		$modelData   = DB::select("
		SELECT CAST(a.check_in AS DATE) AS dates,a.territory_name,SUM(a.fee) AS fee FROM p_transactions a
		WHERE YEAR(a.check_in)='".$pisah[0]."' AND MONTH(a.check_in)='".$pisah[1]."'
		GROUP BY CAST(a.check_in AS DATE),a.territory_name
		ORDER BY CAST(a.check_in AS DATE)		
		");

        $data = array(
            'modelData' => $modelData
        );
        return view('admin/'.$this->modulOp.'/r_report_rekap_w', $data);
    }
	
    public function r_report_rekap(Request $request)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
		
		$pisah = explode("-",$request->bulan);
		
		$modelData   = DB::select("
		SELECT CAST(a.check_in AS DATE) AS dates,SUM(a.fee) AS fee FROM p_transactions a
		WHERE YEAR(a.check_in)='".$pisah[0]."' AND MONTH(a.check_in)='".$pisah[1]."'
		GROUP BY CAST(a.check_in AS DATE)
		ORDER BY CAST(a.check_in AS DATE)
		");

        $data = array(
            'modelData' => $modelData
        );
        return view('admin/'.$this->modulOp.'/r_report_rekap', $data);
    }
}

