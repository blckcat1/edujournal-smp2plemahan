@extends('layouts.journal')

@section('title', 'Login - EduJournal')

@section('content')
<div class="max-w-md mx-auto my-16 px-4 transition-colors duration-200">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-800/80 p-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Selamat Datang</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Masuk ke portal EduJournal Anda</p>
        </div>

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/60 text-red-800 dark:text-red-400 rounded-2xl text-xs font-medium space-y-1">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form action="/login" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                    class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white dark:focus:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition">
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-sm font-bold text-slate-700 dark:text-slate-300">Password</label>
                </div>
                <input type="password" name="password" id="password" required 
                    class="w-full px-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 focus:bg-white dark:focus:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-brand-600 border-slate-300 rounded focus:ring-brand-500">
                <label for="remember" class="ml-2 text-sm text-slate-500 dark:text-slate-400 font-medium">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-2xl bg-brand-600 text-white font-bold text-sm shadow-lg shadow-brand-600/20 hover:bg-brand-700 transition">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center text-sm">
            <span class="text-slate-400">Belum punya akun?</span>
            <a href="/register" class="text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 font-bold ml-1 transition">Daftar Akun Baru</a>
        </div>
    </div>
</div>
@endsection
