<?php /* Template Name: Sekcja - Mapa */ ?>

<section class="map">
  <div class="wrapper">

    <?php if(get_field("map_heading")): ?>
    <h2 class="map__heading heading animate">
      <?php echo get_field("map_heading"); ?>
    </h2>
    <?php endif; ?>

    <?php if(get_field("map_subheading")): ?>
    <h3 class="map__subheading subheading animate delay-1">
      <?php echo get_field("map_subheading"); ?>
    </h3>
    <?php endif; ?>

    <?php if(get_field("map_text")): ?>
    <div class="map__description description animate delay-2">
      <?php echo get_field("map_text"); ?>
    </div>
    <?php endif; ?>

    <?php if(get_field("options_address", "option")): ?>
    <div class="map__address animate delay-3">
      <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/pin-blue.svg"
        class="map__icon" alt="Adres:" />
      <span><?php echo get_field("options_address", "option"); ?></span>
    </div>
    <?php endif; ?>

    <div class="map__content animate delay-4">
      <?php if(get_field("map_link")): ?>
      <a href="<?php echo get_field("map_link"); ?>" target="_blank"><?php endif; ?>
        <?php if(get_field("map_img")): ?>
        <img class="map__img" src="<?php echo get_field("map_img"); ?>" alt="Mapa" />
        <?php endif; ?>
        <?php if(get_field("map_link")): ?></a>
      <?php endif; ?>
    </div>

  </div>
</section>