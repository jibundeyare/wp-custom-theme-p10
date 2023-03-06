<?php

get_header();

if ( have_posts() ):
    the_post();
    ?>
    <article>
        <h2><?php the_title(); ?></h2>
        <div><?php the_content(); ?></div>
    </article>
    <?php
endif;

get_footer();
