@extends('layouts.header')
   
<!-- Container (Upload Section) -->

@section('content')

  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default" id="signup">
      <div class="panel-heading">Create an event image</div>
        <div class="panel-body">
          <div class="container-fluid">
            <div class="form-group col-md-6">
              <a href="{{route('template')}}">
               <button class="btn btn-danger large" type="submit">
                 Create with template
               </button>
              </a>
            </div>
            <div class="form-group col-md-6">
              <a href="{{route('customize')}}">
               <button class="btn btn-danger large" type="submit">Create without template
               </button>
              </a>
            </div>
         </div>
       </div>
     </div>
   </div>
@endsection
