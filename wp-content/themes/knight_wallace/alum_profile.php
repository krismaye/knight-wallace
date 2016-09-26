<?php
/**
 * Template Name: Alumni Profile
 *
 * @package knight_wallace
 */

get_header(); ?>

<?php
include_once('alum_functions.php');
$parent_id = get_post_ancestors($post->ID);
$parent = !empty($parent_id) ? get_post($parent_id[0]) : false;
//get current user
$user = wp_get_current_user();
if(!empty($user) && $user->roles[0] == 'administrator' || $user->roles[0] == 'alumni'){
    $fellows = get_posts(array('post_type'=>'person_kw_fellow','posts_per_page'=> -1));
    $alum = use_alum($user->data->user_login,$fellows);
}
?>

<?php if(!empty($parent)): ?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
    <a href="<?php echo !empty($parent->guid) ? $parent->guid : ''; ?>" class="breadcrumb-link">
        <?php echo !empty($parent->post_title) ? $parent->post_title : ''; ?>
    </a>
    </div>
</div>
</section>
<?php endif; ?>

  <main class="wallace-house-subpage <?php if(empty($parent)): ?>no-breadcrumb<?php endif; ?>">
    <?php if(!empty($user) && $user->roles[0] == 'administrator' || $user->roles[0] == 'alumni'): ?>
    <div class="row">
      <div class="large-12 columns">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'page' ); ?>
    <?php endwhile; // End of the loop. ?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <?php if(!empty($alum)): ?>
            <h2><?php echo $alum[0]->post_title; ?></h2>
            <h3>Current Information: </h3>
            <form id="alum_update_form" method="post">
               <div class="row">
                   <div class="medium-6 columns">
                        <label for="location">Location</label>
                    </div> 
                   <div class="medium-6 columns">
                        <input type="text" name="location" placeholder="Your current location" 
                        value="<?php echo !empty($alum[0]->extra_data['location']) ? 
                                        $alum[0]->extra_data['location'] : ''; ?>" />
                    </div> 
                </div> 
               <div class="row">
                   <div class="medium-6 columns">
                        <label for="special">Speciality</label>
                    </div> 
                   <div class="medium-6 columns">
                        <input type="text" name="special" placeholder="Your speciality" 
                         value="<?php echo !empty($alum[0]->extra_data['special']) ? 
                                        $alum[0]->extra_data['special'] : ''; ?>" />
                    </div> 
                </div> 
               <div class="row">
                   <div class="medium-6 columns">
                        <label for="phone">Phone</label>
                    </div> 
                   <div class="medium-6 columns">
                        <input type="text" name="phone" placeholder="Your phone number" 
                         value="<?php echo !empty($alum[0]->extra_data['phone']) ? 
                                        $alum[0]->extra_data['phone'] : ''; ?>" />
                    </div> 
                </div> 
               <div class="row">
                   <div class="medium-6 columns">
                        <label for="email">Email</label>
                   </div> 
                   <div class="medium-6 columns">
                        <input type="email" name="email" placeholder="Your email" 
                         value="<?php echo !empty($alum[0]->extra_data['email']) ? 
                                        $alum[0]->extra_data['email'] : ''; ?>" />
                    </div> 
                </div> 
               <div class="row">
                   <div class="medium-6 columns">
                        <label for="permission">Display Your Name?</label>
                        <p><em>If public, email and phone number will still only be shown privately.</em></p>
                    </div> 
                   <div class="medium-6 columns">
                        <select name="permission">
                            <option value="2" 
                                <?php echo !empty($alum[0]->extra_data['permission']) && 
                                $alum[0]->extra_data['permission'] == '2' ?
                                'selected' : ''; ?>>Publicly</option>
                            <option value="1"
                                <?php echo !empty($alum[0]->extra_data['permission']) && 
                                $alum[0]->extra_data['permission'] == '1' ?
                                'selected' : ''; ?>>Privately (logged in Alumni)</option>
                            <option value="0"
                                <?php echo !empty($alum[0]->extra_data['permission']) && 
                                $alum[0]->extra_data['permission'] == '0' ?
                                'selected' : ''; ?>>Do not show at all</option>
                        </select>
                    </div> 
                </div> 
               <div class="row">
                   <div class="medium-6 columns">
                        <input type="submit" name="submit" value="update" />
                    </div> 
                </div> 
            </form>
            <br />
            <br />
        <?php else: ?>
            <h2>Sorry, we were not able to find your data. If you are an alumni, please send us an email and we will try to sort this out. If you are an administrator, you should be seeing this message, you have no alumni data to edit. </h2>
        <?php endif; ?>
      </div>
    </div>
    <?php else: ?>
    <div class="row">
      <div class="large-12 columns">
            <h2>Sorry, you must be logged in to view this page</h2>
      </div>
    </div>
    <?php endif; ?>
  </main>
<?php get_footer(); ?>