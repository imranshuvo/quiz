<?php

use App\Http\Controllers\WorkspaceInvitationController;
use App\Livewire\Public\Poll as PublicPoll;
use App\Livewire\Public\Result as PublicResult;
use App\Livewire\Public\Taker as PublicTaker;
use App\Livewire\Questionnaires\Editor as QuestionnaireEditor;
use App\Livewire\Questionnaires\Index as QuestionnairesIndex;
use App\Livewire\Settings\Members as MembersPage;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('settings/members', MembersPage::class)->name('settings.members');

    Route::get('questionnaires', QuestionnairesIndex::class)->name('questionnaires.index');
    Route::get('questionnaires/{questionnaire}/edit', QuestionnaireEditor::class)->name('questionnaires.edit');
});

Route::get('invitations/{token}', [WorkspaceInvitationController::class, 'show'])
    ->name('workspace-invitations.show');
Route::post('invitations/{token}/accept', [WorkspaceInvitationController::class, 'accept'])
    ->middleware('auth')
    ->name('workspace-invitations.accept');

// Public taker / live poll / result share links. No auth, no tenancy
// scope; the components resolve the questionnaire by slug and re-establish
// tenancy from its workspace.
Route::get('q/{slug}', PublicTaker::class)->name('public.taker');
Route::get('q/{slug}/result/{response}', PublicResult::class)->name('public.result');
Route::get('poll/{slug}', PublicPoll::class)->name('public.poll');
Route::get('embed/q/{slug}', PublicTaker::class)->name('public.embed');

require __DIR__.'/auth.php';
