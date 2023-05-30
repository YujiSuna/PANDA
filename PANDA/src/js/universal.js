function ajaxPOST(data, page, func = false, method = "POST") {
    var xhr = new XMLHttpRequest();
    xhr.open(method, page);
    // What to do when server responds
    xhr.onload = function() {
        let answer = this.response;

        if (func != false) {
            func(answer);
        } else {
            console.log("no function detected.");
        }
    };

    if (data != null) {
        xhr.send(data);
    } else {
        xhr.send();
    }
}

function backHistory() {
    window.history.back();
}