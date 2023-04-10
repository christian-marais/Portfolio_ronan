<?php
 namespace Surricate;

class Pages extends Controller{
    //classe permettant d'afficher les pages statiques

    public function __construct(){
        $this->layout='blank';//layout par défaut de la classe
        (empty($_SESSION['message']))?$_SESSION['message'][0]='':'';
    }

    public function index(){//méthode pour l'affichage de la page d'accueil
        $this->layout="blank";//le layout ne contient ne charge que un head et le contenu
        $this->theme="home";// le composant doit être sur home pour la feuille de style de home
        $this->loadModel("Article");
        $articles=$this->Article->getAllArticles();
        $this->render('index',compact('articles'),'pages');
    
    }
    public function erreur404(){//fait les redirections 404
        $this->layout="blank";//on choisit le layout et les éléments html (heads...)
        $this->theme="blank";// les composants utilisés
        $this->render('404');// on affiche la page 404
    }
    public function blocked(){//fait les redirections 404
        $this->layout="blank";//on choisit le layout et les éléments html (heads...)
        $this->theme="blank";// les composants utilisés
        $this->render('blocked');// on affiche la page 404
    }
} 
?>  