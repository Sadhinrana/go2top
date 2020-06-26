<?php

namespace App\Http\Controllers\reseller;

use App\CmsFaq;
use App\Domain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CmsSettingFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_faq = CmsFaq::where('reseller_id', Auth::user()->id)->orderBy('sort')->get();
        return view('reseller.settings.faq.index ',compact('cms_faq'));
    }

    public function getFrontEndView()
    {
        $faqs = null;
        $doma = Domain::where('name', 'LIKE', '%'.$_SERVER['SERVER_NAME'].'%')->first();
        if ($doma!=null) {
            $faqs = CmsFaq::where('reseller_id', $doma->reseller_id)->orderBy('sort')->get();
        }
        
        return view('frontend.faq', compact('faqs'));  
    }
    public function getPublicAboutUs()
    {
        return view('frontend.about-us');  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reseller.settings.faq.create-edit');
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
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required|in:0,1'
        ]);

        try{
            $ff = CmsFaq::create([
                'reseller_id'=> Auth::user()->id,
                'question'=> $request->question,
                'answers'=> utf8_encode($request->answer),
                'status' => $request->status,
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            return redirect()->route('reseller.setting.faq.index')->withSuccess('Faq created successfully.');
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
        $cms_faq = CmsFaq::find($id);
        return view('reseller.settings.faq.create-edit',compact('cms_faq'));
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
            'question' => 'required|max:255',
            'answer' => 'required|max:255',
            'status' => 'required|in:0,1'
        ]);

        try{

            $updateArr = [
                'question' => $request->question, 
                'answers' => $request->answer, 
                'status' => $request->status,
                'updated_at' => date('Y-m-d h:i:s')
            ];
            
            $data = CmsFaq::find($id);
            $data->update($updateArr);

            return redirect()->back()->withSuccess('Faq update successfully.');
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
            CmsFaq::find($id)->delete();
            return redirect()->route('reseller.setting.faq.index')->withSuccess('Faq delete successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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

                    $data = CmsFaq::find($id);
                    $data->update($updateArr);
                    $count++;
                endforeach;
            endif;
            return response()->json(['status' => 1, 'message' => 'sort updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
