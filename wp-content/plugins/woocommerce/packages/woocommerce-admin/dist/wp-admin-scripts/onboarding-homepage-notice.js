this.wc=this.wc||{},this.wc.onboardingHomepageNotice=function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=457)}({13:function(e,t,n){"use strict";n.d(t,"a",(function(){return u})),n.d(t,"b",(function(){return a})),n.d(t,"c",(function(){return d})),n.d(t,"f",(function(){return l})),n.d(t,"g",(function(){return p})),n.d(t,"e",(function(){return f})),n.d(t,"d",(function(){return b}));var o=n(2);const r=["wcAdminSettings","preloadSettings"],c="object"==typeof wcSettings?wcSettings:{},i=Object.keys(c).reduce((e,t)=>(r.includes(t)||(e[t]=c[t]),e),{});Object.keys(c.admin||{}).forEach(e=>{r.includes(e)||(i[e]=c.admin[e])});const s=i.adminUrl,u=(i.countries,i.currency),a=i.locale,d=i.orderStatuses;i.siteTitle,i.wcAssetUrl;function l(e,t=!1,n=(e=>e)){if(r.includes(e))throw new Error(Object(o.__)("Mutable settings should be accessed via data store."));return n(i.hasOwnProperty(e)?i[e]:t,t)}function p(e,t,n=(e=>e)){if(r.includes(e))throw new Error(Object(o.__)("Mutable settings should be mutated via data store."));i[e]=n(t)}function f(e){return(s||"")+e}function b(e){return new Promise((t,n)=>{document.querySelector(`#${e.handle}-js`)&&t();const o=document.createElement("script");o.src=e.src,o.id=e.handle+"-js",o.async=!0,o.onload=t,o.onerror=n,document.body.appendChild(o)})}},16:function(e,t){e.exports=window.wc.tracks},2:function(e,t){e.exports=window.wp.i18n},457:function(e,t,n){"use strict";n.r(t);var o=n(7),r=n(2),c=n(51),i=n.n(c),s=n(13),u=n(16);const a=()=>{if(!document.querySelector(".editor-post-publish-button").classList.contains("is-busy")){return new Promise(e=>{window.requestAnimationFrame(e)}).then(()=>a())}return Promise.resolve(!0)},d=()=>{if(document.querySelector(".editor-post-publish-button").classList.contains("is-busy")){return new Promise(e=>{window.requestAnimationFrame(e)}).then(()=>d())}return Promise.resolve(!0)};i()(()=>{const e=document.querySelector(".editor-post-publish-button");e&&e.addEventListener("click",a().then(()=>(()=>{const e=document.querySelector(".editor-post-publish-button");e.classList.contains("is-clicked")||(e.classList.add("is-clicked"),d().then(()=>{const e=null!==document.querySelector(".components-snackbar__content")?"snackbar":"default";Object(o.dispatch)("core/notices").removeNotice("SAVE_POST_NOTICE_ID"),Object(o.dispatch)("core/notices").createSuccessNotice(Object(r.__)("🏠 Nice work creating your store's homepage!",'woocommerce'),{id:"WOOCOMMERCE_ONBOARDING_HOME_PAGE_NOTICE",type:e,actions:[{label:Object(r.__)("Continue setup.",'woocommerce'),onClick:()=>{Object(u.queueRecordEvent)("tasklist_appearance_continue_setup",{}),window.location=Object(s.e)("admin.php?page=wc-admin&task=appearance")}}]})}))})()))})},51:function(e,t){e.exports=window.wp.domReady},7:function(e,t){e.exports=window.wp.data}});