<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Brand;
use App\Http\Controllers\Controller;
use App\Product;
use App\UploadImage\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use UploadImage;
    private $blog;
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }
    public function showBlogHome(){
        $all_blog = Blog::orderby('blog_id','desc')->paginate(5);
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_name', 'asc')->get();
        $popular_product = Product::where('product_status', 1)->get();
        $blog_popular =  Blog::where('blog_status',2)->get();
        return view('pages.blog.show_blog', compact('brand_product', 'popular_product','blog_popular','all_blog'));
    }
    public function showBlogDetail($blog_slug){
        $popular_product = Product::where('product_status', 1)->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_name', 'asc')->get();
        $blog_popular =  Blog::where('blog_status',2)->get();
        $blog_detail = Blog::where('blog_slug',$blog_slug)->first();
        if($blog_detail){
            return view('pages.blog.blog_detail',compact('blog_detail','blog_popular','popular_product'));
        }else{
            return view('pages.error.404',compact('popular_product','brand_product'));
        }
        
    }
    public function index(){
        $all_blog = Blog::orderBy('blog_id', 'desc')->paginate(5);
        return view('admin.blog.index', compact('all_blog'));
    }
    public function add(){
        return view('admin.blog.add');
    }
    public function save(Request $request){
        $dataBlog = [
            'user_id' => Auth::user()->id,
            'blog_title'=> $request->blog_title,
            'blog_content' => $request->blog_content,
            'blog_status' => $request->blog_status,
            'blog_slug' => Str::slug($request->blog_title)
        ];
        $dataUploadImage = $this->uploadOne($request,'blog_thumb');
        if(!empty($dataUploadImage)){
            $dataBlog['blog_thumb'] = $dataUploadImage['file_name'];
        }else{
            $dataBlog['blog_thumb'] = "";
        }
        $blog = Blog::create($dataBlog);

        return redirect()->route('admin.blog.index')->with('message', 'Thêm bài viết thành công!');

    }
    public function activeBlog($blog_id){
        Blog::where('blog_id', $blog_id)->update(['blog_status' => 2]);
        return redirect()->route('admin.blog.index')->with('message', 'Đã kích hoạt trình trạng bài viêt thành HIỂN THỊ!');

    }
    public function unactiveBlog($blog_id){
        Blog::where('blog_id', $blog_id)->update(['blog_status' => 1]);
        return redirect()->route('admin.blog.index')->with('message', 'Đã kích hoạt trình trạng bài viết thành ẨN!');

    }
    public function edit($blog_id){
        $edit_blog = Blog::find($blog_id);
        return view('admin.blog.edit',compact('edit_blog'));
    }
    public function update(Request $request,  $blog_id){
        $dataBlog = [
            'user_id' => Auth::user()->id,
            'blog_title'=> $request->blog_title,
            'blog_content' => $request->blog_content,
            'blog_slug' => Str::slug($request->blog_title)
        ];
        $dataUploadImage = $this->uploadOne($request,'blog_thumb');
        if(!empty($dataUploadImage)){
            $dataBlog['blog_thumb'] = $dataUploadImage['file_name'];
        }
        $blog = Blog::find($blog_id)->update($dataBlog);
        return redirect()->route('admin.blog.index')->with('message', 'Cập nhật bài viết thành công!');

    }
    public function delete($blog_id){
        Blog::where('blog_id', $blog_id)->delete();
        return redirect()->route('admin.blog.index')->with('message', 'Xóa bài viết thành công!');

    }
}
