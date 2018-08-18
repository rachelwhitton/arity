<?php
namespace App\Theme;

/*
  Template Name:      Newsroom Item
  Template Type:      Module
  Description:        A news item.
  Last Updated:       08/15/2018
  Since:              2.3.0
*/
?>

<div <?php module_class('newsroom-item body-column body-one-column text-module-advanced'); ?>>
  <div class="container">
    <div class="row">
      <div class="body-one-column__col default-styles">


        <?php // echo '<pre>'; print_r($data); echo count($data[items]).'</pre>';

        if( get_query_var('paged') ) {
          $paged = absint(get_query_var( 'paged' ));
        } else {
          $paged = 1;
        }

        // Variables
        $page_name        = 'newsroom-beta'; // change this 
        $row              = 0;
        $items_per_page   = 2; // How many items to display on each page
        $items            = array_reverse($data['items']);
        $total            = count( $items);
        $pages            = ceil( $total / $items_per_page );
        $min              = ( ( $paged * $items_per_page ) - $items_per_page ) + 1;
        $max              = ( $min + $items_per_page ) - 1;

        // ACF Loop
        if( $total > 0 ) : ?>

          <?php while( $row < $total): 
            $row++;

            // Ignore this image if $row is lower than $min
            if($row < $min) { continue; }

            // Stop loop completely if $row is higher than $max
            if($row > $max) { break; }                     
            
            if ($items[$row - 1]['article_id']) {
              $h2_article_id = ' data-article-version="1.0" data-article-id="' . $items[$row - 1]['article_id'] . '"';
            } else {
              $h2_article_id = '';              
            }
            ?>
            <h2<?= $h2_article_id ?>><a href="<?= $items[$row - 1]['link'] ?>" target="_blank" rel="noopener"><?= $items[$row - 1]['headline'] ?></a></h2>
            <p><?= $items[$row - 1]['description'] ?></p>
            <p><em><?= $items[$row - 1]['publication_date'] ?> | <?= $items[$row - 1]['publication'] ?></em></p>
            <hr />
          <?php endwhile;

          // Pagination
          $links = paginate_links(array(
            'base' => get_permalink() . 'page/%#%' . '/',
            'format' => '?page=%#%',
            'current' => $paged,
            'total' => $pages,
            'type' => 'array'
          ));          
          ?>

          <div class="blog-pagination" style="padding-top: 30px;">
            <div class="blog-pagination__inner">
              <?php if( get_previous_posts_link() ) : ?>
                <div class="blog-pagination__arrow-link prev-link">
                  <?php previous_posts_link( '<svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>' ); ?>
                </div>
              <?php else : ?>
                <div class="blog-pagination__arrow-link prev-link no-posts">
                  <div class="rotate">
                    <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>
                  </div>
                </div>
              <?php endif; ?>

              <div class="blog-pagination__page-selector">
                Page
                <select id="blog-pagination">
                    <?php

                    foreach ( $links as $pgl ) {
                        //Skip Prev and Next.
                        if(strpos($pgl, 'class="prev') || strpos($pgl, 'class="next')){
                            continue;
                        }
                        $option = str_replace('<a','<option', $pgl);
                        $option = str_replace('<span','<option id="current" selected ', $option);
                        $option = str_replace('a>','option>', $option);
                        $option = str_replace('span>','option>', $option);
                        $option = str_replace('href','value', $option);
                        $option = str_replace('current"','" id="current" selected', $option);

                        echo $option;
                    }
                    ?>
                </select>
                of
                <a href="/<?= $page_name ?>/page/<?php echo $pages; ?>/"><?php echo $pages; ?></a>
              </div>


              <?php
                $next = 1;
                foreach ( $links as $key => $el ) {
                  if(strpos($el, 'current')) {
                    $next = ($key == 0) ? $key + 2 : $key + 1;
                    break;
                  } else {
                    continue;
                  }
                }
                $next_url = get_permalink() . 'page/' . $next . '/';              
              ?>

              <?php if( $next < count($links) ) : ?>
                <div class="blog-pagination__arrow-link next-link">
                  <?= '<a href="' . $next_url . '"><svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg></a>' ?>
                </div>
              <?php else : ?>
                <div class="blog-pagination__arrow-link next-link no-posts">
                  <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>
                </div>
              <?php endif; ?>
            </div>
          </div>


        <?php else: ?>

          <p>No items found.</p>

        <?php endif; ?>


      </div>
    </div>
  </div>
</div>
