<?php

namespace App\Http\Controllers\Reseller;
use App\CmsPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_page = CmsPage::where('reseller_id', Auth::user()->id)->get();
        return view('reseller.appearance.page.index',compact('cms_page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reseller.appearance.page.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|max:255',
            'page_content' => 'required',
            'page_url' => 'required'
        ]);

        try{
            
            $insert = CmsPage::create([
                'reseller_id'=> Auth::user()->id,
                'page_name'=> $request->page_name,
                'content'=> $request->page_content,
                'url' => Str::slug($request->page_url,'-'),
                'public' => strtoupper($request->is_public),
                'page_title' => $request->seo_title,
                'meta_keyword' => $request->seo_keywords,
                'meta_description' => $request->seo_description,
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            return redirect()->route('reseller.appearance.index')->withSuccess('Page created successfully.');
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
        $cmsData = CmsPage::find($id);
        return view('reseller.appearance.page.create-edit',compact('cmsData'));
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
        $request->validate([
            'page_name' => 'required|max:255',
            'page_content' => 'required',
            'page_url' => 'required'
        ]);

        try{

            $updateArr = [
                'page_name' => $request->page_name, 
                'content' => $request->page_content, 
                'url' => Str::slug($request->page_url,'-'),
                'public' => strtoupper($request->is_public),
                'page_title' => $request->seo_title,
                'meta_keyword' => $request->seo_keywords,
                'meta_description' => $request->seo_description,
                'updated_at' => date('Y-m-d h:i:s')
            ];
            
            $data = CmsPage::find($id);
            $data->update($updateArr);

            return redirect()->back()->withSuccess('Page updated successfully.');
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
        //
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'status' => 'required',
        ]);

        $status = '';
        if ($request->status == 'ACTIVE') :
            $status = 'INACTIVE';
        elseif ($request->status == 'INACTIVE') :
            $status = 'ACTIVE';
        endif;
        
        try{
            $CmsPage = CmsPage::findOrFail($request->id);
            $CmsPage->status = $status;
            $CmsPage->updated_at = date('Y-m-d h:i:s');
            $CmsPage->save();

            return response()->json(['status' => 1, 'message' => 'Page status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
