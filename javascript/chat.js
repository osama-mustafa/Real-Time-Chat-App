const form = document.querySelector(".typing-area");
const inputChat = document.querySelector(".typing-area .input-field");
const sendButton = form.querySelector("button");
const chatBox = document.querySelector(".chat-box");

form.onsubmit = function (e) {
    e.preventDefault();
}


sendButton.addEventListener("click", function () {
    let elements = document.getElementsByClassName('formVal');
    let formData = new FormData();
    for (let i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert_chat.php");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = xhr.response;
            inputChat.value = "";
            scrollToBottom()
        }
    }
    xhr.send(formData);
    xhr.onerror = function () {
        console.log(new Error("Request is failed"));
    }
})

chatBox.onmouseenter = function() {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = function() {
    chatBox.classList.remove("active");
}

setInterval(function () {
    let elements = document.getElementsByClassName('formVal');
    let formData = new FormData();
    for (let i = 0; i < elements.length; i++) {
        formData.append(elements[i].name, elements[i].value);
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get_chat.php");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")) {
                scrollToBottom();
            }
        }
    }
    xhr.send(formData);
    xhr.onerror = function () {
        console.log(new Error("Request is failed!"))
    }
}, 300);


function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
