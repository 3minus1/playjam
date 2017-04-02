

<ul class="collection">


    @foreach($songs as $song)
    <li id="{{$i++}}" class="song_listing collection-item avatar">
      <div class="hidden">{{$song->url}}</div>
      <div class="song_id hidden">{{$song->id}}</div>
      <div class="source hidden">{{$song->source}}</div>
      <img src="{{$song->thumbnail}}" alt="" class="circle">
      <span class="title">{{$song->title}}</span>
      <p class="song_description">{{$song->description}}
      </p>
      <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
    </li>
    @endforeach
</ul>
<iframe id="ytplayer" type="text/html" width="720" height="405" src="" frameborder="2" allowfullscreen >
<!--<iframe sandbox='allow-forms allow-scripts allow-same-origin'  id="player" type="text/html" width="720" height="405" src="http://gaana.com/song/let-me-love-you-415" frameborder="2" >-->