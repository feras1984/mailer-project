const localHost = "http://localhost:8000";
const recipient = document.getElementById('recipient');
const cc = document.getElementById('cc');
const bcc = document.getElementById('bcc');
const subject = document.getElementById('subject');
const content = document.getElementById('content');
const invalidRecipient = document.querySelector('.invalid-recipient');
const invalidCc = document.querySelector('.invalid-cc');
const invalidBcc = document.querySelector('.invalid-bcc');
const infoMessage = document.getElementById('infoMessage');
const xToken = document.querySelector("meta[name=\"csrf-token\"]").getAttribute('content');
const addFile = document.getElementById('add-file');
const fileUpload = document.getElementById('file-upload');
const displayFiles = document.querySelector('.display-files');
let files = [];
var recipientList = [];
var ccList = [];
var bccList = [];

convertBase64 = (file) => {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = () => {
            resolve(fileReader.result);
        };

        fileReader.onerror = (error) => {
            reject(error);
        };
    });
};

addEvent = (element, selector, invalid) => {
    element.addEventListener('focusout', () => {
        let arr = document.getElementById(selector).value.split(',');
        let array = arr.map(res => res.trim()).filter(res => res.length > 0);
        if (selector === 'recipient') recipientList = [...array];
        if (selector === 'cc') ccList = [...array];
        if (selector === 'bcc') bccList = [...array];
        let emails = true;
        array.forEach(res => {
            if (!isValidEmail(res)) emails = false;
        })

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

//Adding Some Files:
addFile.addEventListener('click', function () {
    fileUpload.click();
})

//Store File:
fileUpload.addEventListener('change', async (event) => {
    // console.log(event.target.files);
    let name = event.target.files[0].name;
    let file = await convertBase64(event.target.files[0]);
    files = [...files, {name, file}];
    console.log(files);
    let p = document.createElement('p');
    p.textContent = event.target.files[0].name;
    displayFiles.append(p);
})


const submit = document.getElementById('submit');
submit.addEventListener('click', () => {
    infoMessage.textContent = '';
    // console.log('send: ', recipientList);
    const formData = new FormData();
    formData.append('recipients', recipientList);
    formData.append('cc', ccList);
    formData.append('bcc', bccList);
    formData.append('subject', subject.value);
    formData.append('content', content.value);
    // formData.append('files[]', files);
    fetch(`${localHost}/send`, {
        method: "POST",
        headers: {
            'Content-Type': "application/json; charset=utf-8; boundary=" + Math.random().toString().substr(2),
            'X-CSRF-TOKEN': xToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            recipient: recipientList,
            cc: ccList,
            bcc: bccList,
            subject: subject.value,
            content: content.value,
            files,
        }),
        // body: formData,
    })
        .then(response => {
            if (response.ok) {
                infoMessage.textContent = 'Message has been successfully sent!';
                infoMessage.classList.remove('text-danger');
                infoMessage.classList.add('text-success');

            } else {
                response.json().then(json => {
                    infoMessage.textContent = json.message;
                    infoMessage.classList.add('text-danger');
                    infoMessage.classList.remove('text-success');
                })
            }
        })
        .catch(error => {
            console.log(error);
            infoMessage.textContent = 'Error is happened while sending email!'
            infoMessage.classList.add('text-danger');
            infoMessage.classList.remove('text-success');
        })
});


