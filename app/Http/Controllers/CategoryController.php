<?php

namespace App\Http\Controllers;

use App\Category;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userindex(Request $request)
    {
       // abort_if(!Auth::user()->hasPermission('read-categories'), 403);
        $searchC=($request->searchC) ? $request->searchC: '';
        $searchB = ($request->searchB) ? $request->searchB : '';

        $categories = Category::search('name', $searchC)
            ->searchMany('title', $searchB,'blogs')->paginate(7);
       
        return view('users.Category.index')->withCategories($categories)->withSearchC($searchC);
    }

   
    public function index(Request $request)
    {
        //dd(Auth::user()->permissions);
        abort_if(!Auth::user()->hasPermission('read-categories'), 403);
        $searchC=($request->searchC) ? $request->searchC: '';
        $searchB = ($request->searchB) ? $request->searchB : '';

        $categories = Category::search('name', $searchC)
            ->orderBy('created_at', 'desc')
            ->searchMany('title', $searchB,'blogs')->paginate(7);

        return view('Category.index')->withCategories($categories)->withSearchC($searchC)->withSearchB($searchB);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->hasPermission('create-categories'), 403);

        return view('Category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!Auth::user()->hasPermission('create-categories'), 403);
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required',
         ]);
        $category=new Category;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->user_id=Auth::user()->id;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        abort_if(!Auth::user()->hasPermission('read-categories'), 403);

     
        return view('Category/show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        abort_if(!Auth::user()->hasPermission('update-categories'), 403);
        
        return view('Category/edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        abort_if(!Auth::user()->hasPermission('update-categories'), 403);

        $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
            'description' => 'required',
         ]);
     
        
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();   
        return redirect()->route('categories.index')->with('success', 'Category Successfully Updated');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort_if(!Auth::user()->hasPermission('delete-categories'), 403);
        
        if($category->blogs->count()>0)
        {
        return back()->with('danger', 'Unable to delete ,This Category is assigned with a Blog!');  
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category Deleted');
    }
}
