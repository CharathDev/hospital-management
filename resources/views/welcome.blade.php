<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <header class="absolute w-full top-0 z-50">
            @if (Route::has('login'))
                <nav class="mx-3 flex p-5 justify-end">
                    @auth

                            <a
                                href="{{ url(auth()->user()->user_type . '/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="">
            <section class="h-screen">
                <div class="w-full h-screen relative" style="background-image: url('img/istock-482499394.webp'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="size-full bg-black/50 absolute top-0">
                        <div class="flex size-full justify-center items-center text-white">
                            <h1 class="text-5xl mx-2">Want to book an appointment?</h1>
                            <a href="{{ route('login') }}" class="text-4xl border border-white px-4 py-3 mx-2 hover:bg-white hover:text-black">Log In</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
