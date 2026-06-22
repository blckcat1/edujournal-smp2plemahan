@extends('layouts.journal')

@section('title', 'Register - EduJournal')

@section('content')
<div class="max-w-xl mx-auto my-12 px-4">
    <div class="bg-white dark:bg-slate-900 rounded-lg shadow-md border border-slate-200 dark:border-slate-800 p-8">
        <div class="text-center mb-8 border-b border-slate-100 dark:border-slate-800 pb-4">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight font-heading">Register</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Create an account to submit your manuscripts and participate in the journal.</p>
        </div>

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/65 text-red-800 dark:text-red-400 rounded-lg text-xs font-medium space-y-1">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form action="/register" method="POST" class="space-y-6">
            @csrf
            
            <!-- Given Name / Full Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                    Given Name (Nama Depan / Nama Lengkap) <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                    class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition"
                    placeholder="Enter your full name">
            </div>

            <!-- Affiliation -->
            <div>
                <label for="institution" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                    Affiliation (Afiliasi/Kampus) <span class="text-red-500">*</span>
                </label>
                <input type="text" name="institution" id="institution" value="{{ old('institution') }}" required 
                    class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition"
                    placeholder="Example: SMP Negeri 2 Plemahan / Universitas Brawijaya">
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                    Country (Negara) <span class="text-red-500">*</span>
                </label>
                <select name="country" id="country" required 
                    class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition">
                    <option value="" disabled>Select your country</option>
                    <option value="Indonesia" selected class="dark:bg-slate-900">Indonesia</option>
                    <option value="Malaysia" {{ old('country') === 'Malaysia' ? 'selected' : '' }} class="dark:bg-slate-900">Malaysia</option>
                    <option value="Singapore" {{ old('country') === 'Singapore' ? 'selected' : '' }} class="dark:bg-slate-900">Singapore</option>
                    <option value="Thailand" {{ old('country') === 'Thailand' ? 'selected' : '' }} class="dark:bg-slate-900">Thailand</option>
                    <option value="Philippines" {{ old('country') === 'Philippines' ? 'selected' : '' }} class="dark:bg-slate-900">Philippines</option>
                    <option value="Australia" {{ old('country') === 'Australia' ? 'selected' : '' }} class="dark:bg-slate-900">Australia</option>
                    <option value="United Kingdom" {{ old('country') === 'United Kingdom' ? 'selected' : '' }} class="dark:bg-slate-900">United Kingdom</option>
                    <option value="United States" {{ old('country') === 'United States' ? 'selected' : '' }} class="dark:bg-slate-900">United States</option>
                    <option value="Japan" {{ old('country') === 'Japan' ? 'selected' : '' }} class="dark:bg-slate-900">Japan</option>
                </select>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                    class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition"
                    placeholder="email@example.com">
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                    Username <span class="text-red-500">*</span>
                </label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required 
                    class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition"
                    placeholder="Only lowercase letters and numbers, no spaces (e.g. janesmith)"
                    oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9]/g, '')">
                <span class="text-[10px] text-slate-400 dark:text-slate-500 mt-1 block">Valid format: only one word, lowercase letters and numbers, no spaces.</span>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                    Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password" id="password" required 
                    class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition"
                    placeholder="Minimum 6 characters">
            </div>

            <!-- Checkbox Requirements -->
            <div class="space-y-3 pt-2 border-t border-slate-100 dark:border-slate-800">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="agree_privacy" name="agree_privacy" type="checkbox" required value="1"
                            class="focus:ring-sky-800 h-4 w-4 text-sky-800 border-slate-300 rounded cursor-pointer">
                    </div>
                    <div class="ml-3 text-xs leading-relaxed">
                        <label for="agree_privacy" class="font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                            Yes, I agree to have my data collected and stored according to the <span class="text-sky-800 dark:text-sky-400 underline font-bold cursor-pointer">privacy statement</span>. <span class="text-red-500">*</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="agree_notify" name="agree_notify" type="checkbox" required value="1"
                            class="focus:ring-sky-800 h-4 w-4 text-sky-800 border-slate-300 rounded cursor-pointer">
                    </div>
                    <div class="ml-3 text-xs leading-relaxed">
                        <label for="agree_notify" class="font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                            Yes, I would like to be notified of new publications and announcements. <span class="text-red-500">*</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="agree_review" name="agree_review" type="checkbox" value="1"
                            class="focus:ring-sky-800 h-4 w-4 text-sky-800 border-slate-300 rounded cursor-pointer">
                    </div>
                    <div class="ml-3 text-xs leading-relaxed">
                        <label for="agree_review" class="font-medium text-slate-500 dark:text-slate-400 cursor-pointer">
                            Yes, I would like to be contacted with requests to review submissions to this journal. (Optional)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full py-3 rounded bg-sky-900 hover:bg-sky-950 text-white font-bold text-sm tracking-wider uppercase transition shadow-sm">
                    Register
                </button>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center text-xs">
            <span class="text-slate-400">Already have an account?</span>
            <a href="/login" class="text-sky-800 dark:text-sky-400 hover:underline font-bold ml-1 transition">Log In</a>
        </div>
    </div>
</div>
@endsection
