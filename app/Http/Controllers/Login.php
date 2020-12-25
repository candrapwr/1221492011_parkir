<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User_model;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function index(Request $request)
    {
        $token = $request->get('i');
        if($token){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://service.reto-parking.id/user/profile');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$token,
            ]);
            $response = curl_exec($ch);

            if (!$response) {
                $data = array(  'title'     => 'Login - Credentials');
                return view('login/index',$data);
            }
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if($status_code == 200){
                $res = json_decode($response);
                $user       = $res->data->user;
                if($res->status && $user->role!=2){
                    $request->session()->put('id_user', $user->id);
                    $request->session()->put('nama', $user->name);
                    $request->session()->put('username', $user->username);
                    $request->session()->put('akses_level', $user->role);
                    $request->session()->put('role', $user->role);
                    return redirect('admin/dasbor')->with(['sukses' => 'Anda berhasil login']);
                }else{
                    $data = array(  'title'     => 'Login - Credentials');
                    return view('login/index',$data);
                }
            }else{
                
                $data = array(  'title'     => 'Login - Credentials');
                return view('login/index',$data);
            }
        }else{
            $data = array(  'title'     => 'Login - Credentials');
            return view('login/index',$data);
        }
        
    }

    public function cek(Request $request)
    {
        $username   = $request->username;
        $password   = $request->password;
        $model      = new User_model();
        $user       = $model->login($username);
        if($user) {
			if(Hash::check($password, $user->password) AND $user->role!=2){
				//cek kawasan pengawas
				if($user->role==1){
					$userP = $model->cek_pengawas($user->id);
					if($userP){
						$request->session()->put('id_user', $user->id);
						$request->session()->put('nama', $user->name);
						$request->session()->put('username', $user->username);
						$request->session()->put('akses_level', $user->role);
						$request->session()->put('role', $user->role);
						$request->session()->put('role_name', $user->role_name);
						$request->session()->put('image_profile', $user->image_profile);
						return redirect('admin/dasbor')->with(['sukses' => 'Anda berhasil login']);
					}else{
						return redirect('login')->with(['warning' => 'Login failed failed, pengawas belum punya wilayah !']);
					}
				}else{
					$request->session()->put('id_user', $user->id);
					$request->session()->put('nama', $user->name);
					$request->session()->put('username', $user->username);
					$request->session()->put('akses_level', $user->role);
					$request->session()->put('role', $user->role);
					$request->session()->put('role_name', $user->role_name);
					$request->session()->put('image_profile', $user->image_profile);
					return redirect('admin/dasbor')->with(['sukses' => 'Anda berhasil login']);					
				}
			}else{
				return redirect('login')->with(['warning' => 'Login failed failed, please check your credentials ER-02']);
			}
        }else{
            return redirect('login')->with(['warning' => 'Login failed, please check your credentials ER-01']);
        }
    }

    public function logout()
    {
        Session()->forget('id_user');
        Session()->forget('nama');
        Session()->forget('username');
        Session()->forget('akses_level');
        Session()->forget('role');
        Session()->forget('image_profile');
        return redirect('login')->with(['sukses' => 'Anda berhasil logout']);
    }

    public function lupa()
    {
        $data = array(  'title'     => 'Login - Credentials');
        return view('login/lupa',$data);
    }
}