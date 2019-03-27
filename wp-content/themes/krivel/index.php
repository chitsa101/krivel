
<?php get_header(); ?>
<?php     the_post();?>
    <!-- Header Area -->
    <div id="top" class="header">   
        <div class="vert-text">
        <div style="position: absolute; top:5px; left:5px;">
            <img class="img-rounded" alt="Company Logo" src="<?php echo get_field('main_logo', 'option'); ?>"/>	
        </div>  
        <h2><em>Krivel Aleksey</em></h2>	
            <br />
            <a href="#portfolio" class="btn btn-top"></a>			
        </div>
    </div>
    <!-- /Header Area -->
        <?php 
            // подключим файл c меню
            // set_query_var( 'post_id', 7 );
            get_template_part( 'templates/t', 'nav' ); 
        ?>
    <!-- Portfolio -->
    <div id="portfolio" class="portfolio">
        <div class="container">
            <div class="row push50">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h2>Фотогалерея</h2>
                    <h3>
                        <span class="filter label label-default" data-filter="all">ВСЕ</span>
                        <?php
                            $categories = get_categories('parent=4');
                                foreach( $categories as $cat ):?>
                                    <span class="filter label label-default" data-filter="<?php echo $cat->category_nicename?>">
                                        <?php echo $cat->cat_name?>
                                    </span>
                        <?php endforeach?>
                        <!-- <span class="filter label label-default" data-filter="humans">Люди</span>
                        <span class="filter label label-default" data-filter="nature">Природа</span>
                        <span class="filter label label-default" data-filter="auto_moto">Авто-мото</span> -->
                    </h3> 
                    <hr>
                </div>
            </div>                
            <div class="row">
                <div class="gallery">
                    <ul id="Grid" class="gcontainer">                    
                       <?php
                        // задаем нужные нам критерии выборки данных из БД
                        $args = array(
                            'category_name' => 'gallery',
                            'orderby' => 'rand',
                            'posts_per_page' => 36
                        );
                        $query = new WP_Query( $args );?>
                        <?php if ( $query->have_posts() ) :?>
                            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <li class="col-md-4 col-sm-4 col-xs-12 mix
                            <?php
                                $category = get_the_category();
                                foreach ($category as $cat) {
                                echo "$cat->slug" . " ";} 
                            ?>">
                                <a href="<?php the_permalink( ); ?>" class="mix-cover">
                                    <!-- <img class="horizontal" src="img/portrait1-sm.jpg" alt="placeholder"> -->
                                    <?php the_post_thumbnail('medium'); ?>
                                    <span class="overlay">
                                        <span class="valign"></span>
                                        <span class="title"><?php the_title(); ?></span>
                                    </span>
                                </a>                
                            </li>
                            <?php endwhile;
                        endif; ?>
                        <!-- /* Возвращаем оригинальные данные поста. Сбрасываем $post. */ -->
                        <?php 
                            wp_reset_postdata();
                        ?>
                    </ul> 
                </div>	
            </div>
		</div>
    </div>  
        <!-- News -->
    <div id="services" class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h2>Новости</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <?php
                    // задаем нужные нам критерии выборки данных из БД
                    $args1 = array(
                        'category_name' => 'blog',
                        'orderby' => 'date',
                        'posts_per_page' => 3
                    );
                    $query_one = new WP_Query( $args1 );?>
                    <?php if ( $query_one->have_posts() ) :?>
                        <?php while ( $query_one->have_posts() ) : $query_one->the_post(); ?>

                            <div class="col-md-4 text-center">
                                <div class="service-item">
                                    <?php the_post_thumbnail('medium'); ?>
                                    <h3><?php the_title(); ?></h3>
                                    <?php the_date(); ?>
                                    <a href="<?php the_permalink( ); ?>" class="mix-cover">Подробнее</a> 
                                </div> 
                            </div>
                        <?php endwhile;
                    endif; ?>
                            <!-- /* Возвращаем оригинальные данные поста. Сбрасываем $post. */ -->
                    <?php 
                        wp_reset_postdata();
                    ?>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                <h4><em>Все новости</em></h4>	
            <br />
            <a href="<?php echo get_site_url()?>/blog" class="btn btn-top"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /News -->
    <div id="contact">
        <?php 
            // подключим файл c формой
            // set_query_var( 'post_id', 7 );
            get_template_part( 'templates/t', 'form' ); 
        ?>
    </div>
    <?php get_footer(); ?>

