<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
      class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="dashboard">Document Tracking System</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
         <!--  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li> -->
          @if (Auth::check())          
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
            class="icon-user"></i> EGrappler.com <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Profile</a></li>
              <li><a href="logout">Logout</a></li>
            </ul>
          </li>
          @else
         <li><a href="login" class="btn btn-success"><i class="shortcut-icon icon-user"></i>&nbsp;<span class="shortcut-label">Login</span></a></li>
          @endif
        </ul>
      <!--   <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form> -->
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->