<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Blog;
use Illuminate\Http\Request;
use App\Traits\ProcessResponseTrait;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use ProcessResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        $searchC=($request->searchC) ? $request->searchC: '';
        $searchB = ($request->searchB) ? $request->searchB : '';

        $categories = Category::search('name', $searchC)
            ->orderBy('created_at', 'desc')
            ->with('blogs')
            ->searchMany('title', $searchB,'blogs')->paginate(7);
            
            
            //return view('Category.index')->withCategories($categories)->withSearchC($searchC)->withSearchB($searchB);
            return $this->processResponse($categories,'success');
            
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        
        if($category->blogs->count()>0)
        {
        return $this->processResponse(null,'error','This category has linked blogs, cannot be deleted');  
    }
    
        $category->delete();
        return $this->processResponse(null,'success','category deleted');  
    }
}
