<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Nexmo;
use Log;

class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getRegister(){
        return view('register');
    }

    public function postRegister(Request $request){
        $data = $request->validate([
            'name'          => 'required|max:255|unique:users',
            'email'         => 'required|email|max:255|unique:users',
            'password'      => 'required|min:6',
            'phone_number'  => 'required|size:11|unique:users',
        ]);
        

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone_number' => $data['phone_number']
        ]);

        if($user->save()){
            return redirect('/');
        }else{
            return redirect()->back();
        }
    }

    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        Auth::logout();
        if ($user = Auth::attempt(['name' => $request->get('name'), 'password' => $request->get('password')])) {
            $request->session()->put('verify:user:id', $user['id']);
            $verification = Nexmo::verify()->start([
                'number' => $user['phone_number'],
                'brand'  => 'Laravel mOTP Demo'
            ]);
            $request->session()->put('verify:request_id', $verification->getRequestId());
            return redirect('code');
        }
        return redirect()->back()->withErrors(['Name or password is invalid']); 
    }

    public function getCode(){
        return view('code');
    }

    public function postCode(Request $request){
        $this->validate($request, [
            'code' => 'size:4',
        ]);
     
        try {
            Nexmo::verify()->check(
                $request->session()->get('verify:request_id'),
                $request->code
            );
            Auth::loginUsingId($request->session()->pull('verify:user:id'));
            return redirect('/');
        } catch (Nexmo\Client\Exception\Request $e) {
            return redirect()->back()->withErrors([
                'code' => $e->getMessage()
            ]);
     
        }
    }
}
