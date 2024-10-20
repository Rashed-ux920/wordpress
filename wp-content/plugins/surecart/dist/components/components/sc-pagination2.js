import{proxyCustomElement,HTMLElement,createEvent,h}from"@stencil/core/internal/client";import{d as defineCustomElement$5}from"./sc-button2.js";import{d as defineCustomElement$4}from"./sc-flex2.js";import{d as defineCustomElement$3}from"./sc-icon2.js";import{d as defineCustomElement$2}from"./sc-spinner2.js";import{d as defineCustomElement$1}from"./sc-visually-hidden2.js";const scPaginationCss=":host{display:block}.pagination-display{opacity:0.8}",ScPagination=proxyCustomElement(class extends HTMLElement{constructor(){super(),this.__registerHost(),this.__attachShadow(),this.scPrevPage=createEvent(this,"scPrevPage",7),this.scNextPage=createEvent(this,"scNextPage",7),this.page=1,this.perPage=0,this.total=0,this.totalShowing=0,this.totalPages=0,this.hasNextPage=void 0,this.hasPreviousPage=void 0,this.from=void 0,this.to=void 0}componentWillLoad(){this.handlePaginationChange()}handlePaginationChange(){this.hasNextPage=this.total>1&&this.page<this.totalPages,this.hasPreviousPage=this.totalPages>1&&this.page>1,this.from=this.perPage*(this.page-1)+1,this.to=Math.min(this.from+this.totalShowing-1,this.total)}render(){return this.hasNextPage||this.hasPreviousPage?h("sc-flex",null,h("div",{class:"pagination-display"},wp.i18n.sprintf(wp.i18n.__("Displaying %1d to %2d of %3d items","surecart"),this.from,this.to,this.total)),h("sc-flex",null,h("sc-button",{onClick:()=>this.scPrevPage.emit(),type:"text",disabled:!this.hasPreviousPage},h("sc-visually-hidden",null,wp.i18n.__("Display previous page of items","surecart")),h("span",{"aria-hidden":"true"},wp.i18n.__("Previous","surecart")),h("sc-icon",{"aria-hidden":"true",name:"arrow-left",slot:"prefix"})),h("sc-button",{onClick:()=>this.scNextPage.emit(),type:"text",disabled:!this.hasNextPage},h("sc-visually-hidden",null,wp.i18n.__("Display next page of items","surecart")),h("span",{"aria-hidden":"true"},wp.i18n.__("Next","surecart")),h("sc-icon",{"aria-hidden":"true",name:"arrow-right",slot:"suffix"})))):null}static get watchers(){return{total:["handlePaginationChange"],totalPages:["handlePaginationChange"],page:["handlePaginationChange"],perPage:["handlePaginationChange"],totalShowing:["handlePaginationChange"]}}static get style(){return scPaginationCss}},[1,"sc-pagination",{page:[2],perPage:[2,"per-page"],total:[2],totalShowing:[2,"total-showing"],totalPages:[2,"total-pages"],hasNextPage:[32],hasPreviousPage:[32],from:[32],to:[32]}]);function defineCustomElement(){"undefined"!=typeof customElements&&["sc-pagination","sc-button","sc-flex","sc-icon","sc-spinner","sc-visually-hidden"].forEach((e=>{switch(e){case"sc-pagination":customElements.get(e)||customElements.define(e,ScPagination);break;case"sc-button":customElements.get(e)||defineCustomElement$5();break;case"sc-flex":customElements.get(e)||defineCustomElement$4();break;case"sc-icon":customElements.get(e)||defineCustomElement$3();break;case"sc-spinner":customElements.get(e)||defineCustomElement$2();break;case"sc-visually-hidden":customElements.get(e)||defineCustomElement$1()}}))}export{ScPagination as S,defineCustomElement as d};