<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 text-center">
        <h1 class="text-3xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600 mb-8">You are successfully logged in.</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
</body>

</html>
