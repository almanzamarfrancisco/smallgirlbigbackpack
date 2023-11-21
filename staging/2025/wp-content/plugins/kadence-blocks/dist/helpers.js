(()=>{"use strict";var e={n:n=>{var t=n&&n.__esModule?()=>n.default:()=>n;return e.d(t,{a:t}),t},d:(n,t)=>{for(var i in t)e.o(t,i)&&!e.o(n,i)&&Object.defineProperty(n,i,{enumerable:!0,get:t[i]})},o:(e,n)=>Object.prototype.hasOwnProperty.call(e,n),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},n={};e.r(n),e.d(n,{ConvertColor:()=>w,DeprecatedKadenceColorOutput:()=>M,FONT_SIZES_MAP:()=>B,GAP_SIZES_MAP:()=>F,KadenceColorOutput:()=>l,SPACING_SIZES_MAP:()=>C,SafeParseJSON:()=>X,advancedGetPreviewSize:()=>z,capitalizeFirstLetter:()=>T,clearNonMatchingValues:()=>te,fetchJson:()=>N,getBorderColor:()=>k,getBorderStyle:()=>f,getBorderWidth:()=>y,getFontSizeOptionOutput:()=>H,getGapSizeOptionOutput:()=>ie,getInQueryBlock:()=>J,getPostOrFseId:()=>ue,getPostOrWidgetId:()=>le,getPreviewSize:()=>i,getSpacingNameFromSize:()=>$,getSpacingOptionName:()=>Q,getSpacingOptionOutput:()=>R,getSpacingOptionSize:()=>Y,getSpacingValueFromSize:()=>ee,getTransferableAttributes:()=>U,getUniqueId:()=>E,getUnitIcon:()=>P,hashString:()=>re,hexToRGBA:()=>o,isRTL:()=>A,linkedOrIndividual:()=>q,mouseOverVisualizer:()=>K,objectSameFill:()=>ne,setBlockDefaults:()=>W,setDynamicState:()=>Z,showSettings:()=>x,typographyStyle:()=>G});const t=window.wp.element,i=(e,n,i,o)=>(0,t.useMemo)((()=>{if("Mobile"===e){if(void 0!==o&&""!==o&&null!==o)return o;if(void 0!==i&&""!==i&&null!==i)return i}else if("Tablet"===e&&void 0!==i&&""!==i&&null!==i)return i;return void 0!==n?n:""}),[e,n,i,o]),o=(e,n)=>null===e?"":(e.indexOf("var(")>-1&&(e=window.getComputedStyle(document.documentElement).getPropertyValue(e.replace("var(","").replace(")",""))||"#fff"),e=e.replace("#",""),"rgba("+parseInt(3===e.length?e.slice(0,1).repeat(2):e.slice(0,2),16)+", "+parseInt(3===e.length?e.slice(1,2).repeat(2):e.slice(2,4),16)+", "+parseInt(3===e.length?e.slice(2,3).repeat(2):e.slice(4,6),16)+", "+n+")");function l(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;return e&&e.startsWith("palette")?e="var(--global-"+e+")":null===n||isNaN(n)||1===Number(n)||void 0===e||""===e||(e=o(e,n)),e}function r(e,n,t){return u(e,n,void 0!==t?.[0]?t?.[0]:[],void 0!==t?.[1]?t?.[1]:[],void 0!==t?.[2]?t?.[2]:[])}function u(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",t=arguments.length>2?arguments[2]:void 0,i=arguments.length>3?arguments[3]:void 0,o=arguments.length>4?arguments[4]:void 0,u=arguments.length>5&&void 0!==arguments[5]&&arguments[5];if("Mobile"===e){if(void 0!==o?.[0]?.[n]?.[0]&&""!==o?.[0]?.[n]?.[0])return l(o?.[0]?.[n]?.[0]);if(""!==i?.[0]?.[n]?.[0])return l(i?.[0]?.[n]?.[0]);if(u&&r(e,n,u))return r(e,n,u)}else if("Tablet"===e){if(void 0!==i?.[0]?.[n]?.[0]&&""!==i?.[0]?.[n]?.[0])return l(i?.[0]?.[n]?.[0]);if(u&&r(e,n,u))return r(e,n,u)}return void 0!==t?.[0]?.[n]?.[0]&&""!==t?.[0]?.[n]?.[0]?l(t?.[0]?.[n]?.[0]):u&&r(e,n,u)?r(e,n,u):""}function a(e,n,t){return d(e,n,void 0!==t?.[0]?t?.[0]:[],void 0!==t?.[1]?t?.[1]:[],void 0!==t?.[2]?t?.[2]:[])}function d(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",t=arguments.length>2?arguments[2]:void 0,i=arguments.length>3?arguments[3]:void 0,o=arguments.length>4?arguments[4]:void 0,l=arguments.length>5&&void 0!==arguments[5]&&arguments[5];if("Mobile"===e){if(void 0!==o?.[0]?.[n]?.[1]&&""!==o?.[0]?.[n]?.[1])return o?.[0]?.[n]?.[1];if(""!==i?.[0]?.[n]?.[1])return i?.[0]?.[n]?.[1];if(l&&a(e,n,l))return a(e,n,l)}else if("Tablet"===e){if(void 0!==i?.[0]?.[n]?.[1]&&""!==i?.[0]?.[n]?.[1])return i?.[0]?.[n]?.[1];if(l&&a(e,n,l))return a(e,n,l)}return void 0!==t?.[0]?.[n]?.[1]&&""!==t?.[0]?.[n]?.[1]?t?.[0]?.[n]?.[1]:l&&a(e,n,l)?a(e,n,l):""}function c(e,n,t){return v(e,n,void 0!==t?.[0]?t?.[0]:[],void 0!==t?.[1]?t?.[1]:[],void 0!==t?.[2]?t?.[2]:[])}function v(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",t=arguments.length>2?arguments[2]:void 0,i=arguments.length>3?arguments[3]:void 0,o=arguments.length>4?arguments[4]:void 0,l=arguments.length>5&&void 0!==arguments[5]&&arguments[5];if("Mobile"===e){if(void 0!==o?.[0]?.[n]?.[2]&&""!==o?.[0]?.[n]?.[2])return o?.[0]?.[n]?.[2]+g(e,t,i,o,l);if(""!==i?.[0]?.[n]?.[2])return i?.[0]?.[n]?.[2]+g(e,t,i,o,l);if(l&&c(e,n,l))return c(e,n,l)}else if("Tablet"===e){if(void 0!==i?.[0]?.[n]?.[2]&&""!==i?.[0]?.[n]?.[2])return i?.[0]?.[n]?.[2]+g(e,t,i,o,l);if(l&&c(e,n,l))return c(e,n,l)}return void 0!==t?.[0]?.[n]?.[2]&&""!==t?.[0]?.[n]?.[2]?t?.[0]?.[n]?.[2]+g(e,t,i,o,l):l&&c(e,n,l)?c(e,n,l):""}function s(e,n){return g(e,void 0!==n?.[0]?n?.[0]:[],void 0!==n?.[1]?n?.[1]:[],void 0!==n?.[2]?n?.[2]:[])}function g(e,n,t,i){let o=arguments.length>4&&void 0!==arguments[4]&&arguments[4];if("Mobile"===e){if(void 0!==i?.[0]?.unit&&""!==i?.[0]?.unit)return i[0].unit;if(void 0!==t?.[0]?.unit&&""!==t?.[0]?.unit)return t[0].unit;if(o&&s(e,o))return s(e,o)}else if("Tablet"===e){if(void 0!==t?.[0]?.unit&&""!==t?.[0]?.unit)return t[0].unit;if(o&&s(e,o))return s(e,o)}return void 0!==n?.[0]?.unit&&""!==n?.[0]?.unit?n[0].unit:o&&s(e,o)?s(e,o):"px"}const f=function(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",i=arguments.length>2?arguments[2]:void 0,o=arguments.length>3?arguments[3]:void 0,l=arguments.length>4?arguments[4]:void 0,r=arguments.length>5&&void 0!==arguments[5]&&arguments[5];return(0,t.useMemo)((()=>{const t=v(e,n,i,o,l,r);if(!t)return"";let a=u(e,n,i,o,l,r);a||(a="transparent");let c=d(e,n,i,o,l,r);return c||(c="solid"),t+" "+c+" "+a}),[e,n,i,o,l,r])};function b(e,n,t){return p(e,n,void 0!==t?.[0]?t?.[0]:[],void 0!==t?.[1]?t?.[1]:[],void 0!==t?.[2]?t?.[2]:[])}function p(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",t=arguments.length>2?arguments[2]:void 0,i=arguments.length>3?arguments[3]:void 0,o=arguments.length>4?arguments[4]:void 0,r=arguments.length>5&&void 0!==arguments[5]&&arguments[5];if("Mobile"===e){if(""!==o?.[0]?.[n]?.[0])return l(o?.[0]?.[n]?.[0]);if(""!==i?.[0]?.[n]?.[0])return l(i?.[0]?.[n]?.[0]);if(r&&b(e,n,r))return b(e,n,r)}else if("Tablet"===e){if(""!==i?.[0]?.[n]?.[0])return l(i?.[0]?.[n]?.[0]);if(r&&b(e,n,r))return b(e,n,r)}return""!==t?.[0]?.[n]?.[0]?l(t?.[0]?.[n]?.[0]):r&&b(e,n,r)?b(e,n,r):""}const k=function(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",i=arguments.length>2?arguments[2]:void 0,o=arguments.length>3?arguments[3]:void 0,l=arguments.length>4?arguments[4]:void 0,r=arguments.length>5&&void 0!==arguments[5]&&arguments[5];return(0,t.useMemo)((()=>p(e,n,i,o,l,r)||""),[e,n,i,o,l,r])};function m(e,n,t){return _(e,n,void 0!==(null==t?void 0:t[0])?null==t?void 0:t[0]:[],void 0!==(null==t?void 0:t[1])?null==t?void 0:t[1]:[],void 0!==(null==t?void 0:t[2])?null==t?void 0:t[2]:[])}function _(e){var n,t,i,o;let l=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",r=arguments.length>2?arguments[2]:void 0,u=arguments.length>3?arguments[3]:void 0,a=arguments.length>4?arguments[4]:void 0,d=arguments.length>5&&void 0!==arguments[5]&&arguments[5];if("Mobile"===e){var c,v,s,g,f,b,p,k,_,h;if(void 0!==(null==a||null===(c=a[0])||void 0===c||null===(v=c[l])||void 0===v?void 0:v[2])&&""!==(null==a||null===(s=a[0])||void 0===s||null===(g=s[l])||void 0===g?void 0:g[2]))return(null==a||null===(p=a[0])||void 0===p||null===(k=p[l])||void 0===k?void 0:k[2])+S(e,r,u,a,d);if(""!==(null==u||null===(f=u[0])||void 0===f||null===(b=f[l])||void 0===b?void 0:b[2]))return(null==u||null===(_=u[0])||void 0===_||null===(h=_[l])||void 0===h?void 0:h[2])+S(e,r,u,a,d);if(d&&m(e,l,d))return m(e,l,d)}else if("Tablet"===e){var y,z,x,w,M,O;if(void 0!==(null==u||null===(y=u[0])||void 0===y||null===(z=y[l])||void 0===z?void 0:z[2])&&""!==(null==u||null===(x=u[0])||void 0===x||null===(w=x[l])||void 0===w?void 0:w[2]))return(null==u||null===(M=u[0])||void 0===M||null===(O=M[l])||void 0===O?void 0:O[2])+S(e,r,u,a,d);if(d&&m(e,l,d))return m(e,l,d)}var I,L;return void 0!==(null==r||null===(n=r[0])||void 0===n||null===(t=n[l])||void 0===t?void 0:t[2])&&""!==(null==r||null===(i=r[0])||void 0===i||null===(o=i[l])||void 0===o?void 0:o[2])?(null==r||null===(I=r[0])||void 0===I||null===(L=I[l])||void 0===L?void 0:L[2])+S(e,r,u,a,d):d&&m(e,l,d)?m(e,l,d):""}function h(e,n){return S(e,void 0!==(null==n?void 0:n[0])?null==n?void 0:n[0]:[],void 0!==(null==n?void 0:n[1])?null==n?void 0:n[1]:[],void 0!==(null==n?void 0:n[2])?null==n?void 0:n[2]:[])}function S(e,n,t,i){var o,l;let r=arguments.length>4&&void 0!==arguments[4]&&arguments[4];if("Mobile"===e){var u,a,d,c;if(void 0!==(null==i||null===(u=i[0])||void 0===u?void 0:u.unit)&&""!==(null==i||null===(a=i[0])||void 0===a?void 0:a.unit))return i[0].unit;if(void 0!==(null==t||null===(d=t[0])||void 0===d?void 0:d.unit)&&""!==(null==t||null===(c=t[0])||void 0===c?void 0:c.unit))return t[0].unit;if(r&&h(e,r))return h(e,r)}else if("Tablet"===e){var v,s;if(void 0!==(null==t||null===(v=t[0])||void 0===v?void 0:v.unit)&&""!==(null==t||null===(s=t[0])||void 0===s?void 0:s.unit))return t[0].unit;if(r&&h(e,r))return h(e,r)}return void 0!==(null==n||null===(o=n[0])||void 0===o?void 0:o.unit)&&""!==(null==n||null===(l=n[0])||void 0===l?void 0:l.unit)?n[0].unit:r&&h(e,r)?h(e,r):"px"}const y=function(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",i=arguments.length>2?arguments[2]:void 0,o=arguments.length>3?arguments[3]:void 0,l=arguments.length>4?arguments[4]:void 0,r=arguments.length>5&&void 0!==arguments[5]&&arguments[5];return(0,t.useMemo)((()=>_(e,n,i,o,l,r)||""),[e,n,i,o,l,r])},z=(e,n,t,i,o)=>{const l=void 0!==t[n]?t[n]:"",r=void 0!==i[n]?i[n]:"",u=void 0!==o[n]?o[n]:"";if("Mobile"===e){if(void 0!==u&&""!==u&&null!==u)return u;if(void 0!==r&&""!==r&&null!==r)return r}else if("Tablet"===e&&void 0!==r&&""!==r&&null!==r)return r;return l},x=function(e,n){let t=!(arguments.length>2&&void 0!==arguments[2])||arguments[2];const i=kadence_blocks_params.settings?JSON.parse(kadence_blocks_params.settings):{};let o={};void 0!==i[n]&&"object"==typeof i[n]&&(o=i[n]);const l=kadence_blocks_params.userrole?kadence_blocks_params.userrole:"admin";return void 0===o[e]?t:"all"===o[e]||"contributor"===o[e]&&("contributor"===l||"author"===l||"editor"===l||"admin"===l)||"author"===o[e]&&("author"===l||"editor"===l||"admin"===l)||"editor"===o[e]&&("editor"===l||"admin"===l)||"admin"===o[e]&&"admin"===l};function w(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;return e&&e.startsWith("palette")||null===n||isNaN(n)||1===Number(n)||void 0===e||""===e||(e=o(e,n)),e}function M(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;return e&&e.startsWith("palette")?e="var(--global-"+e+")":null===n||isNaN(n)||1===Number(n)||void 0===e||""===e||(e=o(e,n)),e}const O=window.lodash,I=window.wp.apiFetch;var L=e.n(I);const N=function(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:["x-wp-totalpages"];return new Promise((t=>{L()({...e,parse:!1}).then((e=>Promise.all([e.json?e.json():[],(0,O.zipObject)(n,n.map((n=>e.headers.get(n))))]))).then((e=>t(e))).catch((()=>{}))}))},T=e=>e.charAt(0).toUpperCase()+e.slice(1),X=function(e){let n=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];try{var t=JSON.parse(e);if(t&&"object"==typeof t)return t}catch(e){}return e&&"object"==typeof e?e:!!n&&{}},j=window.kadence.icons,P=e=>{let n=e.toLowerCase();return"%"===n?j.percentIcon:"em"===n?j.emIcon:"vh"===n?j.vhIcon:"vw"===n?j.vwIcon:"rem"===n?j.remIcon:j.pxIcon},D=window.wp.i18n,C=[{value:"0",output:"0",label:(0,D.__)("None","kadence-blocks"),size:0,name:(0,D.__)("None","kadence-blocks")},{value:"xxs",output:"var(--global-kb-spacing-xxs, 0.5rem)",size:8,label:(0,D.__)("XXS","kadence-blocks"),name:(0,D.__)("2X Small","kadence-blocks")},{value:"xs",output:"var(--global-kb-spacing-xs, 1rem)",size:16,label:(0,D.__)("XS","kadence-blocks"),name:(0,D.__)("X Small","kadence-blocks")},{value:"sm",output:"var(--global-kb-spacing-sm, 1.5rem)",size:24,label:(0,D.__)("SM","kadence-blocks"),name:(0,D.__)("Small","kadence-blocks")},{value:"md",output:"var(--global-kb-spacing-md, 2rem)",size:32,label:(0,D.__)("MD","kadence-blocks"),name:(0,D.__)("Medium","kadence-blocks")},{value:"lg",output:"var(--global-kb-spacing-lg, 3rem)",size:48,label:(0,D.__)("LG","kadence-blocks"),name:(0,D.__)("Large","kadence-blocks")},{value:"xl",output:"var(--global-kb-spacing-xl, 4rem)",size:64,label:(0,D.__)("XL","kadence-blocks"),name:(0,D.__)("X Large","kadence-blocks")},{value:"xxl",output:"var(--global-kb-spacing-xxl, 5rem)",size:80,label:(0,D.__)("XXL","kadence-blocks"),name:(0,D.__)("2X Large","kadence-blocks")},{value:"3xl",output:"var(--global-kb-spacing-3xl, 6.5rem)",size:104,label:(0,D.__)("3XL","kadence-blocks"),name:(0,D.__)("3X Large","kadence-blocks")},{value:"4xl",output:"var(--global-kb-spacing-4xl, 8rem)",size:128,label:(0,D.__)("4XL","kadence-blocks"),name:(0,D.__)("4X Large","kadence-blocks")},{value:"5xl",output:"var(--global-kb-spacing-5xl, 10rem)",size:160,label:(0,D.__)("5XL","kadence-blocks"),name:(0,D.__)("5X Large","kadence-blocks")}],B=[{value:"sm",output:"var(--global-kb-font-size-sm, 0.9rem)",size:14,label:(0,D.__)("SM","kadence-blocks"),name:(0,D.__)("Small","kadence-blocks")},{value:"md",output:"var(--global-kb-font-size-md, 1.25rem)",size:20,label:(0,D.__)("MD","kadence-blocks"),name:(0,D.__)("Medium","kadence-blocks")},{value:"lg",output:"var(--global-kb-font-size-lg, 2rem)",size:32,label:(0,D.__)("LG","kadence-blocks"),name:(0,D.__)("Large","kadence-blocks")},{value:"xl",output:"var(--global-kb-font-size-xl, 3rem)",size:48,label:(0,D.__)("XL","kadence-blocks"),name:(0,D.__)("X Large","kadence-blocks")},{value:"xxl",output:"var(--global-kb-font-size-xxl, 4rem)",size:64,label:(0,D.__)("2XL","kadence-blocks"),name:(0,D.__)("2X Large","kadence-blocks")},{value:"3xl",output:"var(--global-kb-font-size-xxxl, 5rem)",size:80,label:(0,D.__)("3XL","kadence-blocks"),name:(0,D.__)("3X Large","kadence-blocks")}],F=[{value:"none",output:"var(--global-kb-gap-none, 0px)",size:0,label:(0,D.__)("None","kadence-blocks"),name:(0,D.__)("None","kadence-blocks")},{value:"xs",output:"var(--global-kb-gap-xs, 0.5rem)",size:8,label:(0,D.__)("XS","kadence-blocks"),name:(0,D.__)("X Small","kadence-blocks")},{value:"sm",output:"var(--global-kb-gap-sm, 1rem)",size:16,label:(0,D.__)("SM","kadence-blocks"),name:(0,D.__)("Small","kadence-blocks")},{value:"md",output:"var(--global-kb-gap-md, 2rem)",size:32,label:(0,D.__)("MD","kadence-blocks"),name:(0,D.__)("Medium","kadence-blocks")},{value:"lg",output:"var(--global-kb-gap-lg, 4rem)",size:64,label:(0,D.__)("LG","kadence-blocks"),name:(0,D.__)("Large","kadence-blocks")}],A=document.body.classList.contains("rtl");function H(e,n){let t=arguments.length>2&&void 0!==arguments[2]?arguments[2]:B;if(!e)return"";if(!t)return e;if("0"===e)return"0";const i=t.find((n=>n.value===e));return i?i.output:e+n}const G=(e,n,t)=>{let o="";if(void 0!==e&&void 0!==e[0]){const n=i(t,void 0!==e&&void 0!==e[0]&&void 0!==e[0].size&&void 0!==e[0].size[0]?e[0].size[0]:"",void 0!==e&&void 0!==e[0]&&void 0!==e[0].size&&void 0!==e[0].size[1]?e[0].size[1]:"",void 0!==e&&void 0!==e[0]&&void 0!==e[0].size&&void 0!==e[0].size[2]?e[0].size[2]:"");n&&(o=o+"font-size:"+H(n,void 0!==e[0].sizeType?e[0].sizeType:"px")+";");const l=i(t,void 0!==e&&void 0!==e[0]&&void 0!==e[0].lineHeight&&void 0!==e[0].lineHeight[0]?e[0].lineHeight[0]:"",void 0!==e&&void 0!==e[0]&&void 0!==e[0].lineHeight&&void 0!==e[0].lineHeight[1]?e[0].lineHeight[1]:"",void 0!==e&&void 0!==e[0]&&void 0!==e[0].lineHeight&&void 0!==e[0].lineHeight[2]?e[0].lineHeight[2]:"");l&&(o=o+"line-height:"+l+(void 0!==e[0].lineType?e[0].lineType:"")+";");const r=i(t,void 0!==e&&void 0!==e[0]&&void 0!==e[0].letterSpacing&&void 0!==e[0].letterSpacing[0]?e[0].letterSpacing[0]:"",void 0!==e&&void 0!==e[0]&&void 0!==e[0].letterSpacing&&void 0!==e[0].letterSpacing[1]?e[0].letterSpacing[1]:"",void 0!==e&&void 0!==e[0]&&void 0!==e[0].letterSpacing&&void 0!==e[0].letterSpacing[2]?e[0].letterSpacing[2]:"");r&&(o=o+"letter-spacing:"+r+(void 0!==e[0].letterSpacingType?e[0].letterSpacingType:"px")+";"),void 0!==e[0].weight&&""!==e[0].weight&&(o=o+"font-weight:"+e[0].weight+";"),void 0!==e[0].style&&""!==e[0].style&&(o=o+"font-style:"+e[0].style+";"),void 0!==e[0].textTransform&&""!==e[0].textTransform&&(o=o+"text-transform:"+e[0].textTransform+";"),void 0!==e[0].family&&""!==e[0].family&&(o=o+"font-family:"+e[0].family+";")}return o?n+"{"+o+"}":""},q=(e,n)=>{let t=(0,O.get)(e,[n,0]),i=(0,O.get)(e,[n,1]),o=(0,O.get)(e,[n,2]),l=(0,O.get)(e,[n,3]);return t===i&&t===o&&t===l?"linked":"individual"},W=(e,n)=>{if(!(n.uniqueID||void 0!==n.noCustomDefaults&&n.noCustomDefaults)){const t=kadence_blocks_params.config&&kadence_blocks_params.config[e]?kadence_blocks_params.config[e]:void 0,i=kadence_blocks_params.configuration?JSON.parse(kadence_blocks_params.configuration):[];void 0!==i[e]&&"object"==typeof i[e]?("kadence/iconlist"===e&&void 0!==i[e]?.items?.[0]?.icon&&i[e]?.items?.[0]?.icon&&!i[e]?.icon&&(n.icon=i[e]?.items?.[0]?.icon),Object.keys(i[e]).map((t=>{n[t]=i[e][t]}))):void 0!==t&&"object"==typeof t&&Object.keys(t).map((e=>{n[e]=t[e]}))}return n};function E(e,n,t,i){let o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:"";const l=e&&2===e.split("_").length,r=(o?o+"_":"")+n.substr(2,9);return!e||l&&e.split("_")[0]!==o.toString()?t(r)?r:(0,O.uniqueId)(r):t(e)||i(e,n)?e:r}function U(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},t=arguments.length>3&&void 0!==arguments[3]?arguments[3]:[],i={};const o=["uniqueID","inQueryBlock","anchor","noCustomDefaults","metadata"].concat(arguments.length>2&&void 0!==arguments[2]?arguments[2]:[]);return i=(0,O.omit)(e,o),t!==[]&&t.forEach((e=>{i[e]=[(0,O.head)(i[e])]})),Object.keys(i).map(((e,t)=>{void 0!==n[e]&&void 0!==n[e].default&&(0,O.isEqual)(i[e],n[e].default)&&delete i[e]})),i}function J(e,n){const t=Boolean(e&&(e.queryId||Number.isFinite(e.queryId))&&e.postId),i=Boolean(e&&void 0!==e["kadence/dynamicSource"]&&e["kadence/dynamicSource"]);return!(!t&&!i)}const V=window.wp.hooks;function Z(e,n,t,i,o,l,r){let u=arguments.length>7&&void 0!==arguments[7]&&arguments[7];t.kadenceDynamic&&t.kadenceDynamic[i]&&t.kadenceDynamic[i].enable&&(0,V.applyFilters)(e,n,t,i,o,l,r,u)}function K(){const[e,n]=(0,t.useState)(!1);return{isMouseOver:e,onMouseOver:()=>n(!0),onMouseOut:()=>n(!1)}}function Q(e,n){let t=arguments.length>2&&void 0!==arguments[2]?arguments[2]:C;if(!e)return(0,D.__)("None","kadence-blocks");if(!t)return(0,D.__)("Unset","kadence-blocks");if("0"===e)return(0,D.__)("None","kadence-blocks");const i=t.find((n=>n.value===e));return i?i.name:e+n}function R(e,n){let t=arguments.length>2&&void 0!==arguments[2]?arguments[2]:C;if(void 0===e)return"";if(!t)return e;if("0"===e)return"0"+n;if(0===e)return"0"+n;const i=t.find((n=>n.value===e));return i?i.output:e+n}function Y(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:C;if(!e)return 0;if(!n)return e;if("0"===e)return 0;const t=n.find((n=>n.value===e));return t?t.size:e}function $(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:C;if(!e)return(0,D.__)("Unset","kadence-blocks");if(!n)return(0,D.__)("Unset","kadence-blocks");if("0"===e)return(0,D.__)("None","kadence-blocks");const t=n.find((n=>n.size===e));return t?t.name:e+"px"}function ee(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:C;if(!e)return"";if(!n)return"";if("0"===e)return"0";const t=n.find((n=>n.size===e));return t?t.value:e}function ne(e,n){if("object"!=typeof e||"object"!=typeof n)return!1;if(e.length!=n.length)return!1;for(let t=0;t<e.length;t++){const i=e[t],o=n[t];if(i&&!o||!i&&o)return!1}return!0}function te(e,n){if("object"!=typeof e||"object"!=typeof n)return n;if(e.length!=n.length)return n;let t=null;for(let i=0;i<e.length;i++){const o=e[i],l=n[i];o!==l&&(t=l)}return t?n.map((e=>typeof e==typeof t?e:"")):n}function ie(e,n){let t=arguments.length>2&&void 0!==arguments[2]?arguments[2]:F;if(void 0===e)return"";if(!t)return e;if("0"===e)return"0"+n;if(0===e)return"0"+n;const i=t.find((n=>n.value===e));return i?i.output:e+n}const oe=window.wp.widgets;function le(e,n,t){let i=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"block-unknown";return(0,O.has)(t,"ref")?t.ref:n||((0,oe.getWidgetIdFromBlock)(e)?(0,oe.getWidgetIdFromBlock)(e):i)}function re(e){for(var n=5381,t=e.length;t;)n=33*n^e.charCodeAt(--t);return n>>>0}function ue(e,n){const{postId:t,reusableParent:i,rootBlock:o,editedPostId:l}=n,r=le(e,t,i,0);if(0===r){if("core/template-part"===(0,O.get)(o,"name")&&(0,O.has)(o,["attributes","slug"]))return re(o.attributes.slug)%1e6;if(l)return re(l)%1e6}return r}(this.kadence=this.kadence||{}).helpers=n})();