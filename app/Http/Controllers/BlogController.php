<?php

namespace App\Http\Controllers;
use App\Category;
use App\Blog;
use App\Tag;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image as Photo;



class BlogController extends Controller
{ 
    public function recycle()
    {
        $blogs=Blog::onlyTrashed()->get();
        $categories=Category::onlyTrashed()->get();
        $tags=Tag::onlyTrashed()->get();
        return view('Recycle.recycle_blog')->withBlogs($blogs)->withCategories($categories)->withTags($tags);
    }
    public function categoryrecycle()
    {
        $categories=Category::onlyTrashed()->get();
        return view('Recycle.recycle_category')->withCategories($categories);
    }
    public function tagrecycle()
    {
        $tags=Tag::onlyTrashed()->get();
        return view('Recycle.recycle_tag')->withTags($tags);
    }
    
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!Auth::user()->hasPermission('read-blogs'), 403);
        $searchB=($request->searchB) ? $request->searchB:'';
        $category=($request->searchC) ? $request->searchC:'';
        $blogs=Blog::where('title','like','%'.$searchB.'%')
        ->whereHas('category', function(Builder $query) use($category)
        {
         $query->where('name','like','%'.$category.'%');   
        })
        ->orderBy('created_at', 'desc')
        ->paginate(6);
       
        return view('Blog/index')->withBlogs($blogs)->withSearchB($searchB)->withCategory($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        abort_if(!Auth::user()->hasPermission('create-blogs'), 403);

        $tags=Tag::all();
        $categories=Category::all();
        return view('Blog/create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Auth::user()->hasPermission('create-blogs'), 403);

        $request->validate([
            'title' => 'required|unique:blogs,title',
            'description' => 'required',
            'blog_category' => 'required',
           
         ]);
        $blog=new Blog;
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->category_id=$request->blog_category;
        $blog->user_id=Auth::user()->id;
        if($request->file('image'))
        {
            $filename = $this->uploadImage($request->file('image'));

            $blog->image = $filename;
        }

        $blog->save();
        $blog->tags()->sync($request->tag_id);
        return redirect()->route('blogs.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        abort_if(!Auth::user()->hasPermission('read-blogs'), 403);

        $comments=Comment::all();

        return view('Blog/show')->withBlog($blog)->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        abort_if(!Auth::user()->hasPermission('update-blogs'), 403);
    
        $tags=Tag::all();
        $categories=Category::all();
        return view('Blog/edit')->withBlog($blog)->withCategories($categories)->withTags($tags);
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Blog $blog)
    { 
        abort_if(!Auth::user()->hasPermission('update-blogs'), 403);

        $request->validate([
            'title' => 'required|unique:blogs,title,'.$blog->id,
            'description' => 'required',
            'blog_category' => 'required',
           
         ]);
     
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->category_id=$request->blog_category;

        if($request->file('image'))
        {
            if($blog->image!=null)
            {
                $this->deleteImage($blog->image);
            }
            $filename=$this->uploadImage($request->file('image'));
            $blog->image=$filename;
        }
        $blog->save();
        $blog->tags()->sync($request->tag_id);
        return redirect()->route('blogs.index')->with('success', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        abort_if(!Auth::user()->hasPermission('delete-blogs'), 403);

      
        $blog->delete();
        if($blog->image)
        {
            $this->deleteImage($blog->image);
        }
        return redirect()->route('blogs.index')->with('success', 'Blog Deleted Successfully');
    }
    public function deleteOnlyImage(Blog $blog)
    {
        if($blog->image)
        {
            $blog->image=null;
            $blog->save();
            $this->deleteImage($blog->image);
        }
        return redirect()->route('blogs');

    }

    public function uploadImage($image)
    {
        $random_name=time();
        $extension=$image->getClientOriginalExtension();
        $filename=$random_name.'.'.$extension;
        Photo::make($image)->save(public_path('image/'. $filename));
        return $filename;
    }
    public function deleteImage($image)
    {
        $filename = public_path('image/' . $image);

        unlink($filename);

    }
    
}
