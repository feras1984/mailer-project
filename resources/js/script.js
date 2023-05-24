const recipient = document.getElementById('recipient');
const cc = document.getElementById('cc');
const bcc = document.getElementById('bcc');
const subject = document.getElementById('subject');
const content = document.getElementById('content');
const invalidRecipient = document.querySelector('.invalid-recipient');
const invalidCc = document.querySelector('.invalid-cc');
const invalidBcc = document.querySelector('.invalid-bcc');
const infoMessage = document.getElementById('infoMessage');
const token = document.getElementById('token');
const xToken = document.querySelector("meta[name=\"csrf-token\"]").getAttribute('content');
console.log('token', xToken);
var recipientList = [];
var ccList = [];
var bccList = [];

addEvent = (element, selector, invalid) => {
    element.addEventListener('focusout', () => {
        let arr = document.getElementById(selector).value.split(',');
        let array = arr.map(res => res.trim());
        if (selector === 'recipient') recipientList = [...array];
        if (selector === 'cc') ccList = [...array];
        if (selector === 'bcc') bccList = [...array];
        let emails = true;
        array.forEach(res => {
            if (!isValidEmail(res)) emails = false;
        })

        console.log('array: ', array);

        if (!emails && array.length > 0 && array[0].length > 0) {
            addBlockClass(invalid, 'Please add valid emails');
        } else {
            addNoneClass(invalid);
        }
    })
}

addEvent(recipient, 'recipient', invalidRecipient);
addEvent(cc, 'cc', invalidCc);
addEvent(bcc, 'bcc', invalidBcc);

function addBlockClass(element, message) {
    element.textContent = message;
    element.classList.add('d-block');
    element.classList.remove('d-none');
}

function addNoneClass(element) {
    element.textContent = '';
    element.classList.add('d-none');
    element.classList.remove('d-block');
}

function isValidEmail(emailAdress){
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (emailAdress.match(regex))
        return true;

    else
        return false;
}


const submit = document.getElementById('submit');
submit.addEventListener('click', () => {
    console.log('send: ', recipientList);
    const formData = new FormData();
    formData.append('name', 'feras');
    fetch('http://localhost:8000/send', {
        method: "POST",
        headers: {
            'Content-Type': "application/json; charset=utf-8; boundary=" + Math.random().toString().substr(2),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            recipient: recipientList,
            cc: ccList,
            bcc: bccList,
            subject: subject.value,
            content: content.value,
            _token: token.value,
        }),
    })
        .then(response => {})
        .catch(error => {
            console.log(error);
            infoMessage.textContent = 'Error is happened while sending email!'
        })
});

