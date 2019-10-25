<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageCreateRequest;
use App\Movie;
use App\Celebrity;
use App\Image;
use Illuminate\Support\Facades\Session;
use DB;

class AdminImagesController extends Controller
{
    public function __construct()
    {
      $this->middleware('administrator');
    }

    public function index()
    {
      //ADD FUNCTIONALITY FOR SHOWING ONLY CELEBRITIES THAT BELONGS TO CHOSEN MOVIE. SORT BY ID OF IMAGE
      $select_movies = Movie::pluck('name', 'id')->all();
      $movies = Movie::all()->sortBy('name');
      $celebrities = Celebrity::all()->sortBy('last_name');

      return view('admin.images.index', compact('select_movies', 'movies', 'celebrities'));
    }

    public function store(ImageCreateRequest $request)
    {
      $movie = Movie::where('id', $request->movie_id)->first();
      if($file = $request->file('image_id'))
      {
        if($movie != null || $request->celebrity != null)
        {
          $name = time() . $file->getClientOriginalName();
          $file->move('images', $name);
          $image = Image::create(['file' => $name]);
          $input['image_id'] = $image->id;

          if($movie != null)
          {
            $movie->images()->save($image);
          }

          if($request->celebrity != null)
          {
            foreach($request->celebrity as $celebrity)
            {
              $celebrity = Celebrity::where('id', $celebrity)->first();
              $celebrity->images()->save($image);
            }
          }
        }

        else
        {
          Session::flash('create_image_error', 'Choose at least one movie or celebrity.');
          return redirect('admin/images');
        }
      }
      Session::flash('created_image', 'An image has been created.');

      return redirect('admin/images');
    }
    //WE ALSO NEED TO UNLINK THE PATH AND DELETE IMAGE FORM IMAGES TABLE< NOT ONLY DETACH
    public function destroyCelebrityImage($id, $celebrity_id)
    {
      $image = Image::findOrFail($id);
      $celebrity = Celebrity::findOrFail($celebrity_id);
      $celebrity->images()->where('id', $image->id)->detach();//or $id instead of $image->id
      $imageable = DB::table('imageables')->where('image_id', $image->id)->get();
      if($imageable->count() == 0)
      {
        unlink(public_path() . $image->file);
        $image->delete();
      }

      return redirect('/admin/images');
    }
    //WE ALSO NEED TO UNLINK THE PATH AND DELETE IMAGE FORM IMAGES TABLE< NOT ONLY DETACH
    public function destroyMovieImage($id, $movie_id)
    {
      $image = Image::findOrFail($id);
      $movie = Movie::findOrFail($movie_id);
      $movie->images()->where('id', $image->id)->detach();
      $imageable = DB::table('imageables')->where('image_id', $image->id)->get();
      //When we delete last image with specific id, it is going to be deleted and unlinked form pulbic path
      if($imageable->count() == 0)
      {
        unlink(public_path() . $image->file);
        $image->delete();
      }

      return redirect('/admin/images');
    }
}
