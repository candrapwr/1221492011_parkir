<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Territory extends Controller
{
    private $tableOp = 'p_territory';
    private $tableOpK = 'id';
    private $modulOp = 'territory';
    //private $respon = '';

    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelCity = DB::table('m_city')->get();

        $modelData = DB::table($this->tableOp)
            ->select($this->tableOp . '.*', 'm_city.name as city_name')
            ->join('m_city', $this->tableOp . '.city', '=', 'm_city.id')
            //->where('is_deleted', '0')
            ->orderBy($this->tableOp . '.' . $this->tableOpK, 'DESC')
            ->get();

        $data = array(
            'title' => 'Pengaturan Wilayah',
            'modelCity' => $modelCity,
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
        $modelCity = DB::table('m_city')->get();

        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Ubah WIlayah',
            'modelCity' => $modelCity,
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
            ->validate(['name' => 'required']);

        DB::beginTransaction();
        try {
            DB::table($this->tableOp)->insert([
                'name' => $request->name,
                'city' => $request->city
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
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()
            ->validate(['name' => 'required']);

        DB::beginTransaction();
        try {
            DB::table($this->tableOp)
                ->where($this->tableOpK, $request->id)
                ->update([
                    'name' => $request->name,
                    'city' => $request->city
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
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::beginTransaction();
        try {
            DB::table($this->tableOp)
                ->where($this->tableOpK, Crypt::decrypt($id))->delete();
            DB::commit();
            $this->respon['sukses'] = 'Berhasil';
        } catch (\Exception $e) {
            DB::rollback();
            $this->respon['warning'] = $e->getMessage();
        }
        return redirect('admin/' . $this->modulOp . '')
            ->with($this->respon);
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
