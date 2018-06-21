

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
 
                <input type="hidden" name="event_name" value="{{ $ename }}">
                <input type="hidden" name="website" value="{{ $website }}">
                <input type="hidden" name="template" value="{{ $template }}">
                <div class="row">
                  <div class="col-sm-12 form-group">
                    <button class="btn btn-success pull-right" type="submit">
                      Create
                    </button>
                  </div>
                </div>
              </div>
           </form>
         </div>
       </div>
     </div>
   </div>
@endsection
