<!-- <div class="p-4 mb-3 bg-light rounded">
  <h4 class="font-italic">About</h4>
  <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
</div> -->

<div class="p-4">
  <h4 class="font-italic">Movie genres</h4>
  <ol class="list-unstyled mb-0">
    @foreach($genres as $genre)
      <li><a href="#">{{$genre->name}}</a></li>
    @endforeach
  </ol>
</div>

<div class="p-4">
  <h4 class="font-italic">The professions of celebrities</h4>
  <ol class="list-unstyled mb-0">
    @foreach($professions as $profession)
      <li><a href="#">{{$profession->name}}</a></li>
    @endforeach
  </ol>
</div>
