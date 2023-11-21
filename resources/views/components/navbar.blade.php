<nav>
    <div class="container">
        <a href="{{ route('dashboard.index') }}" class="home"><i class="fa-solid fa-house"></i></a>

        @if ($menu == 1)
        @if (request()->segment(2) == true)
            <a href="{{ route(request()->segment(2) . '.index') }}">{{ str_replace("-"," ", ucfirst(request()->segment(2))) }}</i></a>
        @endif
        @if (request()->segment(4) == true && request()->segment(4) !== "edit")
            <a href="{{ route(request()->segment(4) . '.index', [request()->segment(3)]) }}">{{ str_replace("-"," ", ucfirst(request()->segment(4))) }}</i></a>
        @endif
        @endif
    </div>
</nav>