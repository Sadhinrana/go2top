<?php

namespace App\Http\Controllers\reseller;

use App\CmsBlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CmsBlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_blog_category = CmsBlogCategory::where('reseller_id', Auth::user()->id)->get();
        return view('reseller.blog.blog_category.index',compact('cms_blog_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reseller.blog.blog_category.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|max:255',
            'is_status' => 'required|in:0,1'
        ]);

        try{
            $insert = CmsBlogCategory::create([
                'reseller_id'=> Auth::user()->id,
                'name'=> $request->category_name,
                'status'=> $request->is_status > 0 ? '1' : '0',
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            return redirect()->route('reseller.blog-category.index')->withSuccess('Category Add successfully.');
         } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cms_blog_category = CmsBlogCategory::where('id', $id)->get();
        return view('reseller.blog.blog_category.create-edit',compact('cms_blog_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_name' => 'required|max:255',
            'is_status' => 'required|in:0,1'
        ]);

        try{
            $update = [
                'name'=> $request->category_name,
                'status'=> $request->is_status > 0 ? '1' : '0',
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $data = CmsBlogCategory::find($id);
            $data->update($update);

            return redirect()->back()->withSuccess('Category updated successfully.');
         } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            CmsBlogCategory::find($id)->delete();
            return redirect()->route('reseller.blog-category.index')->withSuccess('Category delete successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
