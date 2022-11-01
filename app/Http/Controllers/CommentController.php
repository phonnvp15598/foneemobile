<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use App\Http\Requests\CommentCustomerRequest;
use Illuminate\Http\Request;
use App\UploadImage\UploadImage;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    use UploadImage;
    private $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function addCommentProduct(CommentCustomerRequest $request, $product_id){
        $comment = Comment::create([
            'product_id'=> $product_id,
            'customer_id' => $request->customer_id,
            'comment_rate' => $request->comment_rate,
            'comment_content' => $request->comment_content,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        if($request->has('comment_images')){
            foreach($request->comment_images as $fileItem){
                $dateImageDetail = $this->uploadMulti($fileItem);
                $comment->CommentImages()->create([
                    'comment_id' => $comment->comment_id,
                    'comment_image' => $dateImageDetail['file_name']
                ]);
            }
        }
        return redirect()->back()->with('message', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
    public function addCommentReply(Request $request){
        $customer_id = Session::get('customer_id');
        if(isset($customer_id)){
            CommentReply::create([
                'comment_id' => $request->comment_id,
                'customer_id' => $customer_id,
                'comment_reply_content'=>$request->comment_reply_content
            ]);
            return redirect()->back()->with('message', 'Cảm ơn đã gửi phản hồi!');
        }else{
            return redirect()->back()->with('message_error', 'Bạn chưa đăng nhập để gửi phản hồi!');
        }        
    }
    
}
