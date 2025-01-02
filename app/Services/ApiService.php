<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('API_DEMO_URL');
    }

    # ======================================= Authentication Services =======================================
    public function register($data) {
        return Http::post($this->baseUrl . '/api/register', $data)->json();
    }

    public function login($credentials)
    {
        return Http::post($this->baseUrl . '/api/login', $credentials)->json();
    }

    public function getProfileData($token) {
        return Http::withToken($token)->get($this->baseUrl . '/api/profile')->json();
    }

    public function logout($token) {
        return Http::withToken($token)->post($this->baseUrl . '/api/logout')->json();
    }


    # ======================================= Blog Services =================================================
    public function createBlog($blogData, $token) {
        return Http::withToken($token)->post($this->baseUrl . '/api/create-blog', $blogData)->json();
    }

    public function myBlogs($token) {
        return Http::withToken($token)->get($this->baseUrl . '/api/my-blogs')->json();
    }

    public function viewBlog($token, $id) {
        return Http::withToken($token)->get($this->baseUrl . '/api/view-blog', $id)->json();
    }

    public function editBlog($token, $id) {
        return Http::withToken($token)->get($this->baseUrl . '/api/edit-blog', $id)->json();
    }

    public function updateBlog($token, $blogData) {
        return Http::withToken($token)->patch($this->baseUrl . '/api/update-blog', $blogData)->json();
    }

    public function editBlogImage($token, $blogData) {
        return Http::withToken($token)->get($this->baseUrl . '/api/edit-blog-image', $blogData)->json();
    }

    public function updateBlogImage($token, $blogData) {
        return Http::withToken($token)->patch($this->baseUrl . '/api/update-blog-image', $blogData)->json();
    }

    public function destroyBlog($token, $blogData) {
        return Http::withToken($token)->delete($this->baseUrl . '/api/delete-blog', $blogData)->json();
    }
}
