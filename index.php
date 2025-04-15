<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="toastr.min.css">
    <script src="toastr.min.js"></script>
<style>
            .update-transaction-section {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            align-items: center;
            justify-content: center;
            z-index: 1000; /* Ensure it appears above other content */
        }

        .update-transaction-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            max-width: 600px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .update-transaction-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .update-transaction-group label {
            width: 80px;
            font-size: 14px;
            color: black;
        }

        .update-transaction-input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 20px; /* Rounded corners */
            font-size: 14px;
            margin-left: 10px;
            box-sizing: border-box;
            border: 1px solid black;
        }

        .update-transaction-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            background-color: #6ec092;
            color: white;
            font-size: 14px;
            cursor: pointer;
            margin-left: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .update-transaction-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .update-transaction-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 10px; /* Close spacing between buttons */
        }
        .search-results-section{
            margin-left: 20px;
            margin-right:20px;
            margin-bottom:20px;
        }
        /* Overlay for background dimming */
        .reservation-dialog {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .dialog-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .close-dialog {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .dialog-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-reservation-details {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #fff;
            font-size: 16px;
            color: #333;
        }

        .input-reservation-details:focus {
            border-color: #6ec092;
            outline: none;
            box-shadow: 0 0 8px rgba(110, 192, 146, 0.3);
        }

        .btn-reservation-delete,
        .btn-reservation-update {
            padding: 12px 20px;
            width: 100%;
            font-size: 16px;
            background-color: #6ec092;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s ease;
        }   

        .btn-reservation-delete:hover {
            background-color: #f76c6c;
        }

        .btn-reservation-update:hover {
            background-color: #4cae4c;
        }

        .reservation-buttons {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: #d3d3d3;
            border-radius: 20px;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 280px;
            text-align: center;
            position: relative;
        margin-top: 20px;
        margin-left: 20px;
        }

        .image-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            float: left;

        }

        .image-container img {
            width: 100%;
            height: 100%;
            border-radius: 20%;
            object-fit: cover;
            border: 2px solid white;
        }

        .info h2 {
            font-size: 24px;
            margin: 0;
            font-weight: normal;
        }

        .info p {
            font-size: 14px;
            color: gray;
            margin: 5px 0 20px;
            
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .buttons button {
            background-color: #90EE90;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .buttons button:hover {
            background-color: #7ed57e;
        }

        #login-btn, #logout-btn {
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Card Styles */
        .card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card .info {
            margin-bottom: 10px;
        }

        .card .buttons {
            display: flex;
            justify-content: space-between;
        }

        /* Dialog Styles */
        .dialog {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .dialog-content {
            padding: 20px;
        }

        .close-btn {
            float: right;
            font-size: 20px;
            cursor: pointer;
        }

        .page-section {
        display: none;
        padding: 20px;
        }

        .nav-link {
        text-decoration: none;
        color: #333;
        padding: 8px 16px;
        }

        .nav-link:hover {
        background-color: #f0f0f0;
        }

        /* Hide sections by default */
        .page-section:not(#userlog) {
        display: none;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .print-btn {
            background-color: #6ec092;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .print-btn:hover {
            background-color: #5ba77d;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            .print-content, .print-content * {
                visibility: visible;
            }
            .print-content {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    /* Table Styling */
    .menu-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .menu-table th, .menu-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .menu-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    /* Dialog Box Styling */
    #menu-ud-opr-dialog {
        display: none; /* Initially hidden */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        padding: 20px;
        font-family: Arial, sans-serif;
        box-sizing: border-box;
    }

    #menu-ud-opr-dialog label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    #menu-ud-opr-dialog input[type="text"],
    #menu-ud-opr-dialog input[type="number"],
    #menu-ud-opr-dialog textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        box-sizing: border-box;
    }

    #menu-ud-opr-dialog textarea {
        resize: vertical;
    }

    #menu-ud-opr-dialog img {
        display: block;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    #menu-ud-opr-dialog button {
        padding: 10px 15px;
        margin-right: 10px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }

    #menu-ud-opr-dialog button[type="submit"] {
        background-color: #4CAF50;
        color: white;
    }

    #menu-ud-opr-dialog button[type="button"] {
        background-color: #f44336;
        color: white;
    }

    #menu-ud-opr-dialog button#menu-ud-opr-close {
        background-color: #aaa;
        color: white;
    }

    menu-ud-opr-dialog button:hover {
        opacity: 0.9;
    }
    /* General form styling */
    #uniqueAddMenuForm {
        width: 100%;
        max-width: 500px;
        margin: 0 auto; /* Center the form */
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
        font-family: Arial, sans-serif;
        box-sizing: border-box;
    }

    /* Grouping inputs */
    #uniqueAddMenuForm .input-group {
        margin-bottom: 15px;
        }

        /* Labels */
        #uniqueAddMenuForm .input-label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        /* Input fields and textarea */
        #uniqueAddMenuForm .input-unique-details {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Textarea customization */
        #uniqueAddMenuForm textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Button container */
        #uniqueAddMenuForm .unique-button-container {
            text-align: center;
        }

        /* Button styles */
        #uniqueAddMenuForm .btn-unique-add-menu {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #uniqueAddMenuForm .btn-unique-add-menu:hover {
            background-color: #45a049;
        }




    /* Reservation Calendar Dialog Box Styling */
    #date-reservation-dialog.date-reservation-dialog {
        display: none; /* Hidden by default */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    #date-reservation-dialog .date-reservation-dialog-content {
        text-align: center;
        position: relative;
    }

    /* Close Button Styling */
    #date-reservation-dialog .date-reservation-close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    /* Month and Year Display Styling */
    #date-reservation-dialog .date-reservation-month-year {
        font-size: 1.5em;
        margin: 10px 0;
    }

    /* Calendar Grid Styling */
    #date-reservation-dialog .date-reservation-calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr); /* 7 columns for days of the week */
        gap: 5px;
        margin: 20px 0;
    }

    #date-reservation-dialog .date-reservation-calendar .date-reservation-day {
        padding: 10px;
        border: 1px solid #ccc;
        cursor: pointer;
    }

    #date-reservation-dialog .date-reservation-calendar .date-reservation-day.selected {
        background-color: blue;
        color: white;
    }

    /* Navigation Buttons Styling */
    #date-reservation-dialog .date-reservation-navigation {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
    }

    #date-reservation-dialog .date-reservation-navigation button {
        padding: 10px 20px;
        cursor: pointer;
    }

    /* Action Buttons Styling */
    #date-reservation-dialog .date-reservation-action-buttons {
        margin-top: 20px;
    }

    #date-reservation-dialog .date-reservation-action-buttons button {
        padding: 10px 20px;
        margin: 5px;
        cursor: pointer;
    }
    .date-reservation-day.reserved {
        background-color: #ffcccb; /* Reserved date color */
    }

    .date-reservation-day.selected {
        background-color: #6fa3ef; /* Selected date color */
    }
    .date-reservation-day.disabled {
    color: #ccc;
    background-color: #f5f5f5;
    pointer-events: none;
    }
    #add-table-canvas-form {
            display: flex;
            gap: 10px;
        }

        input, select, button {
            padding: 8px;
            font-size: 16px;
        }

        #table-layout-canvas {
            width: 100%;
            height: 600px;
            border: 2px solid #333;
            position: relative;
            background-color: rgb(45, 10, 10);
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            float: left;  
        }

        .table-item {
            width: 80px;
            height: 80px;
            background: linear-gradient(145deg, #6ec092, #5ba77d);
            color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            position: absolute;
            display: flex;
            flex-direction: column;
            
            justify-content: center;
            font-weight: bold;
            cursor: move;
            user-select: none;
            transition: box-shadow 0.3s ease;
            padding: 5px;
            text-align: center;
            font-size: 12px;
            line-height: 1.2;
        }

        .table-item:hover {
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
            transform: translateY(-2px);
        }

        .table-item .table-name {
            font-size: 14px;
            margin-bottom: 2px;
        }

        .table-item .table-capacity {
            font-size: 12px;
            opacity: 0.9;
        }

        .table-form-container {
    float: right;                /* Float the form to the right */
    width: 40%;                  /* Occupy 40% of the container width (adjust as needed) */
    max-width: 800px;           /* Still cap the max width if you like */
    margin-left: 10px;          /* Spacing on the left so it doesn't bump into the table */
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
 }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        .btn-primary {
            background-color: #6ec092;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover,
        .btn-success:hover {
            opacity: 0.9;
        }

        #table-layout-canvas {
            background:rgb(45, 10, 10);
            border: 2px dashed #ccc;
            position: relative;
            margin-top: 20px;
            min-height: 400px;
        }

        .table-item {
            background: linear-gradient(145deg, #6ec092, #5ba77d);
            color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: move;
            user-select: none;
            transition: box-shadow 0.3s ease;
        }

        .table-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        /* Add this CSS to your existing styles */
        .reservation-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .reservation-table th, .reservation-table td {
            border: 1px solid #ddd;
            padding: 10px; /* Increased padding for better spacing */
            text-align: center;
        }

        .reservation-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .btn-reservation-update,
        .btn-reservation-delete {
            padding: 10px 15px; /* Medium-sized button */
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100px;
        }

        .btn-reservation-update {
            background-color: #4CAF50; /* Green for approve */
            color: white;
        }

        .btn-reservation-update:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .btn-reservation-delete {
            background-color: #f44336; /* Red for reject */
            color: white;
        }

        .btn-reservation-delete:hover {
            background-color: #d32f2f; /* Darker red on hover */
        }
</style>

</head>
<body>

<div class="navbar">
        <div class="logo">
            
        </div>
        <nav>
        <ul>
   
        <li><a class="nav-link" href="#Add-tables">Add tables</a></li>
    <li><a class="nav-link" href="#reservation-section">Reservation</a></li>
   
    <li><a class="nav-link" href="#userlog">User Log</a></li>
       </ul>

        </nav>
</div>

 

<section id="Add-tables" class="page-section">
    

    <h3>Existing Tables</h3>
    <table id="tables-list" class="reservation-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Capacity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tablesBody">
            <!-- Fetched table data will be populated here -->
        </tbody>
    </table>
  <div id="add-table-canvas-form">
        <div class="table-form-container">
            <h3>Table Management</h3>
            <div class="form-group">
                <label for="add-table-name-input">Table Name:</label>
                <input type="text" id="add-table-name-input" placeholder="Enter table name" required>
            </div>
            <div class="form-group">
                <label for="add-table-size-select">Table Size:</label>
                <select id="add-table-size-select">
                    <option value="2">Table for 2</option>
                    <option value="4">Table for 4</option>
                    <option value="6">Table for 6</option>
                    <option value="8">Table for 8</option>
                </select>
            </div>
            <div class="form-actions">
                <button id="add-table-button" onclick="addTable()" class="btn-primary">Add Table</button>
                <button id="save-table-layout-button" onclick="saveTables()" class="btn-success">Save Layout</button>
            </div>
        </div>
    </div>

    <div id="table-layout-canvas"></div>
</section>






<!-- reservation page start -->
<section id="reservation-section" class="page-section">
    <button id="date-reservation-button">Open Reservation Calendar</button>

    <!-- Reservation Calendar Dialog Box -->
    <div id="date-reservation-dialog" class="date-reservation-dialog">
        <div class="date-reservation-dialog-content">
            <button id="date-reservation-close" class="date-reservation-close-button">&times;</button>
            <h2>Select a Date</h2>
            <h3 id="date-reservation-month-year" class="date-reservation-month-year"></h3>
            <div id="date-reservation-calendar" class="date-reservation-calendar"></div>
            <div class="date-reservation-navigation">
                <button id="date-reservation-prev-month">Previous Month</button>
                <button id="date-reservation-next-month">Next Month</button>
            </div>
            <div id="date-reservation-action-buttons" class="date-reservation-action-buttons" style="display: none;">
                <button id="date-reservation-open">Open</button>
                <button id="date-reservation-delete">Delete</button>
            </div>
        </div>
    </div>

    <div class="reservation-section" name="reservation-section" id="reservation-section">
        <form>
            <h3 class="section-title">Enter Name:</h3>
            <div class="input-group">
                <input type="text" id="searchName" class="input-reservation" placeholder="Enter Name">
                <button type="button" id="searchBtn" class="btn-reservation-search">Search</button>
            </div>
        </form>
    </div>

   

    <div class="reservation-table-section">
        <h3>Search Results</h3>
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>From Time</th>
                    <th>To Time</th>
                    <th>Table No</th>
                    <th>Mobile No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="searchResults">
                <!-- Search results data will be populated here -->
            </tbody>
        </table>
    </div>
    <div class="reservation-table-section">
        <h3>Pending Reservations</h3>
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>Name</th>
                  
                    <th>From Time</th>
                    <th>To Time</th>
                    <th>Table No</th>
                    <th>Table Name</th>
                    <th>Mobile No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="pendingReservations">
                <!-- Pending reservation data will be populated here -->
            </tbody>
        </table>
    </div>
    <div class="reservation-table-section">
        <div class="table-header">
            <h3>Today's Reservations</h3>
            
        </div>
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>From Time</th>
                    <th>To Time</th>
                    <th>Table No</th>
                    <th>Table Name</th>
                    <th>Mobile No</th>
                    <th>Approved By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="todayReservations">
                <!-- Today's reservation data will be populated here -->
            </tbody>
        </table>
    </div>

    <div class="reservation-table-section">
        <div class="table-header">
            <h3>Tomorrow's Reservations</h3>
            
        </div>
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>From Time</th>
                    <th>To Time</th>
                    <th>Table No</th>
                    <th>Table Name</th>
                    <th>Mobile No</th>
                    <th>Approved By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tomorrowReservations">
                <!-- Tomorrow's reservation data will be populated here -->
            </tbody>
        </table>
    </div>

    <div class="reservation-dialog" id="reservation-dialog">
        <div class="dialog-content">
            <span class="close-dialog">&times;</span>
            <h2 class="dialog-title">Edit Reservation</h2>
            <input type="hidden" id="reservation-id">
            <div class="input-group">
                <label class="input-label">Name</label>
                <input type="text" id="edit-name" class="input-reservation-details">
            </div>
            <div class="input-group">
                <label class="input-label">Date</label>
                <input type="date" id="edit-date" class="input-reservation-details">
            </div>
            <div class="input-group">
                <label class="input-label">From Time</label>
                <input type="time" id="edit-from-time" class="input-reservation-details">
            </div>
            <div class="input-group">
                <label class="input-label">To Time</label>
                <input type="time" id="edit-to-time" class="input-reservation-details">
            </div>
            <div class="input-group">
                <label for="edit-table" class="input-label">Table No:</label>
                <select id="edit-table" class="input-reservation-details">
                <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>

                </select>
            </div>
            <div class="input-group">
                <label class="input-label">Mobile No</label>
                <input type="text" id="edit-mobile-no" class="input-reservation-details">
            </div>
            <div class="reservation-buttons">
                <button class="btn-reservation-delete disable-on-lock">Delete</button>
                <button class="btn-reservation-update disable-on-lock">Update</button>
            </div>
        </div>
    </div>
</section>
<!-- reservation page end --> 




<section id="userlog" class="page-section">
  <div id="employee-cards-container">
    <!-- Cards will be dynamically generated here -->
  </div>

 <!-- Login Dialog -->
 <div id="loginDialog" class="dialog">
    <div class="dialog-content">
        <span onclick="closeLoginDialog()" class="close-btn">&times;</span>
        <h3>Login</h3>
        <form id="loginForm">
            <label for="loginCode">Login Code:</label>
            <input type="password" id="loginCode" name="loginCode" placeholder="Enter your login code" required>
            <button type="button" onclick="loginEmployee()">Submit</button>
        </form>
    </div>
 </div>

</section>


<script src="chart.js"></script>
<script src="jquery-3.6.0.min.js"></script>
<script>
     function fetchTables() {
            fetch('fetchtables.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const tablesBody = document.getElementById('tablesBody');
                        tablesBody.innerHTML = ''; // Clear previous data

                        data.tables.forEach(table => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${table.id}</td>
                                <td>${table.name}</td>
                                <td>${table.capacity}</td>
                                <td><button onclick="deleteTable(${table.id})" class="btn-reservation-delete">Delete</button></td>
                            `;
                            tablesBody.appendChild(row);
                        });
                    } else {
                        console.error('Error fetching tables:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching tables:', error));
        }

        // Function to delete a table
        function deleteTable(tableId) {
            if (confirm('Are you sure you want to delete this table?')) {
                fetch('deletetable.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: tableId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Table deleted successfully!');
                        fetchTables(); // Refresh the table list
                    } else {
                        alert('Error deleting table: ' + data.message);
                    }
                })
                .catch(error => console.error('Error deleting table:', error));
            }
        }

        // Load tables on page load
        document.addEventListener('DOMContentLoaded', () => {
            fetchTables(); // Ensure this is called to load tables
        });




    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll(".page-section");
        const navLinks = document.querySelectorAll(".nav-link");

        // Function to show a specific section and hide others
        function showSection(sectionId) {
            console.log('Showing section:', sectionId); // Debug log

            // If not logged in, only show userlog section
            if (!sessionStorage.getItem('loggedIn')) {
                sections.forEach(section => {
                    if (section.id === 'userlog') {
                        section.style.display = "block";
                    } else {
                        section.style.display = "none";
                    }
                });

                // Hide other nav links except userlog and icon
                navLinks.forEach(link => {
                    const href = link.getAttribute("href");
                    if (href && href !== '#userlog' && !link.id.includes('login-link')) {
                        link.parentElement.style.display = 'none';
                    }
                });
                return;
            }

            // If logged in, show the selected section
            sections.forEach(section => {
                if (section.id === sectionId) {
                    section.style.display = "block";
                } else {
                    section.style.display = "none";
                }
            });

            // Show all nav links
            navLinks.forEach(link => {
                link.parentElement.style.display = 'block';
            });

            // Save current section to sessionStorage
            sessionStorage.setItem('currentSection', sectionId);
        }

        // Initial section display based on login status
        if (sessionStorage.getItem('loggedIn')) {
            // Get last active section or default to transaction section
            const lastSection = sessionStorage.getItem('currentSection') || 'edit-transaction-section';
            showSection(lastSection);
        } else {
            showSection('userlog');
        }

        // Add event listener for successful login
        document.addEventListener('loginSuccess', function() {
            showSection('edit-transaction-section');
        });

        // Add event listener for logout
        document.addEventListener('logout', function() {
            showSection('userlog');
        });

        // Set up navigation link click event handlers
        navLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                if (this.getAttribute("href")) {
                    event.preventDefault();
                    const targetId = this.getAttribute("href").substring(1);
                    showSection(targetId);
                }
            });
        });
    });


   

    
    function searchReservationsByUsername() {
        const username = document.getElementById('searchName')?.value;
        if (!username) {
            console.error('Username input not found or is empty');
            return;
        }

        fetch(`CRUDreservation.php?action=searchReservationsByUsername&username=${encodeURIComponent(username)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success' && data.reservations.length > 0) {
                    const searchResults = document.getElementById('searchResults');
                    searchResults.innerHTML = ''; // Clear previous results
                    
                    data.reservations.forEach(reservation => {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                            <td>${reservation.name}</td>
                            <td>${new Date(reservation.time_from).toLocaleDateString()}</td>
                            <td>${new Date(reservation.time_from).toLocaleTimeString()}</td>
                            <td>${new Date(reservation.time_to).toLocaleTimeString()}</td>
                            <td>${reservation.table_number}</td>
                            <td>${reservation.mobile}</td>
                        <td><button class="btn-edit" onclick="openEditDialog(${reservation.id})">Edit</button></td>
                        `;

                        searchResults.appendChild(row);
                    });
                } else {
                    console.log('No reservations found');
                    document.getElementById('searchResults').innerHTML = '<tr><td colspan="7">No results found</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.getElementById('searchBtn').addEventListener('click', searchReservationsByUsername);

    // Fetch reservations for today and tomorrow
    function fetchReservations() {
        fetch('CRUDreservation.php?action=fetchReservations')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    populateReservations('todayReservations', data.today);
                    populateReservations('tomorrowReservations', data.tomorrow);
                } else {
                    console.error('Error fetching reservations:', data.message);
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching reservations:', error);
                alert('Error fetching reservation data.');
            });
    }

    function populateReservations(tableId, reservations) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = ''; // Clear any previous data

    const groupedReservations = {};

    reservations.forEach(reservation => {
        const key = `${reservation.name}-${reservation.time_from}`;
        if (!groupedReservations[key]) {
            groupedReservations[key] = {
                name: reservation.name,
                time_from: reservation.time_from,
                time_to: reservation.time_to,
                table_numbers: [],
                table_names: [],
                mobiles: [],
                ids: [],
                approved_by: reservation.AppRejected_by || 'N/A'  // Default to 'N/A' if not available
            };
        }
        groupedReservations[key].table_numbers.push(reservation.table_number);
        groupedReservations[key].table_names.push(reservation.table_name);
        groupedReservations[key].mobiles.push(reservation.mobile);
        groupedReservations[key].ids.push(reservation.id);
    });

    // Create a row for each group
    for (const key in groupedReservations) {
        const reservationGroup = groupedReservations[key];
        
        // Create the first row with the grouped name, time, and table details
        const row1 = `<tr>
            <td rowspan="${reservationGroup.table_numbers.length}">${reservationGroup.name}</td>
            <td>${reservationGroup.time_from.split(' ')[0]}</td>
            <td>${reservationGroup.time_from.split(' ')[1].slice(0, 5)}</td>
            <td>${reservationGroup.time_to.split(' ')[1].slice(0, 5)}</td>
            <td>${reservationGroup.table_numbers[0]}</td>
            <td>${reservationGroup.table_names[0]}</td>
            <td>${reservationGroup.mobiles[0]}</td>
            <td>${reservationGroup.approved_by}</td>  <!-- Display Approved By -->
            <td><button class="btn-edit" onclick="openEditDialog(${reservationGroup.ids[0]})">Edit</button></td>
        </tr>`;
        
        tbody.innerHTML += row1;

        // Create subsequent rows for other reservations in the group
        for (let i = 1; i < reservationGroup.table_numbers.length; i++) {
            const row2 = `<tr>
                <td>${reservationGroup.time_from.split(' ')[0]}</td>
                <td>${reservationGroup.time_from.split(' ')[1].slice(0, 5)}</td>
                <td>${reservationGroup.time_to.split(' ')[1].slice(0, 5)}</td>
                <td>${reservationGroup.table_numbers[i]}</td>
                <td>${reservationGroup.table_names[i]}</td>
                <td>${reservationGroup.mobiles[i]}</td>
                <td>${reservationGroup.approved_by}</td>  <!-- Display Approved By -->
                <td><button class="btn-edit" onclick="openEditDialog(${reservationGroup.ids[i]})">Edit</button></td>
            </tr>`;
            
            tbody.innerHTML += row2;
        }
    }
}




        function openEditDialog(reservationId) {
            // Fetch reservation details
            fetch(`CRUDreservation.php?action=fetchReservation&id=${reservationId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('reservation-id').value = data.reservation.id;
                        document.getElementById('edit-name').value = data.reservation.name;
                        document.getElementById('edit-date').value = data.reservation.time_from.split(' ')[0];
                        document.getElementById('edit-from-time').value = data.reservation.time_from.split(' ')[1]; // Time only
                        document.getElementById('edit-to-time').value = data.reservation.time_to.split(' ')[1]; // Time only
                        document.getElementById('edit-table').value = data.reservation.table_number;
                        document.getElementById('edit-mobile-no').value = data.reservation.mobile;
                        document.getElementById('reservation-dialog').style.display = 'block';
                    } else {
                        alert(data.message || 'Error fetching reservation details.');
                    }
                })
                .catch(error => console.error('Error fetching reservation details:', error));
         }

        // Close the dialog when the 'X' is clicked
        document.querySelector('.close-dialog').addEventListener('click', () => {
            document.getElementById('reservation-dialog').style.display = 'none';
    });


    document.querySelector('.btn-reservation-update').addEventListener('click', updateReservation);

        // Function to update reservation
        
        function updateReservation() {
        const id = document.getElementById('reservation-id').value;
        const name = document.getElementById('edit-name').value;
        const date = document.getElementById('edit-date').value;
        const fromTime = document.getElementById('edit-from-time').value;
        const toTime = document.getElementById('edit-to-time').value;
        const tableNo = document.getElementById('edit-table').value;
        const mobileNo = document.getElementById('edit-mobile-no').value;

        // Basic validation
        const currentDate = new Date().toISOString().split('T')[0];
        if (date < currentDate) {
            alert("You cannot reserve a table for a past date.");
            return;
        }

        const reservationFromMinutes = timeToMinutes(fromTime);
        const reservationToMinutes = timeToMinutes(toTime);

        // Time slots
        const timeSlots = {
            morning: [timeToMinutes("08:00"), timeToMinutes("10:00")],
            afternoon: [timeToMinutes("13:00"), timeToMinutes("15:00")],
            night: [timeToMinutes("20:00"), timeToMinutes("22:00")],
        };

        let validSlot = false;
        for (const [start, end] of Object.values(timeSlots)) {
            if (reservationFromMinutes >= start && reservationToMinutes <= end) {
                validSlot = true;
                break;
            }
        }

        if (!validSlot) {
            alert("Reservations can only be made in the following slots:\n" +
                "Morning: 08:00 - 10:00\nAfternoon: 13:00 - 15:00\nNight: 20:00 - 22:00");
            return;
        }

        // Step 1: Check date availability
        fetch('checkDateAvailability.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ date }),
        })
            .then(response => response.json())
            .then(dateData => {
                if (!dateData.success) {
                    alert(dateData.message || "Selected date is unavailable.");
                    return;
                }

                // Step 2: Check for time conflicts
                fetch('CRUDreservation.php?action=checkConflict', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id, // Pass current reservation ID to exclude it from conflict check
                        table_no: tableNo,
                        from_time: `${date} ${fromTime}:00`,
                        to_time: `${date} ${toTime}:00`,
                    }),
                })
                    .then(response => response.json())
                    .then(conflictData => {
                        if (conflictData.status === 'conflict') {
                            alert(`This table is already reserved for the selected time slot.\n` +
                                `Existing reservation: ${conflictData.conflictDetails.from_time} to ${conflictData.conflictDetails.to_time}`);
                            return;
                        }

                        // Step 3: Proceed with the reservation update
                        fetch('CRUDreservation.php?action=updateReservation', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                id,
                                name,
                                from_time: `${date} ${fromTime}:00`,
                                to_time: `${date} ${toTime}:00`,
                                table_no: tableNo,
                                mobile_no: mobileNo,
                            }),
                        })
                            .then(response => response.json())
                            .then(updateData => {
                                if (updateData.status === 'success') {
                                    alert('Reservation updated successfully!');
                                    fetchReservations();
                                    document.getElementById('reservation-dialog').style.display = 'none';
                                } else {
                                    alert('Error updating reservation: ' + updateData.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error updating reservation:', error);
                                alert('Error updating reservation data.');
                            });
                    })
                    .catch(error => {
                        console.error('Error checking conflicts:', error);
                        alert('Error checking for reservation conflicts.');
                    });
            })
            .catch(error => {
                console.error('Error checking date availability:', error);
                alert('Error checking the availability of the selected date.');
            });
      }

       // Helper: Convert time string to minutes
       function timeToMinutes(time) {
        const [hours, minutes] = time.split(':').map(Number);
        return hours * 60 + minutes;
       }




            
            // Helper function to convert time to minutes since midnight (12-hour format to 24-hour format)
            function timeToTimeMinutes(timeString) {
                const [time, period] = timeString.split(' '); // Split the time and AM/PM part
                let [hours, minutes] = time.split(':').map(num => parseInt(num, 10));

                // Convert to 24-hour time based on AM/PM
                if (period === 'PM' && hours !== 12) {
                    hours += 12;  // Convert PM hours to 24-hour format
                } else if (period === 'AM' && hours === 12) {
                    hours = 0;  // Convert 12 AM to 00 (midnight)
                }

                return hours * 60 + minutes; // Return the time in minutes since midnight
            }

            // Event listener for edit button
            document.querySelectorAll('.btn-reservation-edit').forEach(button => {
                button.addEventListener('click', () => {
                    const reservationId = button.getAttribute('data-id'); // Assuming data-id holds the reservation ID
                    fetch(`CRUDreservation.php?action=fetchReservation&id=${reservationId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Populate fields in the edit dialog
                                document.getElementById('reservation-id').value = data.reservation.id;
                                document.getElementById('edit-name').value = data.reservation.name;
                                document.getElementById('edit-date').value = data.reservation.time_from.split(' ')[0]; // Date only
                                document.getElementById('edit-from-time').value = data.reservation.time_from.split(' ')[1]; // Time only
                                document.getElementById('edit-to-time').value = data.reservation.time_to.split(' ')[1]; // Time only
                                document.getElementById('edit-table').value = data.reservation.table_number;
                                document.getElementById('edit-mobile-no').value = data.reservation.mobile;
                                
                                document.getElementById('reservation-dialog').style.display = 'block'; // Show the edit dialog
                            } else {
                                alert('Error fetching reservation: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching reservation:', error);
                            alert('Error fetching reservation data.');
                        });
                });
            });

            document.querySelectorAll('.btn-reservation-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const id = document.getElementById('reservation-id').value; // Get the ID from hidden input

                    // Confirmation dialog
                    const isConfirmed = confirm('Are you sure you want to delete this reservation?');
                    if (!isConfirmed) {
                        return; // Exit if the user cancels
                    }

                    console.log('Sending deletion request for ID:', id);

                    fetch(`CRUDreservation.php?action=deleteReservation`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id }) // Send the ID in the request body
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        console.log('Response from server:', data); // Log the server response
                        if (data.status === 'success') {
                            alert('Reservation deleted successfully!');
                            fetchReservations(); // Refresh the reservation lists
                            document.getElementById('reservation-dialog').style.display = 'none'; // Close the dialog after deletion
                        } else {
                            alert('Error deleting reservation: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting reservation:', error);
                        alert('Error deleting reservation data.');
                    });
                });
    });

    // Initial fetch of reservations
    fetchReservations();

    // Fetch employee data and populate cards
    function fetchEmployees() {
        fetch('FetchEmpOnCMS.php')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('employee-cards-container');
                container.innerHTML = ''; // Clear existing cards

                data.forEach(employee => {
                    const card = document.createElement('div');
                    card.classList.add('card');
                    card.innerHTML = `
                        <div class="info">
                            <h2>${employee.name}</h2>
                            <p>${employee.post}</p>
                        </div>
                        <div class="buttons">
                            <button id="login-btn-${employee.id}" onclick="openLoginDialog(${employee.id}, '${employee.name}', '${employee.post}')">Log-in</button>
                            <button id="logout-btn-${employee.id}" style="display:none" onclick="logoutEmployee(${employee.id})">Log-out</button>
                        </div>
                    `;
                    container.appendChild(card);

                    // Check if this employee is logged in and update the button states
                    if (sessionStorage.getItem('loggedIn') === 'true' && sessionStorage.getItem('employeeId') == employee.id) {
                        document.getElementById(`login-btn-${employee.id}`).textContent = 'Logged In';
                        document.getElementById(`login-btn-${employee.id}`).disabled = true;
                        document.getElementById(`logout-btn-${employee.id}`).style.display = 'inline';
                    }
                });
            })
            .catch(error => console.error('Error fetching employee data:', error));
     }
    
        // Open login dialog
        let currentEmployeeId = null;
        let employeeName = null;
        let employeePost = null;

        function openLoginDialog(employeeId, name, post) {
            currentEmployeeId = employeeId;
            employeeName = name;
            employeePost = post;
            document.getElementById('loginDialog').style.display = 'block';
        }

        // Close login dialog
        function closeLoginDialog() {
            document.getElementById('loginDialog').style.display = 'none';
    }

    // Function to log in the employee
   
    // Function to logout an employee (manual or auto)
    function getFormattedLocalTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`; // Format: YYYY-MM-DD HH:mm:ss
    }

    function loginEmployee() {
        const loginCode = document.getElementById('loginCode').value;
        const loginTime = getFormattedLocalTime(); // Capture the correct local time

        

        // Check if an employee is already logged in
        if (sessionStorage.getItem('loggedIn') === 'true') {
            alert('Another employee is already logged in. Please log out first.');
            return; // Exit if another employee is logged in
        }

        const formData = new FormData();
        formData.append('action', 'login');
        formData.append('name', employeeName);
        formData.append('post', employeePost);
        formData.append('login_at', loginTime);
        formData.append('login_code', loginCode); // Add login code

    

        fetch('AddEmpLogTime.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Logged in successfully');
                    document.getElementById(`login-btn-${currentEmployeeId}`).textContent = 'Logged In';
                    document.getElementById(`login-btn-${currentEmployeeId}`).disabled = true;
                    document.getElementById(`logout-btn-${currentEmployeeId}`).style.display = 'inline';
                    closeLoginDialog();

                    // Store session and login time in sessionStorage
                    sessionStorage.setItem('loggedIn', 'true');
                    sessionStorage.setItem('employeeId', currentEmployeeId);
                    sessionStorage.setItem('employeeName', employeeName); // Store employee name in session
                    sessionStorage.setItem('employeePost', employeePost); // Store employee post in session
                    sessionStorage.setItem('loginTime', loginTime);

                    // Dispatch login success event
                    document.dispatchEvent(new Event('loginSuccess'));

                    // Add page refresh after a short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 500); // 500ms delay to ensure the alert is seen
                } else {
                    alert('Invalid login code');
                }
            })
            .catch(error => console.error('Error during login:', error));
        handleLoginSuccess();
    }

    // Function to logout an employee (manual or auto)
    function logoutEmployee(employeeId = null) {
        const logoutTime = getFormattedLocalTime(); // Capture the correct local time

    

        const storedEmployeeId = sessionStorage.getItem('employeeId');

        // Only proceed if we have stored employee data
        if (!sessionStorage.getItem('employeeName')) {
            return;
        }

        const formData = new FormData();
        formData.append('action', 'logout');
        formData.append('name', sessionStorage.getItem('employeeName'));
        formData.append('post', sessionStorage.getItem('employeePost'));
        formData.append('login_at', sessionStorage.getItem('loginTime'));
        formData.append('logout_at', logoutTime);

        fetch('AddEmpLogTime.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Only try to update UI if this was a manual logout (employeeId provided)
                    if (employeeId) {
                        const loginBtn = document.getElementById(`login-btn-${employeeId}`);
                        const logoutBtn = document.getElementById(`logout-btn-${employeeId}`);
                        
                        if (loginBtn) {
                            loginBtn.textContent = 'Log-in';
                            loginBtn.disabled = false;
                        }
                        
                        if (logoutBtn) {
                            logoutBtn.style.display = 'none';
                        }
                        
                        alert('Logged out successfully');
                    }

                    // Clear session data
                    sessionStorage.clear();

                    // Dispatch logout event
                    document.dispatchEvent(new Event('logout'));
                    
                    // Refresh the page only for manual logout
                    if (employeeId) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    }
                }
            })
            .catch(error => console.error('Error during logout:', error));
    }


    // Update the auto-logout timer setup
    function setupAutoLogout() {
        const LOGOUT_DELAY = 30 * 60 * 1000; // 30 minutes
        let logoutTimer;

        function resetLogoutTimer() {
            clearTimeout(logoutTimer);
            logoutTimer = setTimeout(() => {
                if (sessionStorage.getItem('loggedIn') === 'true') {
                    logoutEmployee(); // Auto logout without employeeId
                    window.location.reload(); // Refresh the page after auto-logout
                }
            }, LOGOUT_DELAY);
        }

        // Reset timer on user activity
        ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(event => {
            document.addEventListener(event, resetLogoutTimer, false);
        });

        // Initial setup of timer
        resetLogoutTimer();
    }

    // Call setupAutoLogout when user logs in successfully
    function handleLoginSuccess() {
        setupAutoLogout();
    }

    // Remove the old timer-related functions
    // Remove: setLogoutCookie, checkLogoutCookie, setLogoutTimer

    // Initial fetch of reservations
    fetchReservations();

    // Fetch employee data and populate cards
    fetchEmployees();

    function checkLoginAndBlockSystem() {
        if (!sessionStorage.getItem('loggedIn') || sessionStorage.getItem('loggedIn') !== 'true') {
            alert('System is locked. Please log in to access the system.');
            // Disable or hide elements related to insertion, update, and deletion
            document.querySelectorAll('.disable-on-lock').forEach(el => el.style.display = 'none'); 
            // Optionally, redirect to a login section if you want
            window.location.hash = "#userlog"; // Redirect to login section
        }
    }

    // Call this function on page load
    window.onload = checkLoginAndBlockSystem;

    function printReservations(tableId) {
        // Get the table data
        const tbody = document.getElementById(tableId);
        const reservations = [];
        
        // Convert table rows to array of objects
        tbody.querySelectorAll('tr').forEach(row => {
            const cells = row.getElementsByTagName('td');
            if (cells.length) {
                reservations.push({
                    name: cells[0].textContent,
                    date: cells[1].textContent,
                    fromTime: cells[2].textContent,
                    toTime: cells[3].textContent,
                    tableNo: cells[4].textContent,
                    mobileNo: cells[5].textContent
                });
            }
        });

        // Create print window content
        const printWindow = window.open('', '_blank');
        const title = tableId === 'todayReservations' ? "Today's Reservations" : "Tomorrow's Reservations";
        
        printWindow.document.write(`
            <html>
            <head>
                <title>${title}</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .header { text-align: center; margin-bottom: 20px; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { 
                        border: 1px solid #ddd; 
                        padding: 8px; 
                        text-align: left; 
                    }
                    th { background-color: #f2f2f2; }
                    .date-time { text-align: right; margin-bottom: 10px; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h2>${title}</h2>
                </div>
                <div class="date-time">
                    Printed on: ${new Date().toLocaleString()}
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>From Time</th>
                            <th>To Time</th>
                            <th>Table No</th>
                            <th>Mobile No</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${reservations.map(res => `
                            <tr>
                                <td>${res.name}</td>
                                <td>${res.date}</td>
                                <td>${convertTo12Hour(res.fromTime)}</td>
                                <td>${convertTo12Hour(res.toTime)}</td>
                                <td>${res.tableNo}</td>
                                <td>${res.mobileNo}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </body>
            </html>
        `);
        
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
        }

        function convertTo12Hour(time24) {
            const [hours, minutes] = time24.split(':');
            let period = 'AM';
            let hour = parseInt(hours);
            
            if (hour >= 12) {
                period = 'PM';
                if (hour > 12) hour -= 12;
            }
            if (hour === 0) hour = 12;
            
            return `${hour}:${minutes} ${period}`;
    }


        
        // Function to fetch and display pending reservations
        function fetchPendingReservations() {
            fetch('fetchpendingreservations.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const pendingBody = document.getElementById('pendingReservations');
                        pendingBody.innerHTML = ''; // Clear previous data

                        // Group reservations by name and time_from
                        const groupedReservations = {};

                        data.reservations.forEach(reservation => {
                            const key = `${reservation.name}-${reservation.time_from}`;
                            if (!groupedReservations[key]) {
                                groupedReservations[key] = {
                                    name: reservation.name || 'N/A',
                                    time_from: reservation.time_from || 'N/A',
                                    time_to: reservation.time_to || 'N/A',
                                    table_numbers: [],
                                    table_names: [],
                                    mobiles: [],
                                    ids: []
                                };
                            }
                            // Group details for the same name and time_from
                            groupedReservations[key].table_numbers.push(reservation.table_number || 'N/A');
                            groupedReservations[key].table_names.push(reservation.table_name || 'N/A');
                            groupedReservations[key].mobiles.push(reservation.mobile || 'N/A');
                            groupedReservations[key].ids.push(reservation.id);
                        });

                        // Create a row for each group
                        for (const key in groupedReservations) {
                            const reservationGroup = groupedReservations[key];
                            // Remove duplicate mobile numbers
                            const uniqueMobiles = [...new Set(reservationGroup.mobiles)];

                            const row = document.createElement('tr');
                            // Set a data attribute with the group IDs (as JSON, if needed)
                            row.setAttribute('data-ids', JSON.stringify(reservationGroup.ids));
                            row.innerHTML = `
                                <td>${reservationGroup.name}</td>
                                <td>${reservationGroup.time_from}</td>
                                <td>${reservationGroup.time_to}</td>
                                <td>${reservationGroup.table_numbers.join(', ')}</td>
                                <td>${reservationGroup.table_names.join(', ')}</td>
                                <td>${uniqueMobiles.join(', ')}</td>
                                <td>
                                    <button onclick="approveReservation(this, [${reservationGroup.ids.join(',')}])" class="btn-reservation-update">Approve</button>
                                    <button onclick="rejectReservation(this, [${reservationGroup.ids.join(',')}])" class="btn-reservation-delete">Reject</button>
                                </td>
                            `;
                            pendingBody.appendChild(row);
                        }
                    } else {
                        console.error('Error fetching pending reservations:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching pending reservations:', error));
        }

        // Function to approve reservations (whole group)
        // 'button' is the element that was clicked; 'reservationIds' is an array of IDs.
        
        // Function to approve reservations
function approveReservation(button, reservationIds) {
    const employeeName = sessionStorage.getItem('employeeName'); // Get the logged-in employee's name
    if (!employeeName) {
        alert('No employee is logged in');
        return; // Prevent further actions if no employee is logged in
    }

    fetch('approvereject.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            ids: reservationIds,
            action: 'approve',
            employee_name: employeeName // Send the logged-in employee's name to the backend
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Reservations approved successfully!');
            // Remove the entire row that contains this button
            button.closest('tr').remove();
        } else {
            alert('Error approving reservations: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error approving reservations:', error);
        alert('Error approving reservations: ' + error.message);
    });
}

// Function to reject reservations
function rejectReservation(button, reservationIds) {
    const employeeName = sessionStorage.getItem('employeeName'); // Get the logged-in employee's name
    if (!employeeName) {
        alert('No employee is logged in');
        return; // Prevent further actions if no employee is logged in
    }

    fetch('approvereject.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            ids: reservationIds,
            action: 'reject',
            employee_name: employeeName // Send the logged-in employee's name to the backend
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Reservations rejected successfully!');
            // Remove the entire row that contains this button
            button.closest('tr').remove();
        } else {
            alert('Error rejecting reservations: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error rejecting reservations:', error);
        alert('Error rejecting reservations: ' + error.message);
    });
}





            // Load pending reservations on page load
            document.addEventListener('DOMContentLoaded', () => {
                fetchPendingReservations(); // Ensure this is called to load pending reservations
            });



            let tables = [];

        function addTable() {
            let name = document.getElementById("add-table-name-input").value.trim();
            let size = document.getElementById("add-table-size-select").value;

            if (!name) {
                alert("Please enter a table name.");
                return;
            }

            // Convert size to integer
            const capacity = parseInt(size, 10);
            if (isNaN(capacity)) {
                alert("Invalid table size.");
                return;
            }

            // Check if table name and size already exist
            if (tables.some(t => t.name === name && t.capacity === capacity)) {
                alert("Table with this name and size already exists!");
                return;
            }

            let table = document.createElement("div");
            table.classList.add("table-item");
            table.innerText = `${name} (${capacity})`;
            table.dataset.name = name;
            table.dataset.capacity = capacity;

            // Default position
            table.style.left = "10px";
            table.style.top = "10px";

            // Make it draggable
            table.onmousedown = dragMouseDown;

            document.getElementById("table-layout-canvas").appendChild(table);
            tables.push({ name, capacity, x: 10, y: 10 });
        }

        function dragMouseDown(event) {
            event.preventDefault();
            let element = event.target;
            let shiftX = event.clientX - element.getBoundingClientRect().left;
            let shiftY = event.clientY - element.getBoundingClientRect().top;

            function onMouseMove(event) {
                let x = event.clientX - shiftX;
                let y = event.clientY - shiftY;

                let canvas = document.getElementById("table-layout-canvas").getBoundingClientRect();
                // Clamp coordinates within canvas bounds
                x = Math.max(0, Math.min(x, canvas.width - 60));
                y = Math.max(0, Math.min(y, canvas.height - 60));

                element.style.left = x + "px";
                element.style.top = y + "px";

                let name = element.dataset.name;
                tables = tables.map(t => t.name === name ? { ...t, x, y } : t);
            }

            document.addEventListener("mousemove", onMouseMove);
            document.addEventListener("mouseup", () => {
                document.removeEventListener("mousemove", onMouseMove);
            }, { once: true });
        }

        function saveTables() {
            fetch("save_tables.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(tables)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    console.error('Save failed:', data.message);
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Error saving tables: ' + error.message);
            });
        }

        function loadTables() {
            fetch("load_tables.php") // Verify this URL is correct
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text(); // Get raw text first for debugging
            })
            .then(text => {
                try {
                    const data = JSON.parse(text); // Attempt to parse JSON
                    if (data.success) {
                        tables = data.tables || [];
                        const canvas = document.getElementById("table-layout-canvas");
                        canvas.innerHTML = '';

                        tables.forEach(tableData => {
                            let table = document.createElement("div");
                            table.classList.add("table-item");
                            table.innerText = `${tableData.name} (${tableData.capacity})`;
                            table.dataset.name = tableData.name;
                            table.dataset.capacity = tableData.capacity;
                            table.style.left = `${tableData.x}px`;
                            table.style.top = `${tableData.y}px`;
                            table.onmousedown = dragMouseDown;
                            canvas.appendChild(table);
                        });
                    } else {
                        console.error('Load failed:', data.message);
                        alert('Error loading tables: ' + data.message);
                    }
                } catch (e) {
                    console.error('Raw response:', text); // Log the raw response
                    throw new Error('Invalid JSON: ' + e.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Error fetching tables: ' + error.message);
            });
        }

        // Load tables when the page loads
        document.addEventListener("DOMContentLoaded", loadTables);
        document.addEventListener('DOMContentLoaded', () => {
    // Get all elements from the DOM
    const reservationDialog = document.getElementById('date-reservation-dialog');
    const calendarDiv = document.getElementById('date-reservation-calendar');
    const prevMonthButton = document.getElementById('date-reservation-prev-month');
    const nextMonthButton = document.getElementById('date-reservation-next-month');
    const openReservationButton = document.getElementById('date-reservation-button');
    const openButton = document.getElementById('date-reservation-open');
    const deleteButton = document.getElementById('date-reservation-delete');
    const actionButtons = document.getElementById('date-reservation-action-buttons');
    const closeButton = document.getElementById('date-reservation-close');
    const monthYearDisplay = document.getElementById('date-reservation-month-year');

    let currentDate = new Date(); // Track the current month and year
    let selectedDates = new Set(); // Track selected dates
    let reservedDates = new Set(); // Track reserved dates

    // Open reservation dialog and fetch reserved dates
    openReservationButton.addEventListener('click', async () => {
        reservationDialog.style.display = 'block'; // Show the dialog
        await fetchReservedDates(currentDate); // Fetch reserved dates
        renderCalendar(currentDate); // Render the calendar
        actionButtons.style.display = 'none'; // Hide action buttons by default
    });

    // Close reservation dialog
    closeButton.addEventListener('click', () => {
        reservationDialog.style.display = 'none'; // Hide the dialog
    });

    // Fetch reserved dates from the server
    async function fetchReservedDates(date) {
        const year = date.getFullYear();
        const month = date.getMonth() + 1; // JavaScript months are 0-based

        try {
            const response = await fetch(`fetchdatesres.php?year=${year}&month=${month}`);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            if (data.success) {
                reservedDates = new Set(data.reservedDates.map(date => formatDate(new Date(date))));
            } else {
                console.error('Error fetching reserved dates:', data.message);
            }
        } catch (error) {
            console.error('Error during fetch:', error);
        }
    }

    // Render the calendar for the given month and year
    function renderCalendar(date) {
        const year = date.getFullYear();
        const month = date.getMonth();
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startingDay = firstDay.getDay();

        monthYearDisplay.textContent = `${date.toLocaleString('default', { month: 'long' })} ${year}`;

        calendarDiv.innerHTML = '';
        for (let i = 0; i < startingDay; i++) {
            calendarDiv.appendChild(document.createElement('div'));
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.textContent = day;
            dayDiv.classList.add('date-reservation-day');

            const dateString = formatDate(new Date(year, month, day));
            const isPastDate = isPastDateCheck(year, month, day); // Check if it's a past date

            if (reservedDates.has(dateString)) {
                dayDiv.classList.add('reserved');
            }

            if (selectedDates.has(dateString)) {
                dayDiv.classList.add('selected');
            }

            // Disable past dates
            if (isPastDate) {
                dayDiv.classList.add('disabled');
                dayDiv.style.pointerEvents = 'none'; // Disable clicking
            } else {
                dayDiv.addEventListener('click', () => toggleDateSelection(new Date(year, month, day)));
            }

            calendarDiv.appendChild(dayDiv);
        }
    }

    // Check if a date is in the past
    function isPastDateCheck(year, month, day) {
        const currentDate = new Date();
        const calendarDate = new Date(year, month, day);
        return calendarDate < currentDate.setHours(0, 0, 0, 0); // Compare only the date part
    }

    // Toggle date selection
    function toggleDateSelection(date) {
        const dateString = formatDate(date);
        if (selectedDates.has(dateString)) {
            selectedDates.delete(dateString);
        } else {
            selectedDates.add(dateString);
        }
        renderCalendar(currentDate);
        actionButtons.style.display = selectedDates.size > 0 ? 'block' : 'none';
    }

    // Handle Open button click
    openButton.addEventListener('click', async () => {
        if (selectedDates.size > 0) {
            const response = await sendDataToServer({
                action: 'store',
                dates: Array.from(selectedDates),
            });
            if (response.success) {
                alert('Dates added successfully!');
                await fetchReservedDates(currentDate);
                renderCalendar(currentDate);
                selectedDates.clear();
                actionButtons.style.display = 'none';
            } else {
                alert('Error adding dates: ' + response.message);
            }
        } else {
            alert('No dates selected.');
        }
    });

    // Handle Delete button click
    deleteButton.addEventListener('click', async () => {
        if (selectedDates.size > 0) {
            const response = await sendDataToServer({
                action: 'delete',
                dates: Array.from(selectedDates),
            });
            if (response.success) {
                alert('Dates deleted successfully!');
                await fetchReservedDates(currentDate);
                renderCalendar(currentDate);
                selectedDates.clear();
                actionButtons.style.display = 'none';
            } else {
                alert('Error deleting dates: ' + response.message);
            }
        } else {
            alert('No dates selected.');
        }
    });

    // Convert date to YYYY-MM-DD format
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Send data to the server
    async function sendDataToServer(data) {
        try {
            const response = await fetch('storedeletereservation.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('Error during request:', error);
            return { success: false, message: error.message };
        }
    }

    // Handle Previous Month button click
    prevMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1); // Move to the previous month
        fetchReservedDates(currentDate).then(() => renderCalendar(currentDate)); // Fetch and render calendar
    });

    // Handle Next Month button click
    nextMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1); // Move to the next month
        fetchReservedDates(currentDate).then(() => renderCalendar(currentDate)); // Fetch and render calendar
    });

    // Initial data load
    fetchReservedDates(currentDate).then(() => renderCalendar(currentDate));
});



</script>
</body>
</html>