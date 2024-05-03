const getSearchparm=()=>{
    let type=document.getElementById("type").value;
    let sort=document.getElementById("sort").value;
    let status=document.getElementById("status").value;

    window.location.href=`http://localhost/Bricolini/Partenaires/commentaires/${type}/${status}/${sort}`;
}
const getSearchparm2=()=>{
    let rating=document.getElementById("rating").value;
    let sort=document.getElementById("sort").value;

    window.location.href=`http://localhost/Bricolini/Partenaires/commentaires/${rating}/${sort}`;
}
function addService() {
    event.preventDefault();

    var form = document.querySelector('form');
    var formData = new FormData(form);
    var jsonObject = {};
    for (const [key, value]  of formData.entries()) {
        jsonObject[key] = value;
    }

    fetch('http://localhost/Bricolini/Partenaires/handleAddService', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonObject)
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}