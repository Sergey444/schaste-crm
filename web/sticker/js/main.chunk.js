(this.webpackJsonpsticker=this.webpackJsonpsticker||[]).push([[0],{14:function(e,t,n){},18:function(e,t,n){},20:function(e,t,n){"use strict";n.r(t);var r=n(0),c=n.n(r),a=n(6),o=n.n(a),i=n(1),s=n(4),l=c.a.createContext(),u=n(8),d=(n(14),function(){var e=Object(r.useState)([]),t=Object(s.a)(e,2),n=t[0],a=t[1],o=Object(r.useState)(!1),d=Object(s.a)(o,2),f=d[0],p=d[1],m=Object(r.useContext)(l);Object(r.useEffect)((function(){m.getStickers().then((function(e){a(e)}))}),[m]);var v=function(e){if(e.preventDefault(),0!==e.button)return!1;var t=document.querySelector("#sticker"),r=1*e.currentTarget.getAttribute("data-index"),c=document.querySelector('[data-id="'+r+'"]'),o=n.reduce((function(e,t){return t.sort>e?t.sort:e}),0)+1;console.log(r);var s,l={x:e.clientX,y:e.clientY},u=function(e){e.preventDefault();var u=l.x-e.clientX,d=l.y-e.clientY;l={x:e.clientX,y:e.clientY};var f=c.offsetLeft-u,p=c.offsetTop-d;c.offsetLeft-u<0&&(f=0),c.offsetTop-d<0&&(p=0),t.offsetWidth<c.offsetLeft+c.offsetWidth-u&&(f=t.offsetWidth-c.offsetWidth),t.offsetHeight<c.offsetTop+c.offsetHeight-d&&(p=t.offsetHeight-c.offsetHeight),s={id:n[r].id,name:n[r].name,description:n[r].description,color:n[r].color,left:f,top:p,sort:o,wide:n[r].wide,ready:n[r].ready},a([].concat(Object(i.a)(n.slice(0,r)),[s],Object(i.a)(n.slice(r+1))))};document.addEventListener("mousemove",u),document.addEventListener("mouseup",(function e(t){t.preventDefault(),document.removeEventListener("mousemove",u),document.removeEventListener("mouseup",e),m.setSticker(s).then((function(e){console.log("res",e)})).catch((function(e){console.error(e)}))}))},h=function(e){var t=e.target.value,r=1*e.target.getAttribute("data-index"),c={id:n[r].id,name:t,color:n[r].color,description:n[r].description,left:n[r].left,top:n[r].top,sort:n[r].sort,wide:n[r].wide,ready:n[r].ready};a([].concat(Object(i.a)(n.slice(0,r)),[c],Object(i.a)(n.slice(r+1))))},k=function(e){var t=e.target.value,r=1*e.target.getAttribute("data-index"),c={id:n[r].id,name:n[r].name,color:n[r].color,description:t,left:n[r].left,top:n[r].top,sort:n[r].sort,wide:n[r].wide,ready:n[r].ready};a([].concat(Object(i.a)(n.slice(0,r)),[c],Object(i.a)(n.slice(r+1))))},b=function(e){var t=1*e.currentTarget.getAttribute("data-index"),r={id:n[t].id,name:n[t].name,color:e.currentTarget.value,description:n[t].description,left:n[t].left,top:n[t].top,sort:n[t].sort,wide:n[t].wide,ready:n[t].ready};m.setSticker(r).then((function(e){a([].concat(Object(i.a)(n.slice(0,t)),[r],Object(i.a)(n.slice(t+1))))}))},g=n.map((function(e,t){var r,o=f===t?c.a.createElement("input",{type:"text","data-index":t,className:"sticker__title",value:e.name,onChange:h}):c.a.createElement("p",{className:"sticker__title"},e.name),s=f===t?c.a.createElement(u.a,{"data-index":t,onChange:k,value:e.description}):c.a.createElement("p",{dangerouslySetInnerHTML:(r=e.description,{__html:r})}),l=f===t?c.a.createElement("span",{onClick:function(){return function(e){m.setSticker(n[e]).then((function(e){console.log("onChange",e)})),p(!1)}(t)},className:"sticker__link sticker__link--save"},"\u0421\u043e\u0445\u0440\u0430\u043d\u0438\u0442\u044c"):c.a.createElement(c.a.Fragment,null,c.a.createElement("span",{onClick:function(){return function(e){p(e)}(t)},className:"sticker__link glyphicon glyphicon-pencil"}),c.a.createElement("span",{onClick:function(){return function(e){window.confirm("\u0412\u044b \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0442\u0435\u043b\u044c\u043d\u043e \u0445\u043e\u0442\u0438\u0442\u0435 \u0443\u0434\u0430\u043b\u0438\u0442\u044c \u044d\u0442\u0443 \u0437\u0430\u043f\u0438\u0441\u044c?")&&m.deleteSticker(n[e].id).then((function(t){a([].concat(Object(i.a)(n.slice(0,e)),Object(i.a)(n.slice(e+1))))})).catch((function(e){return console.error(e)}))}(t)},className:"sticker__link sticker__link--del glyphicon glyphicon-trash"})),d=1*e.wide===1?"400px":"200px",g=1*e.ready===1?"ready":"",y=1*e.ready===1?c.a.createElement("div",null,"\u0417\u0430\u0432\u0435\u0440\u0448\u0435\u043d\u043e..."):c.a.createElement("input",{type:"color","data-index":t,value:e.color,onChange:b});return c.a.createElement("div",{key:t,"data-id":t,className:"sticker__card ".concat(g),style:{backgroundColor:e.color,left:e.left+"px",top:e.top+"px",zIndex:e.sort,width:d}},c.a.createElement("div",{className:"sticker__header"},c.a.createElement("span",{onClick:function(){return function(e){var t={id:n[e].id,name:n[e].name,color:n[e].color,description:n[e].description,left:n[e].left,top:n[e].top,sort:n[e].sort,wide:n[e].wide,ready:1*n[e].ready?0:1};m.setSticker(t).then((function(r){a([].concat(Object(i.a)(n.slice(0,e)),[t],Object(i.a)(n.slice(e+1))))}))}(t)},className:"sticker__checkbox"}),c.a.createElement("div",{className:"sticker__move","data-index":t,onMouseDown:v}),c.a.createElement("button",{type:"button",onClick:function(){return function(e){var t={id:n[e].id,name:n[e].name,color:n[e].color,description:n[e].description,left:n[e].left,top:n[e].top,sort:n[e].sort,wide:1===n[e].wide?0:1,ready:n[e].ready};a([].concat(Object(i.a)(n.slice(0,e)),[t],Object(i.a)(n.slice(e+1))))}(t)},className:"sticker__btn"},c.a.createElement("span",{className:1*e.wide===1?"glyphicon glyphicon-resize-small":"glyphicon glyphicon-resize-full"}))),c.a.createElement("div",{className:"sticker__body"},c.a.createElement("div",{className:"sticker__form-group"},o),c.a.createElement("div",{className:"sticker__form-group"},s)),c.a.createElement("div",{className:"sticker__footer"},y,c.a.createElement("div",null,l)))}));return c.a.createElement("div",null,c.a.createElement("div",{className:"bg-white mg-bottom"},c.a.createElement("button",{className:"btn btn-primary",onClick:function(){var e=1*n.reduce((function(e,t){return 1*t.sort>e?t.sort:e}),0)+1;m.createSticker(e).then((function(e){a([].concat(Object(i.a)(n),[e]))})).catch((function(e){return console.error(e)}))}},"\u0421\u043e\u0437\u0434\u0430\u0442\u044c \u0437\u0430\u043c\u0435\u0442\u043a\u0443")),c.a.createElement("div",{className:"bg-white mg-bottom"},c.a.createElement("div",{className:"sticker",id:"sticker"},g)))}),f=(n(18),n(2)),p=n.n(f),m=n(3),v=n(7),h=function e(){var t=this;Object(v.a)(this,e),this.getResource=function(){var e=Object(m.a)(p.a.mark((function e(t){var n,r,c=arguments;return p.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=c.length>1&&void 0!==c[1]?c[1]:{},e.next=3,fetch(t,n);case 3:if((r=e.sent).ok){e.next=6;break}throw new Error("Could not fetch ".concat(t," , received ").concat(r.status));case 6:return e.next=8,r.json();case 8:return e.abrupt("return",e.sent);case 9:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),this.getStickers=Object(m.a)(p.a.mark((function e(){return p.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.getResource("/journal/get-stickers");case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)}))),this.setSticker=function(){var e=Object(m.a)(p.a.mark((function e(n){var r;return p.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r=n.color.replace("#",""),console.log("sticker",n),e.next=4,t.getResource("/journal/set-sticker",{method:"POST",body:JSON.stringify({id:n.id,left:n.left,top:n.top,name:n.name,description:n.description,color:r,ready:n.ready}),headers:{"content-type":"application/json"}});case 4:return e.abrupt("return",e.sent);case 5:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),this.createSticker=function(){var e=Object(m.a)(p.a.mark((function e(n){return p.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.getResource("/journal/create-sticker?sort=".concat(n));case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),this.deleteSticker=function(){var e=Object(m.a)(p.a.mark((function e(n){return p.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.getResource("/journal/delete-sticker?id=".concat(n));case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}()},k=function(){var e=new h;return c.a.createElement(l.Provider,{value:e},c.a.createElement(d,null))};o.a.render(c.a.createElement(k,null),document.getElementById("sticker-app"))},9:function(e,t,n){e.exports=n(20)}},[[9,1,2]]]);
//# sourceMappingURL=main.7f455c17.chunk.js.map