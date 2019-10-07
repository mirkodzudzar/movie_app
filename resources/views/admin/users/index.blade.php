<ul>
  @foreach($users as $user)
    <li><b>First name: </b>{{$user->first_name}}, <b>Last name: </b>{{$user->last_name}}, <b>Username: </b>{{$user->username}}, <b>Email: </b>{{$user->email}}</li>
  @endforeach
</ul>
