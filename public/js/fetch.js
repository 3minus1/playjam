$(document).ready(function(){

	$('#loader').hide();
	$('#reset').hide();

	$('#reset').click(function(){
		$('#url').val("");
		$('#song-thumbnail').attr('src',"");
		$('#song-title').html("");
		$('#song-duration').html("");
		$('#song-source-logo').attr('src',"");
		$('#form-submit').hide();
		$('#reset').hide();
		$('#fetch_data').show();

	});

	$('#form-submit').hide();
	$('#fetch_data').click(function(){
		$('#fetch_data').hide();
		$('#loader').show();
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
	    else if(song_url.includes("gaana"))
	    	gaana();
	    else if(song_url.includes("saavn"))
	    	saavn();
		else
			console.log("Other");	 



		function gaana()
		{
			var song_url = $('#url').val();
			$.getJSON('http://139.59.64.234:3000/api/gaana?url='+song_url,function(data){

				 if (typeof(data) != "undefined")
				 {


				 	 var thumbnailUrl = data.thumbnail;	
				 	 var title = data.title + " by " + data.artist;
				 	 var duration = MMSStoSS(data.duration);
				   	 $('#song-thumbnail').removeClass();
				   	 $('#song-thumbnail').addClass("song-thumbnail gaanaThumbnail");
				     $('.song-thumbnail').attr("src",thumbnailUrl);
				     $('#song-source-logo').removeClass();
				     $('#song-source-logo').addClass("song-source-logo gaanaLogo");
				     $('.song-source-logo').attr("src","http://css375.gaanacdn.com/images/logo.png");
				     $('.song-title').html(title);
				     $('.song-duration').html("Duration: "+secondsToMMSS(duration));
				     $('#title').val(title);
				     $('#source').val("gaana");
				     $('#duration').val(duration);
				     $('#description').val("Visit Gaana.com for more details!");
				     $('#thumbnail').val(thumbnailUrl);
				 } 
				 $('#loader').hide();
				 $('#form-submit').show();
				 $('#reset').show();

			});
		}

		function saavn()
		{
			var song_url = $('#url').val();
			$.getJSON('http://139.59.64.234:3000/api/saavn?url='+song_url,function(data){

				 if (typeof(data) != "undefined")
				 {

				 	 var thumbnailUrl = data.thumbnail;	
				 	 var title = data.title;
				 	 var duration = data.duration;
				 	 var description = data.description;
				     $('#song-thumbnail').removeClass();
				   	 $('#song-thumbnail').addClass("song-thumbnail saavnThumbnail");
				     $('.song-thumbnail').attr("src",thumbnailUrl);
				     $('#song-source-logo').removeClass();
				     $('#song-source-logo').addClass("song-source-logo saavnLogo");
				     $('.song-source-logo').attr("src","/logo/saavn.png");
				     $('.song-title').html(title);
				     $('.song-duration').html("Duration: "+secondsToMMSS(duration));
				     $('#title').val(title);
				     $('#source').val("saavn");
				     $('#duration').val(duration);
				     $('#description').val(description);
				     $('#thumbnail').val(thumbnailUrl);
				 } 
				 $('#loader').hide();
				 $('#form-submit').show();
				 $('#reset').show();
			});
		}


		function youtube()
		{
			
			var song_url = $('#url').val();
			$.getJSON('http://139.59.64.234:3000/api/yt?url='+song_url,function(data){

				 if (typeof(data) != "undefined")
				 {

				 	 var thumbnailUrl = data.thumbnail;	
				 	 var title = data.title;
				 	 var duration = ConvertToSeconds(data.duration);
				 	 var description = data.description;
				     $('#song-thumbnail').removeClass();
				   	 $('#song-thumbnail').addClass("song-thumbnail youtubeThumbnail");
				     $('.song-thumbnail').attr("src",thumbnailUrl);
				     $('#song-source-logo').removeClass();
				     $('#song-source-logo').addClass("song-source-logo youtubeLogo");
				     $('.song-source-logo').attr("src","/logo/yt.png");
				     $('.song-title').html(title);
				     $('.song-duration').html("Duration: "+secondsToMMSS(duration));
				     $('#title').val(title);
				     $('#source').val("youtube");
				     $('#duration').val(duration);
				     $('#description').val(description);
				     $('#thumbnail').val(thumbnailUrl);
				 } 
				 $('#loader').hide();
				 $('#form-submit').show();
				 $('#reset').show();
			});
		}

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
	return "https://www.youtube.com/embed/"+id+"?autoplay=1&enablejsapi=1";
}


function MMSStoSS(mmss)
{
	var parts = mmss.split(':'); // split it at the colons
	console.log(parts[0]);
	// minutes are worth 60 seconds. Hours are worth 60 minutes.
	var seconds = (parseInt(parts[0]) * 60) + parseInt(parts[1]); 
	return seconds;
}

function secondsToMMSS(time)
{
	var minutes = Math.floor(time / 60);
	var seconds = time%60;
	return minutes+":"+seconds;

}