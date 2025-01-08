<?php 

namespace Jemer\PebbleCms\Controllers;

use Jemer\PebbleCms\Loaders\TemplateLoader;

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
}

?>