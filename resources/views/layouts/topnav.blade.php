<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
      class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a> 
      <a class="brand" href="{{ url('/tracking')}}"><img src="{{ url('/img/cs_logo.png')}}" style="width: 12%; padding: 0px!important; margin: 0px!important" alt="CSRC Logo">&nbsp;{{getSystemName()}} </a>
        <ul class="nav pull-right" style="padding: 2%">
         <!--  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li> -->
          @if (Auth::check())          
          <li class="dropdown" ><a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 15px;"><i
            class="icon-user"></i> {{Auth::user()->name}} <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <!-- <li><a href="javascript:;">Profile</a></li>
 -->              <li><a href="{{ url('/logout')}}">Logout</a></li>
            </ul>
          </li>
          @else
         <li><a href="{{ url('/login')}}" class="btn btn-success"><i class="shortcut-icon icon-user"></i>&nbsp;<span class="shortcut-label">Login</span></a></li>
          @endif
        </ul>
      <!--   <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form> -->
      
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
