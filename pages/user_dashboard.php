<!DOCTYPE html>
<html>
<head>
  <title>User Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f7fc;
    }
    .header {
      background-color: #0a2c49;
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
    }
    .container {
      padding: 30px;
      max-width: 800px;
      margin: auto;
    }
    .card {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }
    .card h2 {
      margin-top: 0;
    }
    .btn {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
    }
    .btn:hover {
      background-color: #0056b3;
    }
    .issue-box {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>
<body>

<div class="header">
  <div><strong>SAP Consulting Platform</strong></div>
  <div>
    <a href="#">Dashboard</a>
    <a href="#">Browse Issues</a>
    <a href="#">Demo User</a>
  </div>
</div>

<div class="container">
  <div class="card">
    <h2>Welcome, Demo User</h2>
    <p>Total Issues: <strong>3</strong></p>
    <p>Open Issues: <strong>1</strong></p>
    <p>Resolved: <strong>1</strong></p>
    <a href="post_issue.php" class="btn">+ Post New Issue</a>
  </div>

  <div class="card">
    <h3>Your Issues</h3>
    <div class="issue-box">
      <span>SAP Material Master Issue</span>
      <a href="view_issue.php" class="btn">View Details</a>
    </div>
  </div>
</div>

</body>
</html>
