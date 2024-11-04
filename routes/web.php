<?php
// Livewire components
use App\Http\Livewire\Users;
use App\Http\Livewire\Badges;
use App\Http\Livewire\Modules;
use App\Http\Livewire\Tutorials;
use App\Http\Livewire\CtfChallenges;
use App\Http\Livewire\Quizzes;
use App\Http\Livewire\QuizQuestions;
use App\Http\Livewire\Courses;

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
 * Livewire Component Routes
 * Route group for authenticated users
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // only need a single route for a single Livewire component (Users) to handle all CRUD operations on users.
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/users', Users::class)->name('users.index');
    });

    // Routes for Badges
    Route::middleware('role:admin')->group(function () {
        Route::get('/badges/create', Badges::class)->name('badges.create');
        Route::post('/badges', Badges::class)->name('badges.store');        
        Route::get('/badges/{id}/edit', Badges::class)->name('badges.edit');
        Route::put('/badges/{id}', Badges::class)->name('badges.update');
        Route::delete('/badges/{id}', Badges::class)->name('badges.destroy');
    });
    
    // Allow students, lecturers, and admins to view badges
    Route::get('/badges', Badges::class)->name('badges.index');
    Route::get('/badges/{id}', Badges::class)->name('badges.show');

    // Routes for Modules
    Route::middleware('role:lecturer,admin')->group(function () {
        Route::get('/modules/create', Modules::class)->name('modules.create');
        Route::post('/modules', Modules::class)->name('modules.store');
        Route::get('/modules/{id}/edit', Modules::class)->name('modules.edit');
        Route::put('/modules/{id}', Modules::class)->name('modules.update');
        Route::delete('/modules/{id}', Modules::class)->name('modules.destroy');
    });

    // Allow students, lecturers, and admins to view modules
    Route::get('/modules', Modules::class)->middleware('role:student,lecturer,admin')->name('modules.index');
    Route::get('/modules/{id}', Modules::class)->middleware('role:student,lecturer,admin')->name('modules.show');

    // Routes for Tutorials
    Route::middleware('role:lecturer,admin')->group(function () {
        Route::get('/tutorials/create', Tutorials::class)->name('tutorials.create');
        Route::post('/tutorials', Tutorials::class)->name('tutorials.store');
        Route::get('/tutorials/{id}/edit', Tutorials::class)->name('tutorials.edit');
        Route::put('/tutorials/{id}', Tutorials::class)->name('tutorials.update');
        Route::delete('/tutorials/{id}', Tutorials::class)->name('tutorials.destroy');
    });

    // Allow students, lecturers, and admins to view tutorials
    Route::get('/tutorials', Tutorials::class)->name('tutorials.index');
    Route::get('/tutorials/{id}', Tutorials::class)->name('tutorials.show');
    
    // Routes for CTF Challenges
    Route::middleware('role:lecturer,admin')->group(function () {
        Route::get('/ctf-challenges/create', CTFChallenges::class)->name('ctf_challenges.create');
        Route::post('/ctf-challenges', CTFChallenges::class)->name('ctf_challenges.store');
        
        Route::get('/ctf-challenges/{id}/edit', CTFChallenges::class)->name('ctf_challenges.edit');
        Route::put('/ctf-challenges/{id}', CTFChallenges::class)->name('ctf_challenges.update');
        Route::delete('/ctf-challenges/{id}', CTFChallenges::class)->name('ctf_challenges.destroy');
    });    

    // Allow students, lecturers, and admins to view CTF challenges
    Route::get('/ctf-challenges', CTFChallenges::class)->name('ctf_challenges.index');
    Route::get('/ctf-challenges/{id}', CTFChallenges::class)->name('ctf_challenges.show');

    // Routes for Quizzes
    Route::middleware('role:lecturer,admin')->group(function () {
        Route::get('/quizzes/create', Quizzes::class)->name('quizzes.create');
        Route::post('/quizzes', Quizzes::class)->name('quizzes.store');
        Route::get('/quizzes/{id}', Quizzes::class)->name('quizzes.show');
        Route::put('/quizzes/{id}', Quizzes::class)->name('quizzes.update');
        Route::delete('/quizzes/{id}', Quizzes::class)->name('quizzes.destroy');
    });
    
    // Allow students, lecturers, and admins to viewquizzes
    Route::get('/quizzes', Quizzes::class)->name('quizzes.index');
    Route::get('/quizzes/{id}/edit', Quizzes::class)->name('quizzes.edit');

    // Routes for Quiz Questions
    Route::middleware('role:lecturer,admin')->group(function () {
        Route::get('/quiz-questions', QuizQuestions::class)->name('quiz_questions.index');
        Route::get('/quiz-questions/create', QuizQuestions::class)->name('quiz_questions.create');
        Route::post('/quiz-questions', QuizQuestions::class)->name('quiz_questions.store');
        Route::get('/quiz-questions/{id}', QuizQuestions::class)->name('quiz_questions.show');
        Route::get('/quiz-questions/{id}/edit', QuizQuestions::class)->name('quiz_questions.edit');
        Route::put('/quiz-questions/{id}', QuizQuestions::class)->name('quiz_questions.update');
        Route::delete('/quiz-questions/{id}', QuizQuestions::class)->name('quiz_questions.destroy');
    });

    // Routes for Courses
    Route::middleware('role:lecturer,admin')->group(function () {        
        Route::get('/courses', Courses::class)->name('courses.index');
    });

require __DIR__.'/auth.php';
});