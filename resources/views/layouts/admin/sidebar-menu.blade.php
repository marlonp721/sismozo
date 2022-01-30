@if (isset($menu['children'])) 
    <li class="panel panel-default dropdown">
        <a data-toggle="collapse" href="#dropdown-{{ $menu['id'] }}"> 
@else 
    <li> 
        @if($menu['tree_role']===0)
            @php
                $explode=explode("|",$menu['description']);
                $description_id=$explode[1];
            @endphp
            <a href="{{ route($menu['url'], $description_id) }}"> 
        @else
            <a href="{{ $menu['url'] ? route($menu['url']) : '#' }}"> 
        @endif
        
@endif

        @if ($menu['icon']) 
            <span class="icon {{ $menu['icon'] }}"></span>
        @endif 

            <span class="title" title="{{ strlen($menu['display_name']) > 31 ? $menu['display_name'] : '' }}">{{ str_limit($menu['display_name'], 31) }}</span>

        </a>
                
    	@if (isset($menu['children']))
    	    <div id="dropdown-{{ $menu['id'] }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="nav navbar-nav">
                        @foreach($menu['children'] as $menu)
                            @include('layouts.admin.sidebar-menu', $menu)
                        @endforeach
                    </ul>
                </div>
            </div>            
        @endif
    </li>
  
