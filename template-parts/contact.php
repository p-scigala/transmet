<?php /* Template Name: Sekcja - Kontakt */ ?>

<section class="contact">

  <div class="wrapper">
    <div class="contact__wrapper">

      <div class="contact__content">
        <div class="contact__content-inner">

          <?php if(get_field("contact_title_01")) { ?>
          <h2 class="contact__header scroll-anim">
            <?php echo get_field("contact_title_01"); ?>
          </h2>
          <?php } ?>

          <?php if(get_field("contact_title_02")) { ?>
          <h3 class="contact__subheader scroll-anim">
            <?php echo get_field("contact_title_02"); ?>
          </h3>
          <?php } ?>

          <?php if(get_field("contact_text")) { ?>
          <div class="contact__text scroll-anim">
            <?php echo get_field("contact_text"); ?>
          </div>
          <?php } ?>

          <ul class="contact__items">
            <?php if(get_field("options_address", "option")): ?>
            <li class="contact__item scroll-anim">
              <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icon-pin.svg"
                class="contact__icon" alt="Address:" />
              <span><?php echo get_field("options_address", "option"); ?></span>
            </li>
            <?php endif; ?>

            <?php if(get_field("options_email", "option")): ?>
            <li class="contact__item scroll-anim">
              <a href="mailto: <?php echo get_field("options_email", "option"); ?>">
                <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icon-mail.svg"
                  class="contact__icon" alt="E-mail:" />
                <span><?php echo get_field("options_email", "option"); ?></span>
              </a>
            </li>
            <?php endif; ?>

            <?php if(get_field("options_phone", "option")): ?>
            <li class="contact__item scroll-anim">
              <a href="tel: <?php echo get_field("options_phone", "option"); ?>">
                <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icon-phone.svg"
                  class="contact__icon" alt="Phone:" />
                <span><?php echo get_field("options_phone", "option"); ?></span>
              </a>
            </li>
            <?php endif; ?>
          </ul>

        </div>
      </div>

      <div class="contact__form scroll-anim">
        <?php echo do_shortcode('[contact-form-7 id="0a1df65" title="Formularz - kontakt"]'); ?>
      </div>

    </div>
  </div>

</section>