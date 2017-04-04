<ul id="userDropdown" class="dropdown-content">
  <li><a href="{{action('PlaylistController@index')}}">My Playlists</a></li>
   <li class="divider"></li>
  <li><a href="{{action('Auth\LoginController@logout')}}">Logout</a></li>
 
</ul>

<nav>
    <div class="nav-wrapper">
      <div class="container">
          <a href="/" class="brand-logo">PlayJam</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            @if(Auth::user())
            	<li><a class="dropdown-button" data-activates="userDropdown" href="#">{{Auth::user()->name}}<i class="material-icons right">arrow_drop_down</i></a></li>
            @endif
          </ul>
      </div>
    </div>
</nav>