<?php

use App\Http\Controllers\WorkspaceInvitationController;
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

require __DIR__.'/auth.php';
