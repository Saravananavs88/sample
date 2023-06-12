<?php
/*

Template Name: Training Options

*/
get_header(); ?>
<section class="explore">
  <div class="container">

  <?php 
          if ( class_exists( 'Veolia_Academy_Public' ) )
          {
              $veolia_public = new Veolia_Academy_Public('veolia-academy','1.0.0');
              $response = $veolia_public->course_list();
         
         extract($response);     
         $current_user = wp_get_current_user();
        $userid = $current_user->ID;
  ?>
  <div style="display:none;" id="filter_load" class="course_loading">Loading&#8230;</div>    
  <div class="row gx-md-5">
      <div class="course-options col-md-3 p-4">
          <h4>Find Your Course <i class="wp-block-social-link fas fa-arrow-circle-right ps-2"></i></h4>
          <p><?php if ( is_active_sidebar( 'course-list-content' ) ) 
                dynamic_sidebar( 'course-list-content' ); ?></p>
          <hr />
          <!-- FUTURE ENHANCEMENT FOR WHEN THERE ENOUGH COURSES TO JUSTIFY SEARCH AND FILTERS -->
          
          <p class="mb-3">Search</p>
          <div class="input-group mb-4">
              <input type="text" class="form-control" id="course_search" value="<?php echo $course_keyword; ?>" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon">
              <button class="btn btn-outline-secondary" type="button" id="search_button"><i class="fas fa-search"></i></button>
          </div>

      </div>
      <div class="col-md-9">


      <?php if (empty($learning_tracks)) : ?>
          <div class="text-center p-3" style="background:#f0f3f5;">No courses found.</div>
      <?php else: ?>

        <?php 
            $total = count( $learning_tracks ); //total items in array    
            $limit = 6; //per page    
            $totalPages = ceil( $total/ $limit ); //calculate total pages
            $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
            $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
            $offset = ($page - 1) * $limit;
            if( $offset < 0 ) $offset = 0;
            $learning_tracks = array_slice( $learning_tracks, $offset, $limit );    
        ?>
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">
          <?php foreach ($learning_tracks as $learning_track): ?>
            <?php $description = !is_array($learning_track["description"]) ? $veolia_public->limit_desc($learning_track["description"], 150) : '&nbsp;'; ?>
            <div class="course col">
                <div class="card">
                    <div class="card-img-wrap">
                 <img src="<?php echo $learning_track['learning_track_mapping']['image_url']; ?>" class="card-img-top img-fluid" alt="<?php echo $learning_track['title']; ?>"></div>
                <div class="card-body">
                    <div class="card-content-wrap">

                   
                    <h5 class="card-title"><a href="<?php echo site_url('course-detail').'?id='. $learning_track['contentItemId']; ?>"><?php echo $learning_track['title']; ?></a></h5>
                    <p class="card-text"><?php echo $description; ?></p> </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-file-video pe-2"></i> <?php echo $learning_track['course_count']; ?> Courses</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                    <?php //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0): ?>    
                        <div class="p-2 flex-fill course-price"><s><small>$<?php echo $learning_track['learning_track_mapping']['price']; ?></small></s>&nbsp;$0</div>
                    <?php //else: ?>
                        <?php /*<div class="p-2 flex-fill course-price">$<?php echo $learning_track['learning_track_mapping']['price']; ?></div>*/ ?>
                    <?php //endif; ?>        
                    <div class="p-2 flex-fill"><a href="<?php echo site_url('course-detail').'?id='. $learning_track['contentItemId']; ?>" class="btn btn-sm btn-primary float-end">Details</a></div>
                    </div>
                </div>
            </div>
            </div>
          <?php endforeach; ?>
        </div>
        <br>
        <?php
            $link = site_url('course-list'). '?id=%d';
            $pagerContainer = '<div class="d-flex align-items-center justify-content-center"><ul class="pagination">';   
            if( $totalPages != 0 ) 
            {
                $pagerContainer .= sprintf( '<li class="page-item"><a class="page-link" href="' . $link . '">Previous</a></li>', $page - 1 ); 
                for($i=1;$i<=$totalPages;$i++)
                {
                   if($i==$page) 
                        $pagerContainer .= sprintf( '<li class="page-item"><a class="page-link active" href="'.$link.'">' . $i . '</a></li>',$i); 
                    else
                        $pagerContainer .= sprintf( '<li class="page-item"><a class="page-link" href="'.$link.'">' . $i . '</a></li>',$i); 
                }
                $pagerContainer .= sprintf( '<li class="page-item"><a class="page-link" href="' . $link . '">Next</a></li>', $page + 1 );        
            }                   
            $pagerContainer .= '</ul></div>';
            echo $pagerContainer;
        ?>
                
      <?php endif; ?>    
      </div>
  </div>


  <script>
      jQuery(document).ready(function($) {
        $('.page-item').click(function () {
            $('#filter_load').show();
        });
           $('#search_button').click(function () {
              //table.search($('#course_search').val()).draw();
              $('#filter_load').show();
              //document.cookie = "course_search="+$('#course_search').val();
              window.location.href = '<?php echo get_home_url() . '/course-list'; ?>?id=<?php echo $page; ?>&keyword='+$('#course_search').val();
          });
      });
  </script>
  <?php
   
}
?>
  </div>



</section>
<?php get_footer(); ?>