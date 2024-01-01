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

async function removeDialog(){
    const dialog = document.querySelector('.confirmation');
    if(dialog){
        dialog.remove();
    }
}

const deleteButtonEle = document.querySelectorAll('.btn-delete');

deleteButtonEle.forEach((deleteButton)=>{
    deleteButton.addEventListener('click',function(e){
        //first remove element if exists
        removeDialog();

        //get current clicked user id
        const id = e.target.closest('.btn-delete').dataset.id;

        //generate and insert html into actual html code
        deleteUser(id);

        //on click remove js html from dom
        const cancelButtons = document.querySelectorAll('.btn-cancel');

       cancelButtons.forEach((btnCancel)=>{
        btnCancel.addEventListener('click',function(){
            removeDialog();
        })
       })

    })
});