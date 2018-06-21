
<div id="videoDiv"> 
<img src="{{asset('images/bg3.jpg')}}" id="videosubstitute" alt="">
<br>
 
	<div id="videoBlock">   
		<video poster="{{asset('images/bg3.jpg')}}" preload id="video" autoplay muted loop controls>
			<!-- <source src="video/t12.webm" type="video/webm"></source> -->
			<source src="{{asset('video/hero.mp4')}}" type="video/mp4"></source>
		</video> 
		<div id="videoMessageBox">
			<div id="videoMessage">
				<h1 class="spacer"> {{$slot}} </h1>
				<h3 class="spacer">
					We make socializing around events easier.
				</h3> 
			</div>
		</div>
	</div>
</div>

<!-- Full screen image background -->
<!-- <div id="fullScreenDiv">
        <img src="https://www.imi21.com/wp-content/uploads/2016/11/t12.jpg" id="videosubstitute" alt="Full screen background video">
        <div id="videoDiv">           
            <video preload="preload" id="video" autoplay="autoplay" loop="loop">
            <source src="video/t12.webm" type="video/webm"></source>
            <source src="video/t12.mp4" type="video/mp4"></source>
            </video> 
        </div>
        <div id="messageBox"> 
            <div>
                <h1>Full screen background video</h1>
                <h2>Would you like this on your site?</h2>
                <h3><a href="#main" class="scrolly">Read below</a></h3>
            </div>
        </div>   
    </div> -->