<div class="row navigation">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <div class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav" id="menu-menu-principal">
                    <li {!! Active::isHome()? 'class="active"' : '' !!} ><a href="{{url('/')}}">
                            <span class="glyphicon glyphicon-home">Home</span></a>
                    </li>
                    @if(count($menus)>0)
                        @foreach($menus as $category)
                            <li {!! Active::isCategory($category->id)? 'class="active"': '' !!} ><a
                                        href="{{url('category/'.$category->id)}}">{{$category->title}}</a></li>
                        @endforeach
                    @endif
                    @if(!Auth::guest())
                        <li class="warning"><a href="{{url('dashboard')}}">dashboard</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>