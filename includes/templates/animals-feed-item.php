<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}
$shelter_manager_options = get_shelter_manager_options();
$shelter_manager_page_uri = $shelter_manager_options['animal_page_slug'];
?>
<li class="item shelter-manager-grid <?php echo $item_class; ?>" data-id="<?php echo $animal_id; ?>" data-age="<?php echo $animal->ANIMALAGE; ?>" data-sex="<?php echo $animal_sex; ?>" data-livewithcats="<?php echo $animal->ISGOODWITHCATSNAME; ?>" data-livewithdogs="<?php echo $animal->ISGOODWITHDOGSNAME; ?>" data-livewithchildren="<?php echo $animal->ISGOODWITHCHILDRENNAME; ?>" data-needsresidentdog="<?php echo $animal->NEEDSRESIDENTDOG; ?>" data-inuk="<?php echo $animal_in_uk; ?>" data-datebroughtin="<?php echo $animal->DATEBROUGHTIN; ?>">
  <?php
  if ($animal_location_id == 19 || $animal_location_id == 20) {
  ?>
    <div class="ribbon">
      <p>In the UK</p>
    </div>
  <?php
  }
  ?>
  <div class="image">
    <picture>
      <source srcset="<?php echo $animal_image; ?>" media="(min-width: 0px)">
      <img class="cover" src="<?php echo $animal_image; ?>" alt="<?php echo $animal->ANIMALNAME; ?>" width='300' height='300'>
    </picture>
  </div>
  <div class="content shelter-manager-grid">
    <h5 class="name"><?php echo $animal->ANIMALNAME; ?></h5>
    <?php if ($shelter_manager_page_uri) { ?>
      <button class='link'>
        <a href="<?php echo home_url() . '/' . $shelter_manager_page_uri . '/?animal_id=' . $animal_id; ?>">Find out more</a>
      </button>
    <?php } ?>
  </div>
</li>