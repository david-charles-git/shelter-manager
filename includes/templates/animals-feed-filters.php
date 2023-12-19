<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$animal_feed_filters = [
  [
    'value' => 'all',
    'type' => 'all',
    'text' => 'All'
  ],
  [
    'value' => 'under-1-year',
    'type' => 'ANIMALAGE',
    'text' => 'Under 1 year'
  ],
  [
    'value' => '1-3-years',
    'type' => 'ANIMALAGE',
    'text' => '1-3 years'
  ],
  [
    'value' => 'over-3-years',
    'type' => 'ANIMALAGE',
    'text' => 'Over 3 years'
  ],
  [
    'value' => '1',
    'type' => 'SEX',
    'text' => 'Male'
  ],
  [
    'value' => '0',
    'type' => 'SEX',
    'text' => 'Female'
  ],
  [
    'value' => 'yes',
    'type' => 'ISGOODWITHCATSNAME',
    'text' => 'Can live with cats'
  ],
  [
    'value' => 'yes',
    'type' => 'ISGOODWITHDOGSNAME',
    'text' => 'Can live with dogs'
  ],
  [
    'value' => 'yes',
    'type' => 'ISGOODWITHCHILDRENNAME',
    'text' => 'Can live with children'
  ],
  [
    'value' => 'yes',
    'type' => 'NEEDSRESIDENTDOG',
    'text' => 'Needs resident dog'
  ],
  [
    'value' => 'yes',
    'type' => 'SHELTERLOCATION',
    'text' => 'In the UK'
  ],
  [
    'value' => '1',
    'type' => 'DATEBROUGHTIN',
    'text' => 'Long termers'
  ]
];
?>
<div class="filters">
  <ul>
    <?php
    foreach ($animal_feed_filters as $filter) {
    ?>
      <li class="filter <?php echo $filter['value'] == 'all' ? 'active' : ''; ?>" data-value="<?php echo $filter['value']; ?>" data-type="<?php echo $filter['type']; ?>" onclick="handleShelterManagerFilterFeed(event)">
        <?php echo $filter['text']; ?>
      </li>
    <?php
    }
    ?>
  </ul>
</div>