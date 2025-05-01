<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">

      <div class="d-flex justify-content-between mt-3">
        <div>
          <h1 class="">User Data</h1>
        </div>
       <div>
        <a href="{{route('create')}}" type="button" style="bottom:0px;" class="btn btn-primary">Add User</a>

       </div>
      </div>


     
        <div class="row">
            <div class="col-md-12 my-3">
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">City</th>
            <th scope="col">Language</th>
            <th scope="col">Gender</th>
            <th scope="col">Photo</th>
            <th scope="col">Message</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
           
          </tr>
        </thead>
        <tbody>

@foreach ($curd as $key=>$curditem)
<tr>
  <th scope="row">{{$key+1}}</th>
  <td>{{$curditem->name}}</td>
  <td>{{$curditem->email}}</td>
  <td>{{$curditem->city}}</td>
  <td>{{$curditem->language}}</td>
  <td>{{$curditem->gender}}</td>
  <td>
    @if ($curditem->photo)
        <img src="{{ asset('storage/' . $curditem->photo) }}" alt="User Photo" style="max-width: 50px;">
    @else
        No Photo
    @endif
</td>
  <td>{{$curditem->message}}</td>
  <td>
    <a href="{{ route('edit', $curditem->id) }}" class="btn btn-success btn-sm">Edit</a>
  </td>
  <td>
    <form action="{{ route('destroy', $curditem->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
</td>

</tr>
@endforeach

        </tbody>
      </table>
    </div>
</div>
</div>

      
</body>
</html>