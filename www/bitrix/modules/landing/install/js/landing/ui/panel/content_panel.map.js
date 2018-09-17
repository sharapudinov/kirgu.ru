{"version":3,"sources":["content_panel.js"],"names":["BX","namespace","Landing","UI","Panel","Content","id","data","BasePanel","apply","this","arguments","layout","classList","remove","Object","freeze","type","isPlainObject","add","overlay","createOverlay","classHide","header","createHeader","title","createTitle","body","createBody","footer","createFooter","sidebar","createSidebar","content","createContent","scrollTarget","forms","Collection","FormCollection","buttons","ButtonCollection","sidebarButtons","closeButton","Button","BaseButton","className","onClick","hide","bind","attrs","message","appendChild","subTitle","create","props","html","window","onwheel","wheelEventName","onmousewheel","init","top","addEventListener","onKeydown","PageObject","getInstance","view","then","frame","contentWindow","console","warn","calculateTransitionDuration","diff","defaultDuration","parseInt","Math","min","scrollTo","container","element","Promise","resolve","elementTop","duration","defaultMargin","elementMarginTop","max","style","containerScrollTop","scrollTop","HTMLIFrameElement","offsetTop","scrollY","pos","abs","start","finish","easing","step","state","animate","setTimeout","getDeltaFromEvent","event","deltaX","deltaY","wheelDeltaX","wheelDeltaY","deltaMode","wheelDelta","x","y","prototype","constructor","__proto__","document","onMouseEnter","onMouseLeave","requestAnimationFrame","right","setTitle","isArray","forEach","item","appendFooterButton","isDomNode","keyCode","stopPropagation","proxy","onMouseWheel","contains","target","currentTarget","unbind","preventDefault","delta","isShown","classShow","show","promise","Utils","Show","Hide","appendForm","form","getNode","appendCard","card","clear","clearContent","clearSidebar","innerHTML","value","button","appendSidebarButton"],"mappings":"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","file":""}