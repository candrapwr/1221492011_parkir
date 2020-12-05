<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Assigns extends Controller
{
	private $tableOp = 'p_user_assigns';
	private $tableOpK = 'id';
	private $modulOp = 'assigns';
	
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
        $modelLot = DB::table('p_parking_lot')->get();
			
        $modelData = DB::table($this->tableOp)
		->select($this->tableOp.'.*','users.name as jukir_name','p_parking_lot.name as parking_lot_name')
		->join('users',$this->tableOp.'.jukir','=','users.id')
		->join('p_parking_lot',$this->tableOp.'.parking_lot','=','p_parking_lot.id')
		//->where('is_deleted', '0')
		->orderBy('p_parking_lot.name', 'ASC')
        ->get();

        $data = array(
            'title' => 'Daftar Jukir',
            'modelJukir' => $modelJukir,
            'modelLot' => $modelLot,
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
        $modelLot = DB::table('p_parking_lot')->get();
		
        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Ubah Daftar Jukir',
            'modelJukir' => $modelJukir,
            'modelLot' => $modelLot,
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
            ->validate(['jukir' => 'required']);

        DB::table($this->tableOp)->insert([
		'jukir' => $request->jukir,
		'parking_lot' => $request->parking_lot,
		'created_by' => $request->created_by
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
			'jukir' => $request->jukir,
			'parking_lot' => $request->parking_lot,
			'created_by' => $request->created_by
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

