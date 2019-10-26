// var readURL = function (input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
        
//         reader.onload = function(e) {
//         $('#img-preview').attr('src', e.target.result);
//         }
        
//         reader.readAsDataURL(input.files[0]);
//     }
// }

$("#add-photo-input").change(function() {
    var urlCreator = window.URL || window.webkitURL;
    var imageUrl = urlCreator.createObjectURL(this.files[0]);
    document.querySelector("#img-preview").src = imageUrl;
});

// var response = function (value) {
   
// }