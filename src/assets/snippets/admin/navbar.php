   
         <nav class="navbar">
            <ul>
               
               <li>
                  <a class='navbar_link'href="<?=$this->setUri('admin/menus')?>">
                     <i class='bx bxs-package'></i>
                  </a>
               </li>
               <li>
                  <a class='navbar_link'href="<?=HTTPS.'://'.$_SERVER['HTTP_HOST']?>">
                     <i class='bx bxs-home-smile'></i>
                  </a>
               </li>
              
               <li>
                  <span class="role">
                  Connecté en : <?=(!empty($_SESSION['role']))?str_replace(',','/',$_SESSION['role']):'';?>
                  </span>
               </li>
            </ul>
         </nav>
         