<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminp.css">
    <title>adminpanel</title>
<style>
    .form-container {
    margin-top: 15px;
    background-color: white;
    padding: 20px;
    border-radius: 15px;
    width: 800px;
    margin-left: 15px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
    }

    .form-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    }
    .form-group label{
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    margin-right:20px;
    }
    label {
    width: 50px;
    font-size: 14px;
    margin-right: 10px;
    }

    .input-field {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: white;
    color: black;
    font-size: 14px;
    border: 1px solid black;
    width: 80px;
    }

    .check-btn, .add-btn {
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    background-color: #6ec092;
    color: black;
    font-size: 14px;
    cursor: pointer;
    margin-left: 10px;
    align-items: center;
    }



    .add-btn {
    width: 200px;
    background-color: #6ec092;

    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease; 
    }
    .add-btn:hover {
    transform: translateY(-5px); 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    }
        .search-results-section{
    margin-left: 20px;
    margin-right:20px;
    margin-bottom:20px;
    }
        .transaction-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #f9f9f9; 
    border-radius: 5px;
    overflow: hidden;

    }

    .transaction-table thead {
    background-color: #808c73;
    }

    .transaction-table th,
    .transaction-table td {
    padding: 10px;
    text-align: left;
    font-size: 14px;
    color: black;
    }

    .transaction-table tbody tr {
    border-bottom: 1px solid #ddd;
    }

    .transaction-table tbody tr:last-child {
    border-bottom: none;
    } 
    .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6); /* Darker background for better contrast */
    }

    .modal-content {
    background-color: #fff;
    margin: 5% auto; /* Reduced margin for better centering */
    padding: 30px; /* Increased padding for better spacing */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Soft shadow for depth */
    width: 50%; /* Adjusted width for a more compact look */
    height:75%;
    }

    .close-btn {
    float: right;
    cursor: pointer;
    font-size: 1.5em; /* Larger close button */
    color: #333; /* Darker color for visibility */
    }

    h3 {
    color: #333; /* Consistent color for the heading */
    margin-bottom: 20px; /* Space below heading */
    }

    label {
    display: block; /* Labels on separate lines */
    margin-top: 10px; /* Space above labels */
    font-weight: bold; /* Bold labels for emphasis */
    }

    input[type="text"],
    input[type="date"] {
    width: calc(100% - 20px); /* Full-width inputs with padding */
    padding: 10px; /* Inner padding for comfort */
    border: 1px solid #ccc; /* Light border */
    border-radius: 5px; /* Rounded edges */
    margin-top: 5px; /* Space above inputs */
    }

    button {
    background-color: #28a745; /* Green background for update */
    color: white; /* White text */
    border: none;
    border-radius: 5px; /* Rounded button edges */
    padding: 10px 15px; /* Button padding */
    cursor: pointer;
    margin-top: 15px; /* Space above buttons */
    transition: background-color 0.3s; /* Smooth hover effect */
    }

    button:hover {
    background-color: #218838; /* Darker green on hover */
    }

    button:nth-of-type(2) {
    background-color: #dc3545; /* Red background for delete */
    }

    button:nth-of-type(2):hover {
    background-color: #c82333; /* Darker red on hover */
    }

    /* Container Styling */
    .table-container {
    width: 90%;  /* Table takes 80% of the screen width */
    margin: 20px auto;  /* Centered horizontally with margin on top/bottom */
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for the div */
    border-radius: 10px; /* Rounded corners */
    }

    /* Table Styling */
    .user-info-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Arial', sans-serif;
    text-align: left;
    color: #333;  /* Normal text color */
    }

    /* Header Styling */
    .user-info-table th {
    padding: 12px;
    background-color: #808c73; /* Green background */
    color: black;
    font-size: 14px;

    border-bottom: 1px solid #ddd;
    }

    /* Body Styling */
    .user-info-table td {
    padding: 10px 15px;
    border-bottom: 1px solid #ddd;
    font-size: 13px;
    }

    /* Zebra Striping for Rows */
    .user-info-table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
    }

    /* Hover Effect on Rows */
    .user-info-table tbody tr:hover {
    background-color: #f1f1f1;
    }

    /* Action Buttons Styling */
    .user-info-table .action-btn {
    padding: 6px 12px;
    font-size: 12px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin: 0 5px;
    transition: background-color 0.3s ease;
    }

    .user-info-table .action-btn.delete {
    background-color: #f44336; /* Red */
    color: white;
    }

    .user-info-table .action-btn.delete:hover {
    background-color: #e53935;
    }

    /* Other existing styles */



    /* Responsive Design */
    @media (max-width: 768px) {
    .table-container {
    width: 95%;  /* Increase width to 95% on smaller screens */
    padding: 10px;
    }

    .user-info-table th, .user-info-table td {
    font-size: 12px;
    padding: 8px;
    }
    }



    /* Dialog Styles */
    .dialog-box {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    }

    .dialog-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    max-width: 90%;
    position: relative;
    }

    .logged-in-modal-dialog {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    }

    .logged-in-modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    max-width: 90%;
    text-align: center;
    }

    .close-btn {
    position: absolute;
    right: 10px;
    top: 10px;
    font-size: 24px;
    cursor: pointer;
    color: #666;
    }

    .close-btn:hover {
    color: #333;
    }

    .form-group {
    margin-bottom: 15px;
    }

    .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    }

    .form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    }

    .btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    }

    .btn-primary {
    background-color: #007bff;
    color: white;
    }

    .btn-primary:hover {
    background-color: #0056b3;
    }

    .btn-danger {
    background-color: #dc3545;
    color: white;
    }

    .btn-danger:hover {
    background-color: #c82333;
    }

    #admin-login-link {
    cursor: pointer;
    }

    button {
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }

    button:hover {
    background-color: #0056b3;
    }

    /* Add these styles to your existing CSS */
    .dialog-box.force-show {
    display: flex !important;
    }

    .navbar nav {
    transition: display 0.3s ease;
    }

    .page-section {
    transition: display 0.3s ease;
    }

    .page-section {
    display: none;
    padding: 20px;
    }

    .nav-link.active {
    background-color: #f0f0f0;
    color: #333;
    }

    #admin-login-link {
    cursor: pointer;
    }

    #admin-login-link:hover {
    opacity: 0.8;
    }

