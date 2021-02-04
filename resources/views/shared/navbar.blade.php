<div class="top-right links">
    <a href="{{ url('/issues') }}">View</a>
    @auth
        <a href="{{ url('/home') }}">Home</a>
        <a href="{{ url('/open-issue') }}">Open Issue</a>
    @else
        <a href="{{ url('signin') }}">Login</a>
        <a href="{{ url('signup') }}">Register</a>
    @endauth
</div>