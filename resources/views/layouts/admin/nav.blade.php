<div class="navbar-header">
    <button type="button" class="navbar-expand-toggle">
        <i class="fa fa-bars icon"></i>
    </button>
    <ol class="breadcrumb navbar-breadcrumb">
        @yield('breadcrumb')
    </ol>
    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
        <i class="fa fa-th icon"></i>
    </button>
</div>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown profile">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa {{ user_icon() }}"></i> {{ auth()->user()->username }} <span class="caret"></span></a>
        <ul class="dropdown-menu animated fadeInDown">
            <li>
                <div class="profile-info">
                    <h4 class="username">{{ auth()->user()->fullname }}</h4>
                    <p>{{ auth()->user()->email }}</p>
                    <div class="btn-group margin-bottom-2x" role="group">
                        <a href="#" class="btn btn-default" id="show-profile"><i class="fa fa-user"></i> Perfil</a>

                        <a href="{{ url('/logout') }}" class="btn btn-default"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Salir
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </li>
</ul>