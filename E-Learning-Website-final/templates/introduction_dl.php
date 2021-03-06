{% include 'header.html' %}  
<title>Deep Learning</title>
{% include 'header1.html' %} 
    <div class="main_body">

    {% include 'dl_topic.html' %}
        <div class="middle_body">
        
       <h1> Welcome to Deep Learning! </h1>
<p> Welcome to our Introduction to Deep Learning course! You&#39;re about to learn all you need to get
started building your own deep neural networks. Using Keras and Tensorflow you&#39;ll learn how to: </p>
<ul> 
    <li>create a fully-connected neural network architecture</li> 
    <li>apply neural nets to two classic ML problems: regression and classification</li>
    <li>train neural nets with stochastic gradient descent, and</li>
    <li>improve performance with dropout, batch normalization, and other techniques</li>
</ul>
    <h1>What is Deep Learning?</h1>
    <p>Some of the most impressive advances in artificial intelligence in recent years have been in the field
of deep learning. Natural language translation, image recognition, and game playing are all tasks
where deep learning models have neared or even exceeded human-level performance.</p>
<p>So what is deep learning? Deep learning is an approach to machine learning characterized by deep
stacks of computations. This depth of computation is what has enabled deep learning models to
disentangle the kinds of complex and hierarchical patterns found in the most challenging real-world
datasets.</p>
<p>Through their power and scalability neural networks have become the defining model of deep
learning. Neural networks are composed of neurons, where each neuron individually performs only a
simple computation. The power of a neural network comes instead from the complexity of the
connections these neurons can form.</p>
<h2>Building the Intuition</h2>
<p>Generally speaking, deep learning is a machine learning method that takes in an input X, and uses it to predict an output of Y. 
    As an example, given the stock prices of the past week as input, my deep learning algorithm will try to predict the stock price of the next day. <br>
Given a large dataset of input and output pairs, a deep learning algorithm will try to minimize the difference between its prediction and expected output.
 By doing this, it tries to learn the association/pattern between given inputs and outputs — this in turn allows a deep learning model to generalize to inputs that it hasn’t seen before.</p>
<img class="image_introduction"src="{{url_for('static', filename='computer_notebook.jpg')}}" alt="layer connections">
<h2>How Do Deep Learning algorithms “learn”?</h2>
<p>Deep Learning Algorithms use something called a neural network to find associations between a set of inputs and outputs. The basic structure is seen below:</p>
<img src="neural_network.jfif" alt="no image found" class="image_introduction">
<p>A neural network is composed of input, hidden, and output layers — all of which are composed of “nodes”. Input layers take in a numerical representation of data (e.g. images with pixel specs), output layers output predictions, while hidden layers are correlated with most of the computation.</p>
<img src="activation_function.png" alt="not found image" class="image_introduction">
<p>I won’t go too in depth into the math, but information is passed between network layers through the function shown above. The major points to keep note of here are the tunable weight and bias parameters — represented by w and b respectively in the function above. These are essential to the actual “learning” process of a deep learning algorithm.</p>
<p>After the neural network passes its inputs all the way to its outputs, the network evaluates how good its prediction was (relative to the expected output) through something called a loss function. As an example, the “Mean Squared Error” loss function is shown below.</p>
<img src="function.png" alt="not found" class="image_introduction">
<h5>Y hat represents the prediction, while Y represents the expected output. A mean is used if batches of inputs and outputs are used simultaneously (n represents sample count)</h5>
<p>The goal of my network is ultimately to minimize this loss by adjusting the weights and biases of the network. In using something called “back propagation” through gradient descent, the network backtracks through all its layers to update the weights and biases of every node in the opposite direction of the loss function — in other words, every iteration of back propagation should result in a smaller loss function than before.</p>
<p>Without going into the proof, the continuous updates of the weights and biases of the network ultimately turns it into a precise function approximator — one that models the relationship between inputs and expected outputs.</p>        
<h2>So why is it called “Deep” Learning?</h2>
<p>The “deep” part of deep learning refers to creating deep neural networks. This refers a neural network with a large amount of layers — with the addition of more weights and biases, the neural network improves its ability to approximate more complex functions.</p>
<br><br>

<form action="/quiz" method="POST">
<button type = "submit" class="quiz_btn" > Go to Quiz</button>
</form>





</div>
        <div class="right_body">
          

        
        </div>

    </div>

    {% include 'footer.html' %}         
    </div>
</body>

</html> 