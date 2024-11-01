(()=>{var e={4184:(e,t)=>{var n;!function(){"use strict";var l={}.hasOwnProperty;function a(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var r=typeof n;if("string"===r||"number"===r)e.push(n);else if(Array.isArray(n)){if(n.length){var o=a.apply(null,n);o&&e.push(o)}}else if("object"===r){if(n.toString!==Object.prototype.toString&&!n.toString.toString().includes("[native code]")){e.push(n.toString());continue}for(var c in n)l.call(n,c)&&n[c]&&e.push(c)}}}return e.join(" ")}e.exports?(a.default=a,e.exports=a):void 0===(n=function(){return a}.apply(t,[]))||(e.exports=n)}()}},t={};function n(l){var a=t[l];if(void 0!==a)return a.exports;var r=t[l]={exports:{}};return e[l](r,r.exports,n),r.exports}n.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},n.d=(e,t)=>{for(var l in t)n.o(t,l)&&!n.o(e,l)&&Object.defineProperty(e,l,{enumerable:!0,get:t[l]})},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{"use strict";const e=window.wp.blocks;var t=n(4184),l=n.n(t);const a=window.wp.blockEditor,r=window.wp.element,o=window.wp.data,c=window.wp.components,s=window.wp.i18n,i=window.wp.sbComponents;var u,m,p={px:{value:"px",label:"px",a11yLabel:(0,s.__)("Pixels (px)"),step:1},"%":{value:"%",label:"%",a11yLabel:(0,s.__)("Percent (%)"),step:.1},em:{value:"em",label:"em",a11yLabel:(0,s._x)("ems","Relative to parent font size (em)"),step:.01},rem:{value:"rem",label:"rem",a11yLabel:(0,s._x)("rems","Relative to root font size (rem)"),step:.01},vw:{value:"vw",label:"vw",a11yLabel:(0,s.__)("Viewport width (vw)"),step:.1},vh:{value:"vh",label:"vh",a11yLabel:(0,s.__)("Viewport height (vh)"),step:.1},vmin:{value:"vmin",label:"vmin",a11yLabel:(0,s.__)("Viewport smallest dimension (vmin)"),step:.1},vmax:{value:"vmax",label:"vmax",a11yLabel:(0,s.__)("Viewport largest dimension (vmax)"),step:.1},ch:{value:"ch",label:"ch",a11yLabel:(0,s.__)("Width of the zero (0) character (ch)"),step:.01},ex:{value:"ex",label:"ex",a11yLabel:(0,s.__)("x-height of the font (ex)"),step:.01},cm:{value:"cm",label:"cm",a11yLabel:(0,s.__)("Centimeters (cm)"),step:.001},mm:{value:"mm",label:"mm",a11yLabel:(0,s.__)("Millimeters (mm)"),step:.1},in:{value:"in",label:"in",a11yLabel:(0,s.__)("Inches (in)"),step:.001},pc:{value:"pc",label:"pc",a11yLabel:(0,s.__)("Picas (pc)"),step:1},pt:{value:"pt",label:"pt",a11yLabel:(0,s.__)("Points (pt)"),step:1}};React.createElement("svg",{width:"60",height:"44",viewBox:"0 0 512 376",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M0 0v376h512V0H0zm480 344H32V32h448v312z"}),React.createElement("circle",{cx:"409.1",cy:"102.9",r:"40.9"}),React.createElement("path",{d:"M480 344H32l86.3-164.2 21.7 11.3 49-77.3 100 113.1 8.9-9.3 17.1 22.3 26-46.4 52.9 71.2 15.1-15.9z"})),React.createElement(c.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},React.createElement(c.Path,{d:"M15 4H9v11h6V4zM4 18.5V20h16v-1.5H4z"})),React.createElement(c.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},React.createElement(c.Path,{d:"M9 20h6V9H9v11zM4 4v1.5h16V4H4z"})),React.createElement(c.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},React.createElement(c.Path,{d:"M20 11h-5V4H9v7H4v1.5h5V20h6v-7.5h5z"})),m=[],(u=["px","vh"])instanceof Array||(u=Array.from(u)),u.forEach((function(e){e in p&&m.push(p[e])}));const v=function(e){var t=e.attributes,n=void 0===t?{}:t,l=e.setAttributes,a=n.carouselAutoplay,r=n.carouselAnimationDuration,o=n.carouselDots,i=n.carouselArrows;return React.createElement(React.Fragment,null,React.createElement(c.PanelBody,null,React.createElement(c.ToggleControl,{label:(0,s.__)("Arrows","solo-blocks"),checked:i,onChange:function(e){return l({carouselArrows:e})}}),React.createElement(c.ToggleControl,{label:(0,s.__)("Dots","solo-blocks"),checked:o,onChange:function(e){return l({carouselDots:e})}}),React.createElement(c.ToggleControl,{label:(0,s.__)("Autoplay","solo-blocks"),checked:!!+a,onChange:function(e){return l({carouselAutoplay:e?"3":""})}}),!!+a&&React.createElement(c.TextControl,{label:(0,s.__)("Autoplay (s)","solo-blocks"),description:(0,s.__)("Empty for disable","solo-blocks"),value:a,onChange:function(e){return l({carouselAutoplay:e})},type:"number"}),React.createElement(c.TextControl,{label:(0,s.__)("Animation duration","solo-blocks"),value:r,onChange:function(e){return l({carouselAnimationDuration:e})},type:"number"})))};var d=[{name:"content",title:(0,s.__)("Settings","solo-blocks")}];const h=function(e){var t=e.attributes;return e.setAttributes,function(e){if(null==e)throw new TypeError("Cannot destructure "+e)}(t),React.createElement(React.Fragment,null,React.createElement(a.InspectorControls,null,React.createElement(c.TabPanel,{className:"sb-control__tabs sb-single__tab",tabs:d,initialTabName:d[0].name},(function(t){if("content"===t.name)return React.createElement(v,e)}))))},b=window.lodash;function w(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,l=new Array(t);n<t;n++)l[n]=e[n];return l}var f=["sb/content-slider-item"],g=(0,b.memoize)((function(e){return(0,b.times)(e,(function(){return["sb/content-slider-item"]}))}));const y=JSON.parse('{"u2":"sb/content-slider","TN":"SB Content Slider"}');React.createElement("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 16 16",width:"20",height:"20",fill:"#212121"},React.createElement("path",{d:"M7.1 6.6c.3-.3.1-.7-.2-.8l-1.8-.2c-.1-.1-.2-.1-.3-.2L4 3.8c-.1-.3-.6-.3-.8 0l-.8 1.6c0 .1-.1.2-.3.2l-1.7.2c-.4.1-.5.5-.3.8l1.3 1.3c.1.1.1.2.1.3L1.2 10c-.1.4.3.6.6.5l1.6-.8c.1-.1.3-.1.4 0l1.6.8c.3.1.6-.2.6-.6l-.3-1.7c0-.1 0-.3.1-.3l1.3-1.3zM4.6 7.7l.2 1.2c0 .1-.1.1-.1.1l-1-.6h-.2l-1.1.5s-.1 0-.1-.1l.2-1.2c0-.1 0-.2-.1-.2l-.8-.7c0-.1 0-.1.1-.1l1.2-.2.1-.1.5-1.1c0-.1.1-.1.1 0l.5 1.1c0 .1.1.1.2.1l1.2.2c.1 0 .1.1.1.1l-.9.8c-.1.1-.1.1-.1.2zM15.4 6.9H8.8c-.3 0-.6-.2-.6-.6s.2-.6.6-.6h6.6c.3 0 .6.2.6.6 0 .4-.2.6-.6.6zM15.4 9.6H8.8c-.3 0-.6-.2-.6-.6s.2-.6.6-.6h6.6c.3 0 .6.2.6.6 0 .4-.2.6-.6.6zM15.4 12.4H8.8c-.3 0-.6-.2-.6-.6s.2-.6.6-.6h6.6c.3 0 .6.2.6.6 0 .4-.2.6-.6.6z"}));var _={icon:React.createElement("div",{className:"slug"},React.createElement("span",{className:"sb-block-editor-icon sb_icon_".concat(y.u2.split("/")[1])})),edit:function(t){var n=t.attributes,u=(t.setAttributes,t.clientId),m=(t.isSelected,n.align),p=n.carouselAutoplay,v=n.carouselAnimationDuration,d=n.carouselArrows,b=n.carouselDots,y=(0,o.useSelect)((function(e){var t,n=e(a.store),l=n.getBlockOrder,r=n.getBlocksByClientId,o=n.getBlocks,c=n.getSelectedBlock,s=n.getBlockParents,i=r(u)[0],m=(i.innerBlocks||[]).map((function(e){return e.clientId})),p=(null===(t=c())||void 0===t?void 0:t.clientId)||"-1",v=s(p),d=m.findIndex((function(e){return e===p}));if(-1===d){var h=!1;v.forEach((function(e){h=h||!!m.includes(e)&&e})),h&&(d=m.findIndex((function(e){return e===h})))}return{hasChildBlocks:l(u).length>0,childBlocks:i.innerBlocks||[],childBlocksIds:m,getBlocks:o,selectedChildPosition:-1!==d&&d}}),[u]),_=y.hasChildBlocks,k=y.childBlocks,x=y.childBlocksIds,E=y.selectedChildPosition,R=y.getBlocks,B=(0,o.useDispatch)(a.store),A=B.replaceInnerBlocks,C=B.selectBlock,S=(0,r.useCallback)((function(){var t,n=R(u),l=(0,e.createBlock)("sb/content-slider-item");n=[].concat(function(e){if(Array.isArray(e))return w(e)}(t=n)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(t)||function(e,t){if(e){if("string"==typeof e)return w(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?w(e,t):void 0}}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}(),[l]),A(u,n),setTimeout((function(){C(l.clientId)}),0)}),[u]),L={type:"slider",rewind:!1,swipeEnable:!0,perView:1,gap:0,focusAt:0,autoplay:+p?1e3*+p:"",animationDuration:+v||400},I=(0,a.useBlockProps)({className:l()({"has-alignment":"none"!==m,"sb-carousel-bullets":b},["align".concat(m)])}),z=(0,a.useInnerBlocksProps)({className:"glide__slides"},{template:g(k),allowedBlocks:f,orientation:"vertical",renderAppender:_?void 0:a.InnerBlocks.ButtonBlockAppender});return React.createElement(React.Fragment,null,React.createElement(a.BlockControls,null,React.createElement(c.ToolbarButton,{className:"sb-control-button",onClick:S},(0,s.__)("Add Slide","solo-blocks"))),React.createElement(h,t),React.createElement("div",I,React.createElement(i.SBGlide,{type:"slider",arrows:!!d&&{next:React.createElement("svg",{viewBox:"0 0 1024 1024",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M408.96 800.96l-33.92-33.92L630.048 512 375.04 256.96l33.92-33.92L697.952 512z"})),prev:React.createElement("svg",{viewBox:"0 0 1024 1024",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"M615.04 800.96L326.048 512l288.992-288.96 33.92 33.92L393.952 512l255.008 255.04z"}))},startAt:!1!==E?E:void 0,bullets:b,options:L,clientId:u,slides:x,hasInnerBlocks:!0},React.createElement("div",z))))},save:function(){var e=a.useInnerBlocksProps.save(a.useBlockProps.save({}));return React.createElement("div",e)}};(0,e.registerBlockType)({name:y.u2,title:y.TN},_)})()})();