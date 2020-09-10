/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
  $(document).ready(function() {
    // console.log(ajax.url);

    $(document).on("click", ".product-per-page > .list > li", function() {
      var ppp = $(this).attr("data-value");

      $.get(
        ajax.url,
        {
          action: "product_pp",
          ppp: ppp
        },
        function(ppp) {
          console.log(ppp);
        }
      );
    });
  });
})(jQuery);
