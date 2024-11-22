<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Card Stack Design</title>
<style>
  /* Container for centering */
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #ffffff;
  }

  /* Base style for each card */
  .card {
    position: absolute;
    width: 300px;
    height: 200px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  /* Style for each color card */
  .card1 {
    background: linear-gradient(to right, #ff5722, #ff7043);
    transform: rotate(-10deg);
    top: 50px;
    left: 50px;
  }

  .card2 {
    background: linear-gradient(to right, #ff9800, #ffc107);
    transform: rotate(-5deg);
    top: 30px;
    left: 80px;
  }

  .card3 {
    background: linear-gradient(to right, #2196f3, #42a5f5);
    transform: rotate(0deg);
    top: 10px;
    left: 110px;
  }

  /* Optional: Text styling for watermark or branding */
  .watermark {
    position: absolute;
    bottom: 10px;
    left: 10px;
    font-size: 14px;
    color: rgba(0, 0, 0, 0.3);
    font-family: Arial, sans-serif;
  }
</style>
</head>
<body>

<div class="container">
  <div class="card card1"></div>
  <div class="card card2"></div>
  <div class="card card3"></div>
  <div class="watermark">VIN JHON TERPAL</div>
</div>

</body>
</html>
