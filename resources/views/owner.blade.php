

@extends('layouts.header')
   
<!-- Container (Upload Section) -->

@section('content')
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default" id="signup">
      <div class="panel-heading">Create an event image</div>
        <div class="panel-body">
          <div class="container-fluid">
            <form method="post" action="{{route('create')}}" enctype="multipart/form-data">
              {{csrf_field()}}
               <div class="col-sm-12 slideanim">
                 <div class="form-group">
                   <label for="exampleFormControlFile1">Choose Image:</label>
                   <input type="file" class="form-control form-control-file" id="FormControlFile1" name="image">
                </div>
                <div class="form-group">
                   <label for="exampleFormControlFile1">First Name:</label>
                     <input type="text" class="form-control form-control-text" id="" name="First-name">
                 </div>
                 
                 <div class="row">
                   <div class="col-sm-12 form-group">
                     <button class="btn btn-success pull-right" type="submit">Create</button>
                   </div>
                </div>
              </div>
           </form>
         </div>
       </div>
     </div>
   </div>
@endsection
