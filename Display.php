<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Table</title>
    <link rel="stylesheet" href="./Css/display.css">
    <style>
        /* Success message styles */
        .success-msg {
            background: #10b981;
            color: white;
            padding: 12px 20px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 8px;
            border-left: 5px solid #047857;
            font-size: 16px;
            animation: slideDown 0.5s ease;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Delete success message */
        .delete-msg {
            background: #ef4444;
            color: white;
            padding: 12px 20px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 8px;
            border-left: 5px solid #dc2626;
            font-size: 16px;
            animation: slideDown 0.5s ease;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            color: #64748b;
            font-size: 14px;
            background: #f1f5f9;
            padding: 8px 15px;
            border-radius: 8px;
        }

        .user-info strong {
            color: #1e293b;
        }

        .btn-add {
            background: #6366f1;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
            display: inline-block;
        }

        .btn-add:hover {
            background: #4f46e5;
        }

        .btn-logout {
            background: #ef4444;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
            display: inline-block;
        }

        .btn-logout:hover {
            background: #dc2626;
        }

        .search-box {
            position: relative;
            display: inline-block;
        }

        .search-box input {
            padding: 10px 35px 10px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
            width: 300px;
        }

        .search-box input:focus {
            border-color: #6366f1;
        }

        .search-box .clear-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 18px;
            display: none;
            padding: 0 5px;
            transition: color 0.3s;
        }

        .search-box .clear-btn:hover {
            color: #ef4444;
        }

        .search-box .clear-btn.visible {
            display: block;
        }

        @media (max-width: 768px) {
            .header-actions {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box input {
                width: 100%;
            }
            
            .btn-add, .btn-logout {
                text-align: center;
            }

            .header-left {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <h1>User Data Table</h1>

    <!-- Success Message for Insert -->
    <?php if(isset($_GET['insert']) && $_GET['insert'] == 'success') { ?>
        <div id="successMsg" class="success-msg">
            ✅ New user added successfully!
        </div>
    <?php } ?>

    <!-- Success Message for Update -->
    <?php if(isset($_GET['update']) && $_GET['update'] == 'success') { ?>
        <div id="successMsg" class="success-msg">
            ✅ User details updated successfully!
        </div>
    <?php } ?>

    <!-- Success Message for Delete -->
    <?php if(isset($_GET['delete']) && $_GET['delete'] == 'success') { ?>
        <div id="deleteMsg" class="delete-msg">
            🗑️ User deleted successfully!
        </div>
    <?php } ?>

    <!-- Header with Add User Button and Search -->
    <div class="header-actions">
        <div class="header-left">
            <a href="insert.php" class="btn-add">➕ Add New User</a>
            <span class="user-info">👤 Logged in as: <strong><?php echo $_SESSION['user_name']; ?></strong></span>
            <a href="logout.php" class="btn-logout">🚪 Logout</a>
        </div>
        
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search users...">
            <button class="clear-btn" id="clearSearch">✕</button>
        </div>
    </div>

    <!-- Table -->
    <div id="tableContainer">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php include 'display.inc.php'; ?>
        </table>
    </div>

</div>

<script>
// Get elements
const searchInput = document.getElementById("searchInput");
const clearBtn = document.getElementById("clearSearch");
const tableRows = document.querySelectorAll("table tr");
const tableContainer = document.getElementById("tableContainer");

// Auto-hide success messages after 3 seconds
const successMsg = document.getElementById("successMsg");
if (successMsg) {
    setTimeout(function() {
        successMsg.style.transition = 'opacity 0.5s ease';
        successMsg.style.opacity = '0';
        setTimeout(function() {
            successMsg.style.display = 'none';
        }, 500);
    }, 3000);
}

// Auto-hide delete message after 3 seconds
const deleteMsg = document.getElementById("deleteMsg");
if (deleteMsg) {
    setTimeout(function() {
        deleteMsg.style.transition = 'opacity 0.5s ease';
        deleteMsg.style.opacity = '0';
        setTimeout(function() {
            deleteMsg.style.display = 'none';
        }, 500);
    }, 3000);
}

// Search functionality
searchInput.addEventListener("keyup", function () {
    let filter = searchInput.value.toLowerCase().trim();

    tableRows.forEach((row, index) => {
        if (index === 0) return; // Skip header

        let text = row.textContent.toLowerCase();
        
        if (filter === "" || text.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });

    // Show/hide clear button
    if (filter.length > 0) {
        clearBtn.classList.add("visible");
    } else {
        clearBtn.classList.remove("visible");
    }

    // Show "No results" message if needed
    let noResultMsg = document.getElementById("noResultsMsg");
    let visibleRows = 0;
    
    tableRows.forEach((row, index) => {
        if (index === 0) return;
        if (row.style.display !== "none") {
            visibleRows++;
        }
    });

    if (visibleRows === 0 && tableRows.length > 1) {
        if (!noResultMsg) {
            noResultMsg = document.createElement("tr");
            noResultMsg.id = "noResultsMsg";
            noResultMsg.innerHTML = `<td colspan="5" style="text-align:center;padding:30px;color:#64748b;font-size:18px;">
                🔍 No users found matching "<strong>${filter}</strong>"
            </td>`;
            document.querySelector("table").appendChild(noResultMsg);
        } else {
            noResultMsg.style.display = "";
            noResultMsg.innerHTML = `<td colspan="5" style="text-align:center;padding:30px;color:#64748b;font-size:18px;">
                🔍 No users found matching "<strong>${filter}</strong>"
            </td>`;
        }
    } else if (noResultMsg) {
        noResultMsg.style.display = "none";
    }
});

// Clear search
clearBtn.addEventListener("click", function() {
    searchInput.value = "";
    searchInput.dispatchEvent(new Event('keyup'));
    clearBtn.classList.remove("visible");
    searchInput.focus();
});
</script>

</body>
</html>