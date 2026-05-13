<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\QuestionnaireExportController;
use App\Http\Controllers\WorkspaceInvitationController;
use App\Livewire\Public\Poll as PublicPoll;
use App\Livewire\Public\Result as PublicResult;
use App\Livewire\Public\Taker as PublicTaker;
use App\Livewire\Questionnaires\Analytics as QuestionnaireAnalytics;
use App\Livewire\Questionnaires\Editor as QuestionnaireEditor;
use App\Livewire\Questionnaires\Index as QuestionnairesIndex;
use App\Livewire\Questionnaires\Responses\Index as QuestionnaireResponsesIndex;
use App\Livewire\Questionnaires\Responses\Show as QuestionnaireResponsesShow;
use App\Livewire\Questionnaires\Webhooks as QuestionnaireWebhooks;
use App\Livewire\Settings\Billing as BillingPage;
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
    Route::get('settings/billing', BillingPage::class)->name('settings.billing');

    Route::post('billing/checkout/{plan}', [BillingController::class, 'checkout'])->name('billing.checkout');
    Route::post('billing/portal', [BillingController::class, 'portal'])->name('billing.portal');

    Route::get('questionnaires', QuestionnairesIndex::class)->name('questionnaires.index');
    Route::get('questionnaires/{questionnaire}/edit', QuestionnaireEditor::class)->name('questionnaires.edit');
    Route::get('questionnaires/{questionnaire}/responses', QuestionnaireResponsesIndex::class)->name('questionnaires.responses.index');
    Route::get('questionnaires/{questionnaire}/responses/export', [QuestionnaireExportController::class, 'csv'])->name('questionnaires.responses.export');
    Route::get('questionnaires/{questionnaire}/responses/{response}', QuestionnaireResponsesShow::class)
        ->where('response', '[0-9]+')
        ->name('questionnaires.responses.show');
    Route::get('questionnaires/{questionnaire}/analytics', QuestionnaireAnalytics::class)->name('questionnaires.analytics');
    Route::get('questionnaires/{questionnaire}/webhooks', QuestionnaireWebhooks::class)->name('questionnaires.webhooks');
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
