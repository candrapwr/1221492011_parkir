<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Transportation extends Controller
{
	private $tableOp = 'm_transportation';
	private $tableOpK = 'id';
	private $modulOp = 'transportation';
	
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
            'title' => 'Transportation Category',
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
            'title' => 'Edit Transportation Category',
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
		'description' => $request->description,
		'image' => $request->image,
		'code' => $request->code,
		'fee' => $request->fee
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
			'description' => $request->description,
			'image' => $request->image,
			'code' => $request->code,
			'fee' => $request->fee
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

