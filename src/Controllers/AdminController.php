<?php

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\App;
use Jemer\PebbleCms\Loaders\ContentLoader;
use Jemer\PebbleCms\Loaders\TemplateRenderer;
use Jemer\PebbleCms\Loaders\UsersLoader;

class AdminController extends BaseController
{
    private TemplateRenderer $renderer;
    private UsersLoader $usersLoader;

    public function __construct()
    {
        parent::__construct();
        $this->renderer = new TemplateRenderer(THEMES_DIR . "/default");
        $this->usersLoader = new UsersLoader();
    }

    public function dashboard()
    {
        // Example of pulling data to pass to the view
        $totalPosts = count($this->postsLoader->getAllPosts());
        $totalPages = count($this->pagesLoader->getAllPages());
        $totalUsers = count($this->usersLoader->getAllUsers());

        $this->renderer->render('dashboard', [
            'total_posts' => $totalPosts,
            'total_pages' => $totalPages,
            'total_users' => $totalUsers
        ]);
    }

    public function posts()
    {
        $posts = $this->postsLoader->getAllPosts();
        $this->renderer->render('posts', ['posts' => $posts]);
    }

    public function pages()
    {
        $pages = $this->pagesLoader->getAllPages();
        $this->renderer->render('pages', ['pages' => $pages]);
    }

    public function settings()
    {
        // Pull settings from the config or database
        $settings = App::getInstance()->getConfig('site');
        $this->renderer->render('settings', $settings);
    }

    public function users()
    {
        $users = $this->usersLoader->getAllUsers();
        $this->renderer->render('users', ['users' => $users]);
    }

    // Other methods for creating/editing posts, pages, etc.
}

?>
