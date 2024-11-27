<!DOCTYPE html>
<html>
<head>
    <title>สร้างกราฟด้วย Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>DashBoard</title>
</head>
<body>
    <h1>ตัวอย่างกราฟ</h1>
    <canvas id="myChart" width="400" height="200"></canvas>
    
    <script>
        // ดึงข้อมูลจากไฟล์ PHP
        fetch('getdata.php') // แก้ไข path ตามไฟล์ PHP ของคุณ
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.fullname); // แก้ไข field ของคุณ
                const values = data.map(item => item.fullname); // แก้ไข field ของคุณ

                // สร้างกราฟด้วย Chart.js
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar', // ประเภทของกราฟ เช่น bar, line, pie
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'ชื่อกราฟของคุณ',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>
</body>
</html>
