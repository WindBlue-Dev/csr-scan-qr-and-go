<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>OTP TEST</title>
    <style>
        body {
            margin: 20px;
        }

        form {
            max-width: 500px;
            border: 1px solid #555;
            margin: 0 auto;
        }

        input {
            margin-bottom: 15px;
        }

        .wb_btn {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="add-user-form" class="p-2" novalidate>
            <input type="text" name="phone" class="form-control form-control-lg wb-phone" maxlength="10" placeholder="เบอร์มือถือ" pattern="[0-9]{10}" required />
            <input type="submit" value="รับส่วนลด" class="btn btn-primary btn-block btn-lg wb_btn " id="add-user-btn">
        </form>
        <form id="verify-otp-form" class="p-2" style="display:none;">
            <input type="text" name="otp" class="form-control form-control-lg wb-otp" maxlength="6" placeholder="OTP" pattern="[0-9]{6}" required />
            <input type="submit" value="ยืนยัน OTP" class="btn btn-primary btn-block btn-lg wb_btn " id="verify-otp-btn">
        </form>
    </div>

    <script>
    const addForm = document.getElementById("add-user-form");
    const verifyOtpForm = document.getElementById("verify-otp-form");
    const userPhone = document.querySelector(".wb-phone");
    const userOtp = document.querySelector(".wb-otp");

    let token = ''; // ตัวแปรเก็บค่า token

    addForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const options = {
            method: 'POST',
            headers: {
                accept: 'application/json',
                'content-type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                key: '1816207780658161',
                secret: 'f813be829b84c02e4b807fadfeba7f9d',
                msisdn: userPhone.value
            })
        };

        fetch('https://crm.beger.co.th/proxy.php?t=r', options)
            .then(res => res.json())
            .then(res => {
                console.log(res);
                if (res.status === 'success') {
                    token = res.token; // เก็บค่า token ที่ได้รับ
                    verifyOtpForm.style.display = "block";
                    addForm.style.display = "none";
                } else {
                    console.log("OTP ส่งไม่สำเร็จ");
                }
            })
            .catch(err => {
                console.error(err);
            });
    });

    verifyOtpForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const options = {
            method: 'POST',
            headers: {
                accept: 'application/json',
                'content-type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                key: '1816207780658161',
                secret: 'f813be829b84c02e4b807fadfeba7f9d',
                token: token, // ใช้ค่า token ที่เก็บไว้
                pin: userOtp.value // ค่า pin ที่ผู้ใช้กรอก
            })
        };

        fetch('https://crm.beger.co.th/proxy.php?t=v', options)
            .then(res => res.json())
            .then(res => {
                console.log(res);
                if (res.status === 'success') {
                    console.log("OTP ถูกต้อง");
                    // ทำการบันทึกข้อมูลหรือดำเนินการต่อไป
                } else {
                    console.log("OTP ไม่ถูกต้อง");
                }
            })
            .catch(err => {
                console.error(err);
            });
    });
</script>

</body>

</html>