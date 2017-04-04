# PlayJam
_This is an internship assignment given by Furlenco_

The app is built on Laravel 5.4

The app is deployed on DigitalOcean at http://139.59.27.158

PlayJam is a music aggregation website, which currently supports YouTube, Gaana, and Saavn.

Song details are fetched by the API I made on NodeJs. It's called [ScrapeJam](https://github.com/3minus1/scrapejam). The song URL is passed as a GET request parameter to respective end-points of the ScrapeJam API. Song details are received as JSON objects, which are then parsed and stored into the database. 

Briefly, PlayJam has the following feature set:

### Mandatory Features
* Facebook authentication
* Ability to create and edit playlists
* Ability to associate tags with playlists
* Add songs to any playlist
* Remove a song from any playlist
* Share playlist with friends on Facebook
* Play a song/playlist

### Bonus Features
* Material UI
* Ability to figure out/scrape song metadata and display on the fronted
* Ability to shuffle the songs in a playlist
* Automatic song change, i.e. after a YouTube video gets over, the next item in the playlist starts playing automatically
* Player Controls to skip to next song, go back to previous song, pause or play song.
* Ability to view all the playlists which has a specific tag
* Ability to view all the playlists created by a specific user
* Seamless retrieval of song meta while adding a song to a playlist
  
***

**_Note:_** _Only YouTube has a functional API as of now. Gaana.com's songs are loaded in a hidden iFrame, and Saavn's songs are loaded on their external website. I had applied for SoundCloud's API access, but they take upto 30 days for processing, and I still haven't got access to it. Both Saavn and SoundCloud do not allow Cross-Origin-Resource-Sharing, so iFrames cannot be used here, making it virtually impossible to play their content on an external website without possessing valid API credentials. (Gaana and Saavn don't even have APIs :P)._

**PS: No copyright infringement or commercial misuse is intended and this is just for educational purposes.**

### Tech Stack:

* Laravel 5.4 (Php)
* Materialize CSS
* Jquery and Javascript
* MySQL
* NodeJS
* Digital Ocean VPS
* Version Control - Git

### Citations:

* Icon/Card Logo: [https://maxcdn.icons8.com/Color/PNG/512/Music/playlist-512.png](https://maxcdn.icons8.com/Color/PNG/512/Music/playlist-512.png)
* Respective Logo Rights to YouTube, Gaana, and Saavn

