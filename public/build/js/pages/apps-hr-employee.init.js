
/*
Template Name: Tailwick - Admin & Dashboard Template
Author: Themesdesign
Website: https://themesdesign.in/
Contact: Themesdesign@gmail.com
File: apps hr employee init js
*/


if (document.querySelector("#profile-img")) {
    document.querySelector("#profile-img").addEventListener("change", function () {
        var preview = document.querySelector(".user-profile-image");
        // console.log(preview);
        
        var file = document.querySelector(".profile-img").files[0];
        var reader = new FileReader();
        reader.addEventListener(
            "load",
            function () {
                preview.src = reader.result;
            },
            false
        );
        if (file) {
            reader.readAsDataURL(file);
        }
    });
}

if (document.querySelector("#profile-img-2")) {
    document.querySelector("#profile-img-2").addEventListener("change", function () {
        var preview = document.querySelector(".user-profile-image-2");
        console.log(preview);
        var file = document.querySelector(".profile-img-2").files[0];
        var reader = new FileReader();
        reader.addEventListener(
            "load",
            function () {
                preview.src = reader.result;
            },
            false
        );
        if (file) {
            reader.readAsDataURL(file);
        }
    });
}

