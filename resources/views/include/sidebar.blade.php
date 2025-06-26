<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN"> 
            </div>
        </a>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == '') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>


                 <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'users/banned') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Users')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users' && $segment2 == '') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('users/banned')}}" class="menu-item {{ ($segment2 == 'banned' && $segment1 == 'users') ? 'active' : '' }}">{{ __('Banned User')}}</a>
                    </div>
                </div>                
             
                @if(auth()->user()->id==2)    
              	<div class="nav-item {{ ($segment1 == 'admins') ? 'active' : '' }}">
                    <a href="{{url('admins')}}"><i class="ik ik-user"></i><span>Manage Admin</span></a>
                </div>
                @endif
            

                <div class="nav-item {{ ($segment1 == 'admin-profile') ? 'active' : '' }}">
                    <a href="{{url('admin-profile')}}"><i class="ik ik-lock"></i><span>{{ __('Admin Profile')}}</span>  </a>
                </div>


                <div class="nav-item {{ ($segment1 == 'clear-cache') ? 'active' : '' }}">
                    <a href="{{url('clear-cache')}}"><i class="ik ik-battery-charging"></i><span>{{ __('Clear Cache')}}</span>  </a>
                </div>
                              
        </div>
    </div>
</div>