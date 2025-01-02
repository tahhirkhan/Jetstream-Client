<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password', 'password_confirmation');
        $response = $this->apiService->register($data);

        // dd(isset($response['status']));

        if (isset($response['status']) && isset($response['token'])) {
            session(['api_token' => $response['token']]);
            return redirect()->route('dashboard')->with('success', 'Registration successful.');
        }

        return back()->withErrors(['message' => $response['message'] ?? 'Registration failed.']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $response = $this->apiService->login($credentials);

        // dd($response);

        if (isset($response['token'])) {
            session(['api_token' => $response['token']]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['message' => $response['message'] ?? 'Login failed.']);
    }

    public function getProfileData() {
        $token = session('api_token');
        $response = $this->apiService->getProfileData($token);

        // dd($response['data']);

        return view('myViews.profile', [
            'profileData' => $response['data'],
        ]);
    }

    public function logout()
    {
        $token = session('api_token');
        $response = $this->apiService->logout($token);

        session()->forget('api_token');
        return redirect()->route('login')->with('success', $response['message'] ?? 'Logged out successfully.');
    }
}
