<?php
/**
 * Template Name: Winners
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>

<?php
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$this_page_meta = get_post_meta($post->ID);
$this_year = !empty($this_page_meta['year']) ? $this_page_meta['year'][0] : null;
$winners = get_posts(array('post_type'=>'person_livingston','posts_per_page'=> -1));
$sorted_winners = sort_winners($winners, $this_year);
?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/livingston-awards/" class="library-link">Livingston Awards</a>
    </div>
</div>
</section>
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title">Winners</h1>
    </div>
</div>
<?php $children = get_pages('child_of='.$post->ID.'&parent='.$post->ID); ?>
<?php if(!empty($children)): ?>
<div class="in-this-section-nav">
    <div class="row">
        <div class="large-12 columns">
            <ul class="inline">
            <?php $c = 0; ?>
            <?php $count = count($children); ?>
            <?php foreach($children as $child): ?>
                <li><a href="<?php echo $child->guid; ?>"><?php echo $child->post_title; ?></a>
                <?php if($c < $count - 1): ?>
                    &nbsp;|&nbsp;
                <?php endif; ?>
                </li>
            <?php $c += 1; ?>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>
<main class="posts winners-list">
<?php if(!empty($sorted_winners)): ?>
<?php foreach($sorted_winners as $win): ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="la-winner">
            <div class="type"><?php echo $win['type']; ?></div>
            <div class="name"><?php echo $win['first_name'].' '.$win['last_name'].', '.$win['age']; ?>
                <?php if(isset($win['co-winner_name_line'])): ?>
                    <?php echo 'and '.$win['co-winner_name_line']; ?>
                <?php endif; ?> 
            </div>
            <div class="lib-item"><a href="<?php echo $win['library_link']; ?>">&ldquo;<?php echo $win['lib']; ?>&rdquo;</a></div>
            <div class="aff"><?php echo $win['aff']?></div>
            <div class="image"><?php echo $win['library_image']; ?></div>
            <div class="descrip"><?php echo $win['lib_item_des']; ?></div>
            <div class="row winner-quote">
                <div class="large-2 columns">
                    <div class="a-image"><?php echo $win['image']; ?></div>
                    <div class="small-name"><?php echo $win['first_name'].' '.$win['last_name'].', '.$win['age']; ?></div>
                <?php if(isset($win['co-winner_image'])): ?>
                    <div class="a-image"><?php echo $win['co-winner_image']; ?></div>
                <?php endif; ?> 
                <?php if(isset($win['co-winner_name_line'])): ?>
                    <div class="small-name"><?php echo $win['co-winner_name_line']; ?></div>
                <?php endif; ?> 
                </div>
                <div class="large-10 columns quote"><?php echo $win['winner_quote']; ?></div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</main>

<?php
//display alerts
if(!empty($alerts)):
?>
<section id="alerts">
<?php foreach($alerts as $alert): ?>
<div class="row alert">
  <div class="large-4 columns">
    <p>
    <strong><?php echo $alert->post_title; ?></strong>
      <br /><?php echo $alert->post_excerpt; ?></p>
  </div>
  <div class="large-8 columns">
  <p><?php echo $alert->post_content; ?></p>
  </div>
</div>
<?php endforeach; ?>
</section>
<?php endif; ?>


<?php get_footer('livingston'); ?>
