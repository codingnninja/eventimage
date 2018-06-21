@extends('layouts.header')
   @section('content')
     @if($url !== null)
       <div class="col-md-6 col-md-offset-2 container-fluid" >
       	<h3>
       	  Give people below url to generate image for your event just like the one provided.
       	</h3>
        <pre> {{ $url }} </pre> 
       </div>
     @endif
	<div class="container-fluid col-md-8 col-md-offset-2"> 	
	  <img src="{{ $image }}" class="img-responsive">
	  <br>
	  <a class="btn btn-danger" href=" {{ $image }}" download>Click to download</a>
	  <br><br>
	  <div class="fb-like" data-href="https://www.facebook.com/motutordotcom" data-layout="standard" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>

     <div class="fb-share-button" data-href="https://eventimage.herokuapp.com" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Feventimage.herokuapp.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
     
    <br>Click like to appreciate our efforts.
	</div>
   @endsection