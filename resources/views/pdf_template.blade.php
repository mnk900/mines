<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content table th, .content table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        User Profile Information
    </div>
    <div class="content">
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <!-- Add other fields as needed -->
        </table>
    </div>
</body>
</html>
