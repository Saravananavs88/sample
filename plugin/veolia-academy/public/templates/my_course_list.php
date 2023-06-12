<?php

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


<main class="vro-lms-pg-main">
    <h1 class="vro-lms-page-entry-title"><?php echo the_title(); ?></h1>
    <div class="vro-lms-breadcrumbs">
        <a href="<?php echo site_url(); ?>">Home</a> <em class="fa fa-chevron-right"></em>
        <span class="breadcrumb_last" id="breadcrumb_last">My Courses</span>
    </div>
    <div class="vro-lms-content-area mt-3">

        <?php if (empty($learning_tracks)) : ?>
            <center>
                <br><br><br>
                <h3>No courses found</h3>
                <div><a href="<?php echo get_home_url() . "/course-list"; ?>" class="">Click Here</a> to purchase new courses </div>
            </center>
        <?php else : ?>

            <!-- Button trigger modal -->
            <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">START LEARNING</button>-->
            <center><a href="<?php echo $redirectUrl; ?>" target="_blank" class="btn btn-success model-ispring-btn">
                    <?php if ($started == 0) : ?>
                        START LEARNING
                    <?php else : ?>
                        CONTINUE LEARNING
                    <?php endif; ?> </a>
            </center>
            <?php /*
    <center><button type="button" class="btn btn-success model-ispring-btn" data-bs-toggle="modal" data-bs-target="#model-ispring"> 
                    <?php if($started==0): ?>
                            START LEARNING
                        <?php else: ?>
                            CONTINUE LEARNING
                        <?php endif; ?>      
                    </button></center>
     */ ?>
            <div class="modal fade" id="model-ispring" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="vro-lms-coruse-start-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="padding : 18px 0px 0px 20px;">
                            <h5 class="modal-title" id="vro-lms-coruse-start-label">
                                <?php if ($started == 0) : ?>
                                    START LEARNING
                                <?php else : ?>
                                    CONTINUE LEARNING
                                <?php endif; ?>
                            </h5>
                        </div>
                        <div class="modal-body">
                            You will be redirected to an external website to learn the courses. Please navigate to the Veolia application browser tab to come back to our website.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="<?php echo $redirectUrl; ?>" target="_blank" class="btn btn-success">Continue</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row vro-lms-courses-list" data-layout="" id="vro-lms-courses-view">
                <table id="learning_tracks" class="table table-striped" style="width:100%">
                    <thead>
                        <tr style="display:none;">
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($learning_tracks as $learning_track) : ?>
                            <tr>
                                <td>
                                    <div class="row vro-lms-course-item">
                                        <div class="col-md-1">
                                            <i class='fas fa-award' style='font-size:48px;color:red'></i>
                                        </div>
                                        <div class="col-md-8 vro-lms-course-content">
                                            <div class="vro-lms-course-title d-flex justify-content-between align-items-center">
                                                <div>
                                                    <a class="second-jl-0" href="<?php echo $redirectUrl; ?>" target="_blank"><?php echo $learning_track['title']; ?></a>
                                                </div>

                                            </div>
                                            <div class="row vro-lms-course-wrapcontent">

                                                <div class="col-md-12 vro-lms-item-lesson">
                                                    <em class="fa fa-video-camera"></em> <b><?php echo $learning_track['course_count']; ?></b> Courses
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-2 align-items-center">
                                            <div class="">
                                                <center style="margin-bottom:10px;"><span style="font-size:16px;padding-bottom:10px;" class="vro-lms-course-price2"><?php echo ($learning_track['course_status'] == 'Complete') ? "Completed" : $learning_track['course_status']; ?></span></center>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: <?php echo $learning_track['course_progress']; ?>%" aria-valuenow="<?php echo $learning_track['course_progress']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <center><?php echo $learning_track['course_progress']; ?>%</center>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
    jQuery(document).ready(function($) {
        var table = jQuery('#learning_tracks').DataTable({
            fixedHeader: true
        });
    });
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js'></script>
<?php
function limit_desc($x, $length)
{
    if (strlen($x) <= $length) {
        return $x;
    } else {
        $y = substr($x, 0, $length) . '...';
        return $y;
    }
}
?>