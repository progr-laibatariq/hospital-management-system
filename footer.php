    <style>
    /* Footer CSS - Complete Fix for Side Spacing */
.footer-bottom {
    background: #003366 ;
    color: white ;
    padding: 1.5rem 0 ;
    text-align: center ;
    position: fixed ;
    bottom: 0 ;
    left: 0 ;
    right: 0 ;
    width: 100% ;
    max-width: none ;
    margin: 0 ;
    box-sizing: border-box ;
    z-index: 1000 ;
    overflow-x: hidden ;
}


.footer-content {
    margin: 0 ;
    padding: 0 ;
    width: 100% ;
}

.footer-bottom p {
    margin: 0 ;
    padding: 0 ;
}

.footer-bottom a {
    color: rgba(255, 255, 255, 0.8) ;
    text-decoration: none ;
    transition: all 0.3s ease ;
    padding: 0 5px ;
}

.footer-bottom a:hover {
    color: #00b4d8 ;
}

/* Remove any body/html margins that might affect footer */
html {
    margin: 0 ;
    padding: 0 ;
}

body {
    margin: 0 ;
    padding: 0 ;
}

/* Main content adjustment to prevent overlap */
.main {
    padding-bottom: 100px ;
}

    </style>

    <div class="footer-bottom">
        <div class="footer-content">
            <p>&copy; 2025 Medcare Hospital. All rights reserved. | 
               <a href="#">Privacy Policy</a> | 
               <a href="#">Terms of Service</a>
            </p>
        </div>
    </div>
</body>
</html>
