<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Image;

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
		->orderBy($this->tableOp.'.id', 'DESC')
        ->get();

        $data = array(
            'title' => 'User Manajemen',
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
        $modelRole = DB::table('role')->get();
		
        $modelData = DB::table($this->tableOp)->where($this->tableOpK, Crypt::decrypt($id))->orderBy($this->tableOpK, 'DESC')
            ->first();

        $data = array(
            'title' => 'Ubah User',
            'modelRole' => $modelRole,
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
		
		$code = $this->getKode($request->role);

        $image = $request->file('gambar');
        if (!empty($image))
        {
            // UPLOAD START
            $filenamewithextension = $request->file('gambar')
                ->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file'] = "profil_".time().".jpg";
            $destinationPath = public_path('upload/user/thumbs/');
            $img = Image::make($image->getRealPath() , array(
                'width' => 150,
                'height' => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath . '/' . $input['nama_file']);
            //$destinationPath = public_path('upload/user/');
            //$image->move($destinationPath, $input['nama_file']);
            // END UPLOAD
        }
		
		if($input['nama_file']){
			DB::table($this->tableOp)->insert([
			'username' => $request->username,
			'id_smartparkir' => $code,
			'npp' => $request->npp,
			'name' => $request->name,
			'address' => $request->address,
			'phone_number' => $request->phone_number,
			'role' => $request->role,
			'password' => Hash::make($request->password)
			]);
		}else{
			DB::table($this->tableOp)->insert([
			'username' => $request->username,
			'id_smartparkir' => $code,
			'npp' => $request->npp,
			'name' => $request->name,
			'address' => $request->address,
			'phone_number' => $request->phone_number,
			'role' => $request->role,
			'image_profile' => "https://reto-parking.id/web_new/public/upload/user/thumbs/".$input['nama_file'],
			'password' => Hash::make($request->password)
			]);			
		}
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
            ->validate(['username' => 'required']);

        $image = $request->file('gambar');
        if (!empty($image))
        {
            // UPLOAD START
            $filenamewithextension = $request->file('gambar')
                ->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file'] = "profil_".time().".jpg";
            $destinationPath = public_path('upload/user/thumbs/');
            $img = Image::make($image->getRealPath() , array(
                'width' => 150,
                'height' => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath . '/' . $input['nama_file']);
            //$destinationPath = public_path('upload/user/');
            //$image->move($destinationPath, $input['nama_file']);
            // END UPLOAD
        }
		
		if($input['nama_file']){
			if($request->password){
			DB::table($this->tableOp)
				->where($this->tableOpK, $request->id)
				->update([
				'npp' => $request->npp,
				'name' => $request->name,
				'address' => $request->address,
				'phone_number' => $request->phone_number,
				'role' => $request->role,
				'image_profile' => "https://reto-parking.id/web_new/public/upload/user/thumbs/".$input['nama_file'],
				'password' => Hash::make($request->password)
				]);
			}else{
				DB::table($this->tableOp)
					->where($this->tableOpK, $request->id)
					->update([
					'npp' => $request->npp,
					'name' => $request->name,
					'address' => $request->address,
					'phone_number' => $request->phone_number,
					'role' => $request->role,
					'image_profile' => "https://reto-parking.id/web_new/public/upload/user/thumbs/".$input['nama_file'],
					]);			
			}
		}else{
			if($request->password){
			DB::table($this->tableOp)
				->where($this->tableOpK, $request->id)
				->update([
				'npp' => $request->npp,
				'name' => $request->name,
				'address' => $request->address,
				'phone_number' => $request->phone_number,
				'role' => $request->role,
				'password' => Hash::make($request->password)
				]);
			}else{
				DB::table($this->tableOp)
					->where($this->tableOpK, $request->id)
					->update([
					'npp' => $request->npp,
					'name' => $request->name,
					'address' => $request->address,
					'phone_number' => $request->phone_number,
					'role' => $request->role
					]);			
			}			
		}
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
	
    public function getKode($id)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
		
		$code = $this->getKodeKat($id);		
		$data  = DB::select("
		SELECT MAX(a.id_smartparkir) AS maxKode FROM users a
		WHERE a.id_smartparkir LIKE '%".$code."%'
		");
		$noUrut = (int) substr($data[0]->maxKode, 3, 4);
		$noUrut++;

		$char = $code;
		$kode = $char . sprintf("%04s", $noUrut);
		return $kode;
    }
	
    public function getKodeKat($id)
    {
        if (Session()->get('username') == "")
        {
            return redirect('login')
                ->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
		$data  = DB::select("
		SELECT code FROM role 
		WHERE id='".$id."'
		");	
		return $data[0]->code;
    }
}

