<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f4f7;
        }

        .container {
            display: flex;
        }

        aside {
            width: 220px;
            background: white;
            padding: 20px;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .menu button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: none;
            background: #e6e9ef;
            cursor: pointer;
        }

        .menu button:hover {
            background: #d9dde4;
        }

        main {
            flex: 1;
            padding: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            max-width: 700px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            background: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border: 1px solid #ccc;
        }

        .form-section {
            margin-top: 15px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        input {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input:disabled {
            background: #eee;
        }

        .edit-btn, .save-btn {
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .edit-btn {
            background: #ddd;
            margin-left: auto;
        }

        .save-btn {
            margin-top: 20px;
            background: #2563eb;
            color: white;
        }

        .save-btn:disabled {
            background: #9bb7ff;
        }
    </style>
</head>

<body>

<div class="container">
    
    <aside>
        <h2>JASHPHOTO</h2>

        <nav class="menu">
            <button>Home</button>
        </nav>
    </aside>

    <main>
        <h2>Pengaturan Profil</h2>

        <section class="card">

            <h3>Profil Saya</h3>

            <div class="profile-header">
                <label for="uploadPhoto">
                    <div id="profileImage" class="avatar">Foto</div>
                </label>
                <input type="file" id="uploadPhoto" style="display:none" accept="image/*">

                <div>
                    <h4 id="displayName">—</h4>
                    <p id="displayRole">—</p>
                </div>

                <button class="edit-btn" onclick="enableEdit()">Edit</button>
            </div>

            <form id="profileForm">

                <div class="form-section">
                    <label>First Name</label>
                    <input type="text" id="firstName" disabled>

                    <label>Last Name</label>
                    <input type="text" id="lastName" disabled>
                </div>

                <div class="form-section">
                    <label>Email</label>
                    <input type="email" id="email" disabled>

                    <label>Phone</label>
                    <input type="text" id="phone" disabled>
                </div>

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

        document.getElementById("displayName").innerText = first + " " + last;
        document.getElementById("displayRole").innerText = "User";

        document.querySelectorAll("input").forEach(el => el.disabled = true);
        document.getElementById("saveBtn").disabled = true;

        alert("Profile berhasil disimpan!");
    }
</script>

</body>
</html> 