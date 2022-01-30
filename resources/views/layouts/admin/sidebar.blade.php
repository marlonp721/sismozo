<nav class="navbar navbar-default" role="navigation">
    <div class="side-menu-container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="col-xs-4"></div>
                <span class="title">INICIO</span>
            </a>
            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav">
            @each('layouts.admin.sidebar-menu', $sidebarMenu, 'menu', 'layouts.admin.sidebar-menu-none')
        </ul>
    </div>
</nav>
