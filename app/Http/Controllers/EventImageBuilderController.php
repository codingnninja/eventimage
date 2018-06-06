<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventImageBuilderController extends Controller
{
	protected $tagline;
    public function index (Request $request) {
    	$this->tagline = 'Create your platinum reasoning contest participants image.';
    	return view('welcome', ['url' => null, 'tagline' => $this->tagline]);
    }

    public function create (Request $request) {
    	$this->tagline = 'Your identification image has been created successfully.';
    	if( $request->hasFile('image') ) {
        	$file = $request->file('image');
        }

    	$random = time();
	    $img = \Image::make('images/pgmc.png');
	    $insert = \Image::make($file)->fit(202,196);
	    $img->insert($insert, 'top-left', 21,37);
	    $img->save('images/'.$random.'.jpg');
	    return view('welcome', ['url' => $random.'.jpg', 'tagline' => $this->tagline]);
    }

	/*protected $y_offset = 21, 
	          $x_offset = 37, 
	          $direction,
	          $profile,
	          $croppedProfile,
	          $background,
	          $image;

	function __construct (Request $request) {
		$this->direction = $request->direction;
		$this->profile = $request->profile;
		$this->setOffsets($request);
		$this->setBackground($request);
	}

    public function setBackgroundImage ($request) {
    	if(is_null($request->file()->background)){ 
    		$this->image = Image::make('images/pgmc.jpg'); 
    	}
    	$this->background = $request->background;
    	return $this;
    }

    public function crop() {  
    	$this->croppedProfile = Image::make($this->$profile)->fit(202,196);
    }

    public function setOffsets($request){

    	if (is_null($request->x_offset) && is_null($request->y_offset) {
        	$this->x_offset = 202;
        	$this->y_offset = 196;
        }

        $this->x_offset = $request->x_offset;
        $this->y_offset = $request->y_offset;
    }

    $img->insert($insert, 'top-left', 21,37);
    $a = Image::make('images/yes.jpg')->destroy();
    $img->save('images/yes.jpg');
    return response()->download('images/yes.jpg');*/
}
