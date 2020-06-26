<?php

namespace App\Http\Controllers\reseller;

use App\CmsBlog;
use App\CmsBlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class CmsBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_blog = CmsBlog::where('reseller_id', Auth::user()->id)->get();
        return view('reseller.blog.add_blog.index',compact('cms_blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $get_cms_category = CmsBlogCategory::where('reseller_id', Auth::user()->id)->get();
        return view('reseller.blog.add_blog.create-edit',compact('get_cms_category'));
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
            'post_title' => 'required|max:255',
            'post_content' => 'required',
            'page_url' => 'required|max:255',
            'blog_type'=> 'required|in:0,1,2',
            'is_visibility' => 'required|in:0,1',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif|max:2000',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2000'
        ]);

        try{

            $image = '';
            if ($request->file('post_image') !='') {
                $file = $request->file('post_image');
                $image = Str::slug($request->page_name).time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/blog', $image);
    
                //Thumbnail create
                $dir = public_path('uploads/blog/thumbnail/');
                if(!file_exists( $dir ) && !is_dir( $dir ))
                {
                    mkdir($dir,0777,true);
                }
                Image::make('uploads/blog/'.$image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($dir.'thumb-'.$image);
            }

            $insert = CmsBlog::create([
                'reseller_id'=> Auth::user()->id,
                'category_id'=> $request->blog_category > 0 && $request->blog_category !="" ? $request->blog_category : 0,
                'title'=> $request->post_title,
                'content'=> $request->post_content,
                'slug'=> $this->createSlug(Str::slug(strtolower($request->page_url))),
                'image' => $image,
                'type' => $request->blog_type,
                'visibility'=> $request->is_visibility > 0 ? '1' : '0',
                'created_at' => date('Y-m-d h:i:s'),
            ]);

            return redirect()->route('reseller.blog.index')->withSuccess('Blog post successfully.');
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
        $cmsBlog = CmsBlog::find($id);
        $get_cms_category = CmsBlogCategory::where('reseller_id', Auth::user()->id)->get();
        return view('reseller.blog.add_blog.create-edit',compact('cmsBlog','get_cms_category'));
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
            'post_title' => 'required|max:255',
            'post_content' => 'required',
            'page_url' => 'required|max:255',
            'blog_type'=> 'required|in:0,1,2',
            'is_visibility' => 'required|in:0,1',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif|max:2000',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2000'
        ]);

        try{
            $update = [
                'category_id'=> $request->blog_category !="" ? $request->blog_category : 0,
                'title'=> $request->post_title,
                'content'=> $request->post_content,
                'slug'=> Str::slug(strtolower($request->page_url)),
                'type' => $request->blog_type,
                'visibility'=> $request->is_visibility > 0 ? '1' : '0',
                'updated_at' => date('Y-m-d h:i:s'),
            ];

            $image = '';
            if ($request->file('post_image') !='') {
                
                $prevImage = CmsBlog::where('id', $id)->get();  
                if (!empty($prevImage) && $prevImage[0]->image !="") {
                    if (File::exists('uploads/blog/'.$prevImage[0]->image)) {
                        File::delete('uploads/blog/'.$prevImage[0]->image);
                        File::delete('uploads/blog/thumbnail/thumb-'.$prevImage[0]->image);
                    }
                } 
                
                $file = $request->file('post_image');
                $image = Str::slug($request->page_name).time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/blog', $image);
    
                //Thumbnail create
                $dir = public_path('uploads/blog/thumbnail/');
                if(!file_exists( $dir ) && !is_dir( $dir ))
                {
                    mkdir($dir,0777,true);
                }
                Image::make('uploads/blog/'.$image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($dir.'thumb-'.$image);

                $update['image'] = $image;
            }

            $data = CmsBlog::find($id);
            $data->update($update);

            return redirect()->back()->withSuccess('Blog post updated successfully.');
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
            CmsBlog::find($id)->delete();
            return redirect()->route('reseller.blog.index')->withSuccess('Blog post delete successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //For Generating Unique Slug Our Custom function
    public function createSlug($slug, $id = 0)
    {
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return CmsBlog::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
