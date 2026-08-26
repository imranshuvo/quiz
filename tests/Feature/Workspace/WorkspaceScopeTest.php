<?php

use App\Models\Concerns\BelongsToWorkspace;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Schema::create('tenant_things', function ($table) {
        $table->id();
        $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
        $table->string('label');
        $table->timestamps();
    });
});

afterEach(function () {
    Schema::dropIfExists('tenant_things');
});

class TenantThing extends Model
{
    use BelongsToWorkspace;

    protected $table = 'tenant_things';

    protected $fillable = ['label', 'workspace_id'];
}

it('hides rows from other workspaces under the global scope', function () {
    $workspaceA = Workspace::factory()->create();
    $workspaceB = Workspace::factory()->create();

    app(Tenancy::class)->setCurrent($workspaceA);
    TenantThing::create(['label' => 'A1']);
    TenantThing::create(['label' => 'A2']);

    app(Tenancy::class)->setCurrent($workspaceB);
    TenantThing::create(['label' => 'B1']);

    expect(TenantThing::pluck('label')->all())->toEqual(['B1']);

    app(Tenancy::class)->setCurrent($workspaceA);
    expect(TenantThing::pluck('label')->sort()->values()->all())->toEqual(['A1', 'A2']);
});

it('returns zero rows when no workspace is current', function () {
    $workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($workspace);
    TenantThing::create(['label' => 'one']);

    app(Tenancy::class)->setCurrent(null);
    expect(TenantThing::count())->toBe(0);
});

it('auto-fills workspace_id from the current workspace on creation', function () {
    $workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($workspace);

    $thing = TenantThing::create(['label' => 'auto']);

    expect($thing->workspace_id)->toBe($workspace->id);
});

it('lets you opt out of the scope explicitly', function () {
    $a = Workspace::factory()->create();
    $b = Workspace::factory()->create();

    app(Tenancy::class)->setCurrent($a);
    TenantThing::create(['label' => 'in-a']);
    app(Tenancy::class)->setCurrent($b);
    TenantThing::create(['label' => 'in-b']);

    app(Tenancy::class)->setCurrent($a);
    expect(TenantThing::withoutWorkspaceScope()->count())->toBe(2);
});

it('Tenancy::runAs scopes a callback to a different workspace', function () {
    $a = Workspace::factory()->create();
    $b = Workspace::factory()->create();
    $tenancy = app(Tenancy::class);

    $tenancy->setCurrent($a);
    TenantThing::create(['label' => 'a-thing']);

    $count = $tenancy->runAs($b, function () {
        TenantThing::create(['label' => 'b-thing']);

        return TenantThing::count();
    });

    expect($count)->toBe(1);
    expect($tenancy->current()->id)->toBe($a->id); // restored
    expect(TenantThing::withoutWorkspaceScope()->count())->toBe(2);
});
