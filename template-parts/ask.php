<?php /* Template Name: Sekcja - Zapytaj o pomoc */ ?>

<section class="ask">

  <div class="wrapper">
    <div class="ask__wrapper">

      <?php if(get_field("ask_map", "option")): ?>
      <a class="ask__img" href="<?php echo get_field("ask_map", "option"); ?>" target="_blank"
        rel="noopener noreferrer">
        <?php if(get_field("ask_img", "option")): ?>
        <img src="<?php echo get_field("ask_img", "option"); ?>" alt="Zapytaj o pomoc" class="animate" />
        <?php endif; ?>
      </a>
      <?php else: ?>
      <div class="ask__img">
        <?php if(get_field("ask_img", "option")): ?>
        <img src="<?php echo get_field("ask_img", "option"); ?>" alt="Zapytaj o pomoc" class="animate" />
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <div class="ask__content">

        <?php if(get_field("ask_title_01", "option")): ?>
        <h2 class="ask__header animate">
          <?php echo get_field("ask_title_01", "option"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("ask_title_02", "option")): ?>
        <h3 class="ask__subheader animate">
          <?php echo get_field("ask_title_02", "option"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("ask_text", "option")): ?>
        <div class="ask__text animate">
          <?php echo get_field("ask_text", "option"); ?>
        </div>
        <?php endif; ?>

        <?php if(get_field("options_address", "option")): ?>
        <div class="link--icon animate">
          <img src="<?php echo get_template_directory(); ?>/imgs/icons/pin.svg" alt="Adres: ">
          <span><?php echo get_field("options_address", "option"); ?></span>
        </div>
        <?php endif; ?>

        <?php if(get_field("options_email_1", "option")): ?>
        <a class="link--icon animate" href="mailto:<?php echo get_field("options_email_1", "option"); ?>">
          <img src="<?php echo get_template_directory(); ?>/imgs/icons/mail.svg" alt="Email: ">
          <span><?php echo get_field("options_email_1", "option"); ?></span>
        </a>
        <?php endif; ?>

        <?php if(get_field("options_email_2", "option")): ?>
        <a class="link--icon animate" href="mailto:<?php echo get_field("options_email_2", "option"); ?>">
          <img src="<?php echo get_template_directory(); ?>/imgs/icons/mail.svg" alt="Email: ">
          <span><?php echo get_field("options_email_2", "option"); ?></span>
        </a>
        <?php endif; ?>

        <?php if(get_field("options_phone", "option")): ?>
        <a class="link--icon animate" href="tel:<?php echo get_field("options_phone", "option"); ?>">
          <img src="<?php echo get_template_directory(); ?>/imgs/icons/tel.svg" alt="Telefon: ">
          <span><?php echo get_field("options_phone", "option"); ?></span>
        </a>
        <?php endif; ?>

      </div>
    </div>
  </div>

</section>