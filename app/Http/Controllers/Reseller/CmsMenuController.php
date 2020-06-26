<?php

namespace App\Http\Controllers\Reseller;

use App\CmsMenu;
use App\CmsPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmsMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_page = CmsPage::select('cms_pages.*')->leftJoin('cms_menus', 'cms_menus.menu_link_id', '=', 'cms_pages.id')
            ->where('cms_pages.status', '!=', 'INACTIVE')->whereNull('cms_menus.id')->get();
        $cms_menu = CmsMenu::where(['reseller_id' => Auth::user()->id, 'status' => 'active'])->orderBy('sort')->get();
        return view('reseller.appearance.menu.index',compact('cms_menu', 'cms_page'));
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
        $request->validate([
            'menu_name' => 'required|max:255',
            'menu_link' => 'required|integer',
        ]);

        //return $request;

        $external_url = '';
        if ($request->menu_link == 0) :
            $external_url = $request->external_url;
        endif;

        try{
            $insert = CmsMenu::create([
                'reseller_id'=> Auth::user()->id,
                'menu_name'=> $request->menu_name,
                'external_link'=> $external_url,
                'menu_link_id'=> $request->menu_link,
                'menu_link_type' => $request->menu_type == 1 ? 'YES' : 'NO',
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            return redirect()->back()->withSuccess('Menu linked successfully.');
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
        //
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
            'menu_name_edit' => 'required|max:255',
            'menu_link_edit' => 'required',
        ]);

        $external_url = '';
        if ($request->menu_link_edit == 0) :
            $external_url = $request->edit_external_url;
        endif;

        try{
            $updateArr = [
                'menu_name' => $request->menu_name_edit,
                'external_link'=> $external_url,
                'menu_link_id' => $request->menu_link_edit,
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $data = CmsMenu::find($id);
            $data->update($updateArr);

            return redirect()->back()->withSuccess('Menu Link updated successfully.');
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
        //return $id;

    }

    public function getMenuData(Request $request){
        $cms_page = CmsMenu::where('id', $request->id)->get();
        return response()->json($cms_page);
    }

    public function sortArrUpdate(Request $request)
    {
        $request->validate([
            'sortArr' => 'required'
        ]);

        try{
            if (!empty($request->sortArr)) :
                $count = 1;
                foreach ($request->sortArr as $key => $id) :

                    $updateArr = [
                        'sort' => $count
                    ];

                    $data = CmsMenu::find($id);
                    $data->update($updateArr);
                    $count++;
                endforeach;
            endif;
            return response()->json(['status' => 1, 'message' => 'sort updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);

        try {
            CmsMenu::find($request->id)->delete();
            return response()->json(['status' => 1, 'message' => 'Delete successfully.']);
        } catch (\Exception $e) {
             return response()->json(['error' => $e->getMessage()]);
        }
    }
}
