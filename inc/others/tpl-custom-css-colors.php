<style type="text/css">

    /* Title Color */

    .site-title a:link,
    .site-title a:visited                                           {color:<?php echo $title_color; ?>}
    .site-title a:hover,
    .site-title a:active,
    .site-title a:focus                                             {color:<?php echo $secondary_color; ?>}

    /* Tagline Color */

    .site-description                                               {color:<?php echo $tagline_color; ?>}
    
    /* Primary Color */

    a:link,
    a:visited,
    .vif-leaflet-map-container .vif-map-markers-index ul a:link,
    .vif-leaflet-map-container .vif-map-markers-index ul a:visited    {color:<?php echo $primary_color; ?>}

    #trips-list li a:link,
    #trips-list li a:visited,
    .entry-summary .entry-more:link,
    .entry-summary .entry-more:visited,
    .site-navigation a:link, 
    .site-navigation a:visited,
    .widget-posts-in-list-more a:link,
    .widget-posts-in-list-more a:visited                            {background-color:<?php echo $primary_color; ?>}

    #site-navigation ul li                                          {border-bottom-color:<?php echo $primary_color; ?>}

    /* Secondary Color */

    a:hover,
    a:active,
    a:focus                                                         {color:<?php echo $secondary_color; ?>}

    #site-navigation ul a:hover,
    #site-navigation ul a:active,
    #site-navigation ul a:focus,
    #site-navigation ul .current-menu-item a,
    #site-navigation ul .current_page_item a,
    #trips-list li a:hover,
    #trips-list li a:active,
    #trips-list li a:focus,
    #trips-list li.current-trip-page a,
    .entry-summary .entry-more:hover,
    .entry-summary .entry-more:active,
    .entry-summary .entry-more:focus,
    article.type-trips,
    .vif-leaflet-map-container .vif-map-markers-index ul,
    .site-navigation a:hover,
    .site-navigation a:active,
    .site-navigation a:focus,
    .widget-posts-in-list-more a:hover,
    .widget-posts-in-list-more a:active,
    .widget-posts-in-list-more a:focus                              {background-color:<?php echo $secondary_color; ?>}

    /* ---------------------
      550px <= Width
    --------------------- */

    @media screen and (min-width: 550px) {

        /* Primary Color */

        #site-navigation ul a                                       {border-top-color:<?php echo $primary_color; ?>}

        .vif-map-actions-toggles .vif-map-markers-index-toggle:hover,
        .vif-map-actions-toggles .vif-map-markers-index-toggle:active,
        .vif-map-actions-toggles .vif-map-markers-index-toggle:focus,
        .vif-map-actions-toggles .vif-map-markers-index-toggle.active,
        .vif-map-actions-toggles .vif-map-export-map-toggle:hover,
        .vif-map-actions-toggles .vif-map-export-map-toggle:active,
        .vif-map-actions-toggles .vif-map-export-map-toggle:focus,
        .vif-map-actions-toggles .vif-map-export-map-toggle.active    {background-color:<?php echo $primary_color; ?>}

        /* Secondary Color */

        #site-navigation ul .current-menu-item a,
        .vif-map-actions-toggles .vif-map-markers-index-toggle:link,
        .vif-map-actions-toggles .vif-map-markers-index-toggle:visited,
        .vif-map-actions-toggles .vif-map-export-map-toggle:link,
        .vif-map-actions-toggles .vif-map-export-map-toggle:visited   {background-color:<?php echo $secondary_color; ?>}

        .vif-map-actions-toggles a                                   {border-color:<?php echo $secondary_color; ?>}

    }

</style>