$(document).ready(function() {
    $('#save-form').submit(function(e) {
        e.preventDefault();
        submitForm();
    });
});

function submitForm(clickedButtonValue) {
    console.log('save')

    var form = document.getElementById('save-form');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', $('#save-form').attr('action'), true);

    var messageBox = document.getElementById('message');
    $('#message').html('')
    // Zdarzenie, które ma być wywołane po zakończeniu wysyłki
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Obsługa sukcesu
            messageBox.append(xhr.responseText)
            document.getElementById("save-form").reset();
        } else {
            messageBox.append(xhr.responseText)
        }
    };

    // Wysłanie danych formularza
    xhr.send(formData);
}
