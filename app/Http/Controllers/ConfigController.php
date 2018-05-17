<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ConfigController extends Controller
{

    use ResetsPasswords;

    public function sendCode(Request $request){

        $validator = Validator::make($request->all(), [
            'mobile' => 'required|min:8',
        ]);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }else{

            $user = User::where('mobile', $request->input('mobile'))->first();

            if (empty($user)){
                return back()->withErrors('Votre numéro est pas associé à un compte')->with('danger', 'Votre numéro est pas associé à un compte');
            }else{

                $code = User::generateRandomString();

                $checked = User::where('token', $code)->first();

                while (!empty($checked)){
                    $code = User::generateRandomString();
                    $checked = User::where('token', $code)->first();
                }

                $user->token = $code;
                $user->save();

                /* code api sms */

                User::sendSms('+'.$user->country->phonecode.''.$user->mobile, "Votre code de réinitialisation est $user->token");

                /* end code api sms */
            }
        }

//        dd('ici');

        return redirect()->route('password.mobile.code', ['mobile' => $user->mobile, 'token' => bin2hex(random_bytes(32))]);
    }

    public function checkedCode(){

//        dd('ici');

        $mobile = Input::get('mobile');

        $data = User::where('mobile', $mobile)->first();

        if (empty($data)){
            return redirect('/404');
        }

        return view('auth.checked', compact('data'));
    }

    public function checkedCodeConfirm(Request $request){

        $data = User::where('token', $request->input('code'))->first();

        if (empty($data)){
            return back()->with('danger', 'Code erroné');
        }

        return view('auth.passwords.reset', compact('data'));
    }

    public function newPassword(Request $request){

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('danger', 'Veuillez renseigner tous les champs');
        }else{

            $user = User::where('token', $request->input('token'))->first();

//            $data = new ResetPasswordController();

            $this->resetPassword($user, $request->input('password'));

//            $user->forceFill([
//                'password' => bcrypt($request->input('password')),
//                'remember_token' => Str::random(60),
//            ])->save();

            $user->token = NULL;
            $user->save();

//            auth()->login($user);
        }

        return redirect('/');
    }

    public function reSendCode(){

        $phone = Input::get('phone');

        if (empty($phone)){
            return redirect('/404');
        }

        $data = User::where('mobile', $phone)->first();

        if (empty($data)){
            return back()->with('danger', 'Numéro de téléphone inconnu');
        }else{

            /* code api sms */

            User::sendSms('+'.$data->country->phonecode.''.$data->mobile, "Votre code de confirmation est $data->token");

            /* end code api sms */

        }

        return redirect()->route('welcome', ['mobile' => addslashes($data->mobile), 'token' => bin2hex(random_bytes(32))]);
    }


    public function reSendCodeNew(){

        $phone = Input::get('phone');

        if (empty($phone)){
            return redirect('/404');
        }

        $data = User::where('mobile', $phone)->first();

        if (empty($data)){
            return back()->with('danger', 'Numéro de téléphone inconnu');
        }else{

            /* code api sms */

            User::sendSms('+'.$data->country->phonecode.''.$data->mobile, "Votre code de réinitialisation est $data->token");

            /* end code api sms */

        }

        return redirect()->back(); //route('welcome', ['mobile' => addslashes($data->mobile), 'token' => bin2hex(random_bytes(32))]);
    }
}
