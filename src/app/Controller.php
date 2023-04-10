<?php

    namespace Surricate;
    use \Exception;

    abstract class Controller extends Security{

        protected $theme;
        protected $defaultTheme='admin';
        protected $layout;
        protected $pathTempFile=ROOT.'temp/temp.';
        protected $file=[];
        protected $post=[];
        private $components;
        //private const THEMES =['Resp_orga','Resp_log','admin'];// liste des themes disponibles dans snippet/theme 

        public function __construct(){
            $this->layout="admin";
            $this->theme='admin';
            self::deleteMessage();
        }

        public function formatTime($int){
            $month=array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
            return $month[$int-1];    
        }

        
        public function setUri($uri){
            return BASE_URI.$this->setUriToken($uri);
        }

  

        protected function uploadImage($sources=Sources::ARTICLE_IMAGE){
            if($_SESSION['login']=='logged'){
                $file = new File();
                $results= $file->uploadFile($sources);
            }else{
                $this->redirection('auth/login');
            }
         return $results;
        }

        private function deleteMessage(){
            if(!empty($_POST['deleteMessage'])){
                unset($_SESSION['message'][$_POST['deleteMessage']]);
            }
        }

        protected function loadModel(string ...$model){
            foreach($model as $item){
                $item=ucfirst($item);
                $itemNamespace=Autoload::classToNamespace($item);
                $this->$item = new $itemNamespace();
            }
        }


        protected function getDatas($methode,string ...$data){
        }

        protected function render(string $fichier,array $data = [],$class=null){
            extract($data);
            if($class==null){
                $class=get_class($this);
            }
            Autoload::namespaceToClass($class);
            try{
                    self::loadComponent($this->theme);
            }catch(Exception $e){
                self::loadComponent($this->defaultTheme);
            }
            ob_start();
            require_once(Sources::path('views').strtolower($class).'/'.$fichier.'.php');
            //require_once(ROOT.'src/views/'.strtolower($class).'/'.$fichier.'.php');// decommenter pour revenir à la méthode par défaut des require
            $content=ob_get_clean();
            require_once(ROOT.'src/views/layouts/'.$this->layout.'.php');
        }

        private function loadComponent($theme,$dir='src/assets/snippets/'){
            $components = str_replace('.php',"",scandir(ROOT.'src/assets/snippets/'.$theme));
            array_splice($components,0,2);
            $component="";
            $this->components=$components;
            foreach($components as $component){
                ob_start();
                require_once(ROOT.$dir.$this->theme.'/'.$component.'.php');
            $contenu=ob_get_clean();
            (defined(strtoupper($component)))?'':define(strtoupper($component),$contenu);
            }  
        }

        protected function registerPost($post){
            (!empty($post))?array_push($this->post,$post):'';
            (!empty($this->post))?Security::setDatas($this->post):'';
        }

        protected function message($message,$id_message="notification"){
            (!empty($_COOKIE['message']))?$message=$_COOKIE['message'].'/'.$message:'';
            setcookie('message','Info-'.$id_message.': '.$message, strtotime('10 seconds'),'/',$_SERVER['HTTP_HOST']);
        }
       
        protected function redirection($redirection){
            header('Location: '.$this->setUri($redirection));
        }

        protected function setPagination($model,$methode,&$search,&$limit,&$numberOfPage,$data=null){
            (empty($_POST['offset-limit']))?$_POST['offset-limit']=10:'';
            (empty($_POST['search-'.PAGE]))?$_POST['search-'.PAGE]="":"";
            (empty($_POST['page']))?$_POST['page']=1:'';
            
            (isset($_POST['next']))?$_POST['page']=$_POST['page']+1:'';
            (!empty($_POST['search-'.PAGE]))?$search=$_POST['search-'.PAGE]:$search=null;
            ($data==null)?$count=implode(array_values($this->$model->$methode($search))):$count=implode(array_values($this->$model->$methode($data,$search)));
            (!empty($_POST['offset-limit']) && gettype(intval($_POST['offset-limit']))=='integer' && intval($_POST['offset-limit'])>=1)? $offset=intval($_POST['offset-limit']):$offset=$count;
            (!empty($_POST['page']) && gettype(intval($_POST['page']))=='integer' && intval($_POST['page'])>=1)? $page=intval($_POST['page']):$page=1;
            $numberOfPage=ceil($count/$offset);
            $limit=[intVal(($page-1)*$offset),intVal($offset)];
        }

        protected function loginMessage($message,$id_message=1){
            if(!empty($_SESSION['message'][0])){
                unset($_SESSION['message'][0]);
            }
            (isset($_SESSION['message'][$id_message]))?$_SESSION['message'][$id_message]=$message :$_SESSION['message'][$id_message]=$message;
        }

        private function setTheme(){
            $this->pickThemeIf($this->theme);
        }

        protected function pickThemeIf($roles){
            if($this->checkPermission($roles,$role)){
                $this->theme=$role;
            }else{
                $this->theme=$this->defaultTheme;
            }
        }
    }
?>