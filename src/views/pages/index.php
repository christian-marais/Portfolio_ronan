
<div class="container">
    <div class="row text-center">
        <div class="col-9 home__title">
            <h1 class=" display1">PORTFOLIO R.L<a href="<?=(!empty($_SESSION['login']))?$this->setUri('admin/articles'):$this->setUri('auth/login')?>" style="all:unset;">O</a>PIN</h1>
            <div class="socials">
               <a href=""><img src="<?=BASE_URI?>images/banque/site/linkedin.png"></a>
               <a href="mailto:ronanlopin@yahou.fr"><img src="<?=BASE_URI?>images/banque/site/mail.png"></a>
            </div>
        </div>       
    </div>
</div>
<?php 
    foreach($articles as $article){
        if($article['active']===1){
            echo'
            <div class="container article">
            <div class="row mb-1 text-center">
                <div class="card col-8" style="">
                <img  src="'.BASE_URI.'/images/banque/articles/'.$article["lien_image"].'" alt="'.$article["lien_image"].'" class="card-img-top">
                <div class="card-body">
                    <p class="card-text">'.$article["description_article"].'</p>
                </div>
                </div>     
            </div>
            </div>
            ';
        }
    }
?>