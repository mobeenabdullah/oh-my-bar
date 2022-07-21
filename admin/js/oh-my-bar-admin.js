(function ($) {
  "use strict";

  $(document).ready(function () {
    /*
     * All variables
     */
    const colorBg = document.querySelector(".color_background input");
    const colorFg = document.querySelector(".color_foreground input");
    const colorBgBox = document.querySelector(".color_background .color-box");
    const colorFgBox = document.querySelector(".color_foreground .color-box");

    /*
     * Range Slider
     */
    var selector = "[data-rangeslider]";
    var $element = $(selector);

    function valueOutput(element) {
      var value = element.value;
      var output =
        element.parentNode.getElementsByClassName("output-value")[0] ||
        element.parentNode.parentNode.getElementsByClassName("output-value")[0];
      output.value = value;
    }

    $(document).on("input", 'input[type="range"], ' + selector, function (e) {
      valueOutput(e.target);
    });

    $(document).on("input", "input[data-rangeslider]", function (e) {
      $(selector, e.target.parentNode).rangeslider({
        polyfill: false,
      });
    });

    $element.rangeslider({
      polyfill: false,
      onInit: function () {
        valueOutput(this.$element[0]);
      },
    });

    /*
     * Color pickr for background
     */
    const bgPickr = Pickr.create({
      el: ".color-picker-bg",
      theme: "nano", // or 'monolith', or 'nano'
      defaultRepresentation: "HEX",
      components: {
        preview: true,
        hue: true,
        interaction: {
          input: true,
          save: true,
        },
      },
    }).on("save", (instance) => {
      colorBg.value = bgPickr.getColor().toHEXA().toString();
      colorBgBox.style.backgroundColor = bgPickr.getColor().toHEXA().toString();
      bgPickr.hide();
    });

    /*
     * Color pickr for foreground
     */
    const fgPickr = Pickr.create({
      el: ".color-picker-fg",
      theme: "nano",
      defaultRepresentation: "HEX",
      components: {
        preview: true,
        hue: true,
        interaction: {
          input: true,
          save: true,
        },
      },
    }).on("save", (instance) => {
      colorFg.value = fgPickr.getColor().toHEXA().toString();
      colorFgBox.style.backgroundColor = fgPickr.getColor().toHEXA().toString();
      fgPickr.hide();
    });
  });
})(jQuery);
