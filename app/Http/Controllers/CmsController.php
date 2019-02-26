<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;

class CmsController extends Controller
{
    public function addCmsPage(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $cmspage = new CmsPage();
            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            if(empty($data['status'])){
                $cmspage->status = 0;
            }else {
                $cmspage->status = 1;
            }
            $cmspage->save();
            return redirect()->back()->with('success', 'CMS page has been added successfully');
        }
        return view('admin.pages.add_cms_page');
    }

    public function viewCmsPages()
    {
        $cmsPages = CmsPage::get();

        return view('admin.pages.view_cms_pages', compact('cmsPages'));
    }
}
