async function deleteUser(id) {
    const bodyEle = document.getElementById("body");
    const popUpHtml = `
    <div class="confirmation d-flex align-items-center hide" style="gap:2rem;justify-content:space-between">
    <p>Are you sure you want to delete?</p>
    <span class="d-flex align-items-center" style="gap:.5rem;">
        <a href="/delete/${id}" style="font-size: 1.33rem;color:rgb(33, 179, 76);">Ok</a>
        <button  class="btn btn-cancel"
            style="border:none;background:transparent;outline:none;color:rgb(215, 45, 91);">Cancel</button>
    </span>
</div>
    `;

    bodyEle.insertAdjacentHTML("afterbegin", popUpHtml);
}

async function removeDialog() {
    const dialog = document.querySelector(".confirmation");
    if (dialog) {
        dialog.remove();
    }
}

async function dialog() {
    const deleteButtonEle = document.querySelectorAll(".btn-delete");

    deleteButtonEle.forEach((deleteButton) => {
        deleteButton.addEventListener("click", function (e) {
            //first remove element if exists
            removeDialog();

            //get current clicked user id
            const id = e.target.closest(".btn-delete").dataset.id;

            //generate and insert html into actual html code
            deleteUser(id);

            //on click remove js html from dom
            const cancelButtons = document.querySelectorAll(".btn-cancel");

            cancelButtons.forEach((btnCancel) => {
                btnCancel.addEventListener("click", function () {
                    removeDialog();
                });
            });
        });
    });
}

function selector(id) {
    return document.querySelector(id);
}

function validateForm() {
    const name = selector("#name");
    const email = selector("#email");
    const password = selector("#password");
    const submitButton = selector("button[type='submit']");

    function disableFormSubmission() {
        submitButton.addEventListener("click", (e) => {
            e.preventDefault();
        });
        submitButton.setAttribute("disabled", true);
    }

    function enableFormSubmission() {
        submitButton.removeEventListener("click", (e) => {
            e.preventDefault();
        });
        submitButton.removeAttribute("disabled");
    }

    function isNameValid() {
        return name.value && name.value.length >= 3;
    }

    function isEmailValid() {
        return (
            email.value &&
            /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)
        );
    }

    function isPasswordValid() {
        return !password || (password.value && password.value.length >= 7);
    }

    function updateFormSubmission() {
        if (isNameValid() && isEmailValid() && isPasswordValid()) {
            enableFormSubmission();
        } else {
            disableFormSubmission();
        }
    }

    name.addEventListener("input", updateFormSubmission);
    email.addEventListener("input", updateFormSubmission);

    if (password) {
        password.addEventListener("input", updateFormSubmission);
    }

    disableFormSubmission();
    return updateFormSubmission;
}


function init(){
    dialog();
    validateForm();
}

init();
