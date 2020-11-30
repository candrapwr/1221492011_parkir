<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Devices extends Controller
{
	private $tableOp = 'devices';
	private $tableOpK = 'id';
	private $modulOp = 'devices';
	
    public function index()
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelData = DB::table($this->tableOp)->orderBy($this->tableOpK, 'DESC')
            ->get();

        $data = array(
            'title' => 'Devices Management',
            'modelData' => $modelData,
            'content' => 'admin/'.$this->modulOp.'/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    public function edit($id)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Edit Devices',
            'modelData' => $modelData,
            'content' => 'admin/'.$this->modulOp.'/edit'
        );
        return view('admin/layout/wrapper', $data);
    }

    public function tambah(Request $request)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()
            ->validate(['serial_number' => 'required']);

        DB::table($this->tableOp)->insert([
		'serial_number' => $request->serial_number,
		'printer_serial_no' => $request->printer_serial_no,
		'printer_service_version' => $request->printer_service_version,
		'printer_firmware_version' => $request->printer_firmware_version,
		'printer_model' => $request->printer_model
		]);
        return redirect('admin/'.$this->modulOp.'')
            ->with(['sukses' => 'Data has been added']);
    }

    public function proses_edit(Request $request)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()
            ->validate(['serial_number' => 'required']);

		$slug_user = str_slug($request->nama, '-');
		DB::table($this->tableOp)
			->where($this->tableOpK, $request->id)
			->update([
			'serial_number' => $request->serial_number,
			'printer_serial_no' => $request->printer_serial_no,
			'printer_service_version' => $request->printer_service_version,
			'printer_firmware_version' => $request->printer_firmware_version,
			'printer_model' => $request->printer_model
			]);
        return redirect('admin/'.$this->modulOp.'')
            ->with(['sukses' => 'Data has update']);
    }

    public function delete($id)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table($this->tableOp)
            ->where($this->tableOpK, Crypt::decrypt($id))->delete();
        return redirect('admin/'.$this->modulOp.'')
            ->with(['sukses' => 'Data has been deleted']);
    }
	
    public function sdelete($id)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

		DB::table($this->tableOp)
			->where($this->tableOpK, Crypt::decrypt($id))
			->update(['is_deleted' => '1']);
			
        return redirect('admin/'.$this->modulOp.'')
            ->with(['sukses' => 'Data has been deleted']);
    }
}

