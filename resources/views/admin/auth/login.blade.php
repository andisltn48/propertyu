<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — PropertyU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akt:wght@100..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F6F3EF;
            --ivory: #FDFBF9;
            --charcoal: #1C1C1C;
            --gold: #B8914A;
            --gold-light: #D4B87A;
            --gold-dark: #8E6F36;
            --muted: #6B6B6B;
            --border: #E5DDD4;
        }
        body {
            font-family: 'Akt', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body class="bg-[#F6F3EF] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[440px]">
        <div class="text-center mb-10">
            <a href="{{ url('/') }}" class="text-3xl font-extrabold tracking-tighter text-[#1C1C1C] inline-flex items-center gap-3">
                <span class="w-10 h-10 bg-[#B8914A] rounded-xl flex items-center justify-center text-white text-xl font-bold">P</span>
                Property<span class="text-[#B8914A]">U</span>
            </a>
        </div>

        <div class="bg-[#FDFBF9] rounded-2xl border border-[#E5DDD4] p-10 shadow-sm">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-[#1C1C1C]">Welcome back</h1>
                <p class="text-sm text-[#6B6B6B] mt-2">Sign in to your admin account</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-[#F6F3EF] border border-[#E5DDD4] rounded-xl">
                    @foreach($errors->all() as $error)
                        <p class="text-sm text-[#1C1C1C] flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B8914A] flex-shrink-0"></span>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-5 py-3.5 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-medium"
                        placeholder="admin@propertyu.com">
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-5 py-3.5 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-medium"
                        placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-[#E5DDD4] text-[#B8914A] focus:ring-[#B8914A]/20">
                        <span class="text-sm text-[#6B6B6B] font-medium">Remember me</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3.5 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all text-sm">
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-xs text-[#6B6B6B]">
            &copy; {{ date('Y') }} PropertyU. All Rights Reserved.
        </p>
    </div>

</body>
</html>
