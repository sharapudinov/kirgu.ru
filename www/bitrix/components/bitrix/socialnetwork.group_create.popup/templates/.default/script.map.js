{"version":3,"sources":["script.js"],"names":["BX","SGCP","bInit","popup","params","pathToCreate","pathToEdit","pathToInvite","Init","obParams","NAME","length","indexOf","message","addCustomEvent","destroyPopup","ShowForm","action","popupName","event","PreventDefault","destroy","actionURL","popupTitle","initialStyles","PopupWindow","autoHide","zIndex","offsetLeft","offsetTop","overlay","lightShadow","draggable","restrict","closeByEsc","titleBar","contentColor","contentNoPaddings","closeIcon","right","top","buttons","content","events","onAfterPopupShow","this","setContent","ajax","post","lang","site_id","arParams","delegate","result","setTimeout","adjustPosition","onPopupClose","WindowManager","GetZIndex","show","SocNetLogDestination","popupWindow","close","popupSearchWindow"],"mappings":"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","file":""}