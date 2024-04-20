const getSearchparm=()=>{
    let type=document.getElementById("type").value;
    let sort=document.getElementById("sort").value;
    let status=document.getElementById("status").value;

    window.location.href=`http://localhost/Bricolini/Clients/getAllCommandes/${type}/${status}/${sort}`;
}
const getSearchparm2=()=>{
    let rating=document.getElementById("rating").value;
    let sort=document.getElementById("sort").value;

    window.location.href=`http://localhost/Bricolini/Clients/getAllComments/${rating}/${sort}`;
}