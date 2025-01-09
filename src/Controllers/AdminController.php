<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\Http\PostRequest;
use Jemer\PebbleCms\Loaders\TemplateLoader;
use Jemer\PebbleCms\Savers\ContentSaver;

class AdminController extends BaseController
{
    private TemplateLoader $templateLoader;

    public function __construct()
    {
        $this->templateLoader = new TemplateLoader(ADMIN_DIR);
    }

    public function index()
    {
        echo "---this is where we'll determin if the user needs to login, go to admin/dashboard for now---";   
    }

    public function dashboard()
    {
        $this->templateLoader->Render('dashboard', []);
    }
    public function users()
    {
        $this->templateLoader->Render('users', []);
    }    
    public function pages()
    {
        $this->templateLoader->Render('pages', []);
    }    
    public function posts()
    {
        $this->templateLoader->Render('posts', []);
    }    
    public function settings()
    {
        $this->templateLoader->Render('settings', []);
    }  
    public function newpost()
    {
        $this->templateLoader->Render('newpost', []);
    } 
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
}

?>