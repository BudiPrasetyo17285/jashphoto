<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan 1</title>

    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #f4f6f9;
        }

        .container {
            display: flex;
        }

         .sidebar {
            width: 230px;
            background: #fff;
            padding: 25px 20px;
            height: 100vh;
            box-shadow: 2px 0 6px rgba(0,0,0,0.05);
        }

        .logo {
            margin-bottom: 30px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 12px; /* jarak antar menu */

        }

        .menu-item {
            width: 100%;
            text-align: left;
            padding: 12px 14px;
            background: #f1f5f9;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .menu-item:hover {
             background: #e2e8f0;

        }

        .menu-item:active {
             background: #cbd5e1;

        }

        .main-content {
            flex: 1;
            padding: 30px 40px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            max-width: 800px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
            cursor: pointer;
        }

        .avatar-empty {
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 12px;
        }

        #uploadPhoto {
            display: none;
        }

        input {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        input:disabled {
            background: #eee;
        }

        .form-section {
            margin-top: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .edit-btn {
            margin-left: auto;
            padding: 8px 14px;
            background: #eee;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .save-btn {
            margin-top: 25px;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            cursor: pointer;
        }

        .save-btn:disabled {
            background: #9bb7ff;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Sidebar tetap layout-nya -->
    <aside class="sidebar">
        <h2 class="logo">ProDeal</h2>

    <nav class="menu">
        <button class="menu-item">Home</button>
        <button class="menu-item">Create Contract</button>
        <button class="menu-item">Contracts</button>
        <button class="menu-item">Payment</button>
        <button class="menu-item">Invoice Receipts</button>
    </nav>
</aside>

    <main class="main-content">
        <header>
            <h2>Account Settings</h2>
        </header>

        <section class="card">
            <h3>My Profile</h3>

            <section class="profile-header">

                <!-- Foto profil -->
                <label for="uploadPhoto">
                    <figure id="profileImage" class="avatar avatar-empty">
                        Upload
                    </figure>
                </label>
                <input type="file" id="uploadPhoto" accept="image/*">

                <section>
                    <h4 id="displayName">—</h4>
                    <p id="displayRole">—</p>
                </section>

                <button class="edit-btn" onclick="enableEdit()">Edit</button>
            </section>

            <form id="profileForm">

                <section class="form-section">
                    <label>First Name</label>
                    <input type="text" id="firstName" placeholder="Enter first name" disabled>

                    <label>Last Name</label>
                    <input type="text" id="lastName" placeholder="Enter last name" disabled>
                </section>

                <section class="form-section">
                    <label>Email</label>
                    <input type="email" id="email" placeholder="Enter email" disabled>

                    <label>Phone</label>
                    <input type="text" id="phone" placeholder="Enter phone number" disabled>
                </section>

                <section class="form-section">
                    <label>Country</label>
                    <input type="text" id="country" placeholder="Enter country" disabled>

                    <label>City / State</label>
                    <input type="text" id="city" placeholder="Enter city or state" disabled>
                </section>

                <button type="button" id="saveBtn" class="save-btn" disabled onclick="saveProfile()">
                    Save Changes
                </button>

            </form>
        </section>
    </main>
</div>

<script>

    const uploadPhoto = document.getElementById("uploadPhoto");
    const profileDiv = document.getElementById("profileImage");

    uploadPhoto.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            img.className = "avatar";
            profileDiv.innerHTML = "";
            profileDiv.classList.remove("avatar-empty");
            profileDiv.appendChild(img);
        }
    });

    function enableEdit() {
        document.querySelectorAll("input").forEach(el => el.disabled = false);
        document.getElementById("saveBtn").disabled = false;
    }

    function saveProfile() {
        const first = document.getElementById("firstName").value;
        const last = document.getElementById("lastName").value;
        const country = document.getElementById("country").value;
        const city = document.getElementById("city").value;

        document.getElementById("displayName").innerText = first + " " + last;
        document.getElementById("displayRole").innerText = `${city} - ${country}`;

        document.querySelectorAll("input").forEach(el => el.disabled = true);
        document.getElementById("saveBtn").disabled = true;

        alert("Profile saved!");
    }
</script>

</body>
</html>