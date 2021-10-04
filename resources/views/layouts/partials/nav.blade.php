<nav class="navbar navbar-expand navbar-light flex-column flex-md-row bd-navbar bg-primary  mb-4">
    <a class="navbar-brand mr-0 mr-md-2" href="/" aria-label="Facebook" style="width: 36px;
    height: 36px; margin-bottom: 6px">
      <?xml version="1.0" encoding="iso-8859-1"?>
      <!-- Generator: Adobe Illustrator 18.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
      <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196;" xml:space="preserve">
      <g>
        <circle style="fill:#3B5998;" cx="56.098" cy="56.098" r="56.098"/>
        <path style="fill:#FFFFFF;" d="M70.201,58.294h-10.01v36.672H45.025V58.294h-7.213V45.406h7.213v-8.34
          c0-5.964,2.833-15.303,15.301-15.303L71.56,21.81v12.51h-8.151c-1.337,0-3.217,0.668-3.217,3.513v7.585h11.334L70.201,58.294z"/>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      <g>
      </g>
      </svg>     
    </a>
  
    <div class="navbar-nav-scroll">
      <ul class="navbar-nav bd-navbar-nav flex-row">
        <li class="nav-item">
          <a class="nav-link" href="/" onclick="ga('send', 'event', 'Navbar', 'Community links', 'Bootstrap');">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('users.all') }}" >users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('statuses.latest') }}">Your Statuses</a>
        </li>
       
      </ul>
    </div>
    
    @guest
    <ul class="navbar-nav ml-md-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>    
    </ul>
    @else
    <ul class="navbar-nav ml-md-auto">
        <li class="nav-item dropdown">
          <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="bd-versions">
            <a class="dropdown-item" href="{{ route('user.profile', auth()->user()->name) }}">Profile</a>

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </li>
    </ul>
    @endguest
</nav>