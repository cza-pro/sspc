import{T as d,o as r,i as u,m as i,b as a,u as s,Z as c,c as p,t as f,e as _,a as t,d as w,n as g,O as y}from"./app-D9WQMsEa.js";import{_ as b}from"./GuestLayout-DdMbVoiy.js";import{_ as x}from"./InputError-CKKtey-c.js";import{_ as k,a as V}from"./InputLabel-7e7URrDN.js";import{_ as h}from"./PrimaryButton-pzQhvHLz.js";/* empty css            */import"./ApplicationLogo-CIhFFmr-.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const v=t("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),N={key:0,class:"mb-4 font-medium text-sm text-green-600"},$={class:"flex items-center justify-end mt-4"},z={__name:"ForgotPassword",props:{status:{type:String}},setup(o){const e=d({email:""}),m=()=>{e.post(route("password.email"))};return(B,l)=>(r(),u(b,null,{default:i(()=>[a(s(c),{title:"Forgot Password"}),v,o.status?(r(),p("div",N,f(o.status),1)):_("",!0),t("form",{onSubmit:y(m,["prevent"])},[t("div",null,[a(k,{for:"email",value:"Email"}),a(V,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":l[0]||(l[0]=n=>s(e).email=n),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(x,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",$,[a(h,{class:g({"opacity-25":s(e).processing}),disabled:s(e).processing},{default:i(()=>[w(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{z as default};
