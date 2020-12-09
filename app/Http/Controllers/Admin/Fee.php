<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Fee extends Controller
{
    private $tableOp = 'p_fee';
    private $tableOpK = 'id';
    private $modulOp = 'fee';

    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelTransportation = DB::table('m_transportation')->get();
        $modelTerritory = DB::table('p_territory')->get();

        $modelData = DB::table($this->tableOp)
            ->select($this->tableOp . '.*', 'm_transportation.name as transportation_name', 'p_territory.name as territory_name', 'users.name as created_by_name')
            ->join('m_transportation', $this->tableOp . '.transportation', '=', 'm_transportation.id')
            ->join('p_territory', $this->tableOp . '.territory', '=', 'p_territory.id')
            ->join('users', $this->tableOp . '.created_by', '=', 'users.id')
            //->where('is_deleted', '0')
            ->orderBy('p_territory.name', 'ASC')
            ->get();

        $data = array(
            'title' => 'Tarif Parkir',
            'modelTransportation' => $modelTransportation,
            'modelTerritory' => $modelTerritory,
            'modelData' => $modelData,
            'content' => 'admin/' . $this->modulOp . '/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    public function edit($id)
    {
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelTransportation = DB::table('m_transportation')->get();
        $modelTerritory = DB::table('p_territory')->get();

        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Ubah Tarif Parkir',
            'modelTransportation' => $modelTransportation,
            'modelTerritory' => $modelTerritory,
            'modelData' => $modelData,
            'content' => 'admin/' . $this->modulOp . '/edit'
        );
        return view('admin/layout/wrapper', $data);
    }

    public function tambah(Request $request)
    {
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()
            ->validate(['fee' => 'required']);

        DB::table($this->tableOp)->insert([
			'fee' => $request->fee,
			'transportation' => $request->transportation,
			'quota' => $request->quota,
			'territory' => $request->territory,
			'created_by' => $request->created_by
        ]);
        return redirect('admin/' . $this->modulOp . '')
            ->with(['sukses' => 'Data has been added']);
    }

    public function proses_edit(Request $request)
    {
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()
            ->validate(['fee' => 'required']);

        DB::table($this->tableOp)
            ->where($this->tableOpK, $request->id)
            ->update([
				'fee' => $request->fee,
				'quota' => $request->quota,
				'transportation' => $request->transportation,
				'territory' => $request->territory,
				'created_by' => $request->created_by
            ]);
        return redirect('admin/' . $this->modulOp . '')
            ->with(['sukses' => 'Data has update']);
    }

    public function delete($id)
    {
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table($this->tableOp)
            ->where($this->tableOpK, Crypt::decrypt($id))->delete();
        return redirect('admin/' . $this->modulOp . '')
            ->with(['sukses' => 'Data has been deleted']);
    }

    public function sdelete($id)
    {
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        DB::table($this->tableOp)
            ->where($this->tableOpK, Crypt::decrypt($id))
            ->update(['is_deleted' => '1']);

        return redirect('admin/' . $this->modulOp . '')
            ->with(['sukses' => 'Data has been deleted']);
    }
}
