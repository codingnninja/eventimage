@extends('layouts.header')
   @section('content')
     <div class="col-md-8 col-md-offset-2">
       <div class="panel panel-default" id="">
         <div class="panel-heading">
           <h3>Customize your event image</h3>
           <hr>
           Make sure your graphics has 490(width) x 292(height)
         </div>
           <div class="panel-body">
             <div class="resize-container col-sm-12" id="resize-container">
               <div id="drag-1" class="draggable">
                 <p> Photo </p>
               </div>
             </div>
             <div class="col-sm-12" style="color:red" id="messages">No file selected.</div>
             <div class="container-fluid">
               <form method="post" action="{{route('processCustomize')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                 <br>
                 <div class="col-sm-12 slideanim">
                   <br>
                   <div class="form-group">
                     <label for="exampleFormControlFile1">Choose a graphical image:</label>
                     <input type="file" class="form-control form-control-file" name="image" accept="image/*" id="chooseImg" onchange="updateImageDisplay('#chooseImg', '#resize-container')">
                  </div>
                  <input type="hidden" name="width_height" id="width_height">
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
