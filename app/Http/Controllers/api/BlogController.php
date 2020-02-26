<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Blog;
use App\Tag;
use App\Comment;
use Illuminate\Http\Request;
use App\Traits\ProcessResponseTrait;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image as Photo;
class BlogController extends Controller
{
    use ProcessResponseTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchB=($request->searchB) ? $request->searchB:'';
        $category=($request->searchC) ? $request->searchC:'';
        $blogs=Blog::where('title','like','%'.$searchB.'%')
        ->whereHas('category', function(Builder $query) use($category)
        {
         $query->where('name','like','%'.$category.'%');   
        })
        ->orderBy('created_at', 'desc')
        ->with('tags')
        ->with('category')
        ->paginate(6);
       
        // return view('Blog/index')->withBlogs($blogs)->withSearchB($searchB)->withCategory($category);
        // return $blogs;
        return $this->processResponse($blogs,'success');

   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeupdate(Request $request)
    {
        $title=$request->title;
        // dd($title);
        $titleFind=Blog::where('title',$title)->first();
       
        if(!$titleFind || $request->has('id'))
        {
            if(!$request->has('id'))
            {
           
            $request->validate([
                'title' => 'required|unique:blogs,title',
                'description' => 'required',
             ]);    
             $blog=new Blog;
            }
            else
            {
                if($titleFind)   
                {
                if($titleFind->id==$request->id)//checking if the updated blog title is present in db:table and both updated title &$titleFind are same
               {
                $request->validate([
                    'title' => 'required|unique:blogs,title,'.$request->id,
                    'description' => 'required',
                    ]);
                    $blog=Blog::find($request->id);
                }

   
                else //another blog title available that  conflict the updated title 
                {
                    return $this->processResponse($titleFind,'success', 'Blog titlee already taken..!!.. edit/add a different `title` ');

                }  
            }
            else
            {
                $blog=Blog::find($request->id);

            }
            }

            $blog->title=$request->title;
            $blog->description=$request->description;
            $blog->category_id=$request->category_id;
            $blog->user_id=1;
            if($request->file('image'))

            {
                $filetitle = $this->uploadImage($request->file('image'));
    
                $blog->image = $filetitle;
            }
    
            $blog->save();
                
                return $this->processResponse($blog,'success', 'Blog added');
        
        }
        else
        {
            return $this->processResponse($titleFind,'success', 'Blog titlee already taken..!!.. edit/add a different `title` ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
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
    
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $blog=Blog::find($id);
      
        if($blog)
        {
        $blog->delete();
        return $this->processResponse(null,'success','blog deleted');  
        }
        else
        {
            $blogs=Blog::onlyTrashed()->where('id',$id)->first('id');
            echo ($blogs);
            if($blogs)
            {   

                return $this->processResponse($blogs,'error','blog already soft deleted ');  
            }
            else
            {
                return $this->processResponse(null,'error','`blog` for given `id` does not Exist or forced deleted ');  
            }
        }
    }
}
