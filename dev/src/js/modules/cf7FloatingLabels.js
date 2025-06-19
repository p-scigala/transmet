/* eslint-disable linebreak-style */
/* eslint-disable func-names */
/* eslint-disable max-len */
/**
 * When the input field is focused, add the class 'focused' to the parent element. When the input field
 * is blurred, if the input field is empty, remove the class 'focused' from the parent element,
 * otherwise add the class 'filled' to the input field.
 * @param $ - The jQuery object
 *
 * HTML structure
 *
 * <div class="box-anim">
 *  <label for="" class="lab-anim"></label>
 *  <input type="text">
 * </div>
 */

const cf7FloatingLabels = ($) => {
    $('input, select, textarea').focus(function () {
      $(this)
        .parents('.box-anim')
        .addClass('focused');
    });
  
    $('input, select, textarea').blur(function () {
      const inputValue = $(this).val();
      if (inputValue === '') {
        $(this).removeClass('filled');
        $(this)
          .parents('.box-anim')
          .removeClass('focused');
      } else {
        $(this).addClass('filled');
      }
    });
  };
  export default cf7FloatingLabels;