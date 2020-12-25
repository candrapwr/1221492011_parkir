<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Quota extends Controller
{
    private $tableOp = 'p_quota';
    private $tableOpK = 'id';
    private $modulOp = 'quota';

    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelTransportation = DB::table('m_transportation')->get();
        $modelLot = DB::table('p_parking_lot')->get();

        $modelData = DB::table($this->tableOp)
            ->select($this->tableOp . '.*', 'm_transportation.name as transportation_name', 'p_parking_lot.name as parking_lot_name')
            ->join('m_transportation', $this->tableOp . '.transportation', '=', 'm_transportation.id')
            ->join('p_parking_lot', $this->tableOp . '.parking_lot', '=', 'p_parking_lot.id')
            //->where('is_deleted', '0')
            ->orderBy('p_parking_lot.name', 'ASC')
            ->get();

        $data = array(
            'title' => 'Kuota Parkir',
            'modelTransportation' => $modelTransportation,
            'modelLot' => $modelLot,
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
        $modelLot = DB::table('p_parking_lot')->get();

        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Ubah Tarif Parkir',
            'modelTransportation' => $modelTransportation,
            'modelLot' => $modelLot,
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
            ->validate(['quota' => 'required']);

        DB::table($this->tableOp)->insert([
			'transportation' => $request->transportation,
			'quota' => $request->quota,
			'parking_lot' => $request->parking_lot
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
			'transportation' => $request->transportation,
			'quota' => $request->quota,
			'parking_lot' => $request->parking_lot
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
