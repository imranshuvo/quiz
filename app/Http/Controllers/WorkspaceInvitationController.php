<?php

namespace App\Http\Controllers;

use App\Models\WorkspaceInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WorkspaceInvitationController extends Controller
{
    /** Show an invitation. If guest, prompt to log in / register. */
    public function show(string $token): Response|\Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        $invitation = WorkspaceInvitation::where('token', $token)->firstOrFail();

        if (! $invitation->isPending()) {
            return response()->view('workspace-invitations.invalid', [
                'invitation' => $invitation,
            ], 410);
        }

        if (! Auth::check()) {
            // Stash where to send them after login/register so the same
            // accept handler picks back up.
            session(['url.intended' => route('workspace-invitations.show', $token)]);
            return redirect()->route('register', ['email' => $invitation->email]);
        }

        return view('workspace-invitations.show', compact('invitation'));
    }

    /** Accept the invitation as the currently authenticated user. */
    public function accept(Request $request, string $token): \Illuminate\Http\RedirectResponse
    {
        $invitation = WorkspaceInvitation::where('token', $token)->firstOrFail();
        abort_unless($invitation->isPending(), 410);

        $user = $request->user();
        abort_if($user === null, 401);

        // Only the invited email may accept.
        abort_unless(
            strcasecmp($user->email, $invitation->email) === 0,
            403,
            'This invitation was sent to a different email address.',
        );

        $workspace = $invitation->workspace;
        $workspace->attachMember($user, $invitation->role);

        $invitation->forceFill(['accepted_at' => now()])->save();

        $user->switchWorkspace($workspace);

        return redirect()->route('dashboard')
            ->with('status', "You've joined {$workspace->name}.");
    }
}
