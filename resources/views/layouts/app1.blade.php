<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Visit Request</title>
</head>
<body>
    <header>
        <!-- Your header content here -->
        <h1>Industrial Visit Request</h1>
    </header>

    <nav>
        <!-- Your navigation links here -->
        <ul>
            <li><a href="{{ route('client.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('client.company') }}">Company Information</a></li>
            <li><a href="{{ route('client.request') }}">Request Industrial Visit</a></li>
            <li><a href="{{ route('client.history') }}">Request History</a></li>
        </ul>
    </nav>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <!-- Your footer content here -->
        <p>&copy; {{ date('Y') }} Industrial Visit Request</p>
    </footer>
</body>
</html>