</style>

</head>
<body>
<div class="navbar">
        <div class="logo">
            <img src="logo.png" alt="logo" height="30px" width="50px">
        </div>
        <nav>
            <ul>
            <li><a class="nav-link"  href="#users-section">Users</a></li>
                <li><a class="nav-link" href="#edit-Employee-section">Empolyees</a></li>
                
                
                <li>
                    <a class="nav-link" id="admin-login-link" href="#" style="cursor: pointer;">
                        <img src="user-solid.svg" alt="SVG Image" width="15" height="15">
                    </a>
                </li>
            </ul>
        </nav>
</div>

<section id="edit-Employee-section" class="page-section">
    <div class="form-container">
        <form id="reservationForm1" enctype="multipart/form-data">
            <div class="form-group">
                <label for="emp-name">Name:</label>
                <input type="text" id="emp-name" name="name" class="input-field" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label for="emp-mobile">Mobile No:</label>
                <input type="text" id="emp-mobile" name="mobile_no" class="input-field" placeholder="Enter mobile number" required>
            </div>
            <div class="form-group">
                <label for="emp-post">Post:</label>
                <select id="emp-post" name="Post" class="input-field" required>
                    <option value="" disabled selected>Select a position</option>
                    <option value="Manager">Manager</option>
                    <option value="Cook">Cook</option>
                    <option value="Reception">Reception</option>
                    <option value="Waiter">Waiter</option>
                </select>
            </div>
            <div class="form-group">
                <label for="emp-password">Password:</label>
                <input type="password" id="emp-password" name="password" class="input-field" placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <label for="emp-date">Joined-Date:</label>
                <input type="date" id="emp-date" name="date" class="input-field" required>
            </div>
            <div class="form-group">
                <label for="emp-login-code">Login Code:</label>
                <input type="password" id="emp-login-code" name="login_code" class="input-field" placeholder="Enter login code" required>
            </div>
            
            <div class="form-group">
                <button type="submit" id="addEmployee" class="add-btn">Add</button>
            </div>
        </form>
    </div>


    <div class="search-results-section">
    <h3>Employees</h3>
    <table class="transaction-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Post</th>
                <th>Password</th>
                <th>Joined Date</th>
                <th>Login Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="search-results">
            <!-- Data will be populated by JavaScript -->
        </tbody>
    </table>
 </div>

 <div id="editDialog" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditDialog()">×</span>
        <h3>Edit Employee</h3>
        <form id="editEmployeeForm">
            <input type="hidden" id="edit-emp-id">
            <label for="edit-emp-name">Name:</label>
            <input type="text" id="edit-emp-name" name="name" required><br>
            <label for="edit-emp-mobile">Mobile No:</label>
            <input type="text" id="edit-emp-mobile" name="mobile_no" required><br>
            <label for="edit-emp-post">Post:</label>
            <input type="text" id="edit-emp-post" name="post" required><br>
            <label for="edit-emp-password">Password:</label>
            <input type="text" id="edit-emp-password" name="password" required><br>
            <label for="edit-emp-joined-date">Joined Date:</label>
            <input type="date" id="edit-emp-joined-date" name="joined_date" required><br>
            <label for="edit-emp-login-code">Login Code:</label>
            <input type="text" id="edit-emp-login-code" name="login_code" required><br>
            <button type="button" onclick="updateEmployee()">Update</button>
            <button type="button" onclick="deleteEmployee()">Delete</button>
        </form>
    </div>
 </div>




