<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Constants\AppConstants;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function loginView(){
        return view("dashboard.auth.login");
    }

    public function login(LoginFormRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $credentials = $request->only('email', 'password');
            $remember =_value($data, 'remember_me') == 'on' ? true : false;
            if (Auth::attempt($credentials, $remember)) {
                $user = Auth::user();
                // check user role and isAdmin
                if($user->role != AppConstants::ADMIN_ROLE){
                    toastr()->error('You are not authorized to access this page.');
                    return back();
                }
                Auth::login($user, $remember);
                toastr()->success('You have successfully logged in.');
                return redirect()->route('admin.dashboard');
            }
            toastr()->error('Invalid credentials. Please try again.');
            return back()->withInput($request->only('email', 'remember_me'));
        } catch (ValidationException $e) {
            report_error($e);
            $message = "The given data was invalid.";
            return redirect()->back()->withErrors($message);
        } catch (\Exception $e) {
            report_error($e);
            $message = 'Something went wrong while processing your request.';
            return redirect()->back()->withErrors($message);
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        toastr()->success('You have successfully logged out.');
        return redirect()->route('auth.admin.login');
    }
}
