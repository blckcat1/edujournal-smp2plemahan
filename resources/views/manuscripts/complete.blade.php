@extends('layouts.journal')

@section('title', 'Submission Complete - EduJournal')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <!-- Progress Tracker (All Steps Completed) -->
    <div class="mb-10 no-print">
        <div class="flex items-center justify-between text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider relative">
            <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-sky-900 -z-10"></div>

            <!-- Step 1 -->
            <div class="flex flex-col items-center space-y-2">
                <span class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold ring-4 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 ring-emerald-600/10">✓</span>
                <span class="text-emerald-600 dark:text-emerald-400">1. Start</span>
            </div>

            <!-- Step 2 -->
            <div class="flex flex-col items-center space-y-2">
                <span class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold ring-4 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 ring-emerald-600/10">✓</span>
                <span class="text-emerald-600 dark:text-emerald-400">2. Upload</span>
            </div>

            <!-- Step 3 -->
            <div class="flex flex-col items-center space-y-2">
                <span class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold ring-4 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 ring-emerald-600/10">✓</span>
                <span class="text-emerald-600 dark:text-emerald-400">3. Metadata</span>
            </div>

            <!-- Step 4 -->
            <div class="flex flex-col items-center space-y-2">
                <span class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold ring-4 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 ring-emerald-600/10">✓</span>
                <span class="text-emerald-600 dark:text-emerald-400">4. Confirmation</span>
            </div>

            <!-- Step 5 -->
            <div class="flex flex-col items-center space-y-2">
                <span class="w-8 h-8 rounded-full bg-sky-900 text-white flex items-center justify-center font-bold ring-4 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 ring-sky-900/10">5</span>
                <span class="text-sky-900 dark:text-sky-400 font-extrabold">5. Next Steps</span>
            </div>
        </div>
    </div>

    <!-- Success Message Card -->
    <div class="bg-white dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-800 p-8 sm:p-12 text-center shadow-sm max-w-2xl mx-auto space-y-6">
        <div class="w-16 h-16 bg-emerald-50 dark:bg-emerald-950/40 rounded-full flex items-center justify-center text-emerald-600 dark:text-emerald-400 mx-auto">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <div class="space-y-2">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white font-heading">Submission Complete</h2>
            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed max-w-md mx-auto">
                Submission Complete. Thank you for your interest in publishing with us.
            </p>
        </div>

        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/author/submission/{{ $manuscript->id }}/summary" 
                class="w-full sm:w-auto px-6 py-2.5 rounded bg-sky-900 hover:bg-sky-950 text-white font-bold text-xs uppercase tracking-wider transition text-center shadow-sm">
                Review this submission
            </a>
            <a href="/author" 
                class="w-full sm:w-auto px-6 py-2.5 rounded border border-slate-300 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider transition text-center">
                Return to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
