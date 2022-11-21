const searchBar = document.querySelector('#searchBar');
const searchButton = document.querySelector('#searchButton');
const usersList = document.querySelector('.users .users-list');

searchButton.addEventListener('click', function () {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchButton.classList.toggle("active");
    searchBar.value = "";
});


searchBar.addEventListener('keyup', function () {
    let searchTerm = searchBar.value;
    let formData = new FormData();
    formData.append("searchTerm", searchTerm);
    if (searchTerm != '') {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = xhr.response;
            usersList.innerHTML = data;
        }
    }
    xhr.send(formData);
    xhr.onerror = function () {
        console.log(new Error("Request is failed!"))
    }

});


setInterval(function () {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = xhr.response;
            if (!searchBar.classList.contains("active")) {
                usersList.innerHTML = data;
            }
        }
    }
    xhr.send();
    xhr.onerror = function () {
        console.log(new Error("Request is failed!"))
    }
}, 500)

