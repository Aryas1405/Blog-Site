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
     * @return \Illuminate\Http\JsonResponse
     */
    // public function mystore(Request $request)
    // {
    //     $name=$request->name;
    //     // dd($name);
    //     $nameFind=Category::where('name',$name)->first();
       
    //     if(!$nameFind || $request->has('id'))
    //     {
    //         if(!$request->has('id'))
    //         {
           
    //         $request->validate([
    //             'name' => 'required|unique:categories,name',
    //             'description' => 'required',
    //          ]);    
    //          $category=new Category;
    //         }
    //         else
    //         {
    //             if($nameFind)   
    //             {
    //             if($nameFind->id==$request->id)//checking if the updated category name is present in db:table and both updated name &$nameFind are same
    //            {
    //             $request->validate([
    //                 'name' => 'required|unique:categories,name,'.$request->id,
    //                 'description' => 'required',
    //                 ]);
    //                 $category=Category::find($request->id);
    //             }

   
    //             else //another cat.name available that  conflict the updated name 
    //             {
    //                 return $this->processResponse($nameFind,'success', 'Category namee already taken..!!.. edit/add a different `name` ');

    //             }  
    //         }
    //         else
    //         {
    //             $category=Category::find($request->id);

    //         }
    //         }
    //             $category->name=$request->name;
    //             $category->slug = $this->slugify($request->name, 'categories');
    //             $category->description=$request->description;
    //             $category->user_id=1;
    //             $category->save();
                
    //             return $this->processResponse($category,'success', 'Category added');
        
    //     }
    //     else
    //     {
    //         return $this->processResponse($nameFind,'success', 'Category namee already taken..!!.. edit/add a different `name` ');
    //     }
    // }
    public function storeupdate(Request $request)
    {
        $exist=$request->name;
        $isDuplicate=Category::where('name', $exist)->first();
        if(!$isDuplicate || $request->has('id'))
        
        {
        if(!$request->has('id')) {

            $request->validate([
                'name' => 'required|unique:categories,name',
                'description' => 'required',
            ]);
        } 
        
        else {
           
            if($isDuplicate)
            {
            if($isDuplicate->id==$request->id)
            {

            $request->validate([
                'name' => 'required|unique:categories,name,'.$request->id,
                'description' => 'required',
            ]);
            }
            else{
                return $this->processResponse(null,'success', 'Category already exist111');

            }
        }
        else{
            $request->validate([
                'name' => 'required|unique:categories,name,'.$request->id,
                'description' => 'required',
                ]);

        }
            
        }
        

        // if($request->has('slug'))
        // {
        //     $slug = $this->slugify($request->name, 'categories');
        // };
     
           
        $category = Category::updateOrCreate(
            
            ['id' => $request->id],
            [
            'user_id' => 1,
            'name' => $request->name,
            'slug' => $this->slugify($request->name, 'categories'),

            'description' => $request->description
            ]
        );


        return $this->processResponse($category,'success', 'Category created');
    }
    else 
    {
        return $this->processResponse(null,'success', 'Category already exist');

    }
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
