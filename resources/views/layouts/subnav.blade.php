<div class="subnavbar" align="center">
  <div class="subnavbar-inner">
    <div class="container">
    <!--   <ul class="mainnav">
        <li class="active"><a href="index.html"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="reports.html"><i class="icon-list-alt"></i><span>Reports</span> </a> </li>
        <li><a href="guidely.html"><i class="icon-facetime-video"></i><span>App Tour</span> </a></li>
        <li><a href="charts.html"><i class="icon-bar-chart"></i><span>Charts</span> </a> </li>
        <li><a href="shortcodes.html"><i class="icon-code"></i><span>Shortcodes</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="icons.html">Icons</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="pricing.html">Pricing Plans</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
            <li><a href="error.html">404</a></li>
          </ul>
        </li>
      </ul> -->
      <ul class="mainnav">
        
        <li class="{{ Request::segment(1)=='dashboard' ? 'active' : ''}}"><a href="{{ url('/dashboard')}}"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li class="{{ Request::segment(1)=='tracking' ? 'active' : ''}}"><a href="{{ url('/tracking')}}"><i class="icon-road"></i></i><span>Tracking</span> </a></li>
        <li class="{{ Request::segment(1)=='reports' ? 'active' : ''}}"><a href="{{ url('/reports')}}"><i class="icon-list-alt"></i><span>Reports</span> </a> </li>
        <li class="{{ Request::segment(1)=='users' ? 'active' : ''}}"><a href="{{ url('/users')}}"><i class="icon-user"></i><span>Users</span> </a> </li>
        <li class="dropdown {{ Request::segment(1)=='references' ? 'active' : ''}}"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-book"></i><span>References</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/references/documents')}}">Document Types</a></li>
            <li><a href="{{ url('/references/institutes')}}">Institutes / Unit</a></li>
            <li><a href="{{ url('/references/offices')}}">Associate Offices</a></li>
            <li><a href="{{ url('/references/utype')}}">User Types</a></li>
            <!-- <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
            <li><a href="error.html">404</a></li> -->
          </ul>
        </li>
       <!--  <li><a href="charts.html"><i class="icon-bar-chart"></i><span>Charts</span> </a> </li>
        <li><a href="shortcodes.html"><i class="icon-code"></i><span>Shortcodes</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="icons.html">Icons</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="pricing.html">Pricing Plans</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
            <li><a href="error.html">404</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>