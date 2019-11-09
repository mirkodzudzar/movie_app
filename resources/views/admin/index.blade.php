@extends('layouts.admin')

@section('content')
<div class="row mx-auto">
  <div class="card-deck">


    <div class="card text-white bg-primary col-md-6 col-xs-12">
      <div class="card-header">Movies</div>
      <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <i class="fa fa-film fa-4x"></i>
            </div>
            <div class="col-lg-9 text-right">
                <div class="huge">{{$movies_count}}</div>
                <div>Movies</div>
            </div>
        </div>
      </div>
      <a href="{{ route('admin.movies.index') }}">
          <div class="card-footer">
               <span class="pull-left">View Details</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
          </div>
      </a>
    </div>


    <div class="card text-white bg-danger col-md-6 col-xs-12">
      <div class="card-header">Celebrities</div>
      <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <i class="fa fa-user-tie fa-4x"></i>
            </div>
            <div class="col-lg-9 text-right">
                <div class="huge">{{$celebrities_count}}</div>
                <div>Celebrities</div>
            </div>
        </div>
      </div>
      <a href="{{ route('admin.celebrities.index' )}}">
          <div class="card-footer">
               <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
          </div>
      </a>
    </div>


    <div class="card text-white bg-warning col-md-6 col-xs-12">
      <div class="card-header">Users</div>
        <div class="card-body">
          <div class="row">
              <div class="col-lg-3">
                  <i class="fa fa-user fa-4x"></i>
              </div>
              <div class="col-lg-9 text-right">
                  <div class="huge">{{$users_count}}</div>
                  <div>Users</div>
              </div>
          </div>
        </div>
        <a href="{{ route('admin.users.index' )}}">
            <div class="card-footer">
                 <span class="pull-left">View Details</span>
                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>


  </div>
</div>


<div class="row mx-auto">
  <div class="card-deck">


    <div class="card text-white bg-success col-md-6 col-xs-12">
      <div class="card-header">Images for celebs</div>
      <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <i class="fa fa-portrait fa-4x"></i>
            </div>
            <div class="col-lg-9 text-right">
                <div class="huge">{{$celebritie_image_count}}</div>
                <div>Images</div>
            </div>
        </div>
      </div>
      <a href="{{ route('admin.images.index') }}#celebrities">
          <div class="card-footer">
               <span class="pull-left">View Details</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
          </div>
      </a>
    </div>


    <div class="card bg-purple col-md-6 col-xs-12">
      <div class="card-header">Images for movies</div>
      <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <i class="fa fa-images fa-4x"></i>
            </div>
            <div class="col-lg-9 text-right">
                <div class="huge">{{$movie_image_count}}</div>
                <div>Images</div>
            </div>
        </div>
      </div>
      <a href="{{ route('admin.images.index') }}#movies">
          <div class="card-footer">
               <span class="pull-left">View Details</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
          </div>
      </a>
    </div>


    <div class="card text-white bg-info col-md-6 col-xs-12">
      <div class="card-header">News</div>
      <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <i class="fa fa-file-alt fa-4x"></i>
            </div>
            <div class="col-lg-9 text-right">
                <div class="huge">{{$news_count}}</div>
                <div>News</div>
            </div>
        </div>
      </div>
      <a href="{{ route('admin.news.index') }}">
          <div class="card-footer">
               <span class="pull-left">View Details</span>
               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
          </div>
      </a>
    </div>


  </div>
</div>

<div class="row mx-auto">
  <div id="donutchart" style="width: 900px; height: 500px;"></div>
</div>
@endsection
