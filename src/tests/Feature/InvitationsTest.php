<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ArticleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function non_owners_may_not_invite_users()
    {
        $article = ArticleFactory::create();
        $user = factory(User::class)->create();

        $assertInvitationForbidden = function () use ($user, $article) {
            $this->actingAs($user)
                ->post($article->path() . '/invitations')
                ->assertStatus(403);
        };

        $assertInvitationForbidden();

        $article->invite($user);

        $assertInvitationForbidden();
    }

    /** @test */
    function a_article_owner_can_invite_a_user()
    {
        $article = ArticleFactory::create();

        $userToInvite = factory(User::class)->create();

        $this->actingAs($article->owner)
            ->post($article->path() . '/invitations', [
                'email' => $userToInvite->email
            ])
            ->assertRedirect($article->path());

        $this->assertTrue($article->members->contains($userToInvite));
    }

    /** @test */
    function the_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
        $article = ArticleFactory::create();

        $this->actingAs($article->owner)
            ->post($article->path() . '/invitations', [
                'email' => 'notauser@example.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have a Birdboard account.'
            ], null, 'invitations');
    }

    /** @test */
    function invited_users_may_update_article_details()
    {
        $article = ArticleFactory::create();

        $article->invite($newUser = factory(User::class)->create());

        $this
            ->actingAs($newUser)
            ->post(action('ArticleTasksController@store', $article), $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
