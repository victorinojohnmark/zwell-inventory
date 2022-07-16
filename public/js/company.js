let companyLogo = document.querySelector('img#companyLogo');
let logoInput = document.querySelector('input[name="logo"]');

logoInput.addEventListener('change', (e)=> {
    console.log(e.target.value);
    updateImage(e.target, companyLogo);
});

function updateImage(inputFile, imageElement) {
    let fileName = inputFile.value;
    let fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if(inputFile.files && inputFile.files[0] && (fileExtension == 'gif' || fileExtension == 'png' || fileExtension == 'jpeg' || fileExtension == 'jpg')) {
        var reader = new FileReader();
        reader.onload = function (e) {
            imageElement.setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(inputFile.files[0]);
    }
    

}