<div class="top-right links">
    @auth
        <a href="{{ url('/home') }}">Home</a>
    @else
        {{-- <a href="{{ url('signin') }}">Login</a>
        <a href="{{ url('signup') }}">Register</a> --}}
    @endauth
    <a href="{{ url('/issues') }}">View</a>
    <a href="{{ url('/open-issue') }}">Open Issue</a>
</div>