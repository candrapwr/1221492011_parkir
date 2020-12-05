<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Assignspengawas extends Controller
{
	private $tableOp = 'p_pengawas_assigns';
	private $tableOpK = 'id';
	private $modulOp = 'assignspengawas';
	
    public function index()
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
		
        $modelUser = DB::table('users')
		->where('role', '1')
		->get();
        $modelT = DB::table('p_territory')->get();
			
        $modelData = DB::table($this->tableOp)
		->select($this->tableOp.'.*','users.name as pengawas_name','p_territory.name as territory_name')
		->join('users',$this->tableOp.'.pengawas','=','users.id')
		->join('p_territory',$this->tableOp.'.territory','=','p_territory.id')
		//->where('is_deleted', '0')
		->orderBy('p_territory.name', 'ASC')
        ->get();

        $data = array(
            'title' => 'Wilayah Pengawas',
            'modelUser' => $modelUser,
            'modelT' => $modelT,
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
        $modelUser = DB::table('users')
		->where('role', '1')
		->get();
        $modelT = DB::table('p_territory')->get();
		
        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Ubah Wilayah Pengawas',
            'modelUser' => $modelUser,
            'modelT' => $modelT,
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
            ->validate(['pengawas' => 'required']);
			
        DB::beginTransaction();
        try {
            DB::table($this->tableOp)->insert([
                'pengawas' => $request->pengawas,
                'territory' => $request->territory,
                'created_by' => Session()->get('id_user')
            ]);
            DB::commit();
            $this->respon['sukses'] = 'Berhasil';
        } catch (\Exception $e) {
            DB::rollback();
            $this->respon['warning'] = $e->getMessage();
        }
		
        return redirect('admin/' . $this->modulOp . '')
            ->with($this->respon);
    }

    public function proses_edit(Request $request)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()
            ->validate(['pengawas' => 'required']);

        DB::beginTransaction();
        try {
			DB::table($this->tableOp)
				->where($this->tableOpK, $request->id)
				->update([
                'pengawas' => $request->pengawas,
                'territory' => $request->territory,
                'created_by' => Session()->get('id_user')
				]);
            DB::commit();
            $this->respon['sukses'] = 'Berhasil';
        } catch (\Exception $e) {
            DB::rollback();
            $this->respon['warning'] = $e->getMessage();
        }

        return redirect('admin/' . $this->modulOp . '')
            ->with($this->respon);
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

