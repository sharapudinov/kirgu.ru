/*
function rsTuningColorPickerSetInputValues(name) {
  var $colorPicker = $('#'+name),
      $colorPickerOption = $colorPicker.parents('.rstuning__option__color-picker'),
      hexColor = $colorPickerOption.find('.active').find('input').val() + '',
      rsColor = new RS.Color(hexColor);

  $colorPicker.ColorPickerSetColor(hexColor);

  $colorPickerOption.find('.field.r').find('input').val(rsColor.getRgb().R).change();
  $colorPickerOption.find('.field.g').find('input').val(rsColor.getRgb().G).change();
  $colorPickerOption.find('.field.b').find('input').val(rsColor.getRgb().B).change();
  $colorPickerOption.find('.field.hex').find('input').val(rsColor.getHex()).change();

  $colorPickerOption.find('.rstuning__option__alone-color.active input').val(hexColor);
  document.querySelector('.rstuning__option__alone-color.active input').value = hexColor;
  document.querySelector('.rstuning__option__alone-color.active input').dispatchEvent(new Event('change'));
  $colorPickerOption.find('.rstuning__option__alone-color.active .js-color-picker-paint').css('backgroundColor', '#' + hexColor);
}
*/

function rsTuningSpectrumSetInputValues(name) {
  var $spectrum = $('#' + name),
      $spectrumOption = $spectrum.parents('.rstuning__option__color-picker'),
      hexColor = $spectrumOption.find('.active').find('input').val() + '',
      rsColor = new RS.Color(hexColor);

  $spectrum.spectrum('set', rsColor._hex);

  $spectrumOption.find('.field.r').find('input').val(rsColor.getRgb().R).change();
  $spectrumOption.find('.field.g').find('input').val(rsColor.getRgb().G).change();
  $spectrumOption.find('.field.b').find('input').val(rsColor.getRgb().B).change();
  $spectrumOption.find('.field.hex').find('input').val(rsColor.getHex()).change();

  $spectrumOption.find('.rstuning__option__alone-color.active input').val(hexColor);
  document.querySelector('.rstuning__option__alone-color.active input').value = hexColor;
  document.querySelector('.rstuning__option__alone-color.active input').dispatchEvent(new Event('change'));
  $spectrumOption.find('.rstuning__option__alone-color.active .js-color-picker-paint').css('backgroundColor', '#' + hexColor);
}

/*
function rsTuningColorPickerInit(name) {

  var $colorPicker = $('#'+name),
      $colorPickerOption = $colorPicker.parents('.rstuning__option__color-picker'),
      hexColor = $colorPicker.data('dcolor') + '',
      rsColor = new RS.Color(hexColor);

  // init colorpicker
  $colorPicker.ColorPicker({
    flat: true,
    color: rsColor._hex,
    onChange: function (hsb, hex, rgb) {
      $colorPickerOption.find('.field.r').find('input').val(rgb.r).change();
      $colorPickerOption.find('.field.g').find('input').val(rgb.g).change();
      $colorPickerOption.find('.field.b').find('input').val(rgb.b).change();
      $colorPickerOption.find('.field.hex').find('input').val(hex).change()
      // $colorPickerOption.find('.rstuning__option__alone-color.active input').val(hex).change();
      $colorPickerOption.find('.rstuning__option__alone-color.active input').val(hex);
      document.querySelector('.rstuning__option__alone-color.active input').value = hex;
      document.querySelector('.rstuning__option__alone-color.active input').dispatchEvent(new Event('change'));
      $colorPickerOption.find('.rstuning__option__alone-color.active .js-color-picker-paint').css('backgroundColor', '#' + hex);
    }
  });

  rsTuningColorPickerSetInputValues(name);
}
*/

