<header class="header">
    <a href="{{ url('/') }}" class="logo">Lucky<span>Quacky</span></a>
    <div class="search-frame">
        <form action="/search" method="GET" class="search">
            <div class="search-icon-box">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </div>

            <label for="search" class="visually-hidden">What are you looking for?</label>
            <input id="search" type="text" name="query" placeholder="What are you looking for?" class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>
    <div class="icons">
        <a class="cart" href="{{ route('cart.index') }}">
            <svg class="icon" viewBox="0 0 24 24">
                <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM7.2 14h9.6c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0 0 21.29 5H6.21l-.94-2H2v2h2l3.6 7.59-1.35 2.44C5.52 15.37 6.48 17 8 17h12v-2H8l1.2-1z"/>
            </svg>
        </a>

        @auth
            <div class="user-menu" style="display: flex; align-items: center; gap: 10px;">
                <a class="profile" href="{{ url('/user-account') }}" title="My account">
                    <svg class="icon" viewBox="0 0 24 24" style="fill: #ffc107;">
                        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                    </svg>
                </a>

                @if(Auth::user()->role && Auth::user()->role->name === 'admin')
                    <a class="admin-link" href="{{ route('admin.panel') }}" title="Admin Panel" style="color: #ffc107; font-weight: bold;">
                        Admin
                    </a>
                @endif
            </div>
        @endauth

        @guest
            <a class="profile" href="{{ url('/login') }}" title="Login">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                </svg>
            </a>
        @endguest
    </div>
</header>
