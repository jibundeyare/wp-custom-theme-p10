<footer>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                // affichage du menu menu-footer
                wp_nav_menu( [
                    'theme_location' => 'menu-footer',
                    // type de balise de l'élément contenant
                    // @warning ne fonctionne pas (à cause du WP_Nav_Walker par défaut ?)
                    // 'container' => 'footer',
                    // classe css de l'élément contenant
                    'container_class' => 'menu-footer-container',
                    // balise qui enrobe l'élément courant
                    'before' => '<span class="outside">',
                    'after' => '</span>',
                    // balise qui enrobe le texte de l'élément courant
                    'link_before' => '<span class="inside">',
                    'link_after' => '</span>',
                ] );
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>