function rsTuningSpectrumInit(name) {
  
    var $spectrum = $('#' + name),
        $spectrumOption = $spectrum.parents('.rstuning__option__color-picker'),
        hexColor = $spectrum.data('dcolor') + '',
        rsColor = new RS.Color(hexColor);
  
    // init colorpicker
    $spectrum.spectrum({
      containerClassName: 'rstuning__spectrum',
      flat: true,
      color: rsColor._hex,
      showButtons: false,
      move: function (color) {
        $spectrumOption.find('.field.r').find('input').val(color.toRgb().r).change();
        $spectrumOption.find('.field.g').find('input').val(color.toRgb().g).change();
        $spectrumOption.find('.field.b').find('input').val(color.toRgb().b).change();
        $spectrumOption.find('.field.hex').find('input').val(color.toHex()).change()
        $spectrumOption.find('.rstuning__option__alone-color.active input').val(color.toHex());
        document.querySelector('.rstuning__option__alone-color.active input').value = color.toHex();
        document.querySelector('.rstuning__option__alone-color.active input').dispatchEvent(new Event('change'));
        $spectrumOption.find('.rstuning__option__alone-color.active .js-color-picker-paint').css('backgroundColor', color.toHexString());
      }
    });
  
    rsTuningSpectrumSetInputValues(name);
  }

$(document).ready(function(){

  $(document).on('click', '.js-colorpicker-set', function() {
    var $this = $(this),
        $colorPicker = $('#'+$this.parent().data('colorpicker-id')),
        value = $this.data('value'),
        id;

    for (valkey in value) {
      if ($('[data-valkey="' + valkey + '"]').length > 0) {
        document.querySelector('[data-valkey="' + valkey + '"]').value = value[valkey];
        document.querySelector('[data-valkey="' + valkey + '"]').dispatchEvent(new Event('change'));
        $('[data-valkey="' + valkey + '"]').parent().find('.js-color-picker-paint').css('backgroundColor', '#' + value[valkey]);
      }
    }

    $this.parents('.rstuning__option__color-picker').find('.active').removeClass('active');
    $this.parent().addClass('active');
    $this.parents('.js-rs_option_info').find('.js-colorpicker-val:first').parent().addClass('active');

    return false;
  });

  $(document).on('click', '.js-colorpicker-val', function() {
    var $this = $(this),
        $colorPicker = $('#'+$this.parent().data('colorpicker-id')),
        value = $this.parent().children('input').val(),
        hexColor = value + '';

    if (hexColor.length == 6) {
      $this.parents('.rstuning__option__color-picker').find('.active').removeClass('active');
      $this.parent().addClass('active');
      // rsTuningColorPickerSetInputValues($this.parents('.rstuning__option__color-picker').find('.active').data('colorpicker-id'));
      rsTuningSpectrumSetInputValues($this.parents('.rstuning__option__color-picker').find('.active').data('colorpicker-id'));
      $('.js-colorpicker-set').removeClass('active');
    }

    return false;
  });

  $(document).on('blur keyup', '.js-colorpicker-hex', function() {
    var $this = $(this);

    if ($this.val().length == 6) {
      var $colorPicker = $('#'+$this.parent().data('colorpicker-id')),
          value = $this.parent().children('input').val(),
          hexColor = value + '';
      
      $this.parents('.rstuning__option__color-picker').find('.active').find('input').val($this.val());
      // rsTuningColorPickerSetInputValues($this.parents('.rstuning__option__color-picker').find('.active').data('colorpicker-id'));
      rsTuningSpectrumSetInputValues($this.parents('.rstuning__option__color-picker').find('.active').data('colorpicker-id'));
    }

    return false;
  });

  $(document).on('click', '.js-colorpicker-multiple .rstuning__option__alone-color .js-colorpicker-val', function() {
    var $this = $(this),
        $multiple = $this.parents('.js-colorpicker-multiple');
    
    $multiple.toggleClass('open');
    
    return false;
  });

	$(document).on('click', function(e) {
    var $tuning = $('#rstuning');

		if ($tuning.hasClass('opened')) {
			if ($(e.target).parents('.js-colorpicker-multiple.open').length > 0) {

			} else {
				$tuning.find('.js-colorpicker-multiple.open').removeClass('open');
			}
		}
	});

});
