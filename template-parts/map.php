<?php /* Template Name: Sekcja - Mapa */ ?>

<section class="map">
  <div class="wrapper">

    <?php if(get_field("map_heading")): ?>
    <h2 class="map__heading animate">
      <?php echo get_field("map_heading"); ?>
    </h2>
    <?php endif; ?>

    <?php if(get_field("map_subheading")): ?>
    <h3 class="map__subheading animate">
      <?php echo get_field("map_subheading"); ?>
    </h3>
    <?php endif; ?>

    <?php if(get_field("map_text")): ?>
    <div class="map__text animate">
      <?php echo get_field("map_text"); ?>
    </div>
    <?php endif; ?>

    <div class="map__content">
      <?php if(get_field("map_link")): ?><a href="<?php echo get_field("map_link"); ?>" target="_blank"><?php endif; ?>
        <img class="map__img animate" src="../wp-content/themes/candyweb-new/assets/imgs/map.png" alt="Mapa" />
        <?php if(get_field("map_link")): ?></a><?php endif; ?>
    </div>

  </div>
</section>