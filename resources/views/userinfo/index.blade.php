@extends('userinfo.layout')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 Test</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('userinfo.create') }}"> Create New User</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
              <th>Gender</th>
                <th>Skills</th>
                  <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        <?php  $i=1; ?>
        @foreach ($userinfo as $users)

       
        <tr>
            <td>{{ $i ++ }}</td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->email }}</td>
            <td class="text-uppercase">{{ $users->gender }}</td>
            <td>{{ $users->skills }}

                <!--  -->
            </td>
            <td>

                 <img style="width: 100px;" src="{{ asset($users->image) }}" >
                
            </td>
            <td>
                <form action="{{ route('userinfo.destroy',$users->id) }}" method="POST">
   
                    <a class="btn btn-primary" href="{{ route('userinfo.edit',$users->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    


    
      
@endsection