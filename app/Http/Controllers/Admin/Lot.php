<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Lot extends Controller
{
	private $tableOp = 'p_parking_lot';
	private $tableOpK = 'id';
	private $modulOp = 'lot';
	
    public function index()
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelTerritory = DB::table('p_territory')->get();
			
        $modelData = DB::table($this->tableOp)
		->select($this->tableOp.'.*','p_territory.name as territory_name','users.name as created_by_name')
		->join('p_territory',$this->tableOp.'.territory','=','p_territory.id')
		->join('users',$this->tableOp.'.created_by','=','users.id')
		//->where('is_deleted', '0')
		->orderBy('p_territory.name', 'ASC')
        ->get();

        $data = array(
            'title' => 'Area Parkir',
            'modelTerritory' => $modelTerritory,
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
            'title' => 'Ubah Area Parkir',
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
		'name' => $request->name,
		'address' => $request->address,
		'lat' => $request->lat,
		'lng' => $request->lng,
		'territory' => $request->territory,
		'target_daily_profit' => $request->target_daily_profit,
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