</section>
<section id="users-section" class="page-section">
  <div class="table-container">
  <table class="user-info-table">
    <thead>
      <tr>
        <th>Username</th>
        <th>User Email</th>
        <th>Account Created</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- Rows will be added dynamically -->
    </tbody>
  </table>
 </div>



</section>


</body>

<script src="chart.js"></script>
<script src="jquery-3.6.0.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    console.log('Script started');

    // Create and append the dialog elements
    function createDialogs() {
        // Create Admin Login Dialog
        const loginDialog = document.createElement('div');
        loginDialog.className = 'dialog-box';
        loginDialog.id = 'admin-login-dialog';
        loginDialog.innerHTML = `
            <div class="dialog-content">
                <span class="close-btn" id="close-admin-login-dialog">&times;</span>
                <h2>Admin Login</h2>
                <form id="admin-login-form">
                    <div class="form-group">
                        <label for="admin-username">Username:</label>
                        <input type="text" id="admin-username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="admin-password">Password:</label>
                        <input type="password" id="admin-password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div id="admin-error-message" style="color: red;"></div>
                </form>
            </div>
        `;

        // Create Admin Logged In Dialog
        const loggedInDialog = document.createElement('div');
        loggedInDialog.className = 'logged-in-modal-dialog';
        loggedInDialog.id = 'admin-logged-in-dialog';
        loggedInDialog.innerHTML = `
            <div class="logged-in-modal-content">
                <span class="close-btn logged-in-close-btn">&times;</span>
                <p>Logged in as: <span id="admin-logged-in-username"></span></p>
                <button id="admin-logout-btn" class="btn btn-danger">Logout</button>
            </div>
        `;

        // Append dialogs to body
        document.body.appendChild(loginDialog);
        document.body.appendChild(loggedInDialog);
        
        console.log('Dialogs created:', {
            loginDialog: document.getElementById('admin-login-dialog'),
            loggedInDialog: document.getElementById('admin-logged-in-dialog')
        });
    }

    // Create dialogs first
    createDialogs();

    const elements = {
        sections: document.querySelectorAll(".page-section"),
        navLinks: document.querySelectorAll(".nav-link"),
        adminLoginLink: document.getElementById('admin-login-link'),
        adminLoginDialog: document.getElementById('admin-login-dialog'),
        adminLoggedInDialog: document.getElementById('admin-logged-in-dialog'),
        closeAdminLoginDialog: document.getElementById('close-admin-login-dialog'),
        adminLoggedInUsername: document.getElementById('admin-logged-in-username'),
        adminLogoutBtn: document.getElementById('admin-logout-btn'),
        adminLoginForm: document.getElementById('admin-login-form'),
        adminErrorMessage: document.getElementById('admin-error-message')
    };

    console.log('Elements found:', elements);

    // Function to show specific section and update URL
    function showSection(sectionId) {
        console.log('Showing section:', sectionId);
        elements.sections.forEach(section => {
            if (section.id === sectionId) {
                section.style.display = 'block';
                // Store current section in localStorage
                localStorage.setItem('currentSection', sectionId);
                // Update URL hash
                window.location.hash = sectionId;
            } else {
                section.style.display = 'none';
            }
        });

        // Update active nav link
        elements.navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href.substring(1) === sectionId) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    // Function to check login status
    function checkLoginStatus() {
        fetch('AdminLogin.php?check_login=true')
            .then(response => response.json())
            .then(data => {
                if (!data.logged_in) {
                    // Hide all sections and navigation
                    elements.sections.forEach(section => {
                        section.style.display = 'none';
                    });
                    document.querySelector('.navbar nav').style.display = 'none';
                    // Show login dialog
                    elements.adminLoginDialog.style.display = 'flex';
                } else {
                    // Show navigation
                    document.querySelector('.navbar nav').style.display = 'block';
                    
                    // Get section from URL hash or localStorage or default to main-section
                    const hash = window.location.hash.substring(1);
                    const storedSection = localStorage.getItem('currentSection');
                    const sectionToShow = hash || storedSection || 'main-section';
                    
                    showSection(sectionToShow);
                    sessionStorage.setItem('adminLoggedIn', 'true');
                    sessionStorage.setItem('adminUsername', data.username);
                }
            })
            .catch(error => {
                console.error('Error checking login status:', error);
                elements.adminLoginDialog.style.display = 'flex';
            });
    }

    // Add click handlers to nav links
    elements.navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.id !== 'admin-login-link') {
                e.preventDefault();
                const sectionId = this.getAttribute('href').substring(1);
                showSection(sectionId);
            }
        });
    });

    // Handle URL hash changes
    window.addEventListener('hashchange', function() {
        const hash = window.location.hash.substring(1);
        if (hash && sessionStorage.getItem('adminLoggedIn')) {
            showSection(hash);
        }
    });

    // Check login status when page loads
    checkLoginStatus();

    // Handle admin icon click
    if (elements.adminLoginLink) {
        elements.adminLoginLink.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Admin icon clicked');
            if (sessionStorage.getItem('adminLoggedIn')) {
                elements.adminLoggedInDialog.style.display = 'flex';
                if (elements.adminLoggedInUsername) {
                    elements.adminLoggedInUsername.textContent = sessionStorage.getItem('adminUsername');
                }
            } else {
                elements.adminLoginDialog.style.display = 'flex';
            }
        });
    }

    // Handle login form submission
    if (elements.adminLoginForm) {
        elements.adminLoginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('admin-username').value;
            const password = document.getElementById('admin-password').value;

            fetch('AdminLogin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    login: true,
                    username: username,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    sessionStorage.setItem('adminLoggedIn', 'true');
                    sessionStorage.setItem('adminUsername', data.username);
                    elements.adminLoginDialog.style.display = 'none';
                    document.querySelector('.navbar nav').style.display = 'block';
                    showSection('main-section');
                } else {
                    elements.adminErrorMessage.textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                elements.adminErrorMessage.textContent = 'An error occurred';
            });
        });
    }

    // Handle logout
    if (elements.adminLogoutBtn) {
        elements.adminLogoutBtn.addEventListener('click', function() {
            fetch('AdminLogin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'logout=true'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    sessionStorage.removeItem('adminLoggedIn');
                    sessionStorage.removeItem('adminUsername');
                    elements.adminLoggedInDialog.style.display = 'none';
                    // Hide all sections and navigation
                    elements.sections.forEach(section => {
                        section.style.display = 'none';
                    });
                    document.querySelector('.navbar nav').style.display = 'none';
                    // Show login dialog
                    elements.adminLoginDialog.style.display = 'flex';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Close dialog buttons
    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const dialog = this.closest('.dialog-box, .logged-in-modal-dialog');
            if (dialog) {
                dialog.style.display = 'none';
            }
        });
    });

    // Close dialogs when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('dialog-box') || 
            event.target.classList.contains('logged-in-modal-dialog')) {
            event.target.style.display = 'none';
        }
    });
});


