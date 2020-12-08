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
        if (Session()->get('username') == "") {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $modelData = DB::table($this->tableOp)->orderBy($this->tableOpK, 'DESC')
            ->get();

        $data = array(
            'title' => 'Kategori Kendaraan',
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
        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Ubah Kategori',
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

        $image = $request->file('gambar');
        if (!empty($image)) {
            // UPLOAD START
            $filenamewithextension = $request->file('gambar')
                ->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file'] = "trans_icon_" . time() . "";
            $destinationPath = public_path('upload/image/icon/');
            $image->move($destinationPath, $input['nama_file'] . ".png");
            // END UPLOAD
        } else {
            $input['nama_file'] = null;
        }

        if ($input['nama_file']) {
            DB::beginTransaction();
            try {
                DB::table($this->tableOp)->insert([
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $input['nama_file'],
                    'code' => $request->code,
                    'fee' => '0'
                ]);
                DB::commit();
                $this->respon['sukses'] = 'Berhasil';
            } catch (\Exception $e) {
                DB::rollback();
                $this->respon['warning'] = $e->getMessage();
            }
        } else {
            DB::beginTransaction();
            try {
                DB::table($this->tableOp)->insert([
                    'name' => $request->name,
                    'description' => $request->description,
                    'code' => $request->code,
                    'fee' => '0'
                ]);
                DB::commit();
                $this->respon['sukses'] = 'Berhasil';
            } catch (\Exception $e) {
                DB::rollback();
                $this->respon['warning'] = $e->getMessage();
            }
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

        $image = $request->file('gambar');
        if (!empty($image)) {
            // UPLOAD START
            $filenamewithextension = $request->file('gambar')
                ->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file'] = "trans_icon_" . time() . "";
            $destinationPath = public_path('upload/image/icon/');
            $image->move($destinationPath, $input['nama_file'] . ".png");
            // END UPLOAD
        } else {
            $input['nama_file'] = null;
        }

        if ($input['nama_file']) {
            DB::beginTransaction();
            try {
                DB::table($this->tableOp)
                    ->where($this->tableOpK, $request->id)
                    ->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'image' => $input['nama_file'],
                        'code' => $request->code,
                        'fee' => '0'
                    ]);
                DB::commit();
                $this->respon['sukses'] = 'Berhasil';
            } catch (\Exception $e) {
                DB::rollback();
                $this->respon['warning'] = $e->getMessage();
            }
        } else {
            DB::beginTransaction();
            try {
                DB::table($this->tableOp)
                    ->where($this->tableOpK, $request->id)
                    ->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'code' => $request->code,
                        'fee' => '0'
                    ]);
                DB::commit();
                $this->respon['sukses'] = 'Berhasil';
            } catch (\Exception $e) {
                DB::rollback();
                $this->respon['warning'] = $e->getMessage();
            }
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
