{% include 'header.html' %}
<title>Project Implementation </title>
<link href="static\css\materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="static\css\style.css" type="text/css" rel="stylesheet" media="screen,projection" />
{% include 'header1.html' %}


  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Forest Fire Prevention</h1>
      <div class="row center">
        <h5 class="header col s12 light">Predict the probability of Forest-Fire Occurence
          <br>
        </h5>
      </div>

      <div class="row">
        <form action="{{url_for('predict')}}" method="post" class="col s12">
          <div class="row">
            <div class="input-field col s4">
              <label for="first_name"><b>Temperature</b></label>
              <br>
              <input placeholder="Temperature in Celsius" name="Temperature" id="first_name" type="text"
                class="validate">
            </div>
            <div class="input-field col s4">

              <label for="last_name"><b>Oxygen </b></label>
              <br>
              <input id="last_name" name="Oxygen" placeholder="Oxygen content in ppm" type="text" class="validate">

            </div>

            <div class="input-field col s4">
              <label for="_name"><b>Humidity</b></label>
              <br>
              <input id="_name" name="Humidity" placeholder="Humidity %" type="text" class="validate">

            </div>

          </div>

          <div class="row center">

            <button type="submit" class="btn-large waves-effect waves-light orange">Predict Probability</button>
          </div>
        </form>
      </div>
      <br>{{pred}}<br>

      </form>
	<a href="{{ url_for('project') }}" class = "backbtn"><strong> Back </strong></a>
	<br> <br>
	<div class="description">Here is the Code Description of This  model
	<a href="{{ url_for('code_description') }}" class = "code_description_link" >Code Description </a>
</div> <br>
    <style>
     a .code_description_link {
       margin-left:20px;
     }

    </style>
      
      

    </div>
  </div>
  </div>
  </div>



  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="static\js\materialize.js"></script>
  <script src="static\js\init.js"></script>
    {% include 'footer.html' %} 