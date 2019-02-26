<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Input;
use Image;

class AdminBannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $banners = Banner::get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'required',
            'link' => 'required',
            ]);

        if($request->status == 0){
            $banner->status = 0;
        } else {
            $banner->status = 1;
        }

        if($request->hasFile('image')){
            $img_tmp = Input::file('image');

            if($img_tmp->isValid()){

                $filename = $img_tmp->getClientOriginalName();
                $banner_path = 'images/banners/' . $filename;

                Image::make($img_tmp)->save($banner_path);

                $banner->image = $filename;
            }
        }
        $banner->title = $request->title;
        $banner->link = $request->link;
        $banner->save();

        return redirect()->route('banners.index')->with('succes', 'Banner created successfully.');


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
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required'
        ]);

        if($request->status == 0){
            $banner->status = 0;
        } else {
            $banner->status = 1;
        }

        if($request->file('image')){
            $img_tmp = Input::file('image');
            if($img_tmp->isValid()){

                $filename = $img_tmp->getClientOriginalName();
                $banner_path = 'images/banners/' . $filename;

                Image::make($img_tmp)->save($banner_path);

                $oldfilename = $banner->image;
                $banner_old_path =  'images/banners/' . $oldfilename;

                unlink ($banner_old_path);

                $banner->image = $filename;

            }

            
        }
        $banner->title = $request->title;
        $banner->link = $request->link;

        $banner->save();

        return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {   

        unlink ('images/banners/'. $banner->image);
        $banner->delete();

        return back()->with('success', 'Banner deleted successfully.');
    }
}
