@extends('layouts.journal')

@section('title', 'Make a Submission - EduJournal')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <!-- Progress Tracker -->
    <div class="mb-10 no-print">
        <div class="flex items-center justify-between text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider relative">
            <!-- Progress Line Background -->
            <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-slate-200 dark:bg-slate-800 -z-10"></div>
            <!-- Active Progress Line -->
            <div id="active-progress-line" class="absolute top-1/2 left-0 h-0.5 bg-sky-900 -z-10 transition-all duration-300" style="width: 0%;"></div>

            <!-- Step 1 -->
            <button type="button" onclick="goToStep(1)" id="step-btn-1" class="flex flex-col items-center space-y-2 focus:outline-none cursor-pointer">
                <span id="step-num-1" class="w-8 h-8 rounded-full bg-sky-900 text-white flex items-center justify-center font-bold ring-4 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 ring-sky-900/10">1</span>
                <span class="text-sky-900 dark:text-sky-400 font-extrabold">1. Start</span>
            </button>

            <!-- Step 2 -->
            <button type="button" onclick="goToStep(2)" id="step-btn-2" class="flex flex-col items-center space-y-2 focus:outline-none cursor-not-allowed" disabled>
                <span id="step-num-2" class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center font-bold">2</span>
                <span>2. Upload</span>
            </button>

            <!-- Step 3 -->
            <button type="button" onclick="goToStep(3)" id="step-btn-3" class="flex flex-col items-center space-y-2 focus:outline-none cursor-not-allowed" disabled>
                <span id="step-num-3" class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center font-bold">3</span>
                <span>3. Metadata</span>
            </button>

            <!-- Step 4 -->
            <button type="button" onclick="goToStep(4)" id="step-btn-4" class="flex flex-col items-center space-y-2 focus:outline-none cursor-not-allowed" disabled>
                <span id="step-num-4" class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center font-bold">4</span>
                <span>4. Confirmation</span>
            </button>

            <!-- Step 5 -->
            <div id="step-btn-5" class="flex flex-col items-center space-y-2 opacity-50">
                <span id="step-num-5" class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center font-bold">5</span>
                <span>5. Next Steps</span>
            </div>
        </div>
    </div>

    <!-- General Error Box -->
    <div id="error-alert-box" class="mb-6 p-4 bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/60 text-red-800 dark:text-red-400 rounded-lg text-xs font-medium hidden">
        <p id="error-alert-message"></p>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/60 text-red-800 dark:text-red-400 rounded-lg text-xs font-medium space-y-1">
        @foreach ($errors->all() as $error)
            <p>• {{ $error }}</p>
        @endforeach
    </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-800 p-6 sm:p-8 shadow-sm">
        <form id="submission-wizard-form" action="/author/submit" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hidden Inputs for Step 3 Metadata arrays -->
            <input type="hidden" name="contributors" id="hidden_contributors">
            <input type="hidden" name="keywords" id="hidden_keywords">

            <!-- ==================== STEP 1: START ==================== -->
            <div id="wizard-step-1" class="space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3 font-heading">
                        Step 1: Submission Requirements
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                        You must read and check all requirements below before proceeding with your submission.
                    </p>
                </div>

                <!-- Checklists -->
                <div class="space-y-4 pt-2">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="req-1" type="checkbox" onchange="validateStep1()"
                                class="focus:ring-sky-800 h-4 w-4 text-sky-800 border-slate-300 rounded cursor-pointer step1-check">
                        </div>
                        <div class="ml-3 text-xs leading-relaxed">
                            <label for="req-1" class="font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                                The submission has not been previously published, nor is it before another journal for consideration. <span class="text-red-500">*</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="req-2" type="checkbox" onchange="validateStep1()"
                                class="focus:ring-sky-800 h-4 w-4 text-sky-800 border-slate-300 rounded cursor-pointer step1-check">
                        </div>
                        <div class="ml-3 text-xs leading-relaxed">
                            <label for="req-2" class="font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                                The submission file is in PDF file format (.pdf). Word documents and other formats are not accepted. <span class="text-red-500">*</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="req-3" type="checkbox" onchange="validateStep1()"
                                class="focus:ring-sky-800 h-4 w-4 text-sky-800 border-slate-300 rounded cursor-pointer step1-check">
                        </div>
                        <div class="ml-3 text-xs leading-relaxed">
                            <label for="req-3" class="font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                                Where available, URLs for the references have been provided. <span class="text-red-500">*</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="req-4" type="checkbox" onchange="validateStep1()"
                                class="focus:ring-sky-800 h-4 w-4 text-sky-800 border-slate-300 rounded cursor-pointer step1-check">
                        </div>
                        <div class="ml-3 text-xs leading-relaxed">
                            <label for="req-4" class="font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                                The text is single-spaced; uses a 12-point font; employs italics, rather than underlining (except with URL addresses); and all illustrations, figures, and tables are placed within the text at the appropriate points, rather than at the end. <span class="text-red-500">*</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="req-5" type="checkbox" onchange="validateStep1()"
                                class="focus:ring-sky-800 h-4 w-4 text-sky-800 border-slate-300 rounded cursor-pointer step1-check">
                        </div>
                        <div class="ml-3 text-xs leading-relaxed">
                            <label for="req-5" class="font-medium text-slate-700 dark:text-slate-300 cursor-pointer">
                                The text adheres to the stylistic and bibliographic requirements outlined in the Author Guidelines. <span class="text-red-500">*</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Comments to editor -->
                <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                    <label for="comments_to_editor" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                        Comments for the Editor (Optional)
                    </label>
                    <textarea name="comments_to_editor" id="comments_to_editor" rows="5"
                        class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-200 text-sm transition"
                        placeholder="Provide any comments or notes for the journal editors here..."></textarea>
                </div>

                <!-- Step Footer Actions -->
                <div class="flex justify-end pt-6 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="nextStep(1)" id="btn-continue-1" disabled
                        class="px-6 py-2.5 rounded bg-sky-900 hover:bg-sky-950 text-white font-bold text-xs uppercase tracking-wider transition opacity-50 cursor-not-allowed">
                        Save and Continue
                    </button>
                </div>
            </div>

            <!-- ==================== STEP 2: UPLOAD SUBMISSION ==================== -->
            <div id="wizard-step-2" class="space-y-6 hidden">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3 font-heading">
                        Step 2: Upload Submission File
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                        Upload the primary manuscript file of your research. File must be in PDF format (.pdf).
                    </p>
                </div>

                <!-- Main File Dropzone -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-355 uppercase tracking-wider">
                        Upload Manuscript File <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-slate-300 dark:border-slate-700 hover:border-sky-900 bg-slate-50 dark:bg-slate-800/40 rounded-lg p-8 text-center cursor-pointer transition relative">
                        <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleFileChange(this)">
                        <div class="space-y-2 pointer-events-none">
                            <svg class="w-12 h-12 text-slate-400 dark:text-slate-550 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200" id="main-file-label">Click or drag PDF file here</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Only PDF file format is accepted (Max 10 MB).</p>
                            <p class="text-xs font-extrabold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider pt-2" id="main-file-selected"></p>
                        </div>
                    </div>
                </div>

                <!-- Dropdown Article Component (Hidden until file uploaded) -->
                <div id="article-component-container" class="space-y-2 hidden">
                    <label for="article_component" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider">
                        Article Component <span class="text-red-500">*</span>
                    </label>
                    <select name="article_component" id="article_component" onchange="validateStep2()"
                        class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-200 text-sm transition">
                        <option value="" disabled selected>Pilih komponen artikel...</option>
                        <option value="Article Text">Article Text</option>
                    </select>
                    <span class="text-[10px] text-slate-400 dark:text-slate-500 block">Identify what element of the submission this file represents. You must select "Article Text" to proceed.</span>
                </div>

                <!-- Optional Supporting Files Upload -->
                <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider">
                        Upload Supporting Files (Optional)
                    </label>
                    <div class="border-2 border-dashed border-slate-300 dark:border-slate-700 hover:border-sky-900 bg-slate-50 dark:bg-slate-800/40 rounded-lg p-6 text-center cursor-pointer transition relative">
                        <input type="file" name="supporting_files" id="supporting_files" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleSupportingFileChange(this)">
                        <div class="space-y-2 pointer-events-none">
                            <svg class="w-8 h-8 text-slate-400 dark:text-slate-550 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200" id="support-file-label">Upload auxiliary documents (ZIP, Excel, PDF, Word)</p>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500">Max 10 MB.</p>
                            <p class="text-[10px] font-bold text-sky-800 dark:text-sky-400 uppercase tracking-wider" id="support-file-selected"></p>
                        </div>
                    </div>
                </div>

                <!-- Step Footer Actions -->
                <div class="flex justify-between pt-6 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="goToStep(1)"
                        class="px-6 py-2.5 rounded border border-slate-300 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider transition">
                        Back
                    </button>
                    <button type="button" onclick="nextStep(2)" id="btn-continue-2" disabled
                        class="px-6 py-2.5 rounded bg-sky-900 hover:bg-sky-950 text-white font-bold text-xs uppercase tracking-wider transition opacity-50 cursor-not-allowed">
                        Save and Continue
                    </button>
                </div>
            </div>

            <!-- ==================== STEP 3: ENTER METADATA ==================== -->
            <div id="wizard-step-3" class="space-y-8 hidden">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3 font-heading">
                        Step 3: Enter Metadata
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                        Provide all article index details. Correct meta description improves searchability of scientific materials.
                    </p>
                </div>

                <!-- A. Title & Abstract -->
                <div class="space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-widest text-sky-900 dark:text-sky-400 border-b border-slate-100 dark:border-slate-800 pb-1">
                        A. Title & Abstract
                    </h4>
                    
                    <div>
                        <label for="title_input" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title_input" oninput="validateStep3()"
                            class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition"
                            placeholder="Enter the full article title">
                    </div>

                    <div>
                        <label for="subtitle_input" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                            Subtitle (Optional)
                        </label>
                        <input type="text" name="subtitle" id="subtitle_input"
                            class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition"
                            placeholder="Enter article subtitle, if any">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="subject_input" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                                Subject / Bidang Pelajaran <span class="text-red-500">*</span>
                            </label>
                            <select name="subject" id="subject_input" onchange="validateStep3()"
                                class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-200 text-sm transition">
                                <option value="" disabled selected>Pilih subjek riset...</option>
                                <option value="IPA" class="dark:bg-slate-900">Sains / IPA</option>
                                <option value="IPS" class="dark:bg-slate-900">Humaniora / IPS</option>
                                <option value="Matematika" class="dark:bg-slate-900">Matematika</option>
                                <option value="Bahasa" class="dark:bg-slate-900">Bahasa & Sastra</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="abstract_input" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                            Abstract <span class="text-red-500">*</span>
                        </label>
                        <textarea name="abstract" id="abstract_input" rows="6" oninput="validateStep3()"
                            class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-200 text-sm transition"
                            placeholder="Type or paste your scientific abstract here..."></textarea>
                    </div>
                </div>

                <!-- B. List of Contributors -->
                <div class="space-y-4">
                    <div class="flex justify-between items-center border-b border-slate-100 dark:border-slate-800 pb-1">
                        <h4 class="text-xs font-extrabold uppercase tracking-widest text-sky-900 dark:text-sky-400">
                            B. List of Contributors
                        </h4>
                        <button type="button" onclick="openContributorModal()"
                            class="px-3 py-1 bg-sky-900 hover:bg-sky-950 text-white rounded text-[10px] font-bold uppercase transition flex items-center space-x-1 cursor-pointer">
                            <span>+ Add Contributor</span>
                        </button>
                    </div>

                    <!-- Contributors Table -->
                    <div class="overflow-x-auto border border-slate-200 dark:border-slate-800 rounded">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800 text-xs">
                            <thead class="bg-slate-50 dark:bg-slate-800/60 font-bold text-slate-505 uppercase">
                                <tr>
                                    <th class="px-4 py-3 text-left">Name</th>
                                    <th class="px-4 py-3 text-left">Email</th>
                                    <th class="px-4 py-3 text-left">Affiliation</th>
                                    <th class="px-4 py-3 text-center">Role</th>
                                    <th class="px-4 py-3 text-center">Correspondence</th>
                                    <th class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="contributors-list" class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                                <!-- Populated dynamically by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- C. Keywords -->
                <div class="space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-widest text-sky-900 dark:text-sky-400 border-b border-slate-100 dark:border-slate-800 pb-1">
                        C. Keywords
                    </h4>
                    <div>
                        <label for="keyword_input" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                            Keywords <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="keyword_input" onkeydown="handleKeywordKeydown(event)"
                            class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-sm transition"
                            placeholder="Type keyword and press comma (,) to add tags">
                        <span class="text-[10px] text-slate-400 dark:text-slate-550 mt-1 block">Keywords help search engines index your paper. Separate with a comma.</span>
                    </div>

                    <!-- Tags list -->
                    <div id="keywords-tags-container" class="flex flex-wrap gap-2 pt-2">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- D. References -->
                <div class="space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-widest text-sky-900 dark:text-sky-400 border-b border-slate-100 dark:border-slate-800 pb-1">
                        D. References
                    </h4>
                    <div>
                        <label for="references_input" class="block text-xs font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-2">
                            References
                        </label>
                        <textarea name="references" id="references_input" rows="6"
                            class="w-full px-4 py-2.5 rounded border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-sky-800 focus:ring-1 focus:ring-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-200 text-sm transition font-mono"
                            placeholder="Copy-paste bibliography list here. Each reference on a new line..."></textarea>
                    </div>
                </div>

                <!-- Step Footer Actions -->
                <div class="flex justify-between pt-6 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="goToStep(2)"
                        class="px-6 py-2.5 rounded border border-slate-300 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider transition">
                        Back
                    </button>
                    <button type="button" onclick="nextStep(3)" id="btn-continue-3" disabled
                        class="px-6 py-2.5 rounded bg-sky-900 hover:bg-sky-950 text-white font-bold text-xs uppercase tracking-wider transition opacity-50 cursor-not-allowed">
                        Save and Continue
                    </button>
                </div>
            </div>

            <!-- ==================== STEP 4: CONFIRMATION ==================== -->
            <div id="wizard-step-4" class="space-y-6 hidden">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3 font-heading">
                        Step 4: Confirmation
                    </h3>
                </div>

                <div class="bg-slate-50 dark:bg-slate-800/40 p-6 rounded border border-slate-200 dark:border-slate-800 space-y-4">
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed text-justify">
                        Your submission has been uploaded and is ready to be sent. You may go back to review and adjust any of the information you have entered before continuing. When you are ready, click 'Finish Submission'.
                    </p>
                </div>

                <!-- Step Footer Actions -->
                <div class="flex justify-between pt-6 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="goToStep(3)"
                        class="px-6 py-2.5 rounded border border-slate-300 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider transition">
                        Back
                    </button>
                    <button type="button" onclick="submitFinalForm()"
                        class="px-6 py-2.5 rounded bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider transition shadow-sm cursor-pointer">
                        Finish Submission
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL: ADD CONTRIBUTOR ==================== -->
<div id="contributor-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-slate-500/75 dark:bg-slate-950/80 transition-opacity" aria-hidden="true" onclick="closeContributorModal()"></div>

        <!-- Modal Center Hook -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-slate-850">
            <form id="contributor-modal-form" onsubmit="saveContributor(event)">
                <div class="bg-white dark:bg-slate-900 px-6 pt-6 pb-4 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2 font-heading">
                        Add Contributor
                    </h3>

                    <div>
                        <label for="m_name" class="block text-[10px] font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-1">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="m_name" required
                            class="w-full px-3 py-2 rounded border border-slate-350 dark:border-slate-700 focus:outline-none focus:border-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-xs transition">
                    </div>

                    <div>
                        <label for="m_email" class="block text-[10px] font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="m_email" required
                            class="w-full px-3 py-2 rounded border border-slate-355 dark:border-slate-700 focus:outline-none focus:border-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-xs transition">
                    </div>

                    <div>
                        <label for="m_country" class="block text-[10px] font-bold text-slate-700 dark:text-slate-355 uppercase tracking-wider mb-1">
                            Country <span class="text-red-500">*</span>
                        </label>
                        <select id="m_country" required
                            class="w-full px-3 py-2 rounded border border-slate-355 dark:border-slate-700 focus:outline-none focus:border-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-200 text-xs transition">
                            <option value="Indonesia" selected class="dark:bg-slate-900">Indonesia</option>
                            <option value="Malaysia" class="dark:bg-slate-900">Malaysia</option>
                            <option value="Singapore" class="dark:bg-slate-900">Singapore</option>
                            <option value="Thailand" class="dark:bg-slate-900">Thailand</option>
                            <option value="Philippines" class="dark:bg-slate-900">Philippines</option>
                            <option value="Australia" class="dark:bg-slate-900">Australia</option>
                            <option value="United Kingdom" class="dark:bg-slate-900">United Kingdom</option>
                            <option value="United States" class="dark:bg-slate-900">United States</option>
                            <option value="Japan" class="dark:bg-slate-900">Japan</option>
                        </select>
                    </div>

                    <div>
                        <label for="m_affiliation" class="block text-[10px] font-bold text-slate-700 dark:text-slate-350 uppercase tracking-wider mb-1">
                            Affiliation (Afiliasi/Kampus) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="m_affiliation" required
                            class="w-full px-3 py-2 rounded border border-slate-355 dark:border-slate-700 focus:outline-none focus:border-sky-800 bg-white dark:bg-slate-850 text-slate-800 dark:text-slate-100 text-xs transition"
                            placeholder="Example: Universitas Brawijaya">
                    </div>

                    <div>
                        <label for="m_role" class="block text-[10px] font-bold text-slate-700 dark:text-slate-355 uppercase tracking-wider mb-1">
                            User Role <span class="text-red-500">*</span>
                        </label>
                        <select id="m_role" required disabled
                            class="w-full px-3 py-2 rounded border border-slate-355 dark:border-slate-700 focus:outline-none focus:border-sky-800 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs transition">
                            <option value="Author" selected>Author</option>
                        </select>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-slate-850/80 px-6 py-4 flex justify-end space-x-2 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="closeContributorModal()"
                        class="px-4 py-2 border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 rounded text-xs font-bold uppercase transition text-slate-700 dark:text-slate-300">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-sky-900 hover:bg-sky-950 text-white rounded text-xs font-bold uppercase transition shadow-sm">
                        Add Author
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Wizard State
    const state = {
        step: 1,
        maxEnabledStep: 1,
        mainFile: null,
        supportFile: null,
        contributors: [
            {
                name: "{{ Auth::user()->name }}",
                email: "{{ Auth::user()->email }}",
                country: "{{ Auth::user()->country ?? 'Indonesia' }}",
                affiliation: "{{ Auth::user()->institution ?? '' }}",
                role: 'Author',
                principal: true
            }
        ],
        keywords: []
    };

    // Initialize display
    document.addEventListener("DOMContentLoaded", () => {
        renderContributors();
        goToStep(1);
    });

    // Error message display
    function showError(message) {
        const errorAlert = document.getElementById('error-alert-box');
        const errorMessage = document.getElementById('error-alert-message');
        if (message) {
            errorMessage.textContent = message;
            errorAlert.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            errorAlert.classList.add('hidden');
        }
    }

    // Navigation state updates
    function goToStep(targetStep) {
        if (targetStep > state.maxEnabledStep) return;

        // Hide all steps
        for (let i = 1; i <= 4; i++) {
            document.getElementById(`wizard-step-${i}`).classList.add('hidden');
            
            // Default step state classes
            const stepNum = document.getElementById(`step-num-${i}`);
            const stepBtn = document.getElementById(`step-btn-${i}`);
            
            if (i < targetStep) {
                // Completed step
                stepNum.className = "w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold ring-4 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 ring-emerald-600/10 cursor-pointer";
                stepBtn.className = "flex flex-col items-center space-y-2 focus:outline-none cursor-pointer";
                stepBtn.removeAttribute('disabled');
            } else if (i === targetStep) {
                // Active step
                stepNum.className = "w-8 h-8 rounded-full bg-sky-900 text-white flex items-center justify-center font-bold ring-4 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 ring-sky-900/10 cursor-pointer";
                stepBtn.className = "flex flex-col items-center space-y-2 focus:outline-none cursor-pointer";
                stepBtn.removeAttribute('disabled');
            } else if (i <= state.maxEnabledStep) {
                // Enabled but future step
                stepNum.className = "w-8 h-8 rounded-full bg-slate-300 dark:bg-slate-700 text-slate-800 dark:text-slate-200 flex items-center justify-center font-bold cursor-pointer";
                stepBtn.className = "flex flex-col items-center space-y-2 focus:outline-none cursor-pointer";
                stepBtn.removeAttribute('disabled');
            } else {
                // Locked step
                stepNum.className = "w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center font-bold cursor-not-allowed";
                stepBtn.className = "flex flex-col items-center space-y-2 focus:outline-none cursor-not-allowed";
                stepBtn.setAttribute('disabled', 'true');
            }
        }

        // Show active step
        document.getElementById(`wizard-step-${targetStep}`).classList.remove('hidden');
        state.step = targetStep;

        // Progress line adjustment
        const activeLine = document.getElementById('active-progress-line');
        const percentage = ((targetStep - 1) / 4) * 100;
        activeLine.style.width = `${percentage}%`;

        // Clear general alert box when shifting steps
        showError(null);
    }

    // Go next trigger
    function nextStep(currentStep) {
        if (currentStep === 1) {
            if (validateStep1()) {
                state.maxEnabledStep = Math.max(state.maxEnabledStep, 2);
                goToStep(2);
            }
        } else if (currentStep === 2) {
            if (validateStep2()) {
                state.maxEnabledStep = Math.max(state.maxEnabledStep, 3);
                goToStep(3);
            }
        } else if (currentStep === 3) {
            if (validateStep3()) {
                state.maxEnabledStep = Math.max(state.maxEnabledStep, 4);
                goToStep(4);
            }
        }
    }

    // ==================== STEP 1 VALIDATION ====================
    function validateStep1() {
        const checks = document.querySelectorAll('.step1-check');
        let allChecked = true;
        checks.forEach(c => {
            if (!c.checked) allChecked = false;
        });

        const btn = document.getElementById('btn-continue-1');
        if (allChecked) {
            btn.removeAttribute('disabled');
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            btn.classList.add('cursor-pointer');
            return true;
        } else {
            btn.setAttribute('disabled', 'true');
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            btn.classList.remove('cursor-pointer');
            return false;
        }
    }

    // ==================== STEP 2 UPLOAD VALIDATION ====================
    function handleFileChange(input) {
        const file = input.files[0];
        const label = document.getElementById('main-file-label');
        const selectedSpan = document.getElementById('main-file-selected');
        const selectContainer = document.getElementById('article-component-container');
        
        showError(null);

        if (file) {
            const ext = file.name.split('.').pop().toLowerCase();
            if (ext !== 'pdf') {
                input.value = ''; // clear input
                state.mainFile = null;
                label.textContent = "Click or drag PDF file here";
                selectedSpan.textContent = "";
                selectContainer.classList.add('hidden');
                validateStep2();
                showError("Format file salah! Sistem hanya menerima berkas PDF (.pdf). File Word (.doc/.docx) dan format lainnya ditolak.");
                return;
            }

            state.mainFile = file;
            label.textContent = "Manuscript file loaded successfully";
            selectedSpan.textContent = `SELECTED: ${file.name} (${(file.size / (1024 * 1024)).toFixed(2)} MB)`;
            selectContainer.classList.remove('hidden');
        } else {
            state.mainFile = null;
            label.textContent = "Click or drag PDF file here";
            selectedSpan.textContent = "";
            selectContainer.classList.add('hidden');
        }

        validateStep2();
    }

    function handleSupportingFileChange(input) {
        const file = input.files[0];
        const span = document.getElementById('support-file-selected');
        if (file) {
            state.supportFile = file;
            span.textContent = `ATTACHED: ${file.name} (${(file.size / (1024 * 1024)).toFixed(2)} MB)`;
        } else {
            state.supportFile = null;
            span.textContent = "";
        }
    }

    function validateStep2() {
        const compSelect = document.getElementById('article_component').value;
        const btn = document.getElementById('btn-continue-2');
        
        if (state.mainFile && compSelect === 'Article Text') {
            btn.removeAttribute('disabled');
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            btn.classList.add('cursor-pointer');
            return true;
        } else {
            btn.setAttribute('disabled', 'true');
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            btn.classList.remove('cursor-pointer');
            return false;
        }
    }

    // ==================== STEP 3 METADATA VALIDATION ====================
    function validateStep3() {
        const title = document.getElementById('title_input').value.trim();
        const abstract = document.getElementById('abstract_input').value.trim();
        const subject = document.getElementById('subject_input').value;
        
        let isValid = true;
        
        if (title === "") isValid = false;
        if (abstract === "") isValid = false;
        if (!subject) isValid = false;
        if (state.contributors.length === 0) isValid = false;
        
        // Ensure there is at least one principal contact
        const hasPrincipal = state.contributors.some(c => c.principal);
        if (!hasPrincipal) isValid = false;

        const btn = document.getElementById('btn-continue-3');
        if (isValid) {
            btn.removeAttribute('disabled');
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            btn.classList.add('cursor-pointer');
            return true;
        } else {
            btn.setAttribute('disabled', 'true');
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            btn.classList.remove('cursor-pointer');
            return false;
        }
    }

    // --- Contributor management ---
    function renderContributors() {
        const tbody = document.getElementById('contributors-list');
        tbody.innerHTML = '';

        state.contributors.forEach((c, idx) => {
            const tr = document.createElement('tr');
            tr.className = "hover:bg-slate-50 dark:hover:bg-slate-800/40 transition";
            
            tr.innerHTML = `
                <td class="px-4 py-3 font-bold text-slate-900 dark:text-white">${c.name}</td>
                <td class="px-4 py-3 text-slate-500 dark:text-slate-400">${c.email}</td>
                <td class="px-4 py-3 text-slate-505 dark:text-slate-400">${c.affiliation} (${c.country})</td>
                <td class="px-4 py-3 text-center">${c.role}</td>
                <td class="px-4 py-3 text-center">
                    <input type="radio" name="principal_correspondence" onchange="setPrincipal(${idx})" ${c.principal ? 'checked' : ''}
                        class="focus:ring-sky-800 h-4 w-4 text-sky-850 border-slate-300 cursor-pointer">
                </td>
                <td class="px-4 py-3 text-center">
                    ${idx > 0 ? `
                        <button type="button" onclick="deleteContributor(${idx})" class="text-red-650 hover:text-red-800 font-bold uppercase text-[10px] tracking-wider transition cursor-pointer">
                            Delete
                        </button>
                    ` : `<span class="text-slate-400 dark:text-slate-600 font-medium">Main Submitter</span>`}
                </td>
            `;
            
            tbody.appendChild(tr);
        });

        validateStep3();
    }

    function setPrincipal(idx) {
        state.contributors.forEach((c, i) => {
            c.principal = (i === idx);
        });
        renderContributors();
    }

    function deleteContributor(idx) {
        if (idx === 0) return;
        const wasPrincipal = state.contributors[idx].principal;
        state.contributors.splice(idx, 1);
        
        // If we deleted the principal contact, default it to author 1
        if (wasPrincipal && state.contributors.length > 0) {
            state.contributors[0].principal = true;
        }

        renderContributors();
    }

    // Modal popup contributor
    function openContributorModal() {
        document.getElementById('contributor-modal-form').reset();
        document.getElementById('m_country').value = "Indonesia";
        document.getElementById('contributor-modal').classList.remove('hidden');
    }

    function closeContributorModal() {
        document.getElementById('contributor-modal').classList.add('hidden');
    }

    function saveContributor(e) {
        e.preventDefault();
        
        const name = document.getElementById('m_name').value.trim();
        const email = document.getElementById('m_email').value.trim();
        const country = document.getElementById('m_country').value;
        const affiliation = document.getElementById('m_affiliation').value.trim();
        const role = "Author";

        state.contributors.push({
            name,
            email,
            country,
            affiliation,
            role,
            principal: false
        });

        closeContributorModal();
        renderContributors();
    }

    // --- Keyword Tags System ---
    function handleKeywordKeydown(e) {
        if (e.key === ',' || e.keyCode === 188) {
            e.preventDefault();
            const input = document.getElementById('keyword_input');
            const keywordValue = input.value.trim().replace(/,/g, '');

            if (keywordValue) {
                // Prevent duplicate tags
                if (!state.keywords.includes(keywordValue)) {
                    state.keywords.push(keywordValue);
                    renderKeywordTags();
                }
                input.value = '';
            }
        }
    }

    function renderKeywordTags() {
        const container = document.getElementById('keywords-tags-container');
        container.innerHTML = '';

        state.keywords.forEach((tag, idx) => {
            const span = document.createElement('span');
            span.className = "inline-flex items-center px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold border border-slate-200 dark:border-slate-700 space-x-1";
            span.innerHTML = `
                <span>${tag}</span>
                <button type="button" onclick="deleteKeyword(${idx})" class="text-slate-400 hover:text-slate-600 focus:outline-none font-bold text-xs ml-1 cursor-pointer">
                    &times;
                </button>
            `;
            container.appendChild(span);
        });

        validateStep3();
    }

    function deleteKeyword(idx) {
        state.keywords.splice(idx, 1);
        renderKeywordTags();
    }

    // ==================== FINAL FORM SUBMISSION ====================
    function submitFinalForm() {
        const form = document.getElementById('submission-wizard-form');
        
        // 1. Confirm dialog
        const isConfirmed = confirm("Are you sure you want to finish the submission? Check your data carefully before continuing.");
        
        if (isConfirmed) {
            // 2. Hydrate hidden input metadata
            document.getElementById('hidden_contributors').value = JSON.stringify(state.contributors);
            document.getElementById('hidden_keywords').value = state.keywords.join(', ');

            // 3. Form submit
            form.submit();
        }
    }
</script>
@endsection
