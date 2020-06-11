<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
class apiController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json('Ürün başarıyla eklendi.');
    }
    public function show($name)
    {
        $post = Post::where("postid",$name)->get();
        return response()->json($post);
    }
    public function update(Request $request, $id)
    {
         $category = Category::find($id);
         $category->catconfirm = $request->catconfirm;
         $category->update();
        return response()->json($category);
    }
    public function destroy($postid)
    {
        Post::where("postid",$postid)->delete();
        return response()->json('Urun Basariyla Silindi.');
    }
}
