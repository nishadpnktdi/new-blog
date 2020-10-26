<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{{ route('posts.index') }}"><i class="fa fa-edit"></i><span>Posts</span></a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{{ route('categories.index') }}"><i class="fa fa-edit"></i><span>Categories</span></a>
</li>

<li class="{{ Request::is('tags*') ? 'active' : '' }}">
    <a href="{{ route('tags.index') }}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>

<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="{{ route('contacts.index') }}"><i class="fa fa-edit"></i><span>Contacts</span></a>
</li>


<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Users</span></a>
</li>
