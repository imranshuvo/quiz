<?php

namespace App\Mail;

use App\Models\WorkspaceInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WorkspaceInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public WorkspaceInvitation $invitation)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "You've been invited to join {$this->invitation->workspace->name}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.workspace-invitation',
            with: [
                'invitation' => $this->invitation,
                'acceptUrl' => $this->invitation->acceptUrl(),
            ],
        );
    }
}
