/**
 * 
 */
;(function(window) {

if (!!window.RS.Tuning)
    return;

window.RS.Tuning = function(id) {
    if (!!id) {
        this.id = id;
        this.initMacrosList();
    } else {
        return new RS.Tuning('rstuning');
    }
};

RS.Tuning.prototype.settings = {
    styleSelectId               : 'rstuning_styles',
    timeoutChanageStylesDelay   : 250,
    timeoutChanageStylesId      : 0
};
RS.Tuning.prototype.colorMacrosContent = '';
RS.Tuning.prototype.colorMacrosCompiled = '';
RS.Tuning.prototype.macrosList = {};

RS.Tuning.prototype.generateCss = function() {

    this.replaceMacros();

    this.innerStyles();

    return true;
};

RS.Tuning.prototype.getReadyMacros = function() {
    var event = new CustomEvent('rs.tuning.onBeforeGetReadyMacros', {'detail' : {'macrosList': this.macrosList}});
    document.dispatchEvent(event);
    return this.macrosList;
};

RS.Tuning.prototype.setColorMacrosContent = function(content) {
    this.colorMacrosContent = content;
    return true;
};

RS.Tuning.prototype.getColorMacrosContent = function() {
    return this.colorMacrosContent;
};

RS.Tuning.prototype.replaceMacros = function() {
    var content = this.getColorMacrosContent(),
        macrosList = this.getReadyMacros();

    for (var key1 in macrosList) {
        content = content.replace(new RegExp('#' + key1 + '#', 'g'), macrosList[key1]);
    }

    this.setColorMacrosCompiled(content);

    return true;
};

RS.Tuning.prototype.innerStyles = function() {
    var this_ = this;
    clearTimeout(this.settings.timeoutChanageStylesId);

    this_.settings.timeoutChanageStylesId = setTimeout(function() {
        document.getElementById(this_.settings.styleSelectId).innerHTML = ''
            + '<style>' + this_.getColorMacrosCompiled() + '</style>';
    }, this_.settings.timeoutChanageStylesDelay);

    return true;
};

RS.Tuning.prototype.setColorMacrosCompiled = function(content) {
    this.colorMacrosCompiled = content;
    return true;
};

RS.Tuning.prototype.getColorMacrosCompiled = function() {
    return this.colorMacrosCompiled;
};

RS.Tuning.prototype.setMacros = function(macrosName, value) {
    this.macrosList[macrosName] = value;
    return true;
};

RS.Tuning.prototype.initMacrosList = function() {
    var tuningObj = this.getTuning(),
        elements = tuningObj.querySelectorAll('[data-macros]');
    
    if (elements && elements.length > 0) {
        for (i = 0; i < elements.length; i++) {
            this.setMacros(elements[i].getAttribute('data-macros'), elements[i].value);
        }
    }

    return true;
};

RS.Tuning.prototype.getTuning = function() {
    return document.getElementById(this.id);
};

})(window);
