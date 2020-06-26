<?php

namespace App\Http\Controllers\reseller;

use App\CmsBlogSlider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class CmsBlogSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_slider = CmsBlogSlider::where('reseller_id', Auth::user()->id)->get();
        return view('reseller.blog.blog_slider.index',compact('cms_slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reseller.blog.blog_slider.create-edit');
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
            'title' => 'required|max:255',
            'status' => 'required|in:0,1',
            'slider_image' => 'image|mimes:jpeg,png,jpg,gif|max:2000',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2000'
        ]);

        try{
            $image = '';
            if ($request->file('slider_image') !='') {
                $file = $request->file('slider_image');
                $image = Str::slug($request->title).'-'.Auth::user()->id.time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/blog-slider/', $image);
    
                //Thumbnail create
                $dir = public_path('uploads/blog-slider/thumbnail/');
                if(!file_exists( $dir ) && !is_dir( $dir ))
                {
                    mkdir($dir,0777,true);
                }
                Image::make('uploads/blog-slider/'.$image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($dir.'thumb-'.$image);
            }

            $insert = CmsBlogSlider::create([
                'reseller_id'=> Auth::user()->id,
                'title'=> $request->title,
                'read_more'=> $request->read_more,
                'image' => $image,
                'status'=> $request->status > 0 ? '1' : '0',
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            return redirect()->route('reseller.blog-slider.index')->withSuccess('Blog Slider Add successfully.');
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
        
        $cms_blog_slider = CmsBlogSlider::where('id', $id)->get();
        return view('reseller.blog.blog_slider.create-edit',compact('cms_blog_slider'));
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
            'title' => 'required|max:255',
            'status' => 'required|in:0,1',
            'slider_image' => 'image|mimes:jpeg,png,jpg,gif|max:2000',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2000'
        ]);

        try{
            $update = [
                'title'=> $request->title,
                'read_more'=> $request->read_more,
                'status'=> $request->status > 0 ? '1' : '0',
                'updated_at' => date('Y-m-d h:i:s'),
            ];
            $image = '';
            if ($request->file('slider_image') !='') {
                
                $prevImage = CmsBlogSlider::where('id', $id)->get();  
                if (!empty($prevImage) && $prevImage[0]->image !="") {
                    if (File::exists('uploads/blog-slider/'.$prevImage[0]->image)) {
                        File::delete('uploads/blog-slider/'.$prevImage[0]->image);
                        File::delete('uploads/blog-slider/thumbnail/thumb-'.$prevImage[0]->image);
                    }
                } 
                
                $file = $request->file('slider_image');
                $image = Str::slug($request->title).'-'.Auth::user()->id.time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/blog-slider', $image);
    
                //Thumbnail create
                $dir = public_path('uploads/blog-slider/thumbnail/');
                if(!file_exists( $dir ) && !is_dir( $dir ))
                {
                    mkdir($dir,0777,true);
                }
                Image::make('uploads/blog-slider/'.$image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($dir.'thumb-'.$image);

                $update['image'] = $image;
            }

            $data = CmsBlogSlider::find($id);
            $data->update($update);

            return redirect()->back()->withSuccess('Blog slider updated successfully.');
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
            CmsBlogSlider::find($id)->delete();
            return redirect()->route('reseller.blog-slider.index')->withSuccess('Blog post delete successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
