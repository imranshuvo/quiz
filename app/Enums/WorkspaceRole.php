<?php

namespace App\Enums;

enum WorkspaceRole: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Editor = 'editor';
    case Viewer = 'viewer';

    public function label(): string
    {
        return match ($this) {
            self::Owner => 'Owner',
            self::Admin => 'Admin',
            self::Editor => 'Editor',
            self::Viewer => 'Viewer',
        };
    }

    public function canManageMembers(): bool
    {
        return in_array($this, [self::Owner, self::Admin], true);
    }

    public function canManageBilling(): bool
    {
        return $this === self::Owner;
    }

    public function canEditContent(): bool
    {
        return in_array($this, [self::Owner, self::Admin, self::Editor], true);
    }

    public function canDeleteWorkspace(): bool
    {
        return $this === self::Owner;
    }

    public static function assignable(): array
    {
        return [self::Admin, self::Editor, self::Viewer];
    }
}
