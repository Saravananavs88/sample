<?php
$current_user = wp_get_current_user();
$userid = $current_user->ID;
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/public/partials
 */

?>

<style>
/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

.filter-wrapper {height:200px;overflow-y:scroll;}
</style>
<div style="display:none;" id="filter_load" class="loading">Loading&#8230;</div>    
<div class="row gx-md-5">
    <div class="course-options col-md-3 p-4">
        <h4>Find Your Course <i class="wp-block-social-link fas fa-arrow-circle-right ps-2"></i></h4>
        <p><?php echo do_shortcode("[hfe_template id='89']"); ?></p>
        <hr />
        <!-- FUTURE ENHANCEMENT FOR WHEN THERE ENOUGH COURSES TO JUSTIFY SEARCH AND FILTERS -->
        
        <p class="mb-3">Search</p>
        <div class="input-group mb-4">
            <input type="text" class="form-control" id="course_search" value="<?php echo $course_keyword; ?>" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon">
            <button class="btn btn-outline-secondary" type="button" id="search_button"><i class="fas fa-search"></i></button>
        </div>

        
        <p class="mb-3">Filter</p>
        <div class="filter-wrapper">
        <?php foreach ($learning_tracks_filter as $learning_filter): ?>

         <?php
            $checked = 'checked'; 
            if(!empty($filter_courses))
            {
                if(!in_array($learning_filter['contentItemId'],$filter_courses))
                    $checked = '';
            }   
        ?>        
        
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="<?php echo $learning_filter['contentItemId']; ?>" <?php echo $checked; ?>>
            <label class="form-check-label" for="flexCheckChecked"> <?php echo $learning_filter['title']; ?> </label>
        </div>
       <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-9">
    <?php if (empty($learning_tracks)) : ?>
        <div class="text-center p-3" style="background:#f0f3f5;">No course's found.</div>
    <?php else: ?>     
        <table id="learning_tracks" class="table table-striped .widget_search" style="width:100%">
                <thead>
                    <tr style="display:none;">
                        <th>&nbsp;</th>
                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                
                  $data=array();
                  $counter=1;
                  $content=''; 
                  foreach ($learning_tracks as $learning_track)
                  { 
                        if($content=='')
                            $content='<div class="row">';
                        $description = !is_array($learning_track["description"]) ? limit_desc($learning_track["description"], 150) : '&nbsp;';    
                        $content .= '
                          <div class="col-md-4">
                          <div class="course col">
                          <div class="card">
                              <div class="ribbon '.strtolower($learning_track['learning_track_mapping']['levels']).'">'.$learning_track['learning_track_mapping']['levels'].'</div>
                              <a class="first-jl-0" href="'.site_url('course-detail').'?id='. $learning_track['contentItemId'].'">
                                  <img src="'.$learning_track['learning_track_mapping']['image_url'].'" class="card-img-top" width="100%" alt="...">
                              </a>
                              <div class="card-body">
                                  <div class="card-content-wrap">
      
                                      <h5 class="card-title"> <a class="second-jl-0" href="'.site_url('course-detail') . "?id=" . $learning_track['contentItemId'].'">'.$learning_track['title'].'</a></h5>
                                      <p class="card-text">'.$description.'</p>
                                  </div>
                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item"><i class="wp-block-social-link fas fa-camera pe-2"></i> Courses</li>
                                  </ul>
                              </div>
                              <div class="card-footer">
                                  <div class="d-flex justify-content-between align-items-center">';
                                       if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) {
                                           $content .='<div class="p-2 flex-fill course-price">$0'.$learning_track['learning_track_mapping']['price'].'</div>'; 
                                       }
                                       else {
                                            $content .='<div class="p-2 flex-fill course-price">$'.$learning_track['learning_track_mapping']['price'].'</div>';
                                       }
                                      $content .='<div class="p-2 flex-fill wp-block-button"><a href="'.site_url('course-detail') . '?id=' . $learning_track['contentItemId'].'" class="wp-block-button__link  float-end">Details</a></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>';
                      $counter++;
                      if($counter==4)
                      {
                        $content.="</div>";
                        $data[] = $content;
                        $content= '';
                        $counter=1;
                      }              
                    }
                    if($content!='')
                    {
                        $content.="</div>";
                        $data[] = $content;
                    }
                   // echo "<pre>"; print_r($data); exit;
                    ?>      

            <?php foreach ($data as $item): ?> 
            
                <tr><td><?php echo $item; ?></td></tr>
                
            <?php endforeach; ?>
            </tbody>
            </table>
    <?php endif; ?>    
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        var table = jQuery('#learning_tracks').DataTable({
            fixedHeader: true,
            searching: false,
            ordering: false,
            info: false,
            pageLength: 2,
            bLengthChange : false,
        });

       
        $('#search_button').click(function () {
            //table.search($('#course_search').val()).draw();
            $('#filter_load').show();
            $('#loftloader-wrapper').show();
            document.cookie = "course_search="+$('#course_search').val();
            window.location.href = '<?php echo get_home_url() . '/course-list'; ?>?filter=1';
        });

        $("input:checkbox").change(function() {
            var filterObj={};
            filterObj.selectedCourses=[];
            $('#filter_load').show();
            $("input:checkbox").each(function(){
                var $this = $(this);

                if($this.is(":checked")){
                    filterObj.selectedCourses.push($this.attr("id"));
                }
            });
            document.cookie = "course_filter="+filterObj.selectedCourses;
            window.location.href = '<?php echo get_home_url() . '/course-list'; ?>?filter=1';
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js'></script>
<?php
/*function limit_desc($text, $limit)
{
    if (str_word_count($text, 0) > $text) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}*/
function limit_desc($string, $limit)
{
    $string = strip_tags($string);
    if (strlen($string) > $limit) {

        // truncate string
        $stringCut = substr($string, 0, $limit);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }
    return $string;
}
?>