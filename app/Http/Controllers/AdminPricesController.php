<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Price;
use App\Http\Requests\PriceCreateRequest;
use App\Http\Requests\PriceEditRequest;
use Illuminate\Support\Facades\Session;
use DB;

class AdminPricesController extends Controller
{
    public function index()
    {
      $movies = Movie::all()->sortBy('movie.price.value');

      return view('admin.prices.index', compact('movies'));
    }

    //By default, movie gets a price value. In case we using seeds, some movie does not get a value. fixed
    public function edit($id)
    {
      $movie = Movie::findOrFail($id);
      $price = Price::where('movie_id', $id)->first();
      //Checking if value of price exist. If it's not exist, price get a value 0 and needs to be edited because it can not be a 0.
      if($price === null)
      {
        $price = new Price;
        $price->movie_id = $id;
        $price->value = 0;
        $price->save();
        $price = Price::where('movie_id', $price->movie_id)->first();
      }
      else
      {
        $price = Price::where('movie_id', $id)->first();
      }

      return view('admin.prices.edit', compact('price'));
    }

    public function update(PriceEditRequest $request, $id)
    {
        $price = Price::findOrFail($id);
        $input = $request->all();
        $price->update($input);
        Session::flash('updated_price', 'The price of movie "'.$price->movie->name.'" has been changed to '.$request->value.' $');

        return redirect('/admin/prices');
    }

    public function destroy($id)
    {
      $price = Price::findOrFail($id);
      $price->delete();
      Session::flash('deleted_price', 'The price '.$price->name.' has been deleted.');

      return redirect('admin/prices');
    }
}
