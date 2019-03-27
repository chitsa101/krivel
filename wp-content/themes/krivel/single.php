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
                <div class="items-row cols <?php the_ID(); ?> row-fluid clearfix">
                    <div class="span12">
                        <div class="item column-1" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                            <!-- <div class="page-header">
                                <h2 itemprop="name">
                                    <a href="<?php the_permalink( ); ?>" target="_blank" itemprop="url">
                                    <?php the_title(); ?></a>
                                </h2>
                            </div> -->
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
                                        <!-- Просмотров: <?php echo setPostViews(the_ID()); ?>		 -->
                                </dd>
                            </dl>
                            <div class="col-xs-12 row normal">
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
                                    <?php the_content(); ?>

                                <?php 
                                    $gallery = get_post_gallery($post->ID, false);
                                    $ids = explode( ",", $gallery['ids'] );
                                    foreach( $ids as $id ):?>

                                    <?php $link   = wp_get_attachment_url( $id );
                                    $caption = wp_get_attachment_caption($id);
                                    $url = wp_get_attachment_image_url( $id, 'full');
                                ?>

                                    <p style="text-align: center;">
                                        <a class="gall_img" href="<?= $link ?>" >
                                            <img alt="" class="photo" src="<?= $url ?>">
                                        </a>
                                    </p>
                                    <?php if(isset($caption)):?>
                                        <p style="text-align: center;">
                                            <?= $caption ?>
                                        </p>
                                    <?php endif?>
                                <?php endforeach ?>
                            </div>
                        </div><!-- end item -->
                    </div><!-- end span -->
                </div><!-- end row -->
                <div class="items-row cols <?php the_ID(); ?> row-fluid clearfix">
                    <input class="readmorer" type="button" onclick="history.back()" value="Назад">
                </div>
            </div>
        </div>
    </div>


    <?php get_footer(); ?>