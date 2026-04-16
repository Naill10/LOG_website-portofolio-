const container = document.getElementById('container');

document.getElementById('signUp').onclick = () => {
    container.classList.add("active");
}

document.getElementById('signIn').onclick = () => {
    container.classList.remove("active");
}