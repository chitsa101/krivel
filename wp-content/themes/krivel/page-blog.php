<?php get_header(); ?>
<?php     the_post();?>
    <?php 
        // подключим файл c меню
        // set_query_var( 'post_id', 7 );
        get_template_part( 'templates/t', 'nav_blog' ); 
    ?>

    <div id="content">

        <div class="blogs" itemscope itemtype="http://schema.org/Blog">
            <div class="page-header">
                <h1> <?php the_title(); ?> </h1>
            </div>

            <?php

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            // задаем нужные нам критерии выборки данных из БД
            $args = array(
                'paged' => $paged,
                'category_name' => 'blog',
                'orderby' => 'date',
                'posts_per_page' => 15
            );

            $query = new WP_Query( $args );

            // Цикл
            if ( $query->have_posts() ) :?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <div class="items-row cols <?php the_ID(); ?> row-fluid clearfix">
                    <div class="span12">
                        <div class="item column-1" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                            <div class="page-header">
                                <h2 itemprop="name">
                                    <a href="<?php the_permalink( ); ?>"  itemprop="url">
                                    <?php the_title(); ?></a>
                                </h2>
                            </div>
                            <dl class="article-info muted">
                                <dt class="article-info-term">
                                    Подробности	
                                </dt>
                                <dd class="published">
                                    <span class="icon-calendar"></span>
                                    <time itemprop="datePublished">
                                        Опубликовано: <?php the_date(); ?>
                                    </time>
                                </dd>					                           
                                <dd class="hits">
                                    <span class="icon-eye-open"></span>
                                    <meta itemprop="interactionCount" content="UserPageVisits:146">
                                    <?php setPostViews(get_the_ID()); ?>
                                    <span class="views">Просмотров: <?php echo getPostViews (get_the_ID ()); ?>
                                </dd>
                            </dl>
                            <div class="col-xs-12 row">
                                <div class="col-md-5 col-xs-12 image">
                                    <?php
                                        if ( has_post_thumbnail()) {
                                        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                                        echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
                                        the_post_thumbnail('medium');
                                        echo '</a>';
                                        }
                                        ?> 
                                </div>
                                <?php add_filter('the_content','htm_image_content_filter',11); ?>
                                <?php the_content(''); ?>
                                <p class="readmore">
                                    <a href="<?php the_permalink( ); ?>"  class="btn">Подробнее...</a>
                                </p>
                            </div>
                        </div><!-- end item -->
                    </div><!-- end span -->
                </div><!-- end row -->
               
            <?php endwhile;
            endif; ?>
            <!-- /* Возвращаем оригинальные данные поста. Сбрасываем $post. */ -->

            <?php 
                kama_pagenavi(array(), $query); 
                wp_reset_postdata();
            ?>

        </div>
    </div>


    <?php get_footer(); ?>