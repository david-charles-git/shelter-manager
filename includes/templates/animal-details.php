<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$shelter_manager_options = get_shelter_manager_options();
$shelter_manager_page_uri = $shelter_manager_options['animal_page_slug'];

if (isset($_GET['sm_animal_id'])) {
  $animal_id = $_GET['sm_animal_id'];
} else if (!isset($animal_id)) {
  $animal_id = 'all';
} else if (!$animal_id) {
  $animal_id = 'all';
}

if (isset($_GET['sm_type'])) {
  $type = $_GET['sm_type'];
} else if (!isset($type)) {
  $type = 'adoptable';
} else if (!$type) {
  $type = 'adoptable';
}

if (!isset($class)) {
  $class = '';
} else if (!$class) {
  $class = '';
}

if (!$animal_id) {
  echo 'No animal ID provided';
  return;
}

$animal = get_animal_json_by_id($animal_id, $type);

if ($animal['error']) {
  echo $animal['message'];
  return;
}

$animal = json_decode($animal['data'], true);

if (!$animal) {
  echo 'No animal data found';
  return;
}
$animal_name = $animal['ANIMALNAME'];
?>
<section class='shelter-manager-animal-details' data-id='<?php echo $animal_id; ?>'>
  <div class='inner shelter-manager-grid'>
    <div class="top shelter-manager-grid">
      <h2 class="title"><?php echo $animal_name; ?></h2>
      <p class="description"><?php echo $animal['ANIMALCOMMENTS']; ?></p>
      <button onclick="handleShelterManagerScrollToAdoptionForm(event)">Apply for <?php echo $animal_name; ?></button>

      <div class='images'>
        <?php
        $count = 1;
        $count_max = intval($animal['WEBSITEIMAGECOUNT']);
        ?>
        <div class="inner shelter-manager-grid" style='grid-template-columns: repeat(<?php echo  $count_max; ?>, auto);'>
          <?php
          while ($count <= $count_max) {
            $animal_image = get_animal_image_by_id($animal_id, $count)['data'];
          ?>
            <div class="image shelter-manager-grid" data-index='<?php echo $count; ?>' onclick="handleShelterManagerOpenImageModal(event)">
              <picture>
                <source srcset="<?php echo $animal_image; ?>" media="(min-width: 0px)">
                <img class="cover" src="<?php echo $animal_image; ?>" alt="<?php echo $animal_name; ?>" width="200" height="200">
              </picture>
            </div>
          <?php
            $count++;
          }
          ?>
        </div>
      </div>
    </div>

    <div class="bottom shelter-manager-grid">
      <div class="left shelter-manager-grid">
        <h3>More about <?php echo $animal_name; ?></h3>
        <?php
        if (intval($animal['FEE']) != 0) {
        ?>
          <p>Adoption fee: <?php echo '£' . number_format(intval($animal['FEE']) / 100, 2, '.', ','); ?></p>
        <?php
        }
        ?>
        </p>
        <p>Sex: <?php echo $animal['SEX'] == 0 ? 'Female' : 'Male'; ?></p>
        <p>Age group: <?php echo $animal['AGEGROUP']; ?></p>
        <p>Breed: <?php echo $animal['BREEDNAME1']; ?></p>
        <p>Age: <?php echo $animal['ANIMALAGE']; ?></p>
      </div>

      <div class="right shelter-manager-grid">
        <h3>What you should know</h3>
        <p>Can live with cats: <?php echo $animal['ISGOODWITHCATSNAME']; ?></p>
        <p>Good with dogs: <?php echo $animal['ISGOODWITHDOGSNAME']; ?></p>
        <p>Needs resident dog: <?php echo $animal['NEEDSRESIDENTDOG']; ?></p>
        <p>Can live with children: <?php echo $animal['ISGOODWITHCHILDRENNAME']; ?></p>
      </div>
    </div>

    <?php if ($shelter_manager_page_uri) { ?>
      <a class="view-all" href='<?php echo home_url() . '/' . $shelter_manager_page_uri . '/'; ?>'>View all animals</a>
    <?php } ?>

    <div class="shelter-manager-modal image-modal">
      <div class='shelter-manager-background' onclick='handleShelterManagerModalClose(event)'></div>

      <div class="inner">
        <div class='images'>
          <?php
          $count = 1;
          $count_max = intval($animal['WEBSITEIMAGECOUNT']);
          ?>
          <div class="inner shelter-manager-grid" style="grid-template-columns: repeat(1, 100%); grid-template-areas: 'stack'">
            <?php
            while ($count <= $count_max) {
              $animal_image = get_animal_image_by_id($animal_id, $count)['data'];
            ?>
              <div class="image shelter-manager-grid shelter-manager-hidden" style="grid-area: stack">
                <picture>
                  <source srcset="<?php echo $animal_image; ?>" media="(min-width: 0px)">
                  <img class="cover" src="<?php echo $animal_image; ?>" alt="<?php echo $animal_name; ?>" width="200" height="200">
                </picture>
              </div>
            <?php
              $count++;
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>