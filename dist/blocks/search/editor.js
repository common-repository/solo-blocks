(()=>{var e={4184:(e,t)=>{var r;!function(){"use strict";var n={}.hasOwnProperty;function a(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var o=typeof r;if("string"===o||"number"===o)e.push(r);else if(Array.isArray(r)){if(r.length){var i=a.apply(null,r);i&&e.push(i)}}else if("object"===o){if(r.toString!==Object.prototype.toString&&!r.toString.toString().includes("[native code]")){e.push(r.toString());continue}for(var s in r)n.call(r,s)&&r[s]&&e.push(s)}}}return e.join(" ")}e.exports?(a.default=a,e.exports=a):void 0===(r=function(){return a}.apply(t,[]))||(e.exports=r)}()},8679:(e,t,r)=>{"use strict";var n=r(9864),a={childContextTypes:!0,contextType:!0,contextTypes:!0,defaultProps:!0,displayName:!0,getDefaultProps:!0,getDerivedStateFromError:!0,getDerivedStateFromProps:!0,mixins:!0,propTypes:!0,type:!0},o={name:!0,length:!0,prototype:!0,caller:!0,callee:!0,arguments:!0,arity:!0},i={$$typeof:!0,compare:!0,defaultProps:!0,displayName:!0,propTypes:!0,type:!0},s={};function c(e){return n.isMemo(e)?i:s[e.$$typeof]||a}s[n.ForwardRef]={$$typeof:!0,render:!0,defaultProps:!0,displayName:!0,propTypes:!0},s[n.Memo]=i;var l=Object.defineProperty,u=Object.getOwnPropertyNames,f=Object.getOwnPropertySymbols,d=Object.getOwnPropertyDescriptor,p=Object.getPrototypeOf,h=Object.prototype;e.exports=function e(t,r,n){if("string"!=typeof r){if(h){var a=p(r);a&&a!==h&&e(t,a,n)}var i=u(r);f&&(i=i.concat(f(r)));for(var s=c(t),m=c(r),g=0;g<i.length;++g){var v=i[g];if(!(o[v]||n&&n[v]||m&&m[v]||s&&s[v])){var y=d(r,v);try{l(t,v,y)}catch(e){}}}}return t}},9921:(e,t)=>{"use strict";var r="function"==typeof Symbol&&Symbol.for,n=r?Symbol.for("react.element"):60103,a=r?Symbol.for("react.portal"):60106,o=r?Symbol.for("react.fragment"):60107,i=r?Symbol.for("react.strict_mode"):60108,s=r?Symbol.for("react.profiler"):60114,c=r?Symbol.for("react.provider"):60109,l=r?Symbol.for("react.context"):60110,u=r?Symbol.for("react.async_mode"):60111,f=r?Symbol.for("react.concurrent_mode"):60111,d=r?Symbol.for("react.forward_ref"):60112,p=r?Symbol.for("react.suspense"):60113,h=r?Symbol.for("react.suspense_list"):60120,m=r?Symbol.for("react.memo"):60115,g=r?Symbol.for("react.lazy"):60116,v=r?Symbol.for("react.block"):60121,y=r?Symbol.for("react.fundamental"):60117,b=r?Symbol.for("react.responder"):60118,w=r?Symbol.for("react.scope"):60119;function S(e){if("object"==typeof e&&null!==e){var t=e.$$typeof;switch(t){case n:switch(e=e.type){case u:case f:case o:case s:case i:case p:return e;default:switch(e=e&&e.$$typeof){case l:case d:case g:case m:case c:return e;default:return t}}case a:return t}}}function k(e){return S(e)===f}t.AsyncMode=u,t.ConcurrentMode=f,t.ContextConsumer=l,t.ContextProvider=c,t.Element=n,t.ForwardRef=d,t.Fragment=o,t.Lazy=g,t.Memo=m,t.Portal=a,t.Profiler=s,t.StrictMode=i,t.Suspense=p,t.isAsyncMode=function(e){return k(e)||S(e)===u},t.isConcurrentMode=k,t.isContextConsumer=function(e){return S(e)===l},t.isContextProvider=function(e){return S(e)===c},t.isElement=function(e){return"object"==typeof e&&null!==e&&e.$$typeof===n},t.isForwardRef=function(e){return S(e)===d},t.isFragment=function(e){return S(e)===o},t.isLazy=function(e){return S(e)===g},t.isMemo=function(e){return S(e)===m},t.isPortal=function(e){return S(e)===a},t.isProfiler=function(e){return S(e)===s},t.isStrictMode=function(e){return S(e)===i},t.isSuspense=function(e){return S(e)===p},t.isValidElementType=function(e){return"string"==typeof e||"function"==typeof e||e===o||e===f||e===s||e===i||e===p||e===h||"object"==typeof e&&null!==e&&(e.$$typeof===g||e.$$typeof===m||e.$$typeof===c||e.$$typeof===l||e.$$typeof===d||e.$$typeof===y||e.$$typeof===b||e.$$typeof===w||e.$$typeof===v)},t.typeOf=S},9864:(e,t,r)=>{"use strict";e.exports=r(9921)},6774:e=>{e.exports=function(e,t,r,n){var a=r?r.call(n,e,t):void 0;if(void 0!==a)return!!a;if(e===t)return!0;if("object"!=typeof e||!e||"object"!=typeof t||!t)return!1;var o=Object.keys(e),i=Object.keys(t);if(o.length!==i.length)return!1;for(var s=Object.prototype.hasOwnProperty.bind(t),c=0;c<o.length;c++){var l=o[c];if(!s(l))return!1;var u=e[l],f=t[l];if(!1===(a=r?r.call(n,u,f,l):void 0)||void 0===a&&u!==f)return!1}return!0}}},t={};function r(n){var a=t[n];if(void 0!==a)return a.exports;var o=t[n]={exports:{}};return e[n](o,o.exports,r),o.exports}r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r.nc=void 0,(()=>{"use strict";const e=window.wp.blocks;var t=r(4184),n=r.n(t),a=r(9864);const o=window.React;var i=r.n(o),s=r(6774),c=r.n(s);const l=function(e){function t(e,n,c,l,d){for(var p,h,m,g,w,k=0,C=0,A=0,x=0,E=0,j=0,z=m=p=0,N=0,M=0,B=0,D=0,F=c.length,L=F-1,H="",G="",V="",Y="";N<F;){if(h=c.charCodeAt(N),N===L&&0!==C+x+A+k&&(0!==C&&(h=47===C?10:47),x=A=k=0,F++,L++),0===C+x+A+k){if(N===L&&(0<M&&(H=H.replace(f,"")),0<H.trim().length)){switch(h){case 32:case 9:case 59:case 13:case 10:break;default:H+=c.charAt(N)}h=59}switch(h){case 123:for(p=(H=H.trim()).charCodeAt(0),m=1,D=++N;N<F;){switch(h=c.charCodeAt(N)){case 123:m++;break;case 125:m--;break;case 47:switch(h=c.charCodeAt(N+1)){case 42:case 47:e:{for(z=N+1;z<L;++z)switch(c.charCodeAt(z)){case 47:if(42===h&&42===c.charCodeAt(z-1)&&N+2!==z){N=z+1;break e}break;case 10:if(47===h){N=z+1;break e}}N=z}}break;case 91:h++;case 40:h++;case 34:case 39:for(;N++<L&&c.charCodeAt(N)!==h;);}if(0===m)break;N++}if(m=c.substring(D,N),0===p&&(p=(H=H.replace(u,"").trim()).charCodeAt(0)),64===p){switch(0<M&&(H=H.replace(f,"")),h=H.charCodeAt(1)){case 100:case 109:case 115:case 45:M=n;break;default:M=_}if(D=(m=t(n,M,m,h,d+1)).length,0<T&&(w=s(3,m,M=r(_,H,B),n,R,P,D,h,d,l),H=M.join(""),void 0!==w&&0===(D=(m=w.trim()).length)&&(h=0,m="")),0<D)switch(h){case 115:H=H.replace(S,i);case 100:case 109:case 45:m=H+"{"+m+"}";break;case 107:m=(H=H.replace(v,"$1 $2"))+"{"+m+"}",m=1===I||2===I&&o("@"+m,3)?"@-webkit-"+m+"@"+m:"@"+m;break;default:m=H+m,112===l&&(G+=m,m="")}else m=""}else m=t(n,r(n,H,B),m,l,d+1);V+=m,m=B=M=z=p=0,H="",h=c.charCodeAt(++N);break;case 125:case 59:if(1<(D=(H=(0<M?H.replace(f,""):H).trim()).length))switch(0===z&&(p=H.charCodeAt(0),45===p||96<p&&123>p)&&(D=(H=H.replace(" ",":")).length),0<T&&void 0!==(w=s(1,H,n,e,R,P,G.length,l,d,l))&&0===(D=(H=w.trim()).length)&&(H="\0\0"),p=H.charCodeAt(0),h=H.charCodeAt(1),p){case 0:break;case 64:if(105===h||99===h){Y+=H+c.charAt(N);break}default:58!==H.charCodeAt(D-1)&&(G+=a(H,p,h,H.charCodeAt(2)))}B=M=z=p=0,H="",h=c.charCodeAt(++N)}}switch(h){case 13:case 10:47===C?C=0:0===1+p&&107!==l&&0<H.length&&(M=1,H+="\0"),0<T*$&&s(0,H,n,e,R,P,G.length,l,d,l),P=1,R++;break;case 59:case 125:if(0===C+x+A+k){P++;break}default:switch(P++,g=c.charAt(N),h){case 9:case 32:if(0===x+k+C)switch(E){case 44:case 58:case 9:case 32:g="";break;default:32!==h&&(g=" ")}break;case 0:g="\\0";break;case 12:g="\\f";break;case 11:g="\\v";break;case 38:0===x+C+k&&(M=B=1,g="\f"+g);break;case 108:if(0===x+C+k+O&&0<z)switch(N-z){case 2:112===E&&58===c.charCodeAt(N-3)&&(O=E);case 8:111===j&&(O=j)}break;case 58:0===x+C+k&&(z=N);break;case 44:0===C+A+x+k&&(M=1,g+="\r");break;case 34:case 39:0===C&&(x=x===h?0:0===x?h:x);break;case 91:0===x+C+A&&k++;break;case 93:0===x+C+A&&k--;break;case 41:0===x+C+k&&A--;break;case 40:0===x+C+k&&(0===p&&(2*E+3*j==533||(p=1)),A++);break;case 64:0===C+A+x+k+z+m&&(m=1);break;case 42:case 47:if(!(0<x+k+A))switch(C){case 0:switch(2*h+3*c.charCodeAt(N+1)){case 235:C=47;break;case 220:D=N,C=42}break;case 42:47===h&&42===E&&D+2!==N&&(33===c.charCodeAt(D+2)&&(G+=c.substring(D,N+1)),g="",C=0)}}0===C&&(H+=g)}j=E,E=h,N++}if(0<(D=G.length)){if(M=n,0<T&&void 0!==(w=s(2,G,M,e,R,P,D,l,d,l))&&0===(G=w).length)return Y+G+V;if(G=M.join(",")+"{"+G+"}",0!=I*O){switch(2!==I||o(G,2)||(O=0),O){case 111:G=G.replace(b,":-moz-$1")+G;break;case 112:G=G.replace(y,"::-webkit-input-$1")+G.replace(y,"::-moz-$1")+G.replace(y,":-ms-input-$1")+G}O=0}}return Y+G+V}function r(e,t,r){var a=t.trim().split(m);t=a;var o=a.length,i=e.length;switch(i){case 0:case 1:var s=0;for(e=0===i?"":e[0]+" ";s<o;++s)t[s]=n(e,t[s],r).trim();break;default:var c=s=0;for(t=[];s<o;++s)for(var l=0;l<i;++l)t[c++]=n(e[l]+" ",a[s],r).trim()}return t}function n(e,t,r){var n=t.charCodeAt(0);switch(33>n&&(n=(t=t.trim()).charCodeAt(0)),n){case 38:return t.replace(g,"$1"+e.trim());case 58:return e.trim()+t.replace(g,"$1"+e.trim());default:if(0<1*r&&0<t.indexOf("\f"))return t.replace(g,(58===e.charCodeAt(0)?"":"$1")+e.trim())}return e+t}function a(e,t,r,n){var i=e+";",s=2*t+3*r+4*n;if(944===s){e=i.indexOf(":",9)+1;var c=i.substring(e,i.length-1).trim();return c=i.substring(0,e).trim()+c+";",1===I||2===I&&o(c,1)?"-webkit-"+c+c:c}if(0===I||2===I&&!o(i,1))return i;switch(s){case 1015:return 97===i.charCodeAt(10)?"-webkit-"+i+i:i;case 951:return 116===i.charCodeAt(3)?"-webkit-"+i+i:i;case 963:return 110===i.charCodeAt(5)?"-webkit-"+i+i:i;case 1009:if(100!==i.charCodeAt(4))break;case 969:case 942:return"-webkit-"+i+i;case 978:return"-webkit-"+i+"-moz-"+i+i;case 1019:case 983:return"-webkit-"+i+"-moz-"+i+"-ms-"+i+i;case 883:if(45===i.charCodeAt(8))return"-webkit-"+i+i;if(0<i.indexOf("image-set(",11))return i.replace(E,"$1-webkit-$2")+i;break;case 932:if(45===i.charCodeAt(4))switch(i.charCodeAt(5)){case 103:return"-webkit-box-"+i.replace("-grow","")+"-webkit-"+i+"-ms-"+i.replace("grow","positive")+i;case 115:return"-webkit-"+i+"-ms-"+i.replace("shrink","negative")+i;case 98:return"-webkit-"+i+"-ms-"+i.replace("basis","preferred-size")+i}return"-webkit-"+i+"-ms-"+i+i;case 964:return"-webkit-"+i+"-ms-flex-"+i+i;case 1023:if(99!==i.charCodeAt(8))break;return"-webkit-box-pack"+(c=i.substring(i.indexOf(":",15)).replace("flex-","").replace("space-between","justify"))+"-webkit-"+i+"-ms-flex-pack"+c+i;case 1005:return p.test(i)?i.replace(d,":-webkit-")+i.replace(d,":-moz-")+i:i;case 1e3:switch(t=(c=i.substring(13).trim()).indexOf("-")+1,c.charCodeAt(0)+c.charCodeAt(t)){case 226:c=i.replace(w,"tb");break;case 232:c=i.replace(w,"tb-rl");break;case 220:c=i.replace(w,"lr");break;default:return i}return"-webkit-"+i+"-ms-"+c+i;case 1017:if(-1===i.indexOf("sticky",9))break;case 975:switch(t=(i=e).length-10,s=(c=(33===i.charCodeAt(t)?i.substring(0,t):i).substring(e.indexOf(":",7)+1).trim()).charCodeAt(0)+(0|c.charCodeAt(7))){case 203:if(111>c.charCodeAt(8))break;case 115:i=i.replace(c,"-webkit-"+c)+";"+i;break;case 207:case 102:i=i.replace(c,"-webkit-"+(102<s?"inline-":"")+"box")+";"+i.replace(c,"-webkit-"+c)+";"+i.replace(c,"-ms-"+c+"box")+";"+i}return i+";";case 938:if(45===i.charCodeAt(5))switch(i.charCodeAt(6)){case 105:return c=i.replace("-items",""),"-webkit-"+i+"-webkit-box-"+c+"-ms-flex-"+c+i;case 115:return"-webkit-"+i+"-ms-flex-item-"+i.replace(C,"")+i;default:return"-webkit-"+i+"-ms-flex-line-pack"+i.replace("align-content","").replace(C,"")+i}break;case 973:case 989:if(45!==i.charCodeAt(3)||122===i.charCodeAt(4))break;case 931:case 953:if(!0===x.test(e))return 115===(c=e.substring(e.indexOf(":")+1)).charCodeAt(0)?a(e.replace("stretch","fill-available"),t,r,n).replace(":fill-available",":stretch"):i.replace(c,"-webkit-"+c)+i.replace(c,"-moz-"+c.replace("fill-",""))+i;break;case 962:if(i="-webkit-"+i+(102===i.charCodeAt(5)?"-ms-"+i:"")+i,211===r+n&&105===i.charCodeAt(13)&&0<i.indexOf("transform",10))return i.substring(0,i.indexOf(";",27)+1).replace(h,"$1-webkit-$2")+i}return i}function o(e,t){var r=e.indexOf(1===t?":":"{"),n=e.substring(0,3!==t?r:10);return r=e.substring(r+1,e.length-1),z(2!==t?n:n.replace(A,"$1"),r,t)}function i(e,t){var r=a(t,t.charCodeAt(0),t.charCodeAt(1),t.charCodeAt(2));return r!==t+";"?r.replace(k," or ($1)").substring(4):"("+t+")"}function s(e,t,r,n,a,o,i,s,c,u){for(var f,d=0,p=t;d<T;++d)switch(f=j[d].call(l,e,p,r,n,a,o,i,s,c,u)){case void 0:case!1:case!0:case null:break;default:p=f}if(p!==t)return p}function c(e){return void 0!==(e=e.prefix)&&(z=null,e?"function"!=typeof e?I=1:(I=2,z=e):I=0),c}function l(e,r){var n=e;if(33>n.charCodeAt(0)&&(n=n.trim()),n=[n],0<T){var a=s(-1,r,n,n,R,P,0,0,0,0);void 0!==a&&"string"==typeof a&&(r=a)}var o=t(_,n,r,0,0);return 0<T&&void 0!==(a=s(-2,o,n,n,R,P,o.length,0,0,0))&&(o=a),O=0,P=R=1,o}var u=/^\0+/g,f=/[\0\r\f]/g,d=/: */g,p=/zoo|gra/,h=/([,: ])(transform)/g,m=/,\r+?/g,g=/([\t\r\n ])*\f?&/g,v=/@(k\w+)\s*(\S*)\s*/,y=/::(place)/g,b=/:(read-only)/g,w=/[svh]\w+-[tblr]{2}/,S=/\(\s*(.*)\s*\)/g,k=/([\s\S]*?);/g,C=/-self|flex-/g,A=/[^]*?(:[rp][el]a[\w-]+)[^]*/,x=/stretch|:\s*\w+\-(?:conte|avail)/,E=/([^-])(image-set\()/,P=1,R=1,O=0,I=1,_=[],j=[],T=0,z=null,$=0;return l.use=function e(t){switch(t){case void 0:case null:T=j.length=0;break;default:if("function"==typeof t)j[T++]=t;else if("object"==typeof t)for(var r=0,n=t.length;r<n;++r)e(t[r]);else $=0|!!t}return e},l.set=c,void 0!==e&&c(e),l},u={animationIterationCount:1,borderImageOutset:1,borderImageSlice:1,borderImageWidth:1,boxFlex:1,boxFlexGroup:1,boxOrdinalGroup:1,columnCount:1,columns:1,flex:1,flexGrow:1,flexPositive:1,flexShrink:1,flexNegative:1,flexOrder:1,gridRow:1,gridRowEnd:1,gridRowSpan:1,gridRowStart:1,gridColumn:1,gridColumnEnd:1,gridColumnSpan:1,gridColumnStart:1,msGridRow:1,msGridRowSpan:1,msGridColumn:1,msGridColumnSpan:1,fontWeight:1,lineHeight:1,opacity:1,order:1,orphans:1,tabSize:1,widows:1,zIndex:1,zoom:1,WebkitLineClamp:1,fillOpacity:1,floodOpacity:1,stopOpacity:1,strokeDasharray:1,strokeDashoffset:1,strokeMiterlimit:1,strokeOpacity:1,strokeWidth:1};var f=/^((children|dangerouslySetInnerHTML|key|ref|autoFocus|defaultValue|defaultChecked|innerHTML|suppressContentEditableWarning|suppressHydrationWarning|valueLink|abbr|accept|acceptCharset|accessKey|action|allow|allowUserMedia|allowPaymentRequest|allowFullScreen|allowTransparency|alt|async|autoComplete|autoPlay|capture|cellPadding|cellSpacing|challenge|charSet|checked|cite|classID|className|cols|colSpan|content|contentEditable|contextMenu|controls|controlsList|coords|crossOrigin|data|dateTime|decoding|default|defer|dir|disabled|disablePictureInPicture|download|draggable|encType|enterKeyHint|form|formAction|formEncType|formMethod|formNoValidate|formTarget|frameBorder|headers|height|hidden|high|href|hrefLang|htmlFor|httpEquiv|id|inputMode|integrity|is|keyParams|keyType|kind|label|lang|list|loading|loop|low|marginHeight|marginWidth|max|maxLength|media|mediaGroup|method|min|minLength|multiple|muted|name|nonce|noValidate|open|optimum|pattern|placeholder|playsInline|poster|preload|profile|radioGroup|readOnly|referrerPolicy|rel|required|reversed|role|rows|rowSpan|sandbox|scope|scoped|scrolling|seamless|selected|shape|size|sizes|slot|span|spellCheck|src|srcDoc|srcLang|srcSet|start|step|style|summary|tabIndex|target|title|translate|type|useMap|value|width|wmode|wrap|about|datatype|inlist|prefix|property|resource|typeof|vocab|autoCapitalize|autoCorrect|autoSave|color|incremental|fallback|inert|itemProp|itemScope|itemType|itemID|itemRef|on|option|results|security|unselectable|accentHeight|accumulate|additive|alignmentBaseline|allowReorder|alphabetic|amplitude|arabicForm|ascent|attributeName|attributeType|autoReverse|azimuth|baseFrequency|baselineShift|baseProfile|bbox|begin|bias|by|calcMode|capHeight|clip|clipPathUnits|clipPath|clipRule|colorInterpolation|colorInterpolationFilters|colorProfile|colorRendering|contentScriptType|contentStyleType|cursor|cx|cy|d|decelerate|descent|diffuseConstant|direction|display|divisor|dominantBaseline|dur|dx|dy|edgeMode|elevation|enableBackground|end|exponent|externalResourcesRequired|fill|fillOpacity|fillRule|filter|filterRes|filterUnits|floodColor|floodOpacity|focusable|fontFamily|fontSize|fontSizeAdjust|fontStretch|fontStyle|fontVariant|fontWeight|format|from|fr|fx|fy|g1|g2|glyphName|glyphOrientationHorizontal|glyphOrientationVertical|glyphRef|gradientTransform|gradientUnits|hanging|horizAdvX|horizOriginX|ideographic|imageRendering|in|in2|intercept|k|k1|k2|k3|k4|kernelMatrix|kernelUnitLength|kerning|keyPoints|keySplines|keyTimes|lengthAdjust|letterSpacing|lightingColor|limitingConeAngle|local|markerEnd|markerMid|markerStart|markerHeight|markerUnits|markerWidth|mask|maskContentUnits|maskUnits|mathematical|mode|numOctaves|offset|opacity|operator|order|orient|orientation|origin|overflow|overlinePosition|overlineThickness|panose1|paintOrder|pathLength|patternContentUnits|patternTransform|patternUnits|pointerEvents|points|pointsAtX|pointsAtY|pointsAtZ|preserveAlpha|preserveAspectRatio|primitiveUnits|r|radius|refX|refY|renderingIntent|repeatCount|repeatDur|requiredExtensions|requiredFeatures|restart|result|rotate|rx|ry|scale|seed|shapeRendering|slope|spacing|specularConstant|specularExponent|speed|spreadMethod|startOffset|stdDeviation|stemh|stemv|stitchTiles|stopColor|stopOpacity|strikethroughPosition|strikethroughThickness|string|stroke|strokeDasharray|strokeDashoffset|strokeLinecap|strokeLinejoin|strokeMiterlimit|strokeOpacity|strokeWidth|surfaceScale|systemLanguage|tableValues|targetX|targetY|textAnchor|textDecoration|textRendering|textLength|to|transform|u1|u2|underlinePosition|underlineThickness|unicode|unicodeBidi|unicodeRange|unitsPerEm|vAlphabetic|vHanging|vIdeographic|vMathematical|values|vectorEffect|version|vertAdvY|vertOriginX|vertOriginY|viewBox|viewTarget|visibility|widths|wordSpacing|writingMode|x|xHeight|x1|x2|xChannelSelector|xlinkActuate|xlinkArcrole|xlinkHref|xlinkRole|xlinkShow|xlinkTitle|xlinkType|xmlBase|xmlns|xmlnsXlink|xmlLang|xmlSpace|y|y1|y2|yChannelSelector|z|zoomAndPan|for|class|autofocus)|(([Dd][Aa][Tt][Aa]|[Aa][Rr][Ii][Aa]|x)-.*))$/;const d=function(e){var t=Object.create(null);return function(e){return void 0===t[e]&&(t[e]=(r=e,f.test(r)||111===r.charCodeAt(0)&&110===r.charCodeAt(1)&&r.charCodeAt(2)<91)),t[e];var r}}();var p=r(8679),h=r.n(p);function m(){return(m=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e}).apply(this,arguments)}var g=function(e,t){for(var r=[e[0]],n=0,a=t.length;n<a;n+=1)r.push(t[n],e[n+1]);return r},v=function(e){return null!==e&&"object"==typeof e&&"[object Object]"===(e.toString?e.toString():Object.prototype.toString.call(e))&&!(0,a.typeOf)(e)},y=Object.freeze([]),b=Object.freeze({});function w(e){return"function"==typeof e}function S(e){return e.displayName||e.name||"Component"}function k(e){return e&&"string"==typeof e.styledComponentId}var C="undefined"!=typeof process&&void 0!==process.env&&(process.env.REACT_APP_SC_ATTR||process.env.SC_ATTR)||"data-styled",A="undefined"!=typeof window&&"HTMLElement"in window,x=Boolean("boolean"==typeof SC_DISABLE_SPEEDY?SC_DISABLE_SPEEDY:"undefined"!=typeof process&&void 0!==process.env&&(void 0!==process.env.REACT_APP_SC_DISABLE_SPEEDY&&""!==process.env.REACT_APP_SC_DISABLE_SPEEDY?"false"!==process.env.REACT_APP_SC_DISABLE_SPEEDY&&process.env.REACT_APP_SC_DISABLE_SPEEDY:void 0!==process.env.SC_DISABLE_SPEEDY&&""!==process.env.SC_DISABLE_SPEEDY&&"false"!==process.env.SC_DISABLE_SPEEDY&&process.env.SC_DISABLE_SPEEDY));function E(e){for(var t=arguments.length,r=new Array(t>1?t-1:0),n=1;n<t;n++)r[n-1]=arguments[n];throw new Error("An error occurred. See https://git.io/JUIaE#"+e+" for more information."+(r.length>0?" Args: "+r.join(", "):""))}var P=function(){function e(e){this.groupSizes=new Uint32Array(512),this.length=512,this.tag=e}var t=e.prototype;return t.indexOfGroup=function(e){for(var t=0,r=0;r<e;r++)t+=this.groupSizes[r];return t},t.insertRules=function(e,t){if(e>=this.groupSizes.length){for(var r=this.groupSizes,n=r.length,a=n;e>=a;)(a<<=1)<0&&E(16,""+e);this.groupSizes=new Uint32Array(a),this.groupSizes.set(r),this.length=a;for(var o=n;o<a;o++)this.groupSizes[o]=0}for(var i=this.indexOfGroup(e+1),s=0,c=t.length;s<c;s++)this.tag.insertRule(i,t[s])&&(this.groupSizes[e]++,i++)},t.clearGroup=function(e){if(e<this.length){var t=this.groupSizes[e],r=this.indexOfGroup(e),n=r+t;this.groupSizes[e]=0;for(var a=r;a<n;a++)this.tag.deleteRule(r)}},t.getGroup=function(e){var t="";if(e>=this.length||0===this.groupSizes[e])return t;for(var r=this.groupSizes[e],n=this.indexOfGroup(e),a=n+r,o=n;o<a;o++)t+=this.tag.getRule(o)+"/*!sc*/\n";return t},e}(),R=new Map,O=new Map,I=1,_=function(e){if(R.has(e))return R.get(e);for(;O.has(I);)I++;var t=I++;return R.set(e,t),O.set(t,e),t},j=function(e){return O.get(e)},T=function(e,t){t>=I&&(I=t+1),R.set(e,t),O.set(t,e)},z="style["+C+'][data-styled-version="5.3.9"]',$=new RegExp("^"+C+'\\.g(\\d+)\\[id="([\\w\\d-]+)"\\].*?"([^"]*)'),N=function(e,t,r){for(var n,a=r.split(","),o=0,i=a.length;o<i;o++)(n=a[o])&&e.registerName(t,n)},M=function(e,t){for(var r=(t.textContent||"").split("/*!sc*/\n"),n=[],a=0,o=r.length;a<o;a++){var i=r[a].trim();if(i){var s=i.match($);if(s){var c=0|parseInt(s[1],10),l=s[2];0!==c&&(T(l,c),N(e,l,s[3]),e.getTag().insertRules(c,n)),n.length=0}else n.push(i)}}},B=function(){return r.nc},D=function(e){var t=document.head,r=e||t,n=document.createElement("style"),a=function(e){for(var t=e.childNodes,r=t.length;r>=0;r--){var n=t[r];if(n&&1===n.nodeType&&n.hasAttribute(C))return n}}(r),o=void 0!==a?a.nextSibling:null;n.setAttribute(C,"active"),n.setAttribute("data-styled-version","5.3.9");var i=B();return i&&n.setAttribute("nonce",i),r.insertBefore(n,o),n},F=function(){function e(e){var t=this.element=D(e);t.appendChild(document.createTextNode("")),this.sheet=function(e){if(e.sheet)return e.sheet;for(var t=document.styleSheets,r=0,n=t.length;r<n;r++){var a=t[r];if(a.ownerNode===e)return a}E(17)}(t),this.length=0}var t=e.prototype;return t.insertRule=function(e,t){try{return this.sheet.insertRule(t,e),this.length++,!0}catch(e){return!1}},t.deleteRule=function(e){this.sheet.deleteRule(e),this.length--},t.getRule=function(e){var t=this.sheet.cssRules[e];return void 0!==t&&"string"==typeof t.cssText?t.cssText:""},e}(),L=function(){function e(e){var t=this.element=D(e);this.nodes=t.childNodes,this.length=0}var t=e.prototype;return t.insertRule=function(e,t){if(e<=this.length&&e>=0){var r=document.createTextNode(t),n=this.nodes[e];return this.element.insertBefore(r,n||null),this.length++,!0}return!1},t.deleteRule=function(e){this.element.removeChild(this.nodes[e]),this.length--},t.getRule=function(e){return e<this.length?this.nodes[e].textContent:""},e}(),H=function(){function e(e){this.rules=[],this.length=0}var t=e.prototype;return t.insertRule=function(e,t){return e<=this.length&&(this.rules.splice(e,0,t),this.length++,!0)},t.deleteRule=function(e){this.rules.splice(e,1),this.length--},t.getRule=function(e){return e<this.length?this.rules[e]:""},e}(),G=A,V={isServer:!A,useCSSOMInjection:!x},Y=function(){function e(e,t,r){void 0===e&&(e=b),void 0===t&&(t={}),this.options=m({},V,{},e),this.gs=t,this.names=new Map(r),this.server=!!e.isServer,!this.server&&A&&G&&(G=!1,function(e){for(var t=document.querySelectorAll(z),r=0,n=t.length;r<n;r++){var a=t[r];a&&"active"!==a.getAttribute(C)&&(M(e,a),a.parentNode&&a.parentNode.removeChild(a))}}(this))}e.registerId=function(e){return _(e)};var t=e.prototype;return t.reconstructWithOptions=function(t,r){return void 0===r&&(r=!0),new e(m({},this.options,{},t),this.gs,r&&this.names||void 0)},t.allocateGSInstance=function(e){return this.gs[e]=(this.gs[e]||0)+1},t.getTag=function(){return this.tag||(this.tag=(r=(t=this.options).isServer,n=t.useCSSOMInjection,a=t.target,e=r?new H(a):n?new F(a):new L(a),new P(e)));var e,t,r,n,a},t.hasNameForId=function(e,t){return this.names.has(e)&&this.names.get(e).has(t)},t.registerName=function(e,t){if(_(e),this.names.has(e))this.names.get(e).add(t);else{var r=new Set;r.add(t),this.names.set(e,r)}},t.insertRules=function(e,t,r){this.registerName(e,t),this.getTag().insertRules(_(e),r)},t.clearNames=function(e){this.names.has(e)&&this.names.get(e).clear()},t.clearRules=function(e){this.getTag().clearGroup(_(e)),this.clearNames(e)},t.clearTag=function(){this.tag=void 0},t.toString=function(){return function(e){for(var t=e.getTag(),r=t.length,n="",a=0;a<r;a++){var o=j(a);if(void 0!==o){var i=e.names.get(o),s=t.getGroup(a);if(i&&s&&i.size){var c=C+".g"+a+'[id="'+o+'"]',l="";void 0!==i&&i.forEach((function(e){e.length>0&&(l+=e+",")})),n+=""+s+c+'{content:"'+l+'"}/*!sc*/\n'}}}return n}(this)},e}(),U=/(a)(d)/gi,W=function(e){return String.fromCharCode(e+(e>25?39:97))};function q(e){var t,r="";for(t=Math.abs(e);t>52;t=t/52|0)r=W(t%52)+r;return(W(t%52)+r).replace(U,"$1-$2")}var X=function(e,t){for(var r=t.length;r;)e=33*e^t.charCodeAt(--r);return e},Z=function(e){return X(5381,e)};function J(e){for(var t=0;t<e.length;t+=1){var r=e[t];if(w(r)&&!k(r))return!1}return!0}var K=Z("5.3.9"),Q=function(){function e(e,t,r){this.rules=e,this.staticRulesId="",this.isStatic=(void 0===r||r.isStatic)&&J(e),this.componentId=t,this.baseHash=X(K,t),this.baseStyle=r,Y.registerId(t)}return e.prototype.generateAndInjectStyles=function(e,t,r){var n=this.componentId,a=[];if(this.baseStyle&&a.push(this.baseStyle.generateAndInjectStyles(e,t,r)),this.isStatic&&!r.hash)if(this.staticRulesId&&t.hasNameForId(n,this.staticRulesId))a.push(this.staticRulesId);else{var o=ge(this.rules,e,t,r).join(""),i=q(X(this.baseHash,o)>>>0);if(!t.hasNameForId(n,i)){var s=r(o,"."+i,void 0,n);t.insertRules(n,i,s)}a.push(i),this.staticRulesId=i}else{for(var c=this.rules.length,l=X(this.baseHash,r.hash),u="",f=0;f<c;f++){var d=this.rules[f];if("string"==typeof d)u+=d;else if(d){var p=ge(d,e,t,r),h=Array.isArray(p)?p.join(""):p;l=X(l,h+f),u+=h}}if(u){var m=q(l>>>0);if(!t.hasNameForId(n,m)){var g=r(u,"."+m,void 0,n);t.insertRules(n,m,g)}a.push(m)}}return a.join(" ")},e}(),ee=/^\s*\/\/.*$/gm,te=[":","[",".","#"];function re(e){var t,r,n,a,o=void 0===e?b:e,i=o.options,s=void 0===i?b:i,c=o.plugins,u=void 0===c?y:c,f=new l(s),d=[],p=function(e){function t(t){if(t)try{e(t+"}")}catch(e){}}return function(r,n,a,o,i,s,c,l,u,f){switch(r){case 1:if(0===u&&64===n.charCodeAt(0))return e(n+";"),"";break;case 2:if(0===l)return n+"/*|*/";break;case 3:switch(l){case 102:case 112:return e(a[0]+n),"";default:return n+(0===f?"/*|*/":"")}case-2:n.split("/*|*/}").forEach(t)}}}((function(e){d.push(e)})),h=function(e,n,o){return 0===n&&-1!==te.indexOf(o[r.length])||o.match(a)?e:"."+t};function m(e,o,i,s){void 0===s&&(s="&");var c=e.replace(ee,""),l=o&&i?i+" "+o+" { "+c+" }":c;return t=s,r=o,n=new RegExp("\\"+r+"\\b","g"),a=new RegExp("(\\"+r+"\\b){2,}"),f(i||!o?"":o,l)}return f.use([].concat(u,[function(e,t,a){2===e&&a.length&&a[0].lastIndexOf(r)>0&&(a[0]=a[0].replace(n,h))},p,function(e){if(-2===e){var t=d;return d=[],t}}])),m.hash=u.length?u.reduce((function(e,t){return t.name||E(15),X(e,t.name)}),5381).toString():"",m}var ne=i().createContext(),ae=(ne.Consumer,i().createContext()),oe=(ae.Consumer,new Y),ie=re();function se(){return(0,o.useContext)(ne)||oe}function ce(e){var t=(0,o.useState)(e.stylisPlugins),r=t[0],n=t[1],a=se(),s=(0,o.useMemo)((function(){var t=a;return e.sheet?t=e.sheet:e.target&&(t=t.reconstructWithOptions({target:e.target},!1)),e.disableCSSOMInjection&&(t=t.reconstructWithOptions({useCSSOMInjection:!1})),t}),[e.disableCSSOMInjection,e.sheet,e.target]),l=(0,o.useMemo)((function(){return re({options:{prefix:!e.disableVendorPrefixes},plugins:r})}),[e.disableVendorPrefixes,r]);return(0,o.useEffect)((function(){c()(r,e.stylisPlugins)||n(e.stylisPlugins)}),[e.stylisPlugins]),i().createElement(ne.Provider,{value:s},i().createElement(ae.Provider,{value:l},e.children))}var le=function(){function e(e,t){var r=this;this.inject=function(e,t){void 0===t&&(t=ie);var n=r.name+t.hash;e.hasNameForId(r.id,n)||e.insertRules(r.id,n,t(r.rules,n,"@keyframes"))},this.toString=function(){return E(12,String(r.name))},this.name=e,this.id="sc-keyframes-"+e,this.rules=t}return e.prototype.getName=function(e){return void 0===e&&(e=ie),this.name+e.hash},e}(),ue=/([A-Z])/,fe=/([A-Z])/g,de=/^ms-/,pe=function(e){return"-"+e.toLowerCase()};function he(e){return ue.test(e)?e.replace(fe,pe).replace(de,"-ms-"):e}var me=function(e){return null==e||!1===e||""===e};function ge(e,t,r,n){if(Array.isArray(e)){for(var a,o=[],i=0,s=e.length;i<s;i+=1)""!==(a=ge(e[i],t,r,n))&&(Array.isArray(a)?o.push.apply(o,a):o.push(a));return o}return me(e)?"":k(e)?"."+e.styledComponentId:w(e)?"function"!=typeof(c=e)||c.prototype&&c.prototype.isReactComponent||!t?e:ge(e(t),t,r,n):e instanceof le?r?(e.inject(r,n),e.getName(n)):e:v(e)?function e(t,r){var n,a,o=[];for(var i in t)t.hasOwnProperty(i)&&!me(t[i])&&(Array.isArray(t[i])&&t[i].isCss||w(t[i])?o.push(he(i)+":",t[i],";"):v(t[i])?o.push.apply(o,e(t[i],i)):o.push(he(i)+": "+(n=i,(null==(a=t[i])||"boolean"==typeof a||""===a?"":"number"!=typeof a||0===a||n in u?String(a).trim():a+"px")+";")));return r?[r+" {"].concat(o,["}"]):o}(e):e.toString();var c}var ve=function(e){return Array.isArray(e)&&(e.isCss=!0),e};function ye(e){for(var t=arguments.length,r=new Array(t>1?t-1:0),n=1;n<t;n++)r[n-1]=arguments[n];return w(e)||v(e)?ve(ge(g(y,[e].concat(r)))):0===r.length&&1===e.length&&"string"==typeof e[0]?e:ve(ge(g(e,r)))}new Set;var be=/[!"#$%&'()*+,./:;<=>?@[\\\]^`{|}~-]+/g,we=/(^-|-$)/g;function Se(e){return e.replace(be,"-").replace(we,"")}function ke(e){return"string"==typeof e&&!0}var Ce=function(e){return"function"==typeof e||"object"==typeof e&&null!==e&&!Array.isArray(e)},Ae=function(e){return"__proto__"!==e&&"constructor"!==e&&"prototype"!==e};function xe(e,t,r){var n=e[r];Ce(t)&&Ce(n)?Ee(n,t):e[r]=t}function Ee(e){for(var t=arguments.length,r=new Array(t>1?t-1:0),n=1;n<t;n++)r[n-1]=arguments[n];for(var a=0,o=r;a<o.length;a++){var i=o[a];if(Ce(i))for(var s in i)Ae(s)&&xe(e,i[s],s)}return e}var Pe=i().createContext();Pe.Consumer;var Re={};function Oe(e,t,r){var n=k(e),a=!ke(e),s=t.attrs,c=void 0===s?y:s,l=t.componentId,u=void 0===l?function(e,t){var r="string"!=typeof e?"sc":Se(e);Re[r]=(Re[r]||0)+1;var n=r+"-"+function(e){return q(Z(e)>>>0)}("5.3.9"+r+Re[r]);return t?t+"-"+n:n}(t.displayName,t.parentComponentId):l,f=t.displayName,p=void 0===f?function(e){return ke(e)?"styled."+e:"Styled("+S(e)+")"}(e):f,g=t.displayName&&t.componentId?Se(t.displayName)+"-"+t.componentId:t.componentId||u,v=n&&e.attrs?Array.prototype.concat(e.attrs,c).filter(Boolean):c,C=t.shouldForwardProp;n&&e.shouldForwardProp&&(C=t.shouldForwardProp?function(r,n,a){return e.shouldForwardProp(r,n,a)&&t.shouldForwardProp(r,n,a)}:e.shouldForwardProp);var A,x=new Q(r,g,n?e.componentStyle:void 0),E=x.isStatic&&0===c.length,P=function(e,t){return function(e,t,r,n){var a=e.attrs,i=e.componentStyle,s=e.defaultProps,c=e.foldedComponentIds,l=e.shouldForwardProp,u=e.styledComponentId,f=e.target,p=function(e,t,r){void 0===e&&(e=b);var n=m({},t,{theme:e}),a={};return r.forEach((function(e){var t,r,o,i=e;for(t in w(i)&&(i=i(n)),i)n[t]=a[t]="className"===t?(r=a[t],o=i[t],r&&o?r+" "+o:r||o):i[t]})),[n,a]}(function(e,t,r){return void 0===r&&(r=b),e.theme!==r.theme&&e.theme||t||r.theme}(t,(0,o.useContext)(Pe),s)||b,t,a),h=p[0],g=p[1],v=function(e,t,r,n){var a=se(),i=(0,o.useContext)(ae)||ie;return t?e.generateAndInjectStyles(b,a,i):e.generateAndInjectStyles(r,a,i)}(i,n,h),y=r,S=g.$as||t.$as||g.as||t.as||f,k=ke(S),C=g!==t?m({},t,{},g):t,A={};for(var x in C)"$"!==x[0]&&"as"!==x&&("forwardedAs"===x?A.as=C[x]:(l?l(x,d,S):!k||d(x))&&(A[x]=C[x]));return t.style&&g.style!==t.style&&(A.style=m({},t.style,{},g.style)),A.className=Array.prototype.concat(c,u,v!==u?v:null,t.className,g.className).filter(Boolean).join(" "),A.ref=y,(0,o.createElement)(S,A)}(A,e,t,E)};return P.displayName=p,(A=i().forwardRef(P)).attrs=v,A.componentStyle=x,A.displayName=p,A.shouldForwardProp=C,A.foldedComponentIds=n?Array.prototype.concat(e.foldedComponentIds,e.styledComponentId):y,A.styledComponentId=g,A.target=n?e.target:e,A.withComponent=function(e){var n=t.componentId,a=function(e,t){if(null==e)return{};var r,n,a={},o=Object.keys(e);for(n=0;n<o.length;n++)r=o[n],t.indexOf(r)>=0||(a[r]=e[r]);return a}(t,["componentId"]),o=n&&n+"-"+(ke(e)?e:Se(S(e)));return Oe(e,m({},a,{attrs:v,componentId:o}),r)},Object.defineProperty(A,"defaultProps",{get:function(){return this._foldedDefaultProps},set:function(t){this._foldedDefaultProps=n?Ee({},e.defaultProps,t):t}}),Object.defineProperty(A,"toString",{value:function(){return"."+A.styledComponentId}}),a&&h()(A,e,{attrs:!0,componentStyle:!0,displayName:!0,foldedComponentIds:!0,shouldForwardProp:!0,styledComponentId:!0,target:!0,withComponent:!0}),A}var Ie,_e=function(e){return function e(t,r,n){if(void 0===n&&(n=b),!(0,a.isValidElementType)(r))return E(1,String(r));var o=function(){return t(r,n,ye.apply(void 0,arguments))};return o.withConfig=function(a){return e(t,r,m({},n,{},a))},o.attrs=function(a){return e(t,r,m({},n,{attrs:Array.prototype.concat(n.attrs,a).filter(Boolean)}))},o}(Oe,e)};["a","abbr","address","area","article","aside","audio","b","base","bdi","bdo","big","blockquote","body","br","button","canvas","caption","cite","code","col","colgroup","data","datalist","dd","del","details","dfn","dialog","div","dl","dt","em","embed","fieldset","figcaption","figure","footer","form","h1","h2","h3","h4","h5","h6","head","header","hgroup","hr","html","i","iframe","img","input","ins","kbd","keygen","label","legend","li","link","main","map","mark","marquee","menu","menuitem","meta","meter","nav","noscript","object","ol","optgroup","option","output","p","param","picture","pre","progress","q","rp","rt","ruby","s","samp","script","section","select","small","source","span","strong","style","sub","summary","sup","table","tbody","td","textarea","tfoot","th","thead","time","title","tr","track","u","ul","var","video","wbr","circle","clipPath","defs","ellipse","foreignObject","g","image","line","linearGradient","marker","mask","path","pattern","polygon","polyline","radialGradient","rect","stop","svg","text","textPath","tspan"].forEach((function(e){_e[e]=_e(e)})),(Ie=function(e,t){this.rules=e,this.componentId=t,this.isStatic=J(e),Y.registerId(this.componentId+1)}.prototype).createStyles=function(e,t,r,n){var a=n(ge(this.rules,t,r,n).join(""),""),o=this.componentId+e;r.insertRules(o,o,a)},Ie.removeStyles=function(e,t){t.clearRules(this.componentId+e)},Ie.renderStyles=function(e,t,r,n){e>2&&Y.registerId(this.componentId+e),this.removeStyles(e,r),this.createStyles(e,t,r,n)},function(){var e=function(){var e=this;this._emitSheetCSS=function(){var t=e.instance.toString();if(!t)return"";var r=B();return"<style "+[r&&'nonce="'+r+'"',C+'="true"','data-styled-version="5.3.9"'].filter(Boolean).join(" ")+">"+t+"</style>"},this.getStyleTags=function(){return e.sealed?E(2):e._emitSheetCSS()},this.getStyleElement=function(){var t;if(e.sealed)return E(2);var r=((t={})[C]="",t["data-styled-version"]="5.3.9",t.dangerouslySetInnerHTML={__html:e.instance.toString()},t),n=B();return n&&(r.nonce=n),[i().createElement("style",m({},r,{key:"sc-0-0"}))]},this.seal=function(){e.sealed=!0},this.instance=new Y({isServer:!0}),this.sealed=!1}.prototype;e.collectStyles=function(e){return this.sealed?E(2):i().createElement(ce,{sheet:this.instance},e)},e.interleaveWithNodeStream=function(e){return E(3)}}();const je=_e,Te=window.wp.blockEditor,ze=window.wp.components,$e=window.wp.element,Ne=window.wp.primitives,Me=(0,$e.createElement)(Ne.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,$e.createElement)(Ne.Path,{d:"M5 15h14V9H5v6zm0 4.8h14v-1.5H5v1.5zM5 4.2v1.5h14V4.2H5z"})),Be=(0,$e.createElement)(Ne.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,$e.createElement)(Ne.Path,{d:"M4 9v6h14V9H4zm8-4.8H4v1.5h8V4.2zM4 19.8h8v-1.5H4v1.5z"})),De=(0,$e.createElement)(Ne.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,$e.createElement)(Ne.Path,{d:"M7 9v6h10V9H7zM5 19.8h14v-1.5H5v1.5zM5 4.3v1.5h14V4.3H5z"})),Fe=(0,$e.createElement)(Ne.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,$e.createElement)(Ne.Path,{d:"M6 15h14V9H6v6zm6-10.8v1.5h8V4.2h-8zm0 15.6h8v-1.5h-8v1.5z"})),Le=(window.wp.data,window.wp.i18n),He=function(e){var t=e.attributes,r=e.setAttributes,n=t.color,a=t.align;return React.createElement(Te.InspectorControls,null,React.createElement(ze.PanelBody,{initialOpen:!0,title:"Settings"},React.createElement(ze.BaseControl,{label:(0,Le.__)("Alignment","solo-blocks")},React.createElement(ze.ButtonGroup,null,React.createElement(ze.Button,{variant:"none"===a?"primary":"",icon:Me,onClick:function(){return r({align:"none"})}}),React.createElement(ze.Button,{variant:"left"===a?"primary":"",icon:Be,onClick:function(){return r({align:"left"})}}),React.createElement(ze.Button,{variant:"center"===a?"primary":"",icon:De,onClick:function(){return r({align:"center"})}}),React.createElement(ze.Button,{variant:"right"===a?"primary":"",icon:Fe,onClick:function(){return r({align:"right"})}}))),React.createElement(Te.PanelColorSettings,{title:(0,Le.__)("Color settings","solo-blocks"),initialOpen:!1,__experimentalIsRenderedInSidebar:!0,colorSettings:[{value:n,onChange:function(e){return r({color:e})},label:(0,Le.__)("Color","solo-blocks")}]})))};var Ge;function Ve(){return Ve=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},Ve.apply(this,arguments)}var Ye,Ue,We=je.div.attrs((function(e){return{style:{"--color":e.attributes.color}}}))(Ge||(Ye=[""],Ue||(Ue=Ye.slice(0)),Ge=Object.freeze(Object.defineProperties(Ye,{raw:{value:Object.freeze(Ue)}}))));const qe=JSON.parse('{"u2":"sb/search","TN":"SB search"}');var Xe={icon:React.createElement("div",{className:"slug"},React.createElement("span",{className:"sb-block-editor-icon sb_icon_".concat(qe.u2.split("/")[1])})),edit:function(e){var t=e.attributes,r=(e.setAttributes,e.clientId,e.isSelected,t.align),a=(0,Te.useBlockProps)({className:n()({"has-alignment":"none"!==r},["align".concat(r),"sb-search"])});return React.createElement(React.Fragment,null,React.createElement(He,e),React.createElement(Te.InspectorControls,null),React.createElement(We,Ve({},a,{attributes:t}),React.createElement("div",{class:"sb-search_icon"},React.createElement("i",null)),React.createElement("div",{class:"sb-search_inner"},React.createElement("form",{role:"search",method:"get",className:"search-form",action:"#"},React.createElement("label",null,React.createElement("span",{className:"screen-reader-text"},__("Search for","solo-blocks")),React.createElement("input",{type:"search",className:"search-field",placeholder:__("Search &hellip;"),value:"",name:"s"})),React.createElement("input",{type:"submit",className:"search-submit",value:__("Search","solo-blocks")})))))},save:function(){return null}};(0,e.registerBlockType)({name:qe.u2,title:qe.TN},Xe)})()})();