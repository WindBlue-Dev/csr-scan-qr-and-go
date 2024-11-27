const addForm = document.getElementById("add-user-form");
const sendQR = document.getElementById("sendQR");
const tbody = document.querySelector("tbody");
const userPhone = document.getElementById("dealerPhone");
const showAlert = document.getElementById("showAlert");



if (userPhone) {
    const fetchAllUsers = async () => {
        const data = await fetch("action.php?p=" + userPhone.value, {
            method: "GET"
        })
        const response = await data.text();
        tbody.innerHTML = response;
        showAlert.innerHTML = response;
    }
    fetchAllUsers();
} else {

}

addForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(addForm);
    formData.append("add", 1);
    if (addForm.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        const response = await data.text();
        showAlert.innerHTML = response;
        addForm.classList.add("was-validated");

        return false;
    } else {
        document.getElementById("add-user-btn").value = "กรุณารอ";
        const data = await fetch("action.php?login", {
            method: "POST",
            body: formData
        })
        if (userPhone.value != "") {
            const response = await data.text();
            addBtn.style = "display:none";
            addForm.classList.remove("was-validated");
            addModal.hide();
            showAlert.innerHTML = response;
            document.location.reload(true);
        } else {
            // console.log("not valid input");
        }

    }
});

// sendQR.addEventListener("submit", async (e) => {
//     e.preventDefault();
//     const formData = new FormData(addForm);
//     formData.append("add", 1);
//     if (addForm.checkValidity() === false) {
//         e.preventDefault();
//         e.stopPropagation();
//         const response = await data.text();
//         showAlert.innerHTML = response;
//         addForm.classList.add("was-validated");

//         return false;
//     } else {
//         document.getElementById("add-user-btn").value = "กรุณารอ";
//         const data = await fetch("action.php?login", {
//             method: "POST",
//             body: formData
//         })
//         if (userPhone.value != "") {
//             const response = await data.text();
//             addBtn.style = "display:none";
//             addForm.classList.remove("was-validated");
//             addModal.hide();
//             showAlert.innerHTML = response;
//             document.location.reload(true);
//         } else {
//             // console.log("not valid input");
//         }

//     }
// });