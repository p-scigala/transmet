<?php /* Template Name: Sekcja - Tekst z nagłówkiem */ ?>

<?php if( $args['id']) $id = $args['id']; ?>

<section class="text-only text-only--<?php echo esc_attr(get_field("text-only_columns", $id)); ?>">

  <div class="text-only__wrapper">
    <div class="wrapper">
      <div class="text-only__content">

        <?php if(get_field("text-only_title_01", $id)): ?>
        <h2 class="text-only__heading heading animate">
          <?php echo get_field("text-only_title_01", $id); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("text-only_title_02", $id)): ?>
        <h3 class="text-only__subheading subheading animate delay-1">
          <?php echo get_field("text-only_title_02", $id); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("text-only_description", $id)): ?>
        <div class="text-only__description animate delay-2">
          <?php echo get_field("text-only_description", $id); ?>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

</section>