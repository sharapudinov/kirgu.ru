{"version":3,"sources":["dropdown_field.js"],"names":["BX","namespace","setTextContent","Landing","Utils","escapeText","data","offsetTop","offsetLeft","bind","unbind","Menu","UI","Tool","Field","Dropdown","options","this","items","BaseField","apply","arguments","onChangeHandler","onChange","layout","classList","add","popup","input","addEventListener","onInputClick","document","onDocumentClick","top","type","isPlainObject","keys","Object","map","key","name","value","setValue","content","prototype","constructor","__proto__","event","stopPropagation","popupRoot","contains","popupWindow","popupContainer","id","Date","bindElement","item","text","onclick","onItemClick","events","onPopupClose","remove","parentElement","appendChild","style","position","isShown","close","show","menuContainer","maxHeight","contentContainer","overflowX","onMouseOver","onMouseLeave","rect","getBoundingClientRect","left","height","width","postfix","property","onValueChangeHandler","fireEvent","getValue","dataset","forEach","isChanged","window","onwheel","onMouseWheel","preventDefault","delta","Panel","Content","getDeltaFromEvent","scrollTop","requestAnimationFrame","y"],"mappings":"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","file":""}