document.getElementById('reservationForm1').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);

    fetch('AddEmployee.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Employee added successfully!');
            // Optionally, reset the form
            document.getElementById('reservationForm1').reset();
        } else {
            alert('Error adding employee: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        alert('Error: ' + error);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    fetchEmployees();
});

function fetchEmployees() {
    fetch('FetchEmpData.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('search-results');
            tableBody.innerHTML = ''; // Clear previous results

            data.forEach(employee => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${employee.id}</td>
                    <td>${employee.name}</td>
                    <td>${employee.mobile_no}</td>
                    <td>${employee.post}</td>
                    <td>${employee.password}</td>
                    <td>${employee.joined_date}</td>
                    <td>${employee.login_code}</td>
                    <td><button onclick="openEditDialog(${employee.id})">Edit</button></td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching employee data:', error));
  }

  function openEditDialog(id) {
    fetch(`FetchEmpData.php?id=${id}`)
        .then(response => response.json())
        .then(employee => {
            document.getElementById('edit-emp-id').value = employee.id;
            document.getElementById('edit-emp-name').value = employee.name;
            document.getElementById('edit-emp-mobile').value = employee.mobile_no;
            document.getElementById('edit-emp-post').value = employee.post;
            document.getElementById('edit-emp-password').value = employee.password;
            document.getElementById('edit-emp-joined-date').value = employee.joined_date;
            document.getElementById('edit-emp-login-code').value = employee.login_code;

            document.getElementById('editDialog').style.display = 'flex';
        })
        .catch(error => console.error('Error fetching employee details:', error));
 }

 function closeEditDialog() {
    document.getElementById('editDialog').style.display = 'none';
 }

 function updateEmployee() {
    const formData = new FormData(document.getElementById('editEmployeeForm'));
    formData.append('id', document.getElementById('edit-emp-id').value);
    formData.append('action', 'update');

    fetch('updateemployee.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Employee updated successfully');
                fetchEmployees();
                closeEditDialog();
            } else {
                alert('Update failed');
            }
        })
        .catch(error => console.error('Error updating employee:', error));
 }

 function deleteEmployee() {
    const id = document.getElementById('edit-emp-id').value;

    if (!confirm('Are you sure you want to delete this employee?')) return;

    fetch('updateemployee.php', {
        method: 'POST',
        body: new URLSearchParams({
            'id': id,
            'action': 'delete'
        })
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Employee deleted successfully');
                fetchEmployees();
                closeEditDialog();
            } else {
                alert('Delete failed');
            }
        })
        .catch(error => console.error('Error deleting employee:', error));
 }

 
 window.onload = function() {
    fetchEmployees();
}
function fetchEmployeeActions() {
    fetch('EmpActions.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tableBody = document.getElementById('search-resul');
                tableBody.innerHTML = ''; // Clear existing rows

                data.actions.forEach(action => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${new Date(action.action_time).toLocaleDateString()}</td>
                        <td>${action.name}</td>
                        <td>${action.post}</td>
                        <td>${new Date(action.action_time).toLocaleTimeString()}</td>
                        <td>${action.action}</td>
                    `;
                    tableBody.appendChild(row);
                });
            } else {
                console.error('Error fetching actions:', data.message);
            }
        })
        .catch(error => console.error('Error fetching employee actions:', error));
}
fetchEmployeeActions();

document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch and display users
    function fetchUsers() {
        fetch('fetchdeleteusers.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('.user-info-table tbody');
                tableBody.innerHTML = ''; // Clear existing rows

                data.forEach(user => {
                    const row = document.createElement('tr');

                    const usernameCell = document.createElement('td');
                    usernameCell.textContent = user.username;

                    const emailCell = document.createElement('td');
                    emailCell.textContent = user.email;

                    const createdAtCell = document.createElement('td');
                    createdAtCell.textContent = user.created_at;

                    const actionsCell = document.createElement('td');
                    const deleteBtn = document.createElement('button');
                    deleteBtn.classList.add('action-btn', 'delete');
                    deleteBtn.textContent = 'Delete';
                    deleteBtn.addEventListener('click', function() {
                        deleteUser(user.id);
                    });

                    actionsCell.appendChild(deleteBtn);
                    row.appendChild(usernameCell);
                    row.appendChild(emailCell);
                    row.appendChild(createdAtCell);
                    row.appendChild(actionsCell);

                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching users:', error));
    }

    // Function to delete a user
    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            fetch('fetchdeleteusers.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `action=delete&user_id=${userId}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Show success or error message
                fetchUsers(); // Re-fetch users after deletion
            })
            .catch(error => console.error('Error deleting user:', error));
        }
    }

    // Initial fetch of users
    fetchUsers();
});


</script>
</html>