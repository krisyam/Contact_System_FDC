<style>
    header {
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 50px;
        background-color: rgb(22, 22, 95);
        align-content: center;
    }
    nav {
        display: flex;
        justify-content: space-around;
        width: 100%;
        color: white;
        align-items: center;
    }
    a {
        color: white;
        text-decoration: none;
    }
    a:hover {
        color: yellow;
    }
</style>

<header>
    <nav>
        <h4>Contact System FDC</h4>
        {{-- <a href="contact.html">Contact</a>
        <a href="about.html">About</a> --}}
        
        @if(auth()->check())
        <form method="POST" action="/logout">
            @csrf
            <button>Logout</button>
        </form>
        @endif
    </nav>
    </nav>
</header>