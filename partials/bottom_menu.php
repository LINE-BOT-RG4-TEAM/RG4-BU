<footer class="footer">
<div class="navbar-bottom">
  <a class="active" href="#">Home</a> 
  <a href="#">Search</a> 
  <a href="#">Contact</a> 
  <a href="#">Login</a>
</div>
</footer>
<style>

.navbar-bottom {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  bottom: 0;
  width: 100%;
}

.navbar-bottom a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
  width: 25%; /* Four links of equal widths */
  text-align: center
}

.navbar-bottom a:hover {
  background: #f1f1f1;
  color: black;
}

.navbar-bottom a.active {
  background-color: #4CAF50;
  color: white;
}
}
</style>