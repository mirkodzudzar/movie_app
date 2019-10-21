<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageCreateRequest;
use App\Movie;
use App\Celebrity;
use App\Image;
use Illuminate\Support\Facades\Session;

class AdminImagesController extends Controller
{
    public function index()
    {
      $select_movies = Movie::pluck('name', 'id')->all();
      $movies = Movie::all();
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

    public function destroy()
    {
      echo 'destroy image';
    }
}
