

@extends('layouts.header')
   
<!-- Container (Upload Section) -->

@section('content')
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default" id="signup">
      <div class="panel-heading">Create an event image</div>
        <div class="panel-body">
          <div class="container-fluid">
            <form method="post" action="{{route('processTemplate')}}" enctype="multipart/form-data">
              {{csrf_field()}}
               <div class="col-sm-12 slideanim">
                 <div class="form-group">
                   <label for="description">Event Name (4 words or less):</label>
                     <input type="text" class="form-control form-control-text" id="" name="event_name">
                 </div>
                 <div class="form-group">
                   <label for="description">Registration url:</label>
                     <input type="text" class="form-control form-control-text" id="" name="event_url">
                     <a href="tml">
                       <small>E.g www.yourwebsite.com/register</small>
                     </a>
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
