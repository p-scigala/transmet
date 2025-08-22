<footer id="footer" class="footer">
  <div class="wrapper">

    <div class="footer__top">

      <div class="footer__col footer__col--1">

        <div class="footer__logo">
          <a href="<?php echo home_url(); ?>" class="footer__logo-link">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/transmet-logo-white.svg" alt="Logo" />
          </a>
        </div>

        <?php if(get_field("options_footer_desc", "option")): ?>
        <p class="footer__desc">
          <?php echo get_field("options_footer_desc", "option"); ?>
        </p>
        <?php endif; ?>

        <h4 class="footer__menu-label">Dostawa i płatność</h4>

        <div class="footer__shipping">
          <?php while(have_rows("options_footer_shipping", "option")): the_row(); ?>
          <?php if(get_sub_field("options_footer_shipping_item")): ?>
          <img src="<?php echo get_sub_field("options_footer_shipping_item"); ?>" alt="" />
          <?php endif; ?>
          <?php endwhile; ?>
        </div>

      </div>

      <div class="footer__col footer__col--2">
        <h4 class="footer__menu-label">Menu</h4>
        <?php
        wp_nav_menu(array(
          "theme_location" => "footer-1",
          "menu_class" => "footer__menu footer__menu--1",
          "container" => "ul"
        ));
        ?>
      </div>

      <div class="footer__col footer__col--3">
        <?php
        wp_nav_menu(array(
          "theme_location" => "footer-2",
          "menu_class" => "footer__menu footer__menu--2",
          "container" => "ul"
        ));
        ?>
      </div>

      <div class="footer__col footer__col--4">
        <h4 class="footer__menu-label">Kontakt</h4>
        <ul class="footer__menu">
          <?php if(get_field("options_address", "option")): ?>
          <li class="menu-item">
            <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/pin.svg"
              class="footer__icon" alt="Adres:" />
            <span><?php echo get_field("options_address", "option"); ?></span>
          </li>
          <?php endif; ?>

          <?php if(get_field("options_email_1", "option")): ?>
          <li class="menu-item">
            <a href="mailto: <?php echo get_field("options_email_1", "option"); ?>">
              <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/mail.svg"
                class="footer__icon" alt="E-mail:" />
              <span><?php echo get_field("options_email_1", "option"); ?></span>
            </a>
          </li>
          <?php endif; ?>

          <?php if(get_field("options_email_2", "option")): ?>
          <li class="menu-item">
            <a href="mailto: <?php echo get_field("options_email_2", "option"); ?>">
              <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/mail.svg"
                class="footer__icon" alt="E-mail:" />
              <span><?php echo get_field("options_email_2", "option"); ?></span>
            </a>
          </li>
          <?php endif; ?>

          <?php if(get_field("options_phone", "option")): ?>
          <li class="menu-item">
            <a href="tel: <?php echo get_field("options_phone", "option"); ?>">
              <img src="<?php echo home_url(); ?>/wp-content/themes/candyweb-new/assets/imgs/icons/phone.svg"
                class="footer__icon" alt="Telefon:" />
              <span><?php echo get_field("options_phone", "option"); ?></span>
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </div>

      <div class="footer__col footer__col--5">
        <h4 class="footer__menu-label">Social media</h4>
        <?php
        get_template_part("template-parts/components/socials", null, array(
          "class" => "footer__socials",
          "hide_labels" => true
        ));
        ?>
      </div>

    </div>

    <div class="footer__bottom">
      <a href="/regulamin">Regulamin</a>
      <a href="/polityka-prywatnosci">Polityka prywatności</a>
    </div>
  </div>

</footer>

<?php wp_footer(); ?>
</body>

</html>