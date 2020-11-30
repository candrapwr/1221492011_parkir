<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Userdevices extends Controller
{
	private $tableOp = 'devices_users';
	private $tableOpK = 'id';
	private $modulOp = 'userdevices';
	
    public function index()
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
		
        $modelJukir = DB::table('users')
		->where('role', '2')
		->get();
        $modelDevice = DB::table('devices')->get();
			
        $modelData = DB::table($this->tableOp)
		->select($this->tableOp.'.*','users.name as jukir_name','devices.serial_number as device_name')
		->join('users',$this->tableOp.'.user','=','users.id')
		->join('devices',$this->tableOp.'.device','=','devices.id')
		//->where('is_deleted', '0')
		->orderBy('users.name', 'ASC')
        ->get();

        $data = array(
            'title' => 'Jukir Device',
            'modelJukir' => $modelJukir,
            'modelDevice' => $modelDevice,
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
        $modelJukir = DB::table('users')
		->where('role', '2')
		->get();
        $modelDevice = DB::table('devices')->get();
		
        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Edit Jukir Device',
            'modelJukir' => $modelJukir,
            'modelDevice' => $modelDevice,
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
            ->validate(['user' => 'required']);

        DB::table($this->tableOp)->insert([
		'user' => $request->user,
		'device' => $request->device
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
            ->validate(['jukir' => 'required']);

		DB::table($this->tableOp)
			->where($this->tableOpK, $request->id)
			->update([
			'user' => $request->user,
			'device' => $request->device
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

