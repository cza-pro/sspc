import{T as R,r as i,q as T,C as j,z as B,o as c,c as l,a as e,F as h,g as G,w as J,v as M,u as S,e as w,Q as x,D as E,n as y,t as N,p as L,f as V}from"./app-D9WQMsEa.js";import{t as b}from"./toast-DdZiLa7U.js";import{_ as $}from"./_plugin-vue_export-helper-DlAUqK2U.js";/* empty css            */const p=d=>(L("data-v-0d179ac4"),d=d(),V(),d),z={class:"filter-block"},q={class:"filter-left"},A=p(()=>e("p",{class:"subject-section"},"年級選擇",-1)),Q={class:"subject-btns"},U={class:"filter-right"},H={key:0,class:"modal"},K={class:"modal-newgrade-content"},P=p(()=>e("p",{class:"grade-text"},"新增標籤：年級選擇",-1)),W={class:"file-div"},X={key:1,class:"removeModal"},Y={class:"modal-closelbl-content"},Z=p(()=>e("p",{class:"closelbl-text"},"請選擇欲關閉之標籤",-1)),ee=p(()=>e("p",{class:"sub-selection"},"年級選擇",-1)),se={class:"itemremove-block"},te={class:"filter1-left"},ae={class:"subject1-btns"},oe=["onClick"],ce={__name:"GradeTable",props:{grades:{type:Object,default:{}}},setup(d){const n=d,r=R({name:""}),u=i([]),m=i(!1),a=i([]),v=i(!1),f=i([]),g=T({checkedGrade:u});j(()=>n.items),B(()=>{console.log("Grade is mounted"),C(),f.value.length===0&&(f.value=JSON.parse(JSON.stringify(n.grades)))});const O=()=>{r.post(route("admin.grade.create"),{preserveState:!0,onSuccess:()=>{_(),b.add({message:x().props.toast.message})},onError:()=>{r.reset(),b.add({message:x().props.toast.message}),_()}})};function D(){g.checkedGrade=a,E.post("/admin/grade/close",g),u instanceof Set?u.clear():u.value=[],b.add({message:"Add !",duration:3e3}),f.value=JSON.parse(JSON.stringify(n.grades)),k()}const _=()=>{m.value=!1},k=()=>{a.value=[],C(),v.value=!1},C=()=>{n.grades.forEach(t=>{t.available=="off"&&a.value.push(t.id)})};function F(t){return a.value.some(o=>o==t.id)?"btn-active":""}const I=t=>{a.value.indexOf(t.id)===-1?a.value.push(t.id):a.value.splice(a.value.indexOf(t.id),1)};return(t,o)=>(c(),l(h,null,[e("div",z,[e("div",q,[A,e("div",Q,[(c(!0),l(h,null,G(n.grades,s=>(c(),l("p",{class:y(["each-btn",s.available==="off"?"removeitem":""]),key:s.id},N(s.name),3))),128))])]),e("div",U,[e("p",{class:"addnewtag",onClick:o[0]||(o[0]=s=>m.value=!0)},"新增標籤"),e("p",{class:"closetag",onClick:o[1]||(o[1]=s=>v.value=!0)},"關閉標籤")])]),m.value?(c(),l("div",H,[e("div",K,[e("span",{class:"confirmation-close",onClick:_},"×"),P,e("div",W,[J(e("input",{type:"text","onUpdate:modelValue":o[2]||(o[2]=s=>S(r).name=s),id:"newGrade",name:"newGrade",class:"gradecss",placeholder:"Name of the photo"},null,512),[[M,S(r).name]])]),e("div",{class:"btn-btn"},[e("p",{class:"grade-btn",onClick:O},"確認新增")])])])):w("",!0),v.value?(c(),l("div",X,[e("div",Y,[e("span",{class:"confirmation-close",onClick:k},"×"),Z,ee,e("div",se,[e("div",te,[e("div",ae,[(c(!0),l(h,null,G(n.grades,s=>(c(),l("p",{class:y([F(s),"each1-btn"]),onClick:le=>I(s),key:s.id},N(s.name),11,oe))),128))])])]),e("div",{class:"confirm-div"},[e("p",{class:"confirmRemove",onClick:D},"確認關閉")])])])):w("",!0)],64))}},ue=$(ce,[["__scopeId","data-v-0d179ac4"]]);export{ue as default};