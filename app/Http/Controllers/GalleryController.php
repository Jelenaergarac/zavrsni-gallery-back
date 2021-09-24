<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
             $value = $request->query('value');
        $galleries = Gallery::search($value)->with('images', 'user', 'comments')->orderBy('created_at', 'desc')->paginate(10);
        
        return response()->json($galleries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGalleryRequest $request)
    {
   
            $data = $request->validated();
        
        $gallery = new Gallery;
        $gallery->title = $data['title'];
        $gallery->description = $data['description'];
        $gallery->user()->associate(Auth::user());
        $gallery->save();

        $image = new Image;
        $image->imageUrl = $data['imageUrl'];
        $image->gallery()->associate($gallery);
        $image->save();

        return response()->json($gallery);
       
   
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['comments.user','images', 'user.galleries']);
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request,Gallery $gallery)
    {
        $data = $request->validated();
        $gallery->update($data);
        return response()->json($gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response()->noContent();
    }
    public function getMyGalleries($user_id){
        $myGalleries = Gallery::with('images','comments')->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return response()->json($myGalleries);
    }
}
