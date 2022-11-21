const form = document.querySelector(".signup form");
const continueButton = document.querySelector(".button input");
const errorText      = document.querySelector(".error-txt");

form.onsubmit = function (e) {
    e.preventDefault();
}

continueButton.onclick = function () {
    
    let elements = document.getElementsByClassName('formVal');
    let image    = document.querySelector('input[type=file]').files[0];
    let formData = new FormData();

    for (let i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }

    formData.append("image", image);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = xhr.response;
            if (data == "success") {
                window.location = "users.php"
            } else {
                errorText.textContent = data;
                errorText.style.display = "block";
            }
        }
    }
    xhr.send(formData);
    xhr.onerror = function () {
        console.log(new Error("Request is failed!"))
    }
}