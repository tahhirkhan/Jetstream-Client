<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BlogController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService) {
        $this->apiService = $apiService;
    }

    public function myBlogs() {
        $token = session('api_token');
        $response = $this->apiService->myBlogs($token);
        // dd($response);
        
        if ($response && isset($response['status']) && $response['status'] === true) {
            $blogs = $response['blogs'];
            return view('myViews.blog.my-blogs', [
                'blogs' => $blogs,
            ]);
        }
        return back()->withErrors(['message' => 'Something Went Wrong!']);
    }

    public function create() {
        return view('myViews.blog.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:5',
            'body' => 'required',
            'blogImg' => 'required|mimes:jpg,png,jpeg|max:3072',
        ]);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('blogImg'));
        $imgExtension = $request->file('blogImg')->getClientOriginalExtension();
        $path = public_path('images/');

        $imgNameWithExtension = $request->file('blogImg')->getClientOriginalName();
        $imgNameWithoutExtension = explode('.', $imgNameWithExtension)[0];

        $imgName = $imgNameWithoutExtension . ".jpeg";

        if($imgExtension == "png") {
            $encoded = $image->toJpeg(30);
            $encoded->save($path.$imgName);
        }
        else {
            $image->save($path.$imgName, quality: 30);
        }

        $blogData = [
            'title' => $validated['title'],
            'body' => $validated['body'],
            'imgName' => $imgName,
        ];

        $token = session('api_token');
        $response = $this->apiService->createBlog($blogData, $token);

        if (isset($response['status'])) {
            return redirect()->route('my-blogs');
        }
        return back()->withErrors(['message' => 'Something Went Wrong!']);
    }

    public function view($id) {
        $token = session('api_token');
        $blogId = [
            'id' => $id,
        ];
        $response = $this->apiService->viewBlog($token, $blogId);
        if ($response && isset($response['status']) && $response['status'] === true) {
            $blog = $response['blog'];
            $blog_author = $response['blog_author'];
            return view('myViews.blog.view', [
                'blog' => $blog,
                'blog_author' => $blog_author
            ]);
        }
        return back()->withErrors(['message' => 'Something Went Wrong!']);        
    }

    public function edit($id) {
        $token = session('api_token');
        $blogId = [
            'id' => $id,
        ];
        $response = $this->apiService->editBlog($token, $blogId);
        if ($response && isset($response['status']) && $response['status'] === true) {
            $blog = $response['blog'];
            return view('myViews.blog.edit', [
                'blog' => $blog,
            ]);
        }
        return back()->withErrors(['message' => 'Something Went Wrong!']);         
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|min:5',
            'body' => 'required',
        ]);

        $blogData = [
            'title' => $validated['title'],
            'body' => $validated['body'],
            'id' => $id,
        ];

        $token = session('api_token');
        $response = $this->apiService->updateBlog($token, $blogData);

        if ($response && isset($response['status']) && $response['status'] === true) {
            $blog = $response['blog'];
            $blog_author = $response['blog_author'];
            
            return redirect()->route('view-blog', [
                'id' => $blog['id']
            ])->with([
                'blog' => $blog,
                'blog_author' => $blog_author
            ]);
            // return view('myViews.blog.view', [
            //     'blog' => $blog,
            //     'blog_author' => $blog_author
            // ]);
        }
        return back()->withErrors(['message' => 'Something Went Wrong!']); 
    }

    public function editBlogImage($id) {
        $token = session('api_token');
        $blogData = [
            'id' => $id
        ];
        $response = $this->apiService->editBlogImage($token, $blogData);
        if ($response && isset($response['status']) && $response['status'] === true) {
            $blog = $response['blog'];
            return view('myViews.blog.edit-blog-image', [
                'blog' => $blog
            ]);
        }
        return back()->withErrors(['message' => 'Something Went Wrong!']);
    }

    public function updateBlogImage(Request $request, $id) {
        // dd($request);

        $validated = $request->validate([
            'blogImg' => 'required|mimes:jpg,png,jpeg|max:3072',
        ]);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('blogImg'));
        $imgExtension = $request->file('blogImg')->getClientOriginalExtension();
        $path = public_path('images/');

        $imgNameWithExtension = $request->file('blogImg')->getClientOriginalName();
        $imgNameWithoutExtension = explode('.', $imgNameWithExtension)[0];

        $imgName = $imgNameWithoutExtension . ".jpeg";

        if($imgExtension == "png") {
            $encoded = $image->toJpeg(30);
            $encoded->save($path.$imgName);
        }
        else {
            $image->save($path.$imgName, quality: 30);
        }

        $blogImgData = [
            'id' => $id,
            'imgName' => $imgName,
        ];

        $token = session('api_token');
        $response = $this->apiService->updateBlogImage($token, $blogImgData);

        if ($response && isset($response['status']) && $response['status'] === true) {
            $blog = $response['blog'];
            $blog_author = $response['blog_author'];
            
            // return redirect()->route('view-blog', [
            //     'id' => $blog['id']
            // ])->with([
            //     'blog' => $blog,
            //     'blog_author' => $blog_author
            // ]);

            return redirect('/view-blog/' . $blog['id'])->with([
                'blog' => $blog,
                'blog_author' => $blog_author
            ]);
        }
        else {
            return back()->withErrors(['message' => 'Something Went Wrong!']);
        }
    }

    public function destroy(Request $request, $id) {
        $blogData = [
            'id' => $id
        ];
        $token = session('api_token');

        $response = $this->apiService->destroyBlog($token, $blogData);
        if ($response && isset($response['status']) && $response['status'] === true) {
            $blogs = $response['blogs'];
            File::delete("images/" . $response['deleted_blog_image_path']);
            return redirect()->route('my-blogs')->with([
                'blogs' => $blogs
            ]);
        }
        return back()->withErrors(['message' => 'Something Went Wrong!']);
    }
}
