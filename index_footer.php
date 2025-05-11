<head>
<style>
/* Footer Styling */
.footer {
    background: #0f3859;
    color: white;
    padding: 40px 0 0;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}

.container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    max-width: 1100px;
    margin: auto;
}

/* Bigger Logo */
.footer-logo {
    font-size: 32px; /* Increased size */
    /* font-weight: bold; */
    color: white;
    text-transform: uppercase;
    margin-top: 40px;
}

.footer-logo span {
    color: #fdfce5;
}

.footer-links h3,
.footer-contact h3 {
    font-size: 18px;
    color: #fdfce5;
    margin-bottom: 10px;
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links ul li {
    margin: 8px 0;
}

.footer-links ul li a {
    text-decoration: none;
    color: white;
    transition: 0.3s;
}

.footer-links ul li a:hover {
    color: #fdfce5;
}

.footer-contact p {
    margin: 5px 0;
    font-size: 14px;
}

.footer-contact a {
    color: #fdfce5;
    text-decoration: none;
}

.footer-bottom {
    background: #09273e;
    padding: 12px;
    margin-top: 20px;
    font-size: 14px;
}

.footer-bottom span {
    color: #fdfce5;
    font-weight: bold;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        text-align: center;
    }

    .footer-logo {
        font-size: 36px; /* Even bigger logo on mobile */
    }
}
</style>
    <!-- <link rel="stylesheet" href="./css/hello.css"> -->
</head>

<div class="footer-container">
<footer class="footer">
    <div class="container">
        <div class="footer-logo text-warning">Page<span>Turner</span></div>

        <div class="footer-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Category</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="footer-contact">
            <h3>Contact</h3>
            <p>📞 +91 8767062627</p>
            <p>📧 <a href="mailto:contact@PageTurner.com">contact@PageTurner.com</a></p>
            <p>📍 Address: Pune</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>Developed By <span>Aditya Todmal</span> | Copyright © 2025 All Rights Reserved</p>
    </div>
</footer>
</div>
