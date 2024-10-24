window.addEventListener("load", function() {
    document.body.classList.add("loaded");
});

document.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", function(event) {
        event.preventDefault();
        document.body.classList.remove("loaded");
        setTimeout(() => {
            window.location.href = this.href;
        }, 500);
    });
});
document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const spinnerContainer = document.getElementById('spinner-container');
    const message = document.getElementById('message');
    const confirmarButton = document.querySelector('.confirmar');
    confirmarButton.disabled = true;

    spinnerContainer.style.display = 'block';

    setTimeout(function() {
        spinnerContainer.style.display = 'none'; 
        message.style.display = 'block';
    }, 3000);
});
document.getElementById('CEP').addEventListener('input', function(event) {
    const input = event.target.value.replace(/\D/g, '');
    if (input.length <= 5) {
        event.target.value = input;
    } else {
        event.target.value = input.slice(0, 5) + '-' + input.slice(5, 8);
    }
});