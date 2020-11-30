<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
	private $tableOp = 'users';
	private $tableOpK = 'id';
	private $modulOp = 'user';
	//Hash::check('pejuang45', '$2y$10$wB.SigBLt3C6al0msnmKhOJn1kKi5cZUIrXkNg.MMo4TrNcIJ8jtW');
	
    public function index()
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelRole = DB::table('role')->get();
			
        $modelData = DB::table($this->tableOp)
		->select($this->tableOp.'.*','role.name as role_name')
		->join('role',$this->tableOp.'.role','=','role.id')
		//->where('is_deleted', '0')
		->orderBy($this->tableOp.'.id', 'ASC')
        ->get();

        $data = array(
            'title' => 'User Management',
            'modelRole' => $modelRole,
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
        $modelTerritory = DB::table('p_territory')->get();
		
        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Edit Fee Rates',
            'modelTerritory' => $modelTerritory,
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
            ->validate(['name' => 'required']);

        DB::table($this->tableOp)->insert([
		'username' => $request->username,
		'id_smartparkir' => $request->id_smartparkir,
		'npp' => $request->npp,
		'name' => $request->name,
		'address' => $request->address,
		'phone_number' => $request->phone_number,
		'role' => $request->role,
		'password' => Hash::make($request->password)
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
            ->validate(['name' => 'required']);

		DB::table($this->tableOp)
			->where($this->tableOpK, $request->id)
			->update([
			'name' => $request->name,
			'address' => $request->address,
			'lat' => $request->lat,
			'lng' => $request->lng,
			'territory' => $request->territory,
			'target_daily_profit' => $request->target_daily_profit,
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

