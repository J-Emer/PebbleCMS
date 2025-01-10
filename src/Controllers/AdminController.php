<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\Helpers\PostPathLoader;
use Jemer\PebbleCms\Http\PostRequest;
use Jemer\PebbleCms\Loaders\TemplateLoader;
use Jemer\PebbleCms\Middlewares\AuthMiddleware;
use Jemer\PebbleCms\Savers\ContentSaver;
use Jemer\PebbleCms\Savers\PageSaver;

class AdminController extends BaseController
{
    private TemplateLoader $templateLoader;
    private AuthMiddleware $authMiddleware;

    public function __construct()
    {
        parent::__construct();
        $this->templateLoader = new TemplateLoader(ADMIN_DIR);
        $this->authMiddleware = new AuthMiddleware('/admin/login');
    }

    public function index()
    {
        echo "---this is where we'll determin if the user needs to login, go to admin/dashboard for now---";   

        // $page = [
        //     'title' => 'Page Title',
        //     'content' => 'page content',
        //     'slug' => 'page-title',
        //     'template' => "post",
        // ];

        // $pageSaver = new PageSaver(CONTENT_DIR);
        // $success = $pageSaver->saveContent($page);

        // echo json_encode(['success' => $success]);
    }

    //show the login screen
    public function showlogin()
    {
        //render login template
    }

    //handle the login logic
    public function login()
    {
         // Retrieve POST data
         $username = $_POST['username'] ?? '';
         $password = $_POST['password'] ?? '';

         //authenticate this user
         $this->authMiddleware->authenticate($username, $password, '/admin/dashboard');
            
    }

    //handle the logout functions, then redirect to login
    public function logout()
    {
        $this->authMiddleware->logout();
    }

    public function dashboard()
    {
        $postCount = $this->contentLoader->getAllPostsCount();
        $pageCount = $this->contentLoader->getAllPagesCount();


        $this->templateLoader->Render('dashboard', ["postcount" => $postCount, "pagecount" => $pageCount]);
    }
    public function users()
    {
        $this->templateLoader->Render('users', []);
    }    
    public function pages()
    {
        $pages = $this->contentLoader->getAllPages();

        $this->templateLoader->Render('pages', ["pages" => $pages]);
    }    
    public function posts()
    {
        $posts = $this->contentLoader->getAllPosts();

        //$this->dd($posts);

        $this->templateLoader->Render('posts', ["posts" => $posts]);
    }    
    public function settings()
    {
        $this->templateLoader->Render('settings', []);
    }  
    /**
     * Loads the newpost.twig.html template
     */
    public function newpost()
    {
        $this->templateLoader->Render('newpost', []);
    } 
    /**
     * saves the new post data
     */
    public function addnewpost()
    {
        $request = new PostRequest();

        $post = [
            'title' => $request->Get('title'),
            'category' => $request->Get('category'),
            'content' => $request->Get('content'),
            'slug' => $request->Get('slug'),
            'author' => "Bob Smith", //---get from the SessionManager->getUsername()
            'date' => date('d-M-Y'),
            'template' => "post",
            'keywords' => "post key words here"
        ];

        $contentSaver = new ContentSaver(CONTENT_DIR);
        $success = $contentSaver->saveContent($post);

        echo json_encode(['success' => $success]);
    } 

    public function newpage()
    {
        $this->templateLoader->Render('newpage', []);
    }

    public function addnewpage()
    {
        $request = new PostRequest();

        $page = [
            'title' => $request->Get('title'),
            'content' => $request->Get('content'),
            'slug' => $request->Get('slug'),
            'template' => "post",
        ];

        $pageSaver = new PageSaver(CONTENT_DIR);
        $success = $pageSaver->saveContent($page);

        echo json_encode(['success' => "asdfasdfasdfsdaf"]);
    }


    /**
     * shows the post-edit template
     */
    public function editpost($slug)
    {
        $post = $this->contentLoader->loadContent($slug);

        $this->templateLoader->Render('postedit', ['post' => $post]);
    }

    /***
     * handles the updating of a post -> redirects to the /admin/posts route
     */
    public function updatepost()
    {

    }
}

?>