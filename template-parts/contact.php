<?php /* Template Name: Sekcja - Kontakt */ ?>

<section class="contact">

  <div class="wrapper">
    <div class="contact__wrapper">

      <div class="contact__content">
        <div class="contact__content-inner">

          <?php if(get_field("contact_title_01")) { ?>
          <h2 class="contact__heading animate">
            <?php echo get_field("contact_title_01"); ?>
          </h2>
          <?php } ?>

          <?php if(get_field("contact_title_02")) { ?>
          <h3 class="contact__subheading animate delay-1">
            <?php echo get_field("contact_title_02"); ?>
          </h3>
          <?php } ?>

          <?php if(get_field("contact_text")) { ?>
          <div class="contact__text animate delay-2">
            <?php echo get_field("contact_text"); ?>
          </div>
          <?php } ?>

          <ul class="contact__items animate delay-3">
            <?php if(get_field("options_address", "option")): ?>
            <li class="contact__item">
              <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/pin-blue.svg"
                class="contact__icon" alt="Adres:" />
              <span><?php echo get_field("options_address", "option"); ?></span>
            </li>
            <?php endif; ?>

            <?php if(get_field("options_email_1", "option")): ?>
            <li class="contact__item">
              <a href="mailto: <?php echo get_field("options_email_1", "option"); ?>">
                <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/mail-blue.svg"
                  class="contact__icon" alt="E-mail:" />
                <span><?php echo get_field("options_email_1", "option"); ?></span>
              </a>
            </li>
            <?php endif; ?>

            <?php if(get_field("options_email_2", "option")): ?>
            <li class="contact__item">
              <a href="mailto: <?php echo get_field("options_email_2", "option"); ?>">
                <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/mail-blue.svg"
                  class="contact__icon" alt="E-mail:" />
                <span><?php echo get_field("options_email_2", "option"); ?></span>
              </a>
            </li>
            <?php endif; ?>

            <!-- <?php if(get_field("options_phone", "option")): ?>
            <li class="contact__item">
              <a href="tel: <?php echo get_field("options_phone", "option"); ?>">
                <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/phone-blue.svg"
                  class="contact__icon" alt="Telefon:" />
                <span><?php echo get_field("options_phone", "option"); ?></span>
              </a>
            </li>
            <?php endif; ?> -->
          </ul>

        </div>
      </div>

      <?php if(get_field("contact_type") === "form"): ?>
      <div class="contact__form animate delay-4">
        <?php echo do_shortcode('[contact-form-7 id="0a1df65" title="Formularz - kontakt"]'); ?>
      </div>
      <?php endif; ?>


      <?php if(get_field("contact_type") === "map" && get_field("contact_map")): ?>
      <div class="contact__map animate delay-4">
        <img src="<?php echo get_field("contact_map"); ?>" alt="Mapa" />
      </div>
      <?php endif; ?>

    </div>
  </div>

</section>