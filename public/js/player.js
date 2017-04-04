var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


var player;

function onYouTubePlayerAPIReady() {
  // create the global player from the specific iframe (#video)
  player = new YT.Player('ytplayer', {
    events: {
      // call this function when player is ready to use
      'onReady': onPlayerReady,
      'onStateChange': onStateChange
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

function onStateChange(event){
	console.log("State: "+event.data);

	if(event.data == 0)
		$('#next').click();
}

var flag="playing";





$(document).ready(function(){


	$('#ytplayer').hide();
	$('#gaanaplayer').hide();
	
	$('#togglePlay').click(function(){

			if(flag=="playing")
			{
				$('#play-pause').html('pause');
				flag="paused";
				console.log("Player paused!");
			}
			else
			{

				$('#play-pause').html('play_arrow');
				flag="playing";
				console.log("Player resumed!");
			}
			var source = $('.active').children('div').eq(2).html();
			if(! source)
			{
				var first_song_id = parseInt($('.collection').children('li').first().attr('id'));
				var last_song_id = parseInt($('.collection').children('li').last().attr('id'));
				if($('#toggleShuffle').is(":checked") == true)
				{
					var idArray = [];
					for (var i = first_song_id; i <= last_song_id; i++)
					    idArray.push(i);

					while(next_song_id == current_song_id)
						next_song_id = idArray[Math.floor(Math.random() * (i-1)) ];
					
				}
				else
					$('.collection').children('li').first().click();					
			}
			console.log("Source: "+source);
			if(source=="gaana")
			{
				if(flag=="playing")
				{
					$('#gaanaplayer').attr('src','');
					flag="paused";
					console.log("Player paused!");
				}
				else
				{

					$('#gaanaplayer').attr('src',$('.active').children('div').first().html());
					flag="playing";
					console.log("Player resumed!");
				}
			}
	});


	$('#next').click(function(){
			$('#play-pause').html('pause');
			var current_song_id = parseInt($('.active').attr('id'));
			var first_song_id = parseInt($('.collection').children('li').first().attr('id'));
			var last_song_id = parseInt($('.collection').children('li').last().attr('id'));
			var next_song_id = current_song_id;
			if($('#toggleShuffle').is(":checked") == true)
			{
				var idArray = [];
				for (var i = first_song_id; i <= last_song_id; i++)
				    idArray.push(i);

				while(next_song_id == current_song_id)
					next_song_id = idArray[Math.floor(Math.random() * (i-1)) ];
				
			}
			else
			{
			
				if(current_song_id==last_song_id)
					next_song_id = first_song_id;
				else
					next_song_id = current_song_id+1;
			}	
			
			console.log("Current Song ID: "+current_song_id);
			console.log("First Song ID: "+first_song_id);
			console.log("Last Song ID: "+last_song_id);
			console.log("Next Song ID: "+next_song_id);
			var source = $('#'+next_song_id).children('div').eq(2).html();

			if(source=="youtube")
		    {
		    	var yt_id = UrlToId($('#'+next_song_id).children('div').first().html());
				var url = YtIdToEmbedUrl(yt_id);
				$('#gaanaplayer').attr('src','');
				$('#ytplayer').attr('src',url);
				$('#ytplayer').show();
		    }	
		    else if(source=="gaana")
		    {
		    	var url = $('#'+next_song_id).children('div').first().html();
		    	$('#ytplayer').attr('src','');
		    	$('#ytplayer').hide();
		    	$('#gaanaplayer').attr('src',url);
		    }
		    else if(source=="saavn")
			{
				console.log("Saavn!");
				var url = $('#'+next_song_id).children('div').first().html();
				$('#ytplayer').attr('src','');
				$('#ytplayer').hide();
				$('#gaanaplayer').attr('src','');
			    $('#gaanaplayer').hide();
			    window.open(url, '_blank');

			}
			$('li').removeClass('active');
			$('#'+next_song_id).addClass('active');
			$('#current_song').html("Currently Playing: "+$('#'+next_song_id).children('span').first().html());
	});

	$('#prev').click(function(){
			$('#play-pause').html('pause');
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
			var source = $('#'+prev_song_id).children('div').eq(2).html();
			if(source=="youtube")
		    {
		    	var yt_id = UrlToId($('#'+prev_song_id).children('div').first().html());
				var url = YtIdToEmbedUrl(yt_id);
				$('#gaanaplayer').attr('src','');
				$('#ytplayer').attr('src',url);
				$('#ytplayer').show();
		    }	
		    else if(source=="gaana")
		    {
		    	var url = $('#'+prev_song_id).children('div').first().html();
		    	$('#ytplayer').attr('src','');
		    	$('#ytplayer').hide();
		    	$('#gaanaplayer').attr('src',url);
		    }
		    else if(source=="saavn")
			{
				console.log("Saavn!");
				var url = $('#'+prev_song_id).children('div').first().html();
				$('#ytplayer').attr('src','');
				$('#ytplayer').hide();
				$('#gaanaplayer').attr('src','');
			    $('#gaanaplayer').hide();
			    window.open(url, '_blank');
			}
			$('li').removeClass('active');
			$('#'+prev_song_id).addClass('active');
			$('#current_song').html("Currently Playing: "+$('#'+prev_song_id).children('span').first().html());
	});

	$('.song_listing').click(function(){
			$('#play-pause').html('pause');
			flag="paused";
			var source = $(this).children('div').eq(2).html();
			if(source=="gaana")
			{
				console.log("Gaana!");
				var url = $(this).children('div').first().html();
				$('#ytplayer').attr('src','');
				$('#ytplayer').hide();
				$('#gaanaplayer').attr('src',url);
			    $('#gaanaplayer').show();
			}
			else if(source=="youtube")
			{
				console.log("YouTube!");
				var yt_id = UrlToId($(this).children('div').first().html());
				var url = YtIdToEmbedUrl(yt_id);
				$('#gaanaplayer').attr('src','');
				$('#ytplayer').attr('src',url);
				$('#ytplayer').show();
			}

			else if(source=="saavn")
			{
				console.log("Saavn!");
				var url = $(this).children('div').first().html();
				$('#ytplayer').attr('src','');
				$('#ytplayer').hide();
				$('#gaanaplayer').attr('src','');
			    $('#gaanaplayer').hide();
			    window.open($(this).children('div').first().html(), '_blank');

			}
			$('li').removeClass('active');
			$(this).addClass('active');
			$('#current_song').html("Currently Playing: "+$(this).children('span').first().html());
	});
  
  
});


function UrlToId(url)
{
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11) ? match[7] : false;
}
function YtIdToEmbedUrl(id)
{
	return "https://www.youtube.com/embed/"+id+"?autoplay=1&enablejsapi=1";
}