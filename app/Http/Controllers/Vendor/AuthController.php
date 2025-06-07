<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Constants\AppConstants;
use Illuminate\Support\Facades\DB;
use App\Constants\Auth\OtpConstants;
use App\Http\Controllers\Controller;
use App\Services\Auth\VerifyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\Auth\OtpException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Services\Auth\RegistrationService;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public $register_service;
    public $verify_service;

    function __construct()
    {
        $this->register_service = new RegistrationService;
        $this->verify_service = new VerifyService;
    }
    public function loginView(){
        return view("dashboard.auth.login");
    }

    public function registerView(){
        return view("dashboard.auth.register");
    }

    public function otpView(){
        return view("dashboard.auth.otp");
    }

    public function login(LoginFormRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $credentials = $request->only('email', 'password');
            $remember =_value($data, 'remember_me') == 'on' ? true : false;
            if (Auth::attempt($credentials, $remember)) {
                $user = Auth::user();
                // check user role
                if($user->role != AppConstants::VENDOR_ROLE){
                    toastr()->error('You are not authorized to access this page.');
                    return back();
                }
                Auth::login($user, $remember);
                toastr()->success('You have successfully logged in.');
                return redirect()->route('vendor.dashboard');
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

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|unique:users,phone_number',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $validator->validated();
            $user = $this->register_service->create($data);
            $this->register_service->postRegisterActions($user);
            return redirect('/otp/verify?email=' . urlencode(encrypt($data['email'])))
                ->with('success', 'Registration successful. Please check your email for verification.');

        } catch (ValidationException $e) {
            report_error($e);
            $message = $e->validator->errors()->first();
            return redirect()->back()->withErrors($message)->withInput();
        } catch (\Exception $e) {
            report_error($e);
            return redirect()->back()->withErrors('Something went wrong while processing your request.')->withInput();
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            $data = $request->all();
            $data['type'] = OtpConstants::TYPE_EMAIL_VERIFICATION;
            $this->verify_service->request($data);
            return back()->with('success', 'OTP sent successfully.');
        } catch (ValidationException $e) {
            report_error($e);
            $message = $e->validator->errors()->first();
            return redirect()->back()->withErrors($message)->withInput();
        } catch (\Exception $e) {
            report_error($e);
            return redirect()->back()->withErrors('Something went wrong while processing your request.')->withInput();
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $data = $request->all();
            $otp = implode('', $request->input('code'));
            $data['code'] = $otp;
            $this->verify_service->verify($data);
            return redirect()->route('auth.vendor.login')->with('success', 'OTP verified successfully.');
        } catch (ValidationException $e) {
            report_error($e);
            $message = $e->validator->errors()->first();
            return redirect()->back()->withErrors($message)->withInput();
        } catch (OtpException $e) {
            report_error($e);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        } catch (\Exception $e) {
            report_error($e);
            return redirect()->back()->withErrors('Something went wrong while processing your request.')->withInput();
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        toastr()->success('You have successfully logged out.');
        return redirect()->route('auth.vendor.login');
    }
}
