<?php
  $response = '';
  $course_keyword = '';
  $current_user = wp_get_current_user();
  $userid = $current_user->ID;

  $page = !empty( $_POST['page'] ) ? (int) $_POST['page'] : 1;
  if(isset($_POST['keyword']) && $_POST['keyword'] != '' || (!empty($_POST['page'])))
  {
    $results = $_SESSION['course_list_data']['learning_tracks'];
    $learning_tracks = array();
    if(isset($_POST['keyword']) && $_POST['keyword'] != '')
    {
      $counter=0;
      foreach ($results as $result) {
        if(str_contains(strtolower($result['title']), strtolower($_POST['keyword'])))
          $learning_tracks[$counter] = $result;
        $counter++;	
      }
      $course_keyword = $_POST['keyword'];
    }
    else
    {
      $learning_tracks = $results;
      $course_keyword = '';
    }
  }
  
  $total = count( $learning_tracks ); //total items in array    
  $limit = 6; //per page    
  $totalPages = ceil( $total/ $limit ); //calculate total pages
  $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
  $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
  $offset = ($page - 1) * $limit;
  if( $offset < 0 ) $offset = 0;
  $learning_tracks = array_slice( $learning_tracks, $offset, $limit );    
  
  if (empty($learning_tracks))
    $response .= '<div class="text-center p-3" style="background:#f0f3f5;">No courses found.</div>';  
  else
  {
    $response .= '<div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">';
    foreach ($learning_tracks as $learning_track)
    {
      $description = !is_array($learning_track["description"]) ? limit_desc($learning_track["description"], 150) : '&nbsp;'; 
      $response .='<div class="course col">
          <div class="card">
              <div class="card-img-wrap">
          <img src="'. $learning_track['learning_track_mapping']['image_url'].'" class="card-img-top img-fluid" alt="'.$learning_track['title'].'"></div>
          <div class="card-body">
              <div class="card-content-wrap">

            
              <h5 class="card-title"><a onclick="preCourseLoader()" href="'. site_url('course-detail').'?id='. $learning_track['contentItemId'].'">'. $learning_track['title'].'</a></h5>
              <p class="card-text">'.$description.'</p> </div>
              <ul class="list-group list-group-flush">
                  <li class="list-group-item"><i class="fas fa-file-video pe-2"></i> '. $learning_track['course_count'].' Courses</li>
              </ul>
          </div>
          <div class="card-footer">
              <div class="d-flex justify-content-between align-items-center">';

              //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) {    
                $response .='<div class="p-2 flex-fill course-price"><s><small>$'. $learning_track['learning_track_mapping']['price'].'</small></s>&nbsp;$0</div>';
              //}
              //else {
                //$response .='<div class="p-2 flex-fill course-price">$'. $learning_track['learning_track_mapping']['price'].'</div>';
              //}        
              $response .= '<div class="p-2 flex-fill"><a onclick="preCourseLoader()" href="'. site_url('course-detail').'?id='. $learning_track['contentItemId'].'" class="btn btn-sm btn-primary float-end">Details</a></div>
              </div>
          </div>
      </div>
      </div>';
    }
     $response .= '</div>';
     
      $link = '#%d';
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
  }

 
    echo $response.'<br>'.$pagerContainer;

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