var tag = document.createElement('script');
tag.src = "http://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


var player;

function onYouTubePlayerAPIReady() {
  // create the global player from the specific iframe (#video)
  player = new YT.Player('ytplayer', {
    events: {
      // call this function when player is ready to use
      'onReady': onPlayerReady
    }
  });
}

function onPlayerReady(event) {
  

  
  var togglePlayButton = document.getElementById("togglePlay");
  togglePlayButton.addEventListener("click", function() {
    	
    	var state = player.getPlayerState();
		if(state==1)
    		player.pauseVideo();
    	else
    		player.playVideo();
    		    
  });

  
}





$(document).ready(function(){

	$('#ytplayer').hide();


	$('#next').click(function(){
		var current_song_id = parseInt($('.active').attr('id'));
		var first_song_id = parseInt($('.collection').children('li').first().attr('id'));
		var last_song_id = parseInt($('.collection').children('li').last().attr('id'));
		
		var next_song_id = "";
		if(current_song_id==last_song_id)
			next_song_id = first_song_id;
		else
			next_song_id = current_song_id+1;

		console.log("Current Song ID: "+current_song_id);
		console.log("First Song ID: "+first_song_id);
		console.log("Last Song ID: "+last_song_id);
		console.log("Next Song ID: "+next_song_id);
		var yt_id = UrlToId($('#'+next_song_id).children('div').first().html());
		var url = YtIdToEmbedUrl(yt_id);
		$('#ytplayer').attr('src',url);
		$('li').removeClass('active');
		$('#'+next_song_id).addClass('active');
		$('#current_song').html("Currently Playing: "+$('#'+next_song_id).children('span').first().html());

	});

	$('#prev').click(function(){
		var current_song_id = parseInt($('.active').attr('id'));
		var first_song_id = parseInt($('.collection').children('li').first().attr('id'));
		var last_song_id = parseInt($('.collection').children('li').last().attr('id'));
		
		var prev_song_id = "";
		if(current_song_id==first_song_id)
			prev_song_id = last_song_id;
		else
			prev_song_id = current_song_id-1;

		console.log("Current Song ID: "+current_song_id);
		console.log("First Song ID: "+first_song_id);
		console.log("Last Song ID: "+last_song_id);
		console.log("Next Song ID: "+prev_song_id);
		var yt_id = UrlToId($('#'+prev_song_id).children('div').first().html());
		var url = YtIdToEmbedUrl(yt_id);
		$('#ytplayer').attr('src',url);
		$('li').removeClass('active');
		$('#'+prev_song_id).addClass('active');
		$('#current_song').html("Currently Playing: "+$('#'+prev_song_id).children('span').first().html());
	});

	$('.song_listing').click(function(){


		var yt_id = UrlToId($(this).children('div').first().html());
		var url = YtIdToEmbedUrl(yt_id);
		$('#ytplayer').attr('src',url);
		$('#ytplayer').show();
		$('li').removeClass('active');
		$(this).addClass('active');
		$('#current_song').html("Currently Playing: "+$(this).children('span').first().html());
		
		
	});
  
  
	

	$('#form-submit').hide();
	$('#fetch_data').click(function(){
		console.log("Works!");

		var song_url = $('#url').val();
	    //find & remove protocol (http, ftp, etc.) and get domain
	    if (song_url.indexOf("://") > -1) {
	        song_url = song_url.split('/')[2];
	    }
	    else {
	        song_url = song_url.split('/')[0];
	    }

	    //find & remove port number
	    song_url = song_url.split(':')[0];
	    

	    if(song_url.includes("youtube") || song_url.includes("youtu.be"))
	    	youtube();
	    else if(song_url.includes("last.fm"))
	    	lastfm();
	    else if(song_url.includes("soundcloud"))
	    	soundcloud();
	    else if(song_url.includes("gaana"))
	    	gaana();
	    else if(song_url.includes("saavn"))
	    	saavn();
		else
			console.log("Other");	    


		function gaana()
		{
			var song_url = $('#url').val();
			$.getJSON('http://localhost:3000/api/gaana?url='+song_url,function(data){

				 if (typeof(data) != "undefined")
				 {


				 	 var thumbnailUrl = data.thumbnail;	
				 	 var title = data.title + " by " + data.artist;
				 	 var duration = data.duration;
				 	 
				   //  var duration = ConvertToSeconds(data.items[0].contentDetails.duration);
				     $('.song-thumbnail').attr("src",thumbnailUrl);
				     $('.song-source-logo').attr("src","http://css375.gaanacdn.com/images/logo.png");
				     $('.song-title').html(title);
				     $('.song-duration').html(duration);
					 

				 } 

			});
		}

		function saavn()
		{
			var song_url = $('#url').val();
			$.getJSON('http://localhost:3000/api/saavn?url='+song_url,function(data){

				 if (typeof(data) != "undefined")
				 {

				 	 var thumbnailUrl = data.thumbnail;	
				 	 var title = data.title;
				 	 var duration = data.duration;
				 	 
				   //  var duration = ConvertToSeconds(data.items[0].contentDetails.duration);
				     $('.song-thumbnail').attr("src",thumbnailUrl);
				     $('.song-source-logo').attr("src","/logo/saavn.png");
				     $('.song-title').html(title);
				     $('.song-duration').html(duration);
					 

				 } 

			});
		}

		function soundcloud()
		{
			$.ajax({
			     url: "https://soundcloud.com/user-61321127/swanggml",
			     crossDomain: true,
			     dataType: 'text',
			     success: function(data) {
			     	console.log(data);
			          /*var elements = $("<div>").html(data)[0].getElementsByTagName("ul")[0].getElementsByTagName("li");
			          for(var i = 0; i < elements.length; i++) {
			               var theText = elements[i].firstChild.nodeValue;
			               // Do something here
			          }*/
			     }
			});
		}

		function lastfm()
		{
			var song_url = $('#url').val();


		}
		

		function youtube()
		{
			/*var vid_url = $('#url').val();

			var vid_id = UrlToId(vid_url);
			var api_key = 'AIzaSyBNoSJcGmYl0G1HjYVdA8V1lT-dPJPzTjY';

			$.getJSON('https://www.googleapis.com/youtube/v3/videos?id='+vid_id+'&key='+api_key+'&part=snippet,contentDetails&callback=?',function(data){

				 if (typeof(data.items[0]) != "undefined")
				 {


				 	 var thumbnailUrl = "https://img.youtube.com/vi/"+vid_id+"/maxresdefault.jpg"	
				 	 var title = data.items[0].snippet.title;
				     var duration = ConvertToSeconds(data.items[0].contentDetails.duration);
				     $('.song-thumbnail').attr("src",thumbnailUrl);
				     $('.song-source-logo').attr("src","/logo/yt.png");
				     $('.song-title').html(title);
				     $('.song-duration').html(duration+" seconds");
				     

					 

				 } 

			});*/

			var song_url = $('#url').val();
			$.getJSON('http://localhost:3000/api/yt?url='+song_url,function(data){

				 if (typeof(data) != "undefined")
				 {

				 	 var thumbnailUrl = data.thumbnail;	
				 	 var title = data.title;
				 	 var duration = ConvertToSeconds(data.duration);
				 	 var description = data.description;
				 	 
				   //  var duration = ConvertToSeconds(data.items[0].contentDetails.duration);
				     $('.song-thumbnail').attr("src",thumbnailUrl);
				     $('.song-source-logo').attr("src","/logo/yt.png");
				     $('.song-title').html(title);
				     $('.song-duration').html(duration+" seconds");
				     $('#title').val(title);
				     $('#source').val("youtube");
				     $('#duration').val(duration);
				     $('#description').val(description);
				     $('#thumbnail').val(thumbnailUrl);
					 

				 } 

			});



		}

		


		$('#form-submit').show();
	});

	

});

	
function UrlToId(url)
{
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11) ? match[7] : false;
}

function ConvertToSeconds(duration) 
{
  var match = duration.match(/PT(\d+H)?(\d+M)?(\d+S)?/);
  var hours = (parseInt(match[1]) || 0);
  var minutes = (parseInt(match[2]) || 0);
  var seconds = (parseInt(match[3]) || 0);
  return hours * 3600 + minutes * 60 + seconds;
}

function YtIdToEmbedUrl(id)
{
	return "http://www.youtube.com/embed/"+id+"?autoplay=1&enablejsapi=1";
}
