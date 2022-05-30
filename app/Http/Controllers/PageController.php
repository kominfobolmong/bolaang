<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use App\Models\Post;
use App\Models\Event;
use App\Models\Tag;
use App\Models\Slider;
use App\Models\Leader;
use App\Models\Service;
use App\Models\Banner;
use App\Models\Statik;
use App\Models\Category;
use App\Models\Dinasdetail;
use App\Models\Instansi;
use App\Models\Download;
use App\Models\Travel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Profile;

class PageController extends Controller
{
    public function index(){
        $posts = News::with('tags')->take(3)->latest()->get();
        $events = Event::take(3)->latest()->get();
        $sliders = Slider::latest()->get();
        $services = Service::all();
        return view('lolak/index',compact(
            'posts','events','sliders','services'));
    }

    public function eventDetail(Request $request, $id){
        $events = Event::where('id', $id)->firstOrFail();
        return view('bolmongkab/detail/agenda-detail',compact('events'));
    }

    public function visimisi(){
        $visimisi = Profile::first();
        return view('lolak/detail/visimisi',compact('visimisi'));
    }

    public function dasarhukum(){
        $dasarhukum = Profile::first();
        return view('lolak/detail/dasarhukum',compact('dasarhukum'));
    }

    public function event(){
        $events = Event::latest()->paginate(5);
        return view('lolak/detail/agenda',compact('events'));
    }

    public function download(){
        $downloads = Download::latest()->paginate(5);
        return view('bolmongkab/detail/download',compact('downloads'));
    }

    public function getDownload(Request $request, $id) {
        $downloads = Download::where('id', $id)->firstOrFail();
        return view('admin.download.show',compact('downloads'));
    }

    public function berita(Request $request) {
        $kategori = Category::latest()->get();
        $posts = News::latest()->Paginate(5);
        $sidebar = News::skip(5)->Paginate(5);
        $tags = Tag::get();
        
        return view('lolak/detail/berita',compact('posts','kategori','sidebar','tags'));
    }

    public function beritaDetail(Request $request, $id){
        if($request->has('cari')){
            $kategori = Category::latest()->get();
            $tags = Tag::latest()->get();
            $sidebar = News::skip(5)->Paginate(5);
            $posts = News::where('title','LIKE','%'.$request->cari.'%')->with('kategori')->get();
            return view('lolak/detail/berita',compact('posts','kategori','sidebar','tags'));
        } else {
            $kategori = Category::latest()->simplePaginate(5);
            $posts = News::where('id', $id)->firstOrFail();
            $tags = Tag::latest()->get();
            $sidebar = News::skip(5)->Paginate(5);
            return view('lolak/detail/berita-detail',compact('posts','sidebar','kategori','tags'));
        }

    }

    public function hascarberita(Request $request) {
        if($request->has('cari')){
            $kategori = Category::latest()->get();
            $tags = Tag::latest()->get();
            $sidebar = News::skip(5)->Paginate(5);
            $posts = News::where('title','LIKE','%'.$request->cari.'%')->get();
        } else {
            $kategori = Category::latest()->simplePaginate(5);
            $posts = News::where('id', $id)->firstOrFail();
            $tags = Tag::latest()->get();
            $sidebar = News::skip(5)->Paginate(5);
        }
        return view('lolak/detail/hascarberita',compact('posts','kategori','sidebar','tags'));
    }

    public function hascarpengumuman(Request $request) {
        if($request->has('cari')){
            $kategori = Category::latest()->get();
            $tags = Tag::latest()->get();
            $sidebar = Post::skip(5)->Paginate(5);
            $posts = Post::where('title','LIKE','%'.$request->cari.'%')->get();
        } else {
            $kategori = Category::latest()->simplePaginate(5);
            $posts = Post::where('id', $id)->firstOrFail();
            $tags = Tag::latest()->get();
            $sidebar = Post::skip(5)->Paginate(5);
        }
        return view('bolmongkab/detail/hascarpengumuman',compact('posts','kategori','sidebar','tags'));
    }

    public function kategori(Category $category) {
       
            $kategori = Category::latest()->get();
            $tags = Tag::latest()->get();
            $sidebar = News::skip(5)->Paginate(5);
            $posts = $category->news()->latest()->paginate(4);

        return view('lolak/detail/berita',compact('posts','kategori','sidebar','tags'));
    }

    public function tag(Tag $tag) {
       
        $kategori = Category::latest()->get();
        $tags = Tag::latest()->get();
        $sidebar = Post::skip(5)->Paginate(5);
        $posts = $tag->posts()->latest()->paginate(4);

    return view('bolmongkab/detail/pengumuman',compact('posts','kategori','sidebar','tags'));
}
}
