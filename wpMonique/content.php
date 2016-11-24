<?php
   /**
    * The template used for displaying page content
    *
    * @package WordPress
    * @subpackage wpMonique
    * @since wpMonique 0.1
    */

    global $cLang;

    $dirTheme = esc_url(get_template_directory_uri());
?>

<!-- Begin Standard Content Template -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php

        if(is_single()) {

            echo '<header class="entry-header">';
                the_title('<h1 class="entry-title">','</h1>');
            echo '</header>';

            echo '<div class="entry-meta">';

                echo ($cLang == 'no' ? get_the_date('j. F Y') : get_the_date('F j, Y'));
                echo '&nbsp;&bull;&nbsp;';
                echo wpMoniqueGetCategoryList(get_the_ID());
                echo '&nbsp;&bull;&nbsp;';
                if($cLang == 'no') {
                    echo comments_number('ingen kommentarer','én kommentar','% kommentarer');
                } else {
                    echo comments_number('no comments','one comment','% comments');
                }
                echo '&nbsp;&bull;&nbsp;';
                echo fPostViews(get_the_ID());
                echo ($cLang == 'no' ? ' visninger' : ' views');
                //~ echo '<b>'.($cLang == 'no' ? get_the_date('j. F Y') : get_the_date('F j, Y')).'</b>';
                //~ echo '<br>';
                //~ echo wpMoniqueGetCategoryList(get_the_ID());
                //~ echo '<br>';
                //~ if($cLang == 'no') {
                    //~ echo comments_number('ingen kommentarer','én kommentar','% kommentarer');
                //~ } else {
                    //~ echo comments_number('no comments','one comment','% comments');
                //~ }
                //~ echo '<br>';
                //~ echo fPostViews(get_the_ID());
                //~ echo ($cLang == 'no' ? ' visninger' : ' views');

            echo '</div>';

            echo '<div class="entry-feature">';

                if(has_post_thumbnail()) the_post_thumbnail(array(720,375));
                $sFCaption = get_post(get_post_thumbnail_id())->post_excerpt;
                if(!empty($sFCaption)) {
                    echo '<span class="feature-caption">'.$sFCaption.'</span>';
                }

            echo '</div>';

            echo '<div class="entry-content">';
                the_content();
            echo '</div>';

            if($cLang == 'no') {
                echo get_the_tag_list('<footer class="entry-footer">Stikkord: ',', ','</footer>');
            } else {
                echo get_the_tag_list('<footer class="entry-footer">Tags: ',', ','</footer>');
            }

            // Show Featured and Related Posts
            echo '<div class="entry-related">';
                $sExclude = fRelatedPosts('featured',3,get_the_ID());

                $sCustom = implode(',',get_post_custom_values('Related'));
                if(!empty($sCustom)) {
                    fRelatedPosts($sCustom,3,$sExclude);
                }
            echo '</div>';

            // Statistics
            if(!is_user_logged_in()) {
                fSetPostViews(get_the_ID());
            }

        } else { ?>

        <header class="entry-header">
            <?php
                if(is_single()) {
                    the_title('<h1 class="entry-title">','</h1>');
                } else {
                    the_title('<h1 class="entry-title"><a href="'.esc_url(get_permalink()).'">','</a></h1>');
                }
            ?>
        </header>
        <div class="entry-meta">
            <?php
                echo ($cLang == 'no' ? get_the_date('j. F Y') : get_the_date('F j, Y'));
                echo '&nbsp;&bull;&nbsp;';
                echo wpMoniqueGetCategoryList(get_the_ID());
                echo '&nbsp;&bull;&nbsp;';
                if($cLang == 'no') {
                    echo comments_number('ingen kommentarer','én kommentar','% kommentarer');
                } else {
                    echo comments_number('no comments','one comment','% comments');
                }
                echo '&nbsp;&bull;&nbsp;';
                echo fPostViews(get_the_ID());
                echo ($cLang == 'no' ? ' visninger' : ' views');
            ?>
        </div>
        <div class="entry-list-feature">
            <?php
                echo '<a href="'.esc_url(get_permalink()).'">';
                if(has_post_thumbnail()) {
                    the_post_thumbnail(array(192,100));
                } else {
                    echo '<img width="192" height="100" src="'.$dirTheme.'/theme-files/no-feature.png" class="wp-post-image">';
                }
                echo '</a>';
            ?>
        </div><div class="entry-excerpt"><?php
            the_excerpt();
            if($cLang == 'no') {
                echo get_the_tag_list('<footer class="entry-footer">Stikkord: ',', ','</footer>');
            } else {
                echo get_the_tag_list('<footer class="entry-footer">Tags: ',', ','</footer>');
            }
        ?></div>
        <?php echo '<div class="entry-spacer clear"></div>'; ?>

    <?php } ?>

</article>
<!-- End Standard Content Template -->
