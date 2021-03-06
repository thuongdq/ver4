<?php 
    get_header();
    get_template_part( 'template-parts/navigation/navigation', 'top');
?>
<div class="content page-category">
    <?php
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<div class="breadcrumbs">','</div>');
    }
    get_template_part( 'template-parts/content/embed', 'postSpecial');
    ?>
    <?php if (have_posts()) {
    while (have_posts()) : the_post(); ?>
    <div class="post">
        <a href="#" title="#">
            <a  href="<?php echo esc_url( get_permalink()) ?>" title="<?php echo get_the_title()?>">
                <h2><?php the_title(); ?></h2>
            </a>
        </a>
        <div class="info">
           <a  href="<?php echo esc_url( get_permalink()) ?>" title="<?php echo get_the_title()?>">
                <!-- .post-thumbnail -->
                <?php if ( '' !== get_the_post_thumbnail()) : ?>
                    <?php the_post_thumbnail( 'image' ); ?>
                <?php else : ?> 
                    <img src="<?php echo get_path_image_first_content_post()?>" alt="<?php echo get_the_title()?>">
                <?php endif; ?>
                <!-- .post-thumbnail -->
            </a>
             <div class="intro">
                <?php
                echo sub_excerpt(get_the_content(),220);       
                ?>
                 <a  href="<?php echo esc_url( get_permalink()) ?>" title="<?php echo get_the_title()?>" class="pull-right btn btn-primary read-more" >Xem thêm</a>
            </div>
        </div>
        
    </div>
    <?php endwhile; }else{
         echo '<div class="post"><h4 class="no-content">Nội dung đang được cập nhật.</h4></div>';
        }?>
   <?php get_template_part('pagination'); 
    get_template_part( 'template-parts/content/embed', 'product');
    get_template_part( 'template-parts/sidebar/postHot');
    get_template_part( 'template-parts/sidebar/postNew');
    ?>
</div>
<?php 
get_sidebar("second");
get_sidebar();
get_footer(); ?>