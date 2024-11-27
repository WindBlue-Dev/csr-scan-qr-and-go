const addModal = new bootstrap.Modal(document.getElementById("addNewUserModal"));
console.log(addModal);
const addForm = document.getElementById("add-user-form");
const verifyOtpForm = document.getElementById("verify-otp-form");
const userPhone = document.querySelector(".wb-phone");
const userOtp = document.querySelector(".wb-otp");
const showAlert = document.getElementById("showAlert");
const checkBox = document.querySelector("#otherskill");
const skillbox = document.querySelector(".skillbox");
const termchk = document.getElementById("termchk");
const otpOverlay = document.getElementById("otp-overlay");
let btn = document.querySelector("#add-user-btn");
let qr_code_element = document.querySelector(".qr-box");
let qr_contain = document.querySelector(".qr-container");
let token = '';
let formData = null;

// ฟังก์ชันสำหรับการอ่านค่า Cookie
function getCookie(member) {
    let cookieArr = document.cookie.split(";");
    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if (member === cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

// ตรวจสอบว่ามี cookie ที่ชื่อว่า 'member' หรือไม่
let memberCookie = getCookie("member");
if (memberCookie) {
    let userid = ''
    userid = memberCookie;
    qr_contain.style = "";
    showAlert.innerHTML = "ท่านเคยลงทะเบียนแล้ว ท่านสามารถใช้ QR CODE นี้รับส่วนลดได้เลย";
    generate(userid);
    console.log("มี cookie 'member'");
} else {
    console.log("ไม่มี cookie 'member'");

    verifyOtpForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        formData = new FormData(addForm); // อัพเดท formData ใหม่อีกครั้ง

        const options = {
            method: 'POST',
            headers: {
                accept: 'application/json',
                'content-type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                key: '',
                secret: '',
                token: token, // ใช้ค่า token ที่เก็บไว้
                pin: userOtp.value // ค่า pin ที่ผู้ใช้กรอก
            })
        };

        try {
            const res = await fetch('https://crm.beger.co.th/proxy.php?t=v', options);
            const data = await res.json();

            if (data.status === 'success') {
                console.log("OTP ถูกต้อง");
                e.preventDefault();
                const formData = new FormData(addForm);
                formData.append("add", 1);

                const response = await fetch("action.php", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();

                if (result.status === "success") {
                    const userid = result.id;

                    if (qr_code_element.childElementCount === 0) {
                        generate(userid);
                        showAlert.innerHTML = result.message;
                        document.getElementById("add-user-btn").value = "รับส่วนลด";
                        addForm.reset();
                        qr_contain.style = "";
                        otpOverlay.style.display = "none";
                        document.getElementById("add-user-btn").style.display = "none";
                        addForm.classList.remove("was-validated");
                        addModal.hide(); // ย้ายการเรียกใช้งาน addModal.hide() มาที่นี่
                        document.getElementById("addBtn").style = "display:none!important";
                    } else {
                        qr_code_element.innerHTML = "";
                        generate(userid);
                    }
                } else {
                    showAlert.innerHTML = result.message;
                    document.getElementById("add-user-btn").value = "รับส่วนลด";
                }
            } else {
                console.log("OTP ไม่ถูกต้อง");
                showAlert.innerHTML = "OTP ไม่ถูกต้อง";
            }
        } catch (err) {
            console.error('Failed to parse JSON:', err);
            showAlert.innerHTML = "เกิดข้อผิดพลาด: " + err.message;
        }
    });

    checkBox.addEventListener('change', function () {
        if (this.checked) {
            skillbox.style = "";
            document.getElementById("skills").required = true;
        } else {
            skillbox.style = "display:none";
            document.getElementById("skills").required = false;
            document.getElementById("skills").value = "";
        }
    });

    termchk.addEventListener('change', function () {
        if (this.checked) {
            btn.disabled = false;
        } else {
            btn.disabled = true;
            btn.style = "";
        }
    });
}

function generate(userid) {
    const qr_code_element = document.querySelector(".qr-box");
    qr_code_element.style = "";
    var qrcode = new QRCode(qr_code_element, {
        text: `${userid}`,
        width: 180,
        height: 180,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
}

addForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    formData = new FormData(addForm);
    const options = {
        method: 'POST',
        headers: {
            accept: 'application/json',
            'content-type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            key: '',
            secret: '',
            msisdn: userPhone.value
        })
    };

    fetch('https://crm.beger.co.th/proxy.php?t=r', options)
        .then(res => res.json())
        .then(res => {
            if (res.status === 'success') {
                token = res.token;
                console.log("OTP ส่งสำเร็จ");
                otpOverlay.style.display = "block";
                addModal.hide();
            } else {
                console.log("OTP ส่งไม่สำเร็จ");
                showAlert.innerHTML = "OTP ส่งไม่สำเร็จ";
            }
        })
        .catch(err => {
            console.error(err);
        });
});
