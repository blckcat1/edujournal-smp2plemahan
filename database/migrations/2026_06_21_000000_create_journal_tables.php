<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('specialization')->nullable();
            $table->timestamps();
        });

        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->integer('volume');
            $table->integer('issue_number');
            $table->integer('year');
            $table->string('title'); // e.g., "Vol. 1 No. 1 (2026)"
            $table->string('status')->default('draft'); // draft, published
            $table->timestamps();
        });

        Schema::create('manuscripts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('issue_id')->nullable()->constrained('issues')->onDelete('set null');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('abstract');
            $table->string('keywords')->nullable();
            $table->string('subject')->nullable(); // e.g., IPA, IPS, Matematika, Bahasa
            $table->string('pdf_path')->nullable();
            $table->string('supporting_files')->nullable(); // JSON or text
            $table->text('comments_to_editor')->nullable();
            $table->text('contributors')->nullable();
            $table->text('references')->nullable();
            $table->string('status')->default('submitted'); // draft, submitted, initial_review, reviewer_assigned, under_review, revision_required, revised_submission, accepted, published
            $table->string('doi')->nullable()->unique(); // e.g., EDU-2026-V1-I1-0001
            $table->integer('likes')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manuscript_id')->constrained('manuscripts')->onDelete('cascade');
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->text('comments')->nullable();
            $table->string('recommendation')->nullable(); // approve, revision, reject
            $table->string('status')->default('assigned'); // assigned, completed
            $table->timestamps();
        });

        Schema::create('rubrics', function (Blueprint $table) {
            $table->id();
            $table->string('criteria_name');
            $table->integer('weight'); // e.g., 20 for 20%
            $table->integer('max_score')->default(100);
            $table->timestamps();
        });

        Schema::create('rubric_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained('reviews')->onDelete('cascade');
            $table->foreignId('rubric_id')->constrained('rubrics')->onDelete('cascade');
            $table->integer('score');
            $table->text('comments')->nullable();
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manuscript_id')->constrained('manuscripts')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('author_name')->nullable(); // For guest comments
            $table->text('content');
            $table->string('type')->default('public'); // public, academic
            $table->timestamps();
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manuscript_id')->constrained('manuscripts')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manuscript_id')->constrained('manuscripts')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('certificate_path')->nullable();
            $table->string('hash')->unique();
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('rubric_scores');
        Schema::dropIfExists('rubrics');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('manuscripts');
        Schema::dropIfExists('issues');
        Schema::dropIfExists('profiles');
    }
};
