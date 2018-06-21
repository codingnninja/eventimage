<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventImageBuilderController extends Controller
{
    protected $tagline,
              $__ename,
              $x_offset,
              $y_offset,
              $result,
              $template,
              $imageUrl = 'https://res.cloudinary.com/nyscapp/image/upload/v1529219926/';

            
    public function index (Request $request) {
        $this->tagline = 'Create social image for your events.';
        return view('welcome', ['url' => 1, 'tagline' => $this->tagline]);
    }

   /* public function template (Request $request) {
        $this->tagline = 'Your identification image has been created successfully.';
        return view('pages.result', ['url'=> null, 'image' =>'yes.jpg', 'tagline' => $this->tagline]);
    }*/

    public function create (Request $request) {
        
        if( $request->hasFile('image') ) {
            $foregroundImg = $request->file('image');
        }
        //template = Image event creator supplied
        $this->template = $request->template;

        $random = rand(0, 1);

        if ($this->template === "yes") {
            $backgroundImg = $this->getRandomImagePath($random);
            $event_name = $request->event_name;
            $website = $request->website;
            $img = $this->combineImages($backgroundImg, $foregroundImg);
            $this->result = $this->makeWithTemplate($img, $event_name, $website);
            $imagePath = $this->imageUrl.$this->result.".jpg";
        }
        
        if ($this->template === "no") {

            $backgroundImg = $this->imageUrl.$request->event_name.".jpg";
            $width_height = explode("_", $request->website);
            $this->result = $this->
                                customized(
                                    $backgroundImg, 
                                    $foregroundImg,
                                    $width_height[0],
                                    $width_height[1]
                                );

            $imagePath = $this->imageUrl.$this->result.".jpg";
        }

        $this->tagline = 'Your identification image has been created successfully.';
        return view('pages.result', ['url'=> null, 'image' =>$imagePath, 'tagline' => $this->tagline]);
    }

    public function makeWithTemplate ($img, $event_name, $website) {
        //It is made with template because it makes text wiht inbuilt templ
        $image = $this->
                     writeOnImage($img, $event_name, $website);
        return $this->save($image);
    }

    public function customized ($backgroundImg, $foregroundImg, $x_offset, $y_offset){
        $image = $this->
                    combineImages($backgroundImg, $foregroundImg, $x_offset, $y_offset);
        return $this->save($image);
    }

    public function setAsBackground ($path) {
        return \Image::make($path);
    }

    public function cropProfileImage ($file_path,$w = 202, $h = 196) {
        return \Image::make($file_path)->fit($w,$h, function ($constraint) {
            $constraint->upsize();
        }, 'top');
    }

    public function getRandomImagePath ($randomNum) {
        $paths = ['newstand.png'];
        return "images/".$paths[$randomNum];
    }

    public function combineImages ($backgroundImg = null, $foregroundImg = null, $x_offset = 21, $y_offset = 37) {
        $background = $this->setAsBackground($backgroundImg);
        $foreground = $this->cropProfileImage($foregroundImg);
        $initialPosition = 'top-left';
        if ($this->template === "no") { 
            $initialPosition = '';
         }
        return $background
                   ->insert($foreground, $initialPosition, $x_offset,$y_offset);      
    }

    public function writeOnImage ($img, $text = "", $url= "") {
        $imgWithText = $this->writeEventNameOnImage($img, $text);
        $imgWithTextAndUrl = $this->writeUrlOnImage($imgWithText, $url);
        return $imgWithTextAndUrl;
    }

    public function writeEventNameOnImage ($image = null, $ename = 'EventImage 2018') {
       
        $this->__ename = explode(' ', trim($ename));;
        for ($i=0; $i < count($this->__ename) ; $i++) { 
            $image->text(
                $this->__ename[$i], 
                367, 
                $this->heights(count($this->__ename), $i),
                $this->setTextStyle() 
            );        
        }
        
        return $image;
    }

    public function writeUrlOnImage ($image = null, $url = 'eventimage.herokuapp.com') {
        $this->__fontControl = 18;
        $image->text(
            'Register @ '.$url, 
            70, 
            280,
            //This is a duplicate code but the library used necessitates it until a workaround is found.
            function ($font) {   
            $font->file('fonts/ARMYC__0.ttf');
            $font->size(18);
            $font->color('#fff');
        });
        return $image;
    }

    public function save ($image) {
        $path = 'images/yes.jpg';
        $result = $image->save($path);
        return $this->sendToCloudinary($path);
    }

    public function heights ($wordCount = null, $index = null ){
        $heights = [168, 200, 235 ];
        return $wordCount === 1 ? 160 : $heights[$index];
    }

    public function normalizeFontSize ($wordCount = null) {
        return $wordCount === 1 ? 38 : 38;
    }

    public function customize (Request $request) {
        
        $this->tagline = 'Customize your event image as you like.';
        return view('pages.customize', [ 'url'=>1, 'tagline' => $this->tagline]);
    }

    public function setTextStyle (){
        return  function ($font) {
            $this->__fontControl = count($this->__ename);    
            $font->file('fonts/ARMYC__0.ttf');
            $font->size($this->normalizeFontSize($this->__fontControl));
            $font->color('#fff');
            $font->align('center');
            $font->valign('center');
        };
    }

    public function sendToCloudinary ($path){
       
        \Cloudinary::config(array(
            "cloud_name" => env('CLOUDINARY_NAME'),
            "api_key" => env('CLOUDINARY_API_KEY'),
            "api_secret" => env('CLOUDINARY_API_SECRET')
        ));
        
        $result = \Cloudinary\Uploader::upload($path, array("flags" => "attachment"));
        return $result['public_id'];
    }
    
    public function processTemplate () {
        request()->validate([
            'event_name'  => 'required|string|max:255',
            'event_url'   => 'required|string',
        ]);

        $this->tagline = "Your request has been processed successfully";
       
        $event_name = request('event_name');
        $reg_url    = request('event_url');
        $path       = "https://eventimage.herokuapp.com/ext-user/{$reg_url}/{$event_name}/yes";

        return view('pages.result', [ 'url'=> $path, 'image' => 'pgmc.png', 'tagline' => $this->tagline]);
    }

    public function template () {
        $this->tagline = 'Create your event image with our templates.';
        return view('pages.template', ['tagline' => $this->tagline]);
    }

    public function externerUser (Request $request, $website, $ename, $template) {
        $this->tagline = "Create a social image for your events.";
        return view('pages.owner', ['ename' => $ename, 'website' => $website, 'tagline' => $this->tagline, 'template' => $template]);
    }

    public function processCustomize (Request $request) { 
        $this->tagline = "Your custome event image has been created successfully";
        $request->validate([
            'image' => 'required',
        ]);

        if ( $request->hasFile('image') ) {
            $backgroundImg = $request->file('image');
        }

        $width_height = $request->width_height;
        $imageId = $this->sendToCloudinary($backgroundImg);
        $path = "https://eventimage.herokuapp.com/ext-user/{$width_height}/{$imageId}/no"; 

        return view('pages.result', [ 'url'=> $path, 'image' => 'pgmc.png', 'tagline' => $this->tagline]); 
    }
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

