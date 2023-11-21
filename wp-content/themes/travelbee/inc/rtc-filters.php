<?php
if( ! function_exists( 'travelbee_widget_filter' ) ) :
/**
 * Filter for Featured page widget
*/
function travelbee_widget_filter( $html, $args, $instance ){ 
    $title             = !empty( $instance['title'] ) ? $instance['title'] : __( '', 'travelbee' );         
    $read_more         = !empty( $instance['readmore'] ) ? $instance['readmore'] : __( 'Read More', 'travelbee' );      
    $show_feat_img     = !empty( $instance['show_feat_img'] ) ? $instance['show_feat_img'] : '' ;  
    $show_page_title   = !empty( $instance['show_page_title'] ) ? $instance['show_page_title'] : '' ;        
    $show_page_content = !empty( $instance['show_page_content'] ) ? $instance['show_page_content'] : '' ;        
    $show_readmore     = !empty( $instance['show_readmore'] ) ? $instance['show_readmore'] : '' ;        
    $page_list         = !empty( $instance['page_list'] ) ? $instance['page_list'] : '' ;
    $image_alignment   = apply_filters( 'rrtc_featured_img_alignment', 'right' );
    $image_alignment   = !empty( $instance['image_alignment'] ) ? $instance['image_alignment'] : $image_alignment;

    if( !isset( $page_list ) || $page_list == '' ) return;
    
    $post_no = get_post($page_list); 

    $target = 'rel="noopener noexternal" target="_blank"';
    if( isset($instance['target']) && $instance['target']!='' )
    {
        $target = 'target="_self"';
    }

    if( $post_no ){
        setup_postdata( $post_no );
        ob_start();

        if( has_post_thumbnail( $post_no ) && $show_feat_img ){ 
            $add_class = ' has-featured-image';
        }else{
            $add_class = ' no-featured-image';
        } ?>
        <div class="widget-featured-holder <?php echo esc_attr($image_alignment); echo esc_attr($add_class);?>">
            <div class="text-holder">
                <?php

                if( isset( $show_page_title ) && $show_page_title!='' ){
                    echo is_page_template( 'templates/about.php' ) ? '<h1 class="section-subtitle">' : '<p class="section-subtitle">'; ?>
                    <span><?php echo esc_html( $post_no->post_title ); ?></span>
                    <?php
                    echo is_page_template( 'templates/about.php' ) ? '</h1>' : '</p>';
                } 

                if( isset( $title ) && $title!='' ){ ?>
                    <h2 class="widget-title"><?php echo esc_html( $title ); ?></h2>
                <?php } ?>
                <div class="featured_page_content">
                    <?php 
                    if( isset( $show_page_content ) && $show_page_content != '' )
                    {
                        echo apply_filters( 'the_content', $post_no->post_content );
                    }
                    else{
                        echo apply_filters( 'the_excerpt', get_the_excerpt( $post_no ) );                                
                    }
                    if( isset( $show_readmore ) && $show_readmore != '' && ! $show_page_content ){ ?>
                        <a href="<?php the_permalink( $post_no );?>" <?php echo $target;?> class="btn-readmore"><?php echo esc_html( $read_more );?></a>
                    <?php } ?>
                </div>
            </div>
            <?php if( has_post_thumbnail( $post_no ) && $show_feat_img ){ ?>
            <div class="img-holder">
                <a <?php echo $target;?> href="<?php the_permalink( $post_no ); ?>">
                    <?php 
                    $featured_img_size = apply_filters( 'rrtc_featured_img_size', 'full' );
                    echo get_the_post_thumbnail( $post_no, $featured_img_size ); ?>
                </a>
            </div>
            <?php } ?>
        </div>        
    <?php }   
    $html = ob_get_clean();
    wp_reset_postdata();
    return $html;
}
endif;
add_filter( 'raratheme_companion_featured_page_widget_filter', 'travelbee_widget_filter', 10, 3 );

if( ! function_exists( 'travelbee_widget_imagetext_filter' ) ) :
/**
 * Filter for Image text widget
*/
function travelbee_widget_imagetext_filter( $html, $args, $instance ){ 
    // $obj = new RaraTheme_Companion_Functions();
    $it_img_size = apply_filters( 'raratheme_it_img_size', 'travelbee-featured' );
    $title   = ! empty( $instance['title'] ) ? $instance['title'] : '' ;	

    $target = 'target="_self"';
    if( isset( $instance['target'] ) && $instance['target']!='' ){
        $target = 'rel="noopener noexternal" target="_blank"';
    }	
    
    ob_start();
    if ( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance ) . $args['after_title']; 
    ?>
        <ul class="raratheme-itw-holder">
            <?php
            if( isset( $instance['link'] ) )
            {
                $size = sizeof( $instance['link'] );
                $max = max( array_keys( $instance['link'] ) );
                for ( $i=0; $i <= $max; $i++ ) {

                    if ( isset( $instance['link'][$i] ) && $instance['link'][$i] != '' ){
                        echo '<li>';
                        ?>
                        <a href="<?php echo esc_url( $instance['link'][$i] );?>" <?php echo $target;?>>
                            <?php
                            if( isset( $instance['image'][$i] ) && $instance['image'][$i] !='' ){ 
                                $image_id = $instance['image'][$i];
                                echo wp_get_attachment_image( $image_id, $it_img_size );
                            }
                            if( $instance['image'][$i] == '' ){
                                //fallback svg
                                travelbee_get_fallback_svg( $it_img_size );
                            }
                            ?>
                        </a>
                        <?php 

                        if( isset( $instance['link_text'][$i] ) && $instance['link_text'][$i] !='' && isset( $instance['link'][$i] ) && $instance['link'][$i] !='' )
                        { 
                            echo '<a class="btn-readmore" href="'.esc_url( $instance['link'][$i] ).'" '.$target.'>'.esc_attr( $instance['link_text'][$i] ).'</a>'; ?>								
                        <?php 
                        }
                        echo '</li>'; 
                    }
                }
            } 
            ?>
        </ul>
    <?php   
    $html = ob_get_clean();
    wp_reset_postdata();
    return $html;
}
endif;
add_filter( 'rara_imagetext_widget_filter', 'travelbee_widget_imagetext_filter', 10, 3 );