import{t as l}from"./toast-DdZiLa7U.js";import"./_baseGetTag-Esjt_9k3.js";import{T as h,r as d,o as m,c as p,a as e,b as n,d as I,u,e as b,p as F,f as M}from"./app-D9WQMsEa.js";import{_ as S}from"./InputError-CKKtey-c.js";import"./vue-datepicker-B3u5gnGp.js";import{_ as k}from"./_plugin-vue_export-helper-DlAUqK2U.js";import x from"./FeatureImageTable-0LAR2hFi.js";import{_ as C}from"./PictureCollection-A30XqWh1.js";/* empty css                                                   *//* empty css                                                                    *//* empty css                                                                   */import"./moment-C5S46NFB.js";/* empty css            *//* empty css                                                                      */const c=s=>(F("data-v-a59bacec"),s=s(),M(),s),N={class:"photo-content"},V={class:"left-content"},y={class:"right-content"},B={class:"btn-div"},T=c(()=>e("img",{src:"/images/admin/img-icon.png",alt:"upload",class:"upload-img"},null,-1)),$=c(()=>e("p",{class:"upload-txt"},"上傳圖片",-1)),E=[T,$],P={key:0,class:"featureModal"},U={class:"modal-confirm-content"},j={class:"file-div"},w={class:"selectFile"},L=c(()=>e("p",{class:"f1name"},"檔案名稱：",-1)),O={__name:"Index",props:{feature_images:{type:Object,default:{}}},setup(s){const _=s,t=h({feature_image:""}),f=d(!1),o=d(!1),r=()=>{o.value=!1},g=()=>{t.post(route("admin.feature_image.create"),{preserveScroll:!0,preserveState:!0,onStart:()=>{f.value=!0},onSuccess:()=>{r(),t.reset(),l.add({message:usePage().props.toast.message})},onError:()=>{t.reset(),l.add({message:usePage().props.toast.message}),r()}})};return(v,a)=>(m(),p("div",N,[e("div",V,[n(C,{onMenuManage:v.menuManage},null,8,["onMenuManage"])]),e("div",y,[e("div",B,[e("div",{class:"btn-css",onClick:a[0]||(a[0]=i=>o.value=!0)},E)]),n(x,{feature_images:_.feature_images},null,8,["feature_images"])]),o.value?(m(),p("div",P,[e("div",U,[e("span",{class:"confirmation-close",onClick:r},"×"),e("div",j,[e("p",w,[I("選擇檔案 "),e("input",{type:"file",onInput:a[1]||(a[1]=i=>u(t).feature_image=i.target.files[0])},null,32),n(S,{message:u(t).errors.feature_image,class:"mt-2"},null,8,["message"])])]),L,e("div",{class:"file-div"},[e("button",{class:"select1File",onClick:g},"確認上傳 ")])])])):b("",!0)]))}},ee=k(O,[["__scopeId","data-v-a59bacec"]]);export{ee as default};