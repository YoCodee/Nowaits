@extends('layouts.auth')

@section('title', 'Daftar Akun')

@section('content')

    <div class="min-h-screen w-[1200px] flex items-center justify-center bg-gray-50 p-4">
        <div class="bg-white w-full max-w-7xl rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

            <div class="w-full md:w-[42%] p-10 md:p-14 lg:p-16 flex flex-col justify-center relative">

                <div class="mb-6">
                    <span class="bg-black text-white text-xs font-bold px-5 py-2 rounded-full inline-block">Register</span>
                </div>

                <h1 class="text-4xl md:text-4xl font-bold text-slate-900 mb-3 leading-tight">
                    Create your account <br> to NoWaits
                </h1>
                <p class="text-gray-500 font-medium text-sm mb-10">
                    Sign to your account
                </p>

                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-900 mb-3">Nama Lengkap</label>
                        <input type="text" name="name" id="name" placeholder="nama KTP"
                            class="w-full border-2 border-gray-300 rounded-2xl px-5 py-3.5 text-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition placeholder-gray-400 text-sm"
                            required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-900 mb-3">Your Email</label>
                        <input type="email" name="email" id="email" placeholder="user123@example.com"
                            class="w-full border-2 border-gray-300 rounded-2xl px-5 py-3.5 text-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition placeholder-gray-400 text-sm"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-3">Role</label>
                        <div class="flex gap-3">
                            <label class="cursor-pointer flex-1">
                                <input type="radio" name="role" value="farmer" class="peer sr-only" checked>
                                <div
                                    class="border-2 border-gray-300 rounded-xl p-4 flex items-center justify-between hover:bg-gray-50 peer-checked:border-gray-900 peer-checked:bg-gray-50 transition">
                                    <span class="font-bold text-gray-800 text-sm">Farmer</span>
                                    <div
                                        class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:bg-orange-400 peer-checked:border-orange-400 bg-orange-400">
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer flex-1">
                                <input type="radio" name="role" value="mitra" class="peer sr-only">
                                <div
                                    class="border-2 border-gray-300 rounded-xl p-4 flex items-center justify-between hover:bg-gray-50 peer-checked:border-gray-900 peer-checked:bg-gray-50 transition">
                                    <span class="font-bold text-gray-800 text-sm">Mitra</span>
                                    <div
                                        class="w-5 h-5 rounded-full border-2 border-gray-300 bg-white peer-checked:bg-orange-400 peer-checked:border-orange-400">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">*Choose this if you want to sell your fruits</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-900 mb-3">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="w-full border-2 border-gray-300 rounded-2xl px-5 py-3.5 text-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition placeholder-gray-400 text-sm tracking-widest"
                            required>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-3">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="••••••••"
                            class="w-full border-2 border-gray-300 rounded-2xl px-5 py-3.5 text-gray-700 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition placeholder-gray-400 text-sm tracking-widest"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg transition duration-200 mt-6 text-sm">
                        Register
                    </button>
                </form>

                <div class="text-center mt-8">
                    <p class="text-gray-600 text-sm">
                        Already Have Account ? <a href="{{ route('login') }}"
                            class="text-blue-500 hover:text-blue-700 font-semibold">Login</a>
                    </p>
                </div>
            </div>

            <div class="hidden md:block w-[58%] p-4 bg-gradient-to-br from-gray-100 to-gray-50">
                <div class="h-full w-full rounded-3xl overflow-hidden relative shadow-lg">
                    <img src="https://images.unsplash.com/photo-1595974482597-4b8da8879bc5?q=80&w=2071&auto=format&fit=crop"
                        alt="Farmer Harvesting" class="absolute inset-0 w-full h-full object-cover">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 right-0 p-10 text-white">
                        <h2 class="text-5xl font-bold mb-3 text-right">Manage</h2>
                        <p class="text-sm font-light leading-relaxed opacity-95 text-right">
                            A digital platform reducing fruit waste by connecting farmers to partners with smart pricing,
                            logistics tracking, and sustainable redistribution systems.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection