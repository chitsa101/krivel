<div id="nav" class="blog_nav">
        <!-- Navigation -->
        <nav class="navbar navbar-new" role="navigation">
            <div class="cont">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mobilemenu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse row" id="mobilemenu">
                <?php
                    $args = array(
                        'theme_location' => 'main',
                        'container' => false,
                        'menu_id'         => '',
                        'menu_class'      => 'nav menu navbar-nav navbar-left text-center col-xs-7', // css-класс меню
                        // 'walker'=> new True_Walker_Nav_Menu() // этот параметр нужно добавить                    
                    );
                    wp_nav_menu( $args );
                ?>
                <ul class="bgul col-xs-5">
                    <li><a class="vk" href="<?php the_field('vk', 'option') ?>" rel="noopener" target="_blank"></a></li>
                    <li><a class="ok" href="<?php the_field('ok', 'option') ?>" rel="noopener" target="_blank"></a></li>
                    <li><a class="face" href="<?php the_field('face', 'option') ?>" rel="noopener" target="_blank"></a></li>
                    <li><a class="twit" href="<?php the_field('twitter', 'option') ?>" rel="noopener" target="_blank"></a></li>
                    <li><a class="g" href="<?php the_field('google+', 'option') ?>" rel="noopener" target="_blank"></a></li>
                    <li><a class="mail" href="malito:<?php the_field('e-mail', 'option') ?>" rel="noopener" target="_blank"></a></li>               
                </ul>

            </div><!-- /.navbar-collapse -->
        </div>
        </nav>

        <!-- /Navigation -->
    </div>
    <!-- Navbar -->