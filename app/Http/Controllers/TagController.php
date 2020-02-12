<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      abort_if(!Auth::user()->hasPermission('read-tags'), 403);

      $searchT=($request->searchT) ? $request->searchT : ''; 
      $tags=Tag::where('name','like','%'.$searchT.'%')->paginate(8);
      return view('Tag.index')->withTags($tags)->withSearchT($searchT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->hasPermission('create-tags'), 403);

        return view('Tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Auth::user()->hasPermission('create-tags'), 403);

        $request->validate([
            'tag_name' => 'required|unique:tags,name',
         ]);
        $tag=new Tag;
        $tag->name=$request->tag_name;
        $tag->user_id=Auth::user()->id;
        $tag->save();
        return redirect()->route('tags.index')->with('success', 'Tag added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        abort_if(!Auth::user()->hasPermission('update-tags'), 403);

       
        return view('Tag.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Tag $tag)
    {
        abort_if(!Auth::user()->hasPermission('update-tags'), 403);

        $request->validate([
            'tag_name' => 'required|unique:tags,name,'.$tag->id,
         ]);
        
        $tag->name=$request->tag_name;
        $tag->save();
         return redirect()->route('tags.index')->with('success', 'Tag Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        abort_if(!Auth::user()->hasPermission('delete-tags'), 403);
  
      if($tag->blog->count()>0)
      {
      return back()->with('danger', 'Unable to delete ,This Tag is assigned with a Blog!');  
      }
      $tag->delete();
      return redirect()->route('tags.index')->with('success', 'Tag Deleted');
  }

    
}
