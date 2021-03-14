<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    @if(Request::is('admin/*'))
    <div class="user-info" style="background-image: url({{ asset('backend/images/admin-bg.jpg') }})">
    @else
    <div class="user-info" style="background-image: url({{ asset('backend/images/author-bg.jpg') }})">
    @endif
        <div class="image">
            <img src="{{ Storage::disk('public')->url('user/'. Auth::user()->image) }}" width="48" height="48" alt="User"/>
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false">{{ Auth::user()->name }} (<small>{{ Auth::user()->role->name }}</small>)</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ (Auth::user()->role->id == 1 ?  route('admin.setting'):route('author.setting')) }}"><i class="material-icons">settings</i>Setting</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="material-icons">input</i>Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                @if(Request::is('admin/*'))
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="{{ Request::is('admin/dashboard') ? 'active':'' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/tag*') ? 'active':'' }}">
                            <a href="{{ route('admin.tag.index') }}">
                                <i class="material-icons">label</i>
                                <span>Tag</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/category*') ? 'active':'' }}">
                            <a href="{{ route('admin.category.index') }}">
                                <i class="material-icons">apps</i>
                                <span>Category</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/post*') ? 'active':'' }}">
                            <a href="{{ route('admin.post.index') }}">
                                <i class="material-icons">library_books</i>
                                <span>Posts</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/pending/post') ? 'active':'' }}">
                            <a href="{{ route('admin.pending.post') }}">
                                <i class="material-icons">library_books</i>
                                <span>Pending Posts</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/favorite') ? 'active':'' }}">
                            <a href="{{ route('admin.favorite.index') }}">
                                <i class="material-icons">favorite</i>
                                <span>Favorite Post</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/comment') ? 'active':'' }}">
                            <a href="{{ route('admin.comment.index') }}">
                                <i class="material-icons">comment</i>
                                <span>Comment</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/subscriber') ? 'active':'' }}">
                            <a href="{{ route('admin.subscriber.index') }}">
                                <i class="material-icons">group</i>
                                <span>Subsriber</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/theme') ? 'active':'' }}">
                            <a href="{{ route('admin.theme.index') }}">
                                <i class="material-icons">color_lens</i>
                                <span>Theme</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/author') ? 'active':'' }}">
                            <a href="{{ route('admin.author.index') }}">
                                <i class="material-icons">account_circle</i>
                                <span>Authors List</span>
                            </a>
                        </li>
                    </ul>
                @endif
                @if(Request::is('author/*'))
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="{{ Request::is('author/dashboard') ? 'active':'' }}">
                            <a href="{{ route('author.dashboard') }}">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('author/post*') ? 'active':'' }}">
                            <a href="{{ route('author.post.index') }}">
                                <i class="material-icons">library_books</i>
                                <span>Posts</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('author/comment') ? 'active':'' }}">
                            <a href="{{ route('author.comment.index') }}">
                                <i class="material-icons">comment</i>
                                <span>Comment</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('author/favorite') ? 'active':'' }}">
                            <a href="{{ route('author.favorite.index') }}">
                                <i class="material-icons">favorite</i>
                                <span>Favorite Post</span>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
</aside>
