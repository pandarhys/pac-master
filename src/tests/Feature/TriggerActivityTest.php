<?php

namespace Tests\Feature;

use App\Task;
use Facades\Tests\Setup\ArticleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function creating_a_article()
    {
        $article = ArticleFactory::create();

        $this->assertCount(1, $article->activity);

        tap($article->activity->last(), function ($activity) {
            $this->assertEquals('created_article', $activity->description);

            $this->assertNull($activity->changes);
        });
    }

    /** @test */
    function updating_a_article()
    {
        $article = ArticleFactory::create();
        $originalTitle = $article->title;

        $article->update(['title' => 'Changed']);

        $this->assertCount(2, $article->activity);

        tap($article->activity->last(), function ($activity) use ($originalTitle) {
            $this->assertEquals('updated_article', $activity->description);

            $expected = [
                'before' => ['title' => $originalTitle],
                'after' => ['title' => 'Changed']
            ];

            $this->assertEquals($expected, $activity->changes);
        });
    }

    /** @test */
    function creating_a_new_task()
    {
        $article = ArticleFactory::create();

        $article->addTask('Some task');

        $this->assertCount(2, $article->activity);

        tap($article->activity->last(), function ($activity) {
            $this->assertEquals('created_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
            $this->assertEquals('Some task', $activity->subject->body);
        });
    }

    /** @test */
    function completing_a_task()
    {
        $article = ArticleFactory::withTasks(1)->create();

        $this->actingAs($article->owner)
            ->patch($article->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);

        $this->assertCount(3, $article->activity);

        tap($article->activity->last(), function ($activity) {
            $this->assertEquals('completed_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
        });
    }

    /** @test */
    function incompleting_a_task()
    {
        $article = ArticleFactory::withTasks(1)->create();

        $this->actingAs($article->owner)
            ->patch($article->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);

        $this->assertCount(3, $article->activity);

        $this->patch($article->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $article->refresh();

        $this->assertCount(4, $article->activity);

        $this->assertEquals('incompleted_task', $article->activity->last()->description);
    }

    /** @test */
    function deleting_a_task()
    {
        $article = ArticleFactory::withTasks(1)->create();

        $article->tasks[0]->delete();

        $this->assertCount(3, $article->activity);
    }
}
