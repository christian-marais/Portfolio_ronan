
<section class="admin"> 
  <div class="container">
      <div class="bloc" id="" >
        <h3 class="text-white">Manager le site</h3>

        <div class="row justify-content-md-center">
            <div class="col-lg-10">
              <div class="row">
                  <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="cards home__card text-center text-center">
                        <div class="text-white">
                          <h4 class="card-title mt-5 mb-3">Utilisateur</h4>
                          <p class="card-text">Gérer les utilisateurs</p>
                          <a href="<?=$this->setUri('admin/utilisateurs')?>" class="">
                            <button class="button">
                              Gérer
                            </button> 
                          </a>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="cards home__card text-center">
                        <div class="text-white">
                          <h4 class="card-title  mt-5 mb-3">Articles</h4>
                          <p class="card-text">Gérer les articles</p>
                          <a href="<?=$this->setUri('admin/articles')?>" class="">
                            <button class="button">
                              Gérer
                            </button> 
                          </a>
                        </div>
                    </div>
                  </div>
                  
                  <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="cards home__card text-center text-center">
                        <div class="text-white">
                          <h4 class="card-title mt-5 mb-3">Permissions</h4>
                          <p class="card-text">Gérer les Permissionss</p>
                          <a href="<?=$this->setUri('admin/roles')?>" class="">
                            <button class="button">
                              Gérer
                            </button> 
                          </a>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</section>