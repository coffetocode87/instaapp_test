<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaApp</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-white font-sans">

    <div class="bg-white/10 backdrop-blur-md rounded-xl shadow-2xl p-8 w-full max-w-md animate-fade-in text-center">
        
        <!-- Icon kecil -->
        <svg class="w-10 h-10 mx-auto text-white mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 6.75H18a2.25 2.25 0 012.25 2.25v9A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V9a2.25 2.25 0 012.25-2.25h2.25m3-1.5h3m-3 0A2.25 2.25 0 018.25 6.75h7.5A2.25 2.25 0 0118 9v0a2.25 2.25 0 01-2.25 2.25h-7.5A2.25 2.25 0 016 9v0a2.25 2.25 0 012.25-2.25zm1.5 5.25a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
        </svg>

        <h1 class="text-3xl font-bold mb-2">Welcome to <span class="text-yellow-300">InstaApp</span></h1>
        <p class="text-sm text-gray-200">A beautiful way to share your moments.</p>

        <div class="mt-6 flex justify-center gap-4">
            <a href="/login" class="px-5 py-2 bg-white text-purple-700 rounded-full font-semibold hover:bg-gray-200 transition">Login</a>
            <a href="/register" class="px-5 py-2 bg-yellow-400 text-gray-900 rounded-full font-semibold hover:bg-yellow-300 transition">Register</a>
        </div>

        <p class="mt-6 text-xs text-gray-300">&copy; 2025 InstaApp. All rights reserved.</p>
    </div>

</body>
</html>
