/* empty css                                                   */import{_ as K}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{r as v,C as Q,h as x,o as i,c as r,a as t,F as V,g as z,b as D,m as F,e as f,n as W,t as b,p as X,f as Y}from"./app-D9WQMsEa.js";/* empty css            */const h=c=>(X("data-v-91d1f5f1"),c=c(),Y(),c),ee={class:"photo-block"},te={key:0,class:"each-image"},oe={class:"checked-css"},ne=["onClick"],se=["onClick"],ae={class:"photo-block1"},le=["src"],ce={class:"photo-data"},de={class:"photo-title"},ie={class:"photo-content"},re={key:1},ue=["src"],me={key:2,class:"modal"},he={class:"modal-content"},ge={class:"modal-container"},ve=["src"],pe={key:0,class:"confirm-modal"},_e=h(()=>t("p",{class:"confirm-text"},"是否一併下載灰階版照片？",-1)),fe=h(()=>t("img",{src:"/images/download.png",alt:"download",class:"download-img"},null,-1)),ke=h(()=>t("p",{class:"download-css"}," 下載 ",-1)),be=[fe,ke],Ce={key:0},we=h(()=>t("img",{src:"/images/download-btn.png",alt:"download",class:"dl-css"},null,-1)),ye=h(()=>t("p",{class:"download-btn"},"下載("+b(1)+")",-1)),Ie=h(()=>t("img",{src:"/images/download-btn.png",alt:"download",class:"dl-css",style:{visibility:"hidden"}},null,-1)),Se=[we,ye,Ie],xe={class:"custom-sizes"},Ve=h(()=>t("span",null,"每頁顯示",-1)),De=h(()=>t("span",null,"張",-1)),Be={class:"custom-total"},Ee={key:0,class:"modal"},$e=h(()=>t("p",{class:"confirm-text"},"是否一併下載灰階版照片？",-1)),Ue={__name:"ImageModal",props:{thumbnailSrc:String,fullImageSrc:String,photo:[],results:Array,searchbar:Boolean},setup(c){const g=c,C=v(1),p=v(10),B=v(400);Q(()=>Math.ceil(B.value/p.value));const A=s=>{p.value=s},L=s=>{C.value=s},k=v(!1),w=v(!1),_=v(!1),y=v([]),M=v(40),I=()=>{k.value=!1,_.value=!1},O=()=>{_.value=!0},N=()=>{_.value=!1},P=()=>{w.value=!1},E=s=>{const e=g.results.findIndex(o=>o.id===s.id);e!==-1?(console.log("good luck CZA ",g.results[e].id),console.log("good luck TDA ",s.id),console.log("good luck ",e),g.results[e].checkCondition=!g.results[e].checkCondition):console.log("Item not found in the array")},R=()=>{U(g.fullImageSrc),I()},j=()=>{U(g.fullImageSrc),J(g.fullImageSrc),I()},G=()=>{y.value=g.results.filter(s=>s.checkCondition===!0).map(s=>s.srcPath),w.value=!0},T=()=>{y.value.forEach((s,e)=>{const o=`image_${e}.png`;Z(s,o)})},Z=(s,e)=>{const o=document.createElement("a");o.href=s,o.download=e,document.body.appendChild(o),o.click(),document.body.removeChild(o)},q=async()=>{for(const[s,e]of y.value.entries()){const o=`image_${s}.png`;$(e,o);const d=await H(e);$(d,`grayscale_${o}`)}},$=(s,e)=>{const o=document.createElement("a");o.href=s,o.download=e,document.body.appendChild(o),o.click(),document.body.removeChild(o)},H=s=>new Promise((e,o)=>{const d=new Image;d.crossOrigin="Anonymous",d.src=s,d.onload=()=>{const u=document.createElement("canvas"),n=u.getContext("2d");u.width=d.width,u.height=d.height,n.drawImage(d,0,0);const a=n.getImageData(0,0,u.width,u.height),l=a.data;for(let m=0;m<l.length;m+=4){const S=(l[m]+l[m+1]+l[m+2])/3;l[m]=S,l[m+1]=S,l[m+2]=S}n.putImageData(a,0,0),u.toBlob(m=>{e(URL.createObjectURL(m))})},d.onerror=()=>{o(new Error("Failed to load image"))}}),U=s=>{const e=document.createElement("a");e.href=s,e.download=s.split("/").pop(),document.body.appendChild(e),e.click(),document.body.removeChild(e)},J=s=>{const e=new Image;e.crossOrigin="Anonymous",e.src=s,e.onload=()=>{const o=document.createElement("canvas");o.width=e.width,o.height=e.height;const d=o.getContext("2d");d.drawImage(e,0,0);const u=d.getImageData(0,0,o.width,o.height),n=u.data;for(let a=0;a<n.length;a+=4){const l=(n[a]+n[a+1]+n[a+2])/3;n[a]=l,n[a+1]=l,n[a+2]=l}d.putImageData(u,0,0),o.toBlob(a=>{const l=document.createElement("a");l.href=URL.createObjectURL(a),l.download="grayscale_"+s.split("/").pop(),document.body.appendChild(l),l.click(),document.body.removeChild(l)})}};return(s,e)=>{const o=x("el-option"),d=x("el-select"),u=x("el-pagination");return i(),r(V,null,[t("div",ee,[(i(!0),r(V,null,z(c.results,n=>(i(),r("div",{key:n,class:W(c.searchbar&&c.searchbar==="true"?"result-photo":"each-photo")},[c.searchbar&&c.searchbar==="true"?(i(),r("div",te,[t("div",oe,[n.checkCondition?(i(),r("img",{key:0,src:"/images/checked.png",alt:"checked",class:"",onClick:a=>E(n)},null,8,ne)):(i(),r("img",{key:1,src:"/images/uncheck.png",alt:"uncheck",class:"",onClick:a=>E(n)},null,8,se))]),t("div",ae,[t("img",{src:c.thumbnailSrc,onClick:e[0]||(e[0]=a=>k.value=!0),alt:"Filter",class:"thumbnail"},null,8,le),t("div",ce,[t("p",de,b(n.title),1),t("p",ie,b(n.content),1)])])])):(i(),r("div",re,[t("img",{src:c.thumbnailSrc,onClick:e[1]||(e[1]=a=>k.value=!0),alt:"Filter",class:"thumbnail"},null,8,ue)])),k.value?(i(),r("div",me,[t("div",he,[_.value?f("",!0):(i(),r("span",{key:0,class:"close",onClick:e[2]||(e[2]=a=>I())},"×")),t("div",ge,[t("img",{src:c.fullImageSrc,class:"modal-image"},null,8,ve),_.value?(i(),r("div",pe,[t("div",{class:"modal-confirm-content confirmation-content"},[t("span",{class:"close confirmation-close",onClick:N},"×"),_e,t("button",{onClick:R,class:"cancel-button"},"不需要"),t("button",{onClick:j,class:"confirm-button"},"是")])])):f("",!0)]),t("div",{class:"download-row",onClick:O},be)])])):f("",!0)],2))),128))]),c.searchbar&&c.searchbar==="true"?(i(),r("div",Ce,[t("div",{class:"right-btn"},[t("div",{class:"btn-block",onClick:G},Se)]),t("div",null,[D(u,{"current-page":C.value,"onUpdate:currentPage":e[4]||(e[4]=n=>C.value=n),"page-size":p.value,"onUpdate:pageSize":e[5]||(e[5]=n=>p.value=n),"page-sizes":[10,12,15,20],small:!1,disabled:!1,background:!0,layout:"prev, slot, next",total:M.value,"prev-text":"上一頁","next-text":"下一頁",onSizeChange:A,onCurrentChange:L},{default:F(()=>[t("div",xe,[Ve,D(d,{modelValue:p.value,"onUpdate:modelValue":e[3]||(e[3]=n=>p.value=n),placeholder:"每頁顯示"},{default:F(()=>[(i(),r(V,null,z([10,20,30,40],n=>D(o,{key:n,label:`${n}`,value:n},null,8,["label","value"])),64))]),_:1},8,["modelValue"]),De]),t("div",Be,"共 "+b(B.value)+" 頁",1)]),_:1},8,["current-page","page-size","total"])]),w.value?(i(),r("div",Ee,[t("div",{class:"modal-confirm-content confirmation-content"},[t("span",{class:"close confirmation-close",onClick:P},"×"),$e,t("button",{onClick:T,class:"cancel-button"},"不需要"),t("button",{onClick:q,class:"confirm-button"},"是")])])):f("",!0)])):f("",!0)],64)}}},Me=K(Ue,[["__scopeId","data-v-91d1f5f1"]]);export{Me as default};