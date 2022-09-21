function convertTime(epochTime) {
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let _date = new Date(epochTime * 1000);
    let month = months[_date.getMonth()];
    let _day = _date.getDate();
    let _year = _date.getFullYear();
    let _hour = _date.getHours();
    let _min = _date.getMinutes();
    if (_day < 10) {
        _day = '0' + _day;
    }
    if (_hour < 10) {
        _hour = '0' + _hour;
    }
    if (_min < 10) {
        _min = '0' + _min;
    }

    return (_day + ' ' + month + ' ' + _year + ' ' + _hour + ':' + _min);
}

function copyToClipboard(text) {
    var input = document.body.appendChild(document.createElement("input"));
    input.value = text;
    input.focus();
    input.select();
    document.execCommand('copy');
    input.parentNode.removeChild(input);
}

function escapeInput(input) {
    return String(input)
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}