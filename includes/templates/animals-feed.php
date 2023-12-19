<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

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

if (!isset($limit)) {
  $limit = 12;
} else if (!$limit) {
  $limit = 12;
}
$limit = intval($limit);

if (!isset($title)) {
  $title = '';
} else if (!$title) {
  $title = '';
}

if (!isset($class)) {
  $class = '';
} else if (!$class) {
  $class = '';
}

$class_name = 'shelter-manager-animal-feed ' . $type . ' ' . $class;
$animals = get_animals_json_by_type($type, -1, ['all', 'all']);

if ($animals['error']) {
  echo $animals['message'];
  return;
}

$animals = json_decode($animals['data']);

if (!$animals) {
  echo 'No animal data found';
  return;
}

usort($animals, function ($a, $b) {
  return strcmp($a->ANIMALNAME, $b->ANIMALNAME);
});
?>
<section class="<?php echo $class_name; ?>">
  <div class="inner">
    <?php
    if ($title) {
    ?>
      <div class="header">
        <p><?php echo $title; ?></p>
      </div>
    <?php
    }
    ?>
    <div class="body shelter-manager-grid">
      <?php
      include_once(SHELTER_MANAGER_PLUGIN . 'includes/templates/animals-feed-filters.php');
      ?>
      <ul class="feed shelter-manager-grid" data-limit="<?php echo $limit; ?>" data-count="<?php echo count($animals) > $limit ? $limit : count($animals); ?>">
        <?php
        if (count($animals) == 0) {
        ?>
          <p>No animals found</p>
        <?php
        } else {
          $for_count = 0;
          foreach ($animals as $animal) {
            $animal_id = $animal->ID;
            $animal_sex = $animal->SEX == 0 ? 'Female' : 'Male';
            $animal_image = get_animal_image_by_id($animal_id, 1)['data'];
            $animal_location_id = intval($animal->SHELTERLOCATION);
            $animal_in_uk = $animal_location_id == 19 || $animal_location_id == 20 ? 'Yes' : 'No';
            $item_class = $for_count >= $limit ? 'shelter-manager-hidden' : '';

            include(SHELTER_MANAGER_PLUGIN . 'includes/templates/animals-feed-item.php');

            $for_count++;
          }
        }
        ?>
      </ul>
      <div class="load-more shelter-manager-grid <?php echo count($animals) <= $limit ? 'shelter-manager-hidden' : ''; ?>">
        <button class="button" onclick="handleShelterManagerFeedLoadMore(event)">Load more</button>
      </div>
    </div>
</section>