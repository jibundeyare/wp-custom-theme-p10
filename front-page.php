<?php
get_header();
?>

<main class="container">
    <!-- carousel -->
    <div class="row">
        <div class="col-8 offset-2">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= get_template_directory_uri() ?>/img/hao-wang-pVq6YhmDPtk-unsplash-1920x1280.jpg" class="d-block w-100" alt="Photo de Miikka Luotio">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= get_template_directory_uri() ?>/img/jr-korpa-9XngoIpxcEo-unsplash-1920x1280.jpg" class="d-block w-100" alt="Photo de Jr Korpa">
                    </div>
                    <div class="carousel-item">
                        <img src="<?= get_template_directory_uri() ?>/img/miikka-luotio-Z8pDFNfS5xA-unsplash-1920x1280.jpg" class="d-block w-100" alt="Photo de hao wang">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="articles-container row">
        <!-- liste d'articles -->
        <div class="col-12">
            <h2>Nos derniers articles</h2>
        </div>
        <?php
        $args = array(
            'post_type' => array( 'post' ),
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        // Exécution de la requête WP_Query
        $query = new WP_Query( $args );

        // Affichage du résultat de la requête WP_Query avec la boucle
        if ( $query->have_posts() ):
            while ( $query->have_posts() ):
                $query->the_post();
                ?>
                <div class="col">
                    <article>
                        <h3><a href="<?= get_permalink() ?>"><?php the_title(); ?></a></h3>
                        <div><?php the_excerpt(); ?></div>
                    </article>
                </div>
                <?php
            endwhile;
        else:
            ?>
            <div class="col">
                Aucun article trouvé
            </div>
            <?php
        endif;

        // Restauration des paramètres originaux de la requête de l'utilisateur
        wp_reset_postdata();
        ?>
    </div>

    <address class="row ">
        <!-- 8 col -->
        <div class="col-8">
            <?php get_sidebar( 'map' ); ?>
        </div>
        <!-- 4 col -->
        <!-- illustration -->
        <div class="address-illustration col-4 h-100">
            <img src="<?= get_template_directory_uri() ?>/img/mymind-wHJ5L9KGTl4-unsplash-1920x2879.jpg" alt="Photo de mymind">
        </div>
    </address>

    <!-- 6 col, 3 espace à gauche, 3 espaces à droite  -->
    <!-- le contenu de la page d'accueil -->
    <div class="row">
        <div class="col-6 offset-3">
            <?php
            $args = array(
                'post_type' => 'page',
                'pagename' => 'accueil',
            );

            // Exécution de la requête WP_Query
            $query = new WP_Query( $args );

            // Affichage du résultat de la requête WP_Query avec la boucle
            if ( $query->have_posts() ):
                $query->the_post();
                the_content();
            else:
                ?>
                <div class="col">
                    Page d'accueil non trouvée
                </div>
                <?php
            endif;

            // Restauration des paramètres originaux de la requête de l'utilisateur
            wp_reset_postdata();
            ?>
        </div>
    </div>

</main>

<?php
get_footer();
