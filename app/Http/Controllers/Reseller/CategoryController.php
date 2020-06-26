<?php

namespace App\Http\Controllers\Reseller;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:reseller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('reseller.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('reseller.category.create-edit');
    }

    public function displayCategory($id)
    {
        $category = Category::find($id);
        if($category != null)
            return response()->json(['status'=>200,'data'=>$category]);
        else
            return response()->json(['status'=>401,'message'=>'Unable to load data']);
    }

    public function enablingCategory($id)
    {
        $category = Category::find($id);
        $category->status = $category->status == 'active'?'inactive':'active';

        if($category->save())
            return redirect()->back()->withSuccess('Updated successfully');
        else
            return redirect()->back()->withError('Problem update data');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->has('edit_id'))
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255']
            ]);
        }
        else
        {
            $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        }


        try {
            if($request->has('edit_id'))
            {
                $data = $request->except('_token', 'score','edit_id','edit_mode');
            }
            else
            {
                $data = $request->except('_token', 'score');
            }

            $data['reseller_id'] = Auth::guard('reseller')->id();
            if ($request->hasFile('icon')) {
                $data['icon'] = $request->file('icon')->store('icons', ['disk' => 'public']);
            }
            if ($request->has('edit_id') && $request->has('edit_mode'))
            {
                $payload = Category::find($request->edit_id);
                $payload->name = $data['name'] !=''?$data['name']:$payload->name;
                $payload->reseller_id = $data['reseller_id'] !=''?$data['reseller_id']:$payload->reseller_id;
                $payload->save();
            }
            else
            {
                $payload = Category::create($data);
            }
            return response()->json(['status'=>200,'data'=> $payload, 'message'=>'Category created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status'=>401, 'data'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        Gate::authorize('view', $category);

        return view('reseller.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        Gate::authorize('view', $category);

        return view('reseller.category.create-edit', compact('category'));
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
        // Validate form data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'score' => ['required', 'integer', 'min:1', 'max:5'],
            'short_description' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'image', 'max:25'],
            'status' => 'required|in:active,inactive',
        ]);

        Gate::authorize('update', $category);

        try {
            $data = $request->except('_token', '_method', 'score');
            $data['star'] = $request->score;
            if ($request->hasFile('icon')) {
                if ($category->icon) {
                    Storage::delete('public/'.$category->icon);
                }

                $data['icon'] = $request->file('icon')->store('icons', ['disk' => 'public']);
            }

            $category->update($data);

            return redirect()->back()->withSuccess('Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);

        try {
            if ($category->icon) {
                Storage::delete('public/'.$category->icon);
            }

            Category::destroy($category->id);

            return redirect()->back()->withSuccess('Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function sortData(Request $r)
    {
        try {
             $categories  = $r->category_ids;
             $cas = Category::get();
             $category_count = count($categories);
             foreach($cas as $ca)
             {
                 $pos = null;
                 foreach ($categories as $key => $id) {
                        if ($ca->id == $id) {
                            $pos  = $key == 0? 1: $key + 1;
                            break;
                        }
                 }
                 if ($pos !=null)
                 {
                     $ca->sort  = $pos;
                     $ca->save();
                     $category_count--;
                 }

             }
        } catch (\Exception $e) {
             return response()->json([
                    'status' => false, 
                    'data'   => $e->getMessage(),
             ]);
        }
    }
}
