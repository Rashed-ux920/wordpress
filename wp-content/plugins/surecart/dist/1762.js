"use strict";(self.webpackChunk_surecart_surecart=self.webpackChunk_surecart_surecart||[]).push([[1762],{448:function(t,e,r){r.d(e,{a:function(){return d},b:function(){return a},g:function(){return c}});var n=r(4942),i=r(885);function o(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function s(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?o(Object(r),!0).forEach((function(e){(0,n.Z)(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):o(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function l(t,e){var r="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!r){if(Array.isArray(t)||(r=function(t,e){if(t){if("string"==typeof t)return u(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);return"Object"===r&&t.constructor&&(r=t.constructor.name),"Map"===r||"Set"===r?Array.from(t):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?u(t,e):void 0}}(t))||e&&t&&"number"==typeof t.length){r&&(t=r);var n=0,i=function(){};return{s:i,n:function(){return n>=t.length?{done:!0}:{done:!1,value:t[n++]}},e:function(t){throw t},f:i}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var o,s=!0,l=!1;return{s:function(){r=r.call(t)},n:function(){var t=r.next();return s=t.done,t},e:function(t){l=!0,o=t},f:function(){try{s||null==r.return||r.return()}finally{if(l)throw o}}}}function u(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}function a(t){for(var e,r="",n=Object.entries(t);e=n.shift();){var o=e,s=(0,i.Z)(o,2),u=s[0],a=s[1];if(Array.isArray(a)||a&&a.constructor===Object){var c,d=l(Object.entries(a).reverse());try{for(d.s();!(c=d.n()).done;){var h=(0,i.Z)(c.value,2),f=h[0],v=h[1];n.unshift(["".concat(u,"[").concat(f,"]"),v])}}catch(t){d.e(t)}finally{d.f()}}else void 0!==a&&(null===a&&(a=""),r+="&"+[u,a].map(encodeURIComponent).join("="))}return r.substr(1)}function c(t){return(function(t){var e;try{e=new URL(t,"http://example.com").search.substring(1)}catch(t){}if(e)return e}(t)||"").replace(/\+/g,"%20").split("&").reduce((function(t,e){var r=e.split("=").filter(Boolean).map(decodeURIComponent),n=(0,i.Z)(r,2),o=n[0],l=n[1],u=void 0===l?"":l;return o&&function(t,e,r){for(var n=e.length,i=n-1,o=0;o<n;o++){var l=e[o];!l&&Array.isArray(t)&&(l=t.length.toString());var u=!isNaN(Number(e[o+1]));t[l]=o===i?r:t[l]||(u?[]:{}),Array.isArray(t[l])&&!u&&(t[l]=s({},t[l])),t=t[l]}}(t,o.replace(/\]/g,"").split("["),u),t}),{})}function d(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",e=arguments.length>1?arguments[1]:void 0;if(!e||!Object.keys(e).length)return t;var r=t,n=t.indexOf("?");return-1!==n&&(e=Object.assign(c(t),e),r=r.substr(0,n)),r+"?"+a(e)}},1762:function(t,e,r){r.r(e),r.d(e,{sc_wordpress_user:function(){return l}});var n=r(5671),i=r(3144),o=r(8860),s=r(448),l=function(){function t(e){(0,n.Z)(this,t),(0,o.r)(this,e),this.heading=void 0,this.user=void 0}return(0,i.Z)(t,[{key:"renderContent",value:function(){var t,e,r,n,i,s,l,u;return this.user?(0,o.h)(o.F,null,!!(null===(t=null==this?void 0:this.user)||void 0===t?void 0:t.display_name)&&(0,o.h)("sc-stacked-list-row",{style:{"--columns":"3"},mobileSize:480},(0,o.h)("div",null,(0,o.h)("strong",null,wp.i18n.__("Display Name","surecart"))),(0,o.h)("div",null,null===(e=this.user)||void 0===e?void 0:e.display_name),(0,o.h)("div",null)),!!(null===(r=null==this?void 0:this.user)||void 0===r?void 0:r.email)&&(0,o.h)("sc-stacked-list-row",{style:{"--columns":"3"},mobileSize:480},(0,o.h)("div",null,(0,o.h)("strong",null,wp.i18n.__("Account Email","surecart"))),(0,o.h)("div",null,null===(n=this.user)||void 0===n?void 0:n.email),(0,o.h)("div",null)),!!(null===(i=null==this?void 0:this.user)||void 0===i?void 0:i.first_name)&&(0,o.h)("sc-stacked-list-row",{style:{"--columns":"3"},mobileSize:480},(0,o.h)("div",null,(0,o.h)("strong",null,wp.i18n.__("First Name","surecart"))),(0,o.h)("div",null,null===(s=this.user)||void 0===s?void 0:s.first_name),(0,o.h)("div",null)),!!(null===(l=null==this?void 0:this.user)||void 0===l?void 0:l.last_name)&&(0,o.h)("sc-stacked-list-row",{style:{"--columns":"3"},mobileSize:480},(0,o.h)("div",null,(0,o.h)("strong",null,wp.i18n.__("Last Name","surecart"))),(0,o.h)("div",null,null===(u=this.user)||void 0===u?void 0:u.last_name),(0,o.h)("div",null))):this.renderEmpty()}},{key:"renderEmpty",value:function(){return(0,o.h)("slot",{name:"empty"},wp.i18n.__("User not found.","surecart"))}},{key:"render",value:function(){return(0,o.h)("sc-dashboard-module",{class:"customer-details"},(0,o.h)("span",{slot:"heading"},this.heading||wp.i18n.__("Account Details","surecart")," "),(0,o.h)("sc-button",{type:"link",href:(0,s.a)(window.location.href,{action:"edit",model:"user"}),slot:"end"},(0,o.h)("sc-icon",{name:"edit-3",slot:"prefix"}),wp.i18n.__("Update","surecart")),(0,o.h)("sc-card",{"no-padding":!0},(0,o.h)("sc-stacked-list",null,this.renderContent())))}}]),t}();l.style=":host{display:block;position:relative}.customer-details{display:grid;gap:0.75em}"}}]);