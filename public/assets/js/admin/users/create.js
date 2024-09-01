console.log('hehe');

function previewImage(event) {
    const img = document.getElementById('projectlogo-img');
    img.src = URL.createObjectURL(event.target.files[0]);
}
