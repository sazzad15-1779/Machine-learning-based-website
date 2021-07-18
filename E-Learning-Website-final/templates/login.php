{% include 'header.html' %}  
<title>Login</title>
{% include 'header1.html' %} 

 <div class="login_container">
    {% with messages = get_flashed_messages(with_categories=true) %}
  {% if messages %}
    {% for category, message in messages %}
      <div class="alert alert-{{ category }}">{{ message }}</div>
    {% endfor %}
  {% endif %}
{% endwith %}

{% if error %}
  <div class="alert alert-danger">{{error}}</div>
{% endif %}

{% if msg %}
  <div class="alert alert-success">{{msg}}</div>
{% endif %}     
      <h1>Login</h1>
  <form action="" method="POST">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form_input" placeholder ="Enter Username ..">
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form_input" placeholder ="Enter Password .."  >
    </div>
    <button type="submit" class="login_btn">LogIn</button>
  </form>
    </div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
      CKEDITOR.replace('editor')
    </script>

{% include 'footer.html' %}         
    </div>
</body>

</html> 