const showReclam=(id_reclamateur,type_reclamateur,type_reclamation,id_t)=>{
    document.getElementById("recBanner").style.display="block";
    document.getElementById("id_reclamateur").value=id_reclamateur;
    document.getElementById("id_T").value=id_t;
    document.getElementById("type_reclamation").value=type_reclamation;
    document.getElementById("type_reclamateur").value=type_reclamateur;
    addEvent();
}
const addEvent=()=>{
    document.getElementById("autreRadio").addEventListener("change",()=>{
        if(document.getElementById("autreRadio").checked){
            document.getElementById("autre").style.opacity="1";
        }else{
            document.getElementById("autre").style.opacity="0";
        }
    })
}
const closeReclam=()=>{
    document.getElementById("recBanner").style.display="none";
}
const sendReclamation=async()=>{
    let id_reclamateur=document.getElementById("id_reclamateur").value;
    let id_T=document.getElementById("id_T").value;
    let type_reclamation=document.getElementById("type_reclamation").value;
    let type_reclamateur=document.getElementById("type_reclamateur").value;
    let radios=document.querySelectorAll("input[type='radio']");
    let motif="";
    if(document.getElementById("autreRadio").checked){
        motif=document.getElementById("autreText").value;
    }else{
        for(let i=0;i<radios.length; i++){
            if(radios[i].checked){
                motif=radios[i].value;
            }
        }
    }
    let formData=new FormData();
    formData.append("id_reclamateur",id_reclamateur);
    formData.append("type_reclamation",type_reclamation);
    formData.append("id_T",id_T);
    formData.append("motif",motif);
    formData.append("type_reclamateur",type_reclamateur);

    console.log("fetching");
    const response=await fetch("http://localhost/Bricolini/Clients/report",{
        method:"POST",
        body:formData
    });
    /*const data=await response.text().then((data)=>{
        console.log(data);
    })*/
    closeReclam();
}