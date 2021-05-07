@extends('userinfo.layout')
  
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('userinfo.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   

<form action="{{ route('userinfo.update', $userinfo->id) }}" method="POST" name="update_user" enctype="multipart/form-data">
{{ csrf_field() }}
@method('PATCH')


  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $userinfo->name }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $userinfo->email }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                 <strong>Old Image:</strong>
                <img style="width: 100px;" src="{{ asset($userinfo->image) }}" >
                
            </div>
            <div class="form-group">
                <strong>New Image:</strong>
                <input type="file" name="newimage">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Gender:</strong>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="male"  @if(@$userinfo->gender == "male") checked @endif >
                  <label class="form-check-label" for="flexRadioDefault1">
                    Male
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="gender" value="female"  @if(@$userinfo->gender == "female") checked @endif >
                  <label class="form-check-label" for="flexRadioDefault1">
                    Female
                  </label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Skill:</strong>
                <br>
                <label><input type="checkbox" name="skills[]" value="Laravel"> Laravel</label>
                <label><input type="checkbox" name="skills[]" value="Code-igniter"> Code-igniter</label>
                <label><input type="checkbox" name="skills[]" value="Ajax"> Ajax</label>
                <label><input type="checkbox" name="skills[]" value="Vuejs"> Vuejs</label>
                <label><input type="checkbox" name="skills[]" value="MySQL">MySQL</label>
                <label><input type="checkbox" name="skills[]" value="API">API</label>

            